<?php

namespace BeelineOrd\Exception;

use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiException extends Exception implements RequestExceptionInterface
{
    protected RequestInterface $request;
    protected ResponseInterface $response;
    protected $responseBody;

    public function __construct(
        RequestInterface $request, ResponseInterface $response, $responseBody = null,
                         $message = "", $code = 0, \Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->response = $response;
        $this->responseBody = $responseBody ?: (string)$response->getBody();
        if (empty($this->message)) {
            $this->message = $response->getReasonPhrase() . ': '
                . sprintf(
                    "API returned %d %s\nBody: %s",
                    $response->getStatusCode(),
                    $response->getReasonPhrase(),
                    json_encode($responseBody, JSON_PRETTY_PRINT)
                );
        }
        if (empty($this->code)) {
            $this->code = $response->getStatusCode();
        }
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }

}