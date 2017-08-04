<?php
namespace Core;
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 12:53
 */
class Router
{
    /**
     * @var Request
     */
    protected $_request;
    /**
     * @var string
     */
    protected $_resource = null;
    /**
     * @var string
     */
    protected $_method = null;
    /**
     * @var string
     */
    protected $_inUrlParam = null;

    const RESOURCE_NAMESPACE = '\\Resource\\';
    const ALLOWED_VERB = ['GET','POST','PUT','DELETE'];


    public function __construct(Request $request)
    {
        $this->setRequest($request);
    }

    /**
     * get method from the url and the verb
     *
     * @return string
     */
    public function getResource()
    {
        // we look if we already done the resource parsing
        if(empty($this->_resource))
        {
            //we get url parts from the request
            $parts = $this->getRequest()->getUrlParts();
            //we look for the real first part
            $className = ucfirst($parts[0]);
            if(empty($parts[0]))
            {
                $className = ucfirst($parts[1]);
            }
            // we check the class and if exist we store it and send it
            if(class_exists(self::RESOURCE_NAMESPACE.$className))
            {
                return $this->setResource(self::RESOURCE_NAMESPACE.$className);
            }
        }
        //In that case the resource is already found
        return $this->_resource;
    }

    /**
     * get method from the url and the verb
     *
     * @return string
     */
    public function getMethod()
    {
        if(is_null($this->_method))
        {
            $method = "";
            $parts = $this->getRequest()->getUrlParts();
            $parts = $this->_cleanFirstUrlParts($parts);
            //if we always have parts we check for specific route
            if(!empty($parts) && !empty($parts[0]) && !is_numeric($parts[0]))
            {
                $resource = $this->getResource();
                $instance = new $resource(new Response(), $this->getRequest());
                //we look if the method exist
                $tmpMethod =strtolower($parts[0]).'Action';
                if(method_exists($instance, $tmpMethod))
                {
                    $method = $tmpMethod;
                }
            }
            // if the previous doen't work and the no other params after we just set the verb action
            if($method === "" && !isset($parts[1]) || empty($parts[1]))
            {
                $method = strtolower($this->getRequest()->getVerb()) . 'Action';
            }
            $this->setMethod($method);
        }
        return $this->_method;
    }

    /**
     * get the in url param if exist
     *
     * @return string
     */
    public function getInUrlParam()
    {
        if(empty($this->_inUrlParam))
        {
            $parts = $this->getRequest()->getUrlParts();
            $parts = $this->_cleanFirstUrlParts($parts);
            if(!empty($parts) && !empty($parts[0]))
            {
                if(is_numeric($parts[0]))
                {
                    return $this->setInUrlParam($parts[0]);
                }
                $resource = $this->getResource();
                $instance = new $resource(new Response(), $this->getRequest());
                //we look if the method exist
                $tmpMethod =strtolower($parts[0]).'Action';
                if(!method_exists($instance, $tmpMethod))
                {
                    return $this->setInUrlParam($parts[0]);
                }
                else
                {
                    if(isset($parts[1]) && !empty($parts[1]))
                    {
                        return $this->setInUrlParam($parts[1]);
                    }
                }
            }
        }
        return $this->_inUrlParam;
    }

    /**
     * Return stored request
     *
     * @return \Core\Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Set stored request
     *
     * @param Request $request
     * @return Request
     */
    public function setRequest(Request $request)
    {
        $this->_request = $request;
        return $this->getRequest();
    }

    /**
     * Set stored resource
     *
     * @param string $resource
     * @return string
     */
    public function setResource($resource)
    {
        $this->_resource = $resource;
        return $this->getResource();
    }

    /**
     * Set stored method
     *
     * @param string $method
     * @return string
     */
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this->getMethod();
    }

    /**
     * Set stored inUrlParam
     *
     * @param string $inUrlParam
     * @return string
     */
    public function setInUrlParam($inUrlParam)
    {
        $this->_inUrlParam = $inUrlParam;
        return $this->getInUrlParam();
    }

    /**
     * @param array $urlParts
     * @return array
     */
    private function _cleanFirstUrlParts($urlParts)
    {
        //if part 0 empty we also delete part 1
        if(empty($urlParts[0]))
        {
            unset($urlParts[1]);
        }
        // always delete part 0
        unset($urlParts[0]);
        // rebuild index
        $urlParts = array_values($urlParts);
        return $urlParts;
    }
}