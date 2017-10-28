<?php

namespace IsysRestClient\Request;

use IsysRestClient\Request\Method\RequestMethodMap;
use IsysRestClient\Response\GetAllProducersResponse;

class GetAllProducersRequest extends AbstractRequest
{

    public function getExcpectedResponseClassName()
    {
        return GetAllProducersResponse::class;
    }

    public function getMethod()
    {
        return RequestMethodMap::METHOD_GET;
    }
}
