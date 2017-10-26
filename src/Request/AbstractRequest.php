<?php

namespace IsysRestClient\Request;

use InvalidArgumentException;

abstract class AbstractRequest
{
    /**
     * @var string
     */
    protected $requestUrl;

    protected $headers = [];

    /**
     * AbstractRequest constructor.
     * @param string $requestUrl
     */
    public function __construct($requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    public function getHeaders()
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

    abstract public function getExcpectedResponseClass();

    abstract public function getMethod();
}