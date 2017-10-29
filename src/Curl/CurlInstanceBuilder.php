<?php

namespace IsysRestClient\Curl;

use IsysRestClient\Authorization\AbstractAuthorization;
use IsysRestClient\Request\RequestMethod\RequestMethodMap;
use InvalidArgumentException;

class CurlInstanceBuilder
{
    /**
     * @var resource
     */
    private $curlHandler;

    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->curlHandler = curl_init($url);
        curl_setopt($this->curlHandler, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
    }

    public function setRequestMethod(string $httpMethod): CurlInstanceBuilder
    {
        curl_setopt($this->curlHandler, CURLOPT_CUSTOMREQUEST, $httpMethod);

        return $this;
    }

    public function setAdditionalHeaders(array $headers): CurlInstanceBuilder
    {
        foreach ($headers as $header) {
            curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER, $header);
        }

        return $this;
    }

    public function setRequestData($httpMethod, $data): CurlInstanceBuilder
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
                throw new InvalidArgumentException("RequestMethod not allowed");
        }

        return $this;
    }

    public function setAuthorization(AbstractAuthorization $authorization): CurlInstanceBuilder
    {
        $authorization->authorize($this->curlHandler);

        return $this;
    }

    public function getInstance()
    {
        return $this->curlHandler;
    }

    private function prepareUrlWithQueryString(string $queryString): string
    {
        return $this->url . '?' . $queryString;
    }
}
