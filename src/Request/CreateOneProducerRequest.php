<?php

namespace IsysRestClient\Request;

use IsysRestClient\Request\Method\RequestMethodMap;
use IsysRestClient\Response\CreateOneProducerResponse;

class CreateOneProducerRequest extends AbstractRequest
{

    /**
     * @return string
     */
    public function getExcpectedResponseClassName()
    {
        return CreateOneProducerResponse::class;
    }

    public function getData()
    {
        return json_encode($this->data);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return RequestMethodMap::METHOD_POST;
    }
}
