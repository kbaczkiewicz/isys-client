<?php

namespace IsysRestClient\Request;

use IsysRestClient\Request\Method\RequestMethodMap;
use IsysRestClient\Response\CreateOneProducerResponse;

class CreateOneProducerRequest extends AbstractRequest
{
    /**
     * @var array
     */
    private $body;

    /**
     * CreateOneProducerRequest constructor.
     * @param string $requestUrl
     * @param array $body
     */
    public function __construct($requestUrl, array $body)
    {
        parent::__construct($requestUrl);
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getExcpectedResponseClass()
    {
        return CreateOneProducerResponse::class;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return RequestMethodMap::METHOD_POST;
    }
}
