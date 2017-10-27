<?php

namespace IsysRestClient\Client;

use IsysRestClient\Curl\CurlInstanceBuilder;

class ClientFactory
{
    private function __construct()
    {
    }

    public static function createClient(string $url)
    {
        return new Client(new CurlInstanceBuilder($url));
    }
}