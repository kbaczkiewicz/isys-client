<?php

namespace IsysRestClient\Request;

use IsysRestClient\Request\RequestMethod\RequestMethodMap;
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
        return json_encode(
            [
                'producer' => $this->data,
            ]
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return RequestMethodMap::METHOD_POST;
    }
}
