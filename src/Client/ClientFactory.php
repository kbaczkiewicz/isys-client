<?php

namespace IsysRestClient\Client;

use IsysRestClient\Curl\CurlInstance;
use IsysRestClient\Curl\CurlInstanceBuilder;
use IsysRestClient\Request\AbstractRequest;

class ClientFactory
{
    private function __construct()
    {
    }

    public static function createClient(AbstractRequest $request): Client
    {
        $url = $request->getRequestUrl();
        $curlInstance = new CurlInstance($request->getRequestUrl());
        return new Client($request, new CurlInstanceBuilder($curlInstance, $url));
    }
}