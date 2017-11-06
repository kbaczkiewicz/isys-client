<?php

namespace IsysRestClient\Request;

use InvalidArgumentException;
use IsysRestClient\Request\RequestMethod\RequestMethodMap;

abstract class AbstractRequest
{
    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $data;

    public function __construct($requestUrl, $data = '')
    {
        $this->requestUrl = $requestUrl;
        $this->data = $data;
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function addHeader(array $header)
    {
        $this->headers[] = $header;
    }

    public function addHeaders(array $headers)
    {
        foreach ($headers as $header) {
            if (!is_array($header)) {
                throw new InvalidArgumentException('Header must be an array');
            }
            $this->headers[] = $header;
        }
    }

    public function getData()
    {
        return $this->data;
    }

    private function validateRequest()
    {
        if(!in_array($this->getMethod(), RequestMethodMap::getList())) {
            throw new \InvalidArgumentException("Bad method request");
        }
    }

    abstract public function getExcpectedResponseClassName(): string;

    abstract public function getMethod(): string;
}