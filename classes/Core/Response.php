<?php
namespace Core;
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 12:54
 */
class Response
{
    /**
     * @var array
     */
    protected $_header = [];
    /**
     * @var string
     */
    protected $_body;
    /**
     * @var int
     */
    protected $_code;

    /**
     * @return true
     */
    public function forgeResponse()
    {
        // set headers
        $this->_forgeHeaders();
        // send body
        echo $this->getBody();

        http_response_code($this->getCode());
        return true;
    }

    /**
     * @return true
     */
    protected function _forgeHeaders()
    {
        foreach($this->getHeader() AS $key=>$value)
        {
            header($key.': '.$value,true);
        }
        return true;
    }
    /**
     * @param int $code
     * @return int
     */
    public function setCode(int $code)
    {
        $this->_code = $code;
        return $this->getCode();
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * @param string $body
     * @return string
     */
    public function setBody($body)
    {
        $this->_body = $body;
        return $this->getBody();
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        return $this->_header;
    }

    /**
     * @param string $key
     * @param string $value
     * @return array
     */
    public function addHeader($key, $value)
    {
        $this->_header[$key] = $value;
        return $this->getHeader();
    }

    /**
     * @param array $header
     * @return array
     */
    public function setHeader(array $header)
    {
        $this->_header = $header;
        return $this->getHeader();
    }
}