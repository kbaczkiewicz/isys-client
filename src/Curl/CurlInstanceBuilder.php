<?php

namespace IsysRestClient\Curl;

use IsysRestClient\Authorization\AbstractAuthorization;
use IsysRestClient\Request\Method\RequestMethodMap;
use InvalidArgumentException;

class CurlInstanceBuilder
{
    private $curlHandler;

    private $url;

    public function __construct($url)
    {
        $this->url = $url;
        $this->curlHandler = curl_init($url);
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
    }

    public function setRequestMethod(string $httpMethod)
    {
        curl_setopt($this->curlHandler, CURLOPT_CUSTOMREQUEST, $httpMethod);

        return $this;
    }

    public function setAdditionalHeaders(array $headers)
    {
        curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER, $headers);

        return $this;
    }

    public function setRequestData($httpMethod, $data)
    {
        switch ($httpMethod) {
            case RequestMethodMap::METHOD_GET:
                curl_setopt(
                    $this->curlHandler,
                    CURLOPT_URL,
                    $this->prepareUrlWithQueryString($data)
                );
                break;
            case RequestMethodMap::METHOD_POST:
                curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                throw new InvalidArgumentException("Method not allowed");
        }

        return $this;
    }

    public function setAuthorization(AbstractAuthorization $authorization)
    {
        $authorization->authorize($this->curlHandler);

        return $this;
    }

    public function getInstance()
    {
        return $this->curlHandler;
    }

    private function prepareUrlWithQueryString(string $queryString)
    {
        return $this->url . '?' . $queryString;
    }
}