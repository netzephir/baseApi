<?php
namespace Core;
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 12:54
 */
class Resource
{
    /**
     * @var Response
     */
    protected $_response;
    /**
     * @var Request
     */
    protected $_request;
    /**
     * @var bool
     */
    protected $_returnResult = false;

    public function __construct(Response $response, Request $request, $returnResult = false)
    {
        $this->_setResponse($response);
        $this->_setRequest($request);
        $this->setReturnResult($returnResult);
    }

    /**
     * @param array $response
     * @param int $code
     * @return mixed
     */
    public function sendResponse(array $response,$code = 200)
    {
        if($this->getReturnResult())
        {
            return $response;
        }
        $this->getResponse()->addHeader('content-Type','application/json');
        $this->getResponse()->setBody(json_encode($response));
        $this->getResponse()->setCode($code);
        return true;
    }

    /**
     * @param int $code
     * @param string $message
     * @return true
     */
    public function sendErrorCode(int $code, $message = null)
    {
        $this->getResponse()->setCode($code);
        $this->getResponse()->setBody($message);
        return true;
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
    protected function _setResponse(Response $response)
    {
        $this->_response = $response;
        return $this->getResponse();
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @param Response Request
     * @return Request
     */
    protected function _setRequest(Request $request)
    {
        $this->_request = $request;
        return $this->getRequest();
    }

    /**
     * @return bool
     */
    public function getReturnResult()
    {
        return $this->_returnResult;
    }

    /**
     * @param Response bool
     * @return bool
     */
    public function setReturnResult(bool $returnResult)
    {
        $this->_returnResult = $returnResult;
        return $this->getReturnResult();
    }
}