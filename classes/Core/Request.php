<?php
namespace Core;
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 12:53
 */
class Request
{
    /**
     * @var string
     */
    protected $_referrer;
    /**
     * @var string
     */
    protected $_url;
    /**
     * @var array
     */
    protected $_params = [];
    /**
     * @var string
     */
    protected $_scheme;
    /**
     * @var string
     */
    protected $_verb;
    /**
     * @var array
     */
    protected $_urlParts = [];

    public function __construct()
    {
        $this->setReferrer($_SERVER['REMOTE_ADDR']);
        $this->setUrl($_SERVER['REDIRECT_URL']);
        $this->setScheme($_SERVER['REQUEST_SCHEME']);
        $this->setVerb($_SERVER['REQUEST_METHOD']);
        $this->setParams($_REQUEST);
    }

    /**
     * @return string
     */
    public function getReferrer()
    {
        return $this->_referrer;
    }

    /**
     * @param string $value
     * @return string
     */
    public function setReferrer($value)
    {
        $this->_referrer = $value;
        return $this->getReferrer();
    }
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }
    /**
     * @param string $value
     * @return string
     */
    public function setUrl($value)
    {
        $this->_url = $value;
        return $this->getUrl();
    }
    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }
    /**
     * @param array $value
     * @return array
     */
    public function setParams($value)
    {
        $this->_params = $value;
        return $this->getParams();
    }
    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->_scheme;
    }
    /**
     * @param string $value
     * @return string
     */
    public function setScheme($value)
    {
        $this->_scheme = $value;
        return $this->getScheme();
    }
    /**
     * @return string
     */
    public function getVerb()
    {
        return $this->_verb;
    }
    /**
     * @param string $value
     * @return string
     */
    public function setVerb($value)
    {
        $this->_verb = $value;
        return $this->getVerb();
    }

    /**
     * @return array
     */
    public function getUrlParts()
    {
        if(empty($this->_urlParts))
        {
            return $this->setUrlParts(explode('/',$this->getUrl()));
        }
        return $this->_urlParts;
    }

    /**
     * @param array $parts
     * @return array
     */
    public function setUrlParts(array $parts)
    {
        $this->_urlParts = $parts;
        return $this->getUrlParts();
    }
}