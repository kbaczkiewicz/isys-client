<?php

namespace IsysRestClient\Client;

use IsysRestClient\Authorization\AbstractAuthorization;
use IsysRestClient\Curl\CurlInstanceBuilder;
use IsysRestClient\Exception\BadRequestException;
use IsysRestClient\Request\AbstractRequest;
use IsysRestClient\Request\RequestMethod\RequestMethodMap;
use InvalidArgumentException;
use Exception;
use IsysRestClient\Response\AbstractResponse;

class Client
{

    const HTTP_OK = 200;

    /**
     * @var CurlInstanceBuilder
     */
    private $curlInstanceBuilder;

    /**
     * @var AbstractRequest
     */
    private $request;

    public function __construct(AbstractRequest $request, CurlInstanceBuilder $curlInstanceBuilder)
    {
        $this->request = $request;
        $this->curlInstanceBuilder = $curlInstanceBuilder;
    }

    public function authorize(AbstractAuthorization $authorization)
    {
        $this->curlInstanceBuilder->setAuthorization($authorization);
    }

    public function sendRequest(): AbstractResponse
    {
        $this->validateRequestMethod($this->request->getMethod());
        $curlHandler = $this->curlInstanceBuilder
            ->setAdditionalHeaders($this->request->getHeaders())
            ->setRequestMethod($this->request->getMethod())
            ->setRequestData($this->request->getMethod(), $this->request->getData())
            ->getInstance();

        return $this->createResponse($curlHandler, $this->request->getExcpectedResponseClassName());
    }

    private function validateRequestMethod(string $httpMethod)
    {
        if (!in_array($httpMethod, RequestMethodMap::getList())) {
            throw new InvalidArgumentException("RequestMethod is not allowed");
        }
    }

    private function createResponse($curlHandler, $responseClassName): AbstractResponse
    {
        $result = curl_exec($curlHandler);
        if (false === $result) {
            throw new Exception("cURL error: " . curl_error($curlHandler));
        }

        if (self::HTTP_OK !== curl_getinfo($curlHandler, CURLINFO_HTTP_CODE)) {
            throw new BadRequestException(
                $result,
                curl_getinfo($curlHandler, CURLINFO_HTTP_CODE)
            );
        }

        curl_close($curlHandler);

        return new $responseClassName($result);
    }
}
