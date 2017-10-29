<?php

namespace IsysRestClient\Client;

use IsysRestClient\Curl\CurlInstanceBuilder;
use IsysRestClient\Request\AbstractRequest;

class ClientFactory
{
    private function __construct()
    {
    }

    public static function createClient(AbstractRequest $request): Client
    {
        return new Client($request, new CurlInstanceBuilder($request->getRequestUrl()));
    }
}