<?php

namespace IsysRestClient\Curl;

use IsysRestClient\Authorization\AuthorizationInterface;
use IsysRestClient\Request\RequestMethod\RequestMethodMap;
use InvalidArgumentException;

class CurlInstanceBuilder
{
    /**
     * @var CurlInstance
     */
    private $curlInstance;

    /**
     * @var string
     */
    private $url;

    public function __construct(CurlInstance $curlInstance, string $url)
    {
        $this->url = $url;
        $this->curlInstance = $curlInstance;
        $this->curlInstance->setOptions(
            [
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_RETURNTRANSFER => 1,
            ]
        );
    }

    public function setRequestMethod(string $httpMethod): CurlInstanceBuilder
    {
        $this->curlInstance->setOption(CURLOPT_CUSTOMREQUEST, $httpMethod);

        return $this;
    }

    public function setAdditionalHeaders(array $headers): CurlInstanceBuilder
    {
        foreach ($headers as $header) {
            $this->curlInstance->setOption(CURLOPT_HTTPHEADER, $header);
        }

        return $this;
    }

    public function setRequestData($httpMethod, $data): CurlInstanceBuilder
    {
        if (RequestMethodMap::METHOD_GET === $httpMethod) {
            $this->curlInstance->setOption(CURLOPT_URL, $this->prepareUrlWithQueryString($data));
        } else {
            $this->curlInstance->setOption(CURLOPT_POSTFIELDS, $data);
        }

        return $this;
    }

    public function setAuthorization(AuthorizationInterface $authorization): CurlInstanceBuilder
    {
        $authorization->authorize($this->curlInstance);

        return $this;
    }

    public function getInstance(): CurlInstance
    {
        return $this->curlInstance;
    }

    private function prepareUrlWithQueryString(string $queryString): string
    {
        return $this->url . '?' . $queryString;
    }
}
