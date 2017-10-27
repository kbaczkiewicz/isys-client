<?php

namespace IsysRestClient\Client;

use IsysRestClient\Authorization\AbstractAuthorization;
use IsysRestClient\Curl\CurlInstanceBuilder;
use IsysRestClient\Exception\BadRequestException;
use IsysRestClient\Exception\HttpBadRequestException;
use IsysRestClient\Exception\HttpNotFoundException;
use IsysRestClient\Request\AbstractRequest;
use IsysRestClient\Request\Method\RequestMethodMap;
use InvalidArgumentException;
use Exception;
use IsysRestClient\Response\AbstractResponse;

class Client
{
    const HTTP_OK = 200;

    private $curlInstanceBuilder;

    public function __construct(CurlInstanceBuilder $curlInstanceBuilder)
    {
        $this->curlInstanceBuilder = $curlInstanceBuilder;
    }


    public function authorize(AbstractAuthorization $authorization)
    {
        $this->curlInstanceBuilder->setAuthorization($authorization);
    }

    public function sendRequest(AbstractRequest $request): AbstractResponse
    {
        $this->validateRequestMethod($request->getMethod());
        $curlHandler = $this->curlInstanceBuilder
            ->setRequestMethod($request->getMethod())
            ->setAdditionalHeaders($request->getHeaders())
            ->setRequestData($request->getMethod(), $request->getData())
            ->getInstance();

        return $this->createResponse($curlHandler, $request->getExcpectedResponseClass());
    }

    private function validateRequestMethod(string $httpMethod)
    {
        if (!in_array($httpMethod, RequestMethodMap::getList())) {
            throw new InvalidArgumentException("Method is not allowed");
        }
    }

    private function createResponse($curlHandler, $responseClassName)
    {
        if (!curl_exec($curlHandler)) {
            throw new Exception("cURL error: " . curl_error($curlHandler));
        }

        if (self::HTTP_OK !== curl_getinfo($curlHandler, CURLINFO_HTTP_CODE)) {
            throw new BadRequestException(
                (string)($curlHandler['data']['messages']),
                curl_getinfo($curlHandler, CURLINFO_HTTP_CODE)
            );
        }

        return new $responseClassName($curlHandler);
    }
}
