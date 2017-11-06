<?php

namespace IsysRestClient\Client;

use IsysRestClient\Authorization\AuthorizationInterface;
use IsysRestClient\Curl\CurlInstance;
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

    public function authorize(AuthorizationInterface $authorization)
    {
        $this->curlInstanceBuilder->setAuthorization($authorization);
    }

    public function sendRequest(): AbstractResponse
    {
        $curlInstance = $this->curlInstanceBuilder
            ->setAdditionalHeaders($this->request->getHeaders())
            ->setRequestMethod($this->request->getMethod())
            ->setRequestData($this->request->getMethod(), $this->request->getData())
            ->getInstance();

        return $this->createResponse($curlInstance, $this->request->getExcpectedResponseClassName());
    }

    private function createResponse(CurlInstance $curlInstance, $responseClassName): AbstractResponse
    {
        $result = $curlInstance->execute();
        if (false === $result) {
            throw new Exception("cURL error: " . $curlInstance->getError());
        }

        if (self::HTTP_OK !== $curlInstance->getInfo(CURLINFO_HTTP_CODE)) {
            throw new BadRequestException(
                $result,
                $curlInstance->getInfo(CURLINFO_HTTP_CODE)
            );
        }

        $curlInstance->closeResource();

        return new $responseClassName($result);
    }
}
