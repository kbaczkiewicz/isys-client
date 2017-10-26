<?php

namespace IsysRestClient\Request;

use IsysRestClient\Request\Method\RequestMethodMap;

class GetAllProducersRequest extends AbstractRequest
{

    public function getExcpectedResponseClass()
    {
        return GetAllProducersRequest::class;
    }

    public function getMethod()
    {
        return RequestMethodMap::METHOD_GET;
    }
}
