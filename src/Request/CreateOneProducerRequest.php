<?php

namespace IsysRestClient\Request;

use IsysRestClient\Request\RequestMethod\RequestMethodMap;
use IsysRestClient\Response\CreateOneProducerResponse;

class CreateOneProducerRequest extends AbstractRequest
{
    public function getExcpectedResponseClassName(): string
    {
        return CreateOneProducerResponse::class;
    }

    public function getData(): string
    {
        return json_encode(
            [
                'producer' => $this->data,
            ]
        );
    }

    public function getMethod(): string
    {
        return RequestMethodMap::METHOD_POST;
    }
}
