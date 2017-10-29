<?php

namespace IsysRestClient\Request;

use IsysRestClient\Request\RequestMethod\RequestMethodMap;
use IsysRestClient\Response\GetAllProducersResponse;

class GetAllProducersRequest extends AbstractRequest
{
    public function getExcpectedResponseClassName(): string
    {
        return GetAllProducersResponse::class;
    }

    public function getMethod(): string
    {
        return RequestMethodMap::METHOD_GET;
    }
}
