<?php

namespace IsysRestClient\Client;

use IsysRestClient\Request\AbstractRequest;

class Client
{
    private $ch;

    public function __construct(AbstractRequest $request)
    {
        $this->ch = curl_init($request->getRequestUrl());
    }
}