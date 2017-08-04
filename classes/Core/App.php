<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 13:32
 */

namespace Core;


class App
{
    /**
     * @var Router
     */
    protected $_router;
    /**
     * @var Response
     */
    protected $_response;

    public function __construct(Router $router)
    {
        $this->_setRouter($router);
        $this->setResponse(new Response());
    }

    public function run()
    {
        $router = $this->getRouter();
        $resource = $router->getResource();
        $method = $router->getMethod();

        if(empty($resource) || empty($method))
        {
            $this->_response->setCode(404);
            $this->_response->forgeResponse();
            return;
        }
        $verb = $router->getRequest()->getVerb();
        $param = $router->getInUrlParam();
        //specific rule for edit and delete rules
        if($verb === 'PUT' || $verb === 'DELETE' && empty($param))
        {
            $this->_response->setCode(400);
            $this->_response->setBody('Missing id param');
            $this->_response->forgeResponse();
            return;
        }

        try
        {
            // start instantiate resource and call method
            $class = new $resource($this->getResponse(), $this->getRouter()->getRequest());
            if(!empty($param))
            {
                $class->$method($param);
            }
            else
            {
                $class->$method();
            }
        }
        catch (\Exception $e)
        {
            $this->_response->setCode(500);
            $this->_response->setBody($e->getMessage());
        }
        // send response
        $this->_response->forgeResponse();
        return;
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        return $this->_router;
    }

    /**
     * @param Router $router
     * @return Router
     */
    private function _setRouter(Router $router)
    {
        $this->_router = $router;
        return $this->getRouter();
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function setResponse(Response $response)
    {
        $this->_response = $response;
        return $this->getResponse();
    }
}