<?php

namespace IsysRestClient\Authorization;

use IsysRestClient\Curl\CurlInstance;

interface AuthorizationInterface
{
    public function authorize(CurlInstance $curlInstance);
}