<?php

namespace IsysRestClient\Authorization;

use IsysRestClient\Curl\CurlInstance;

class BasicAuthAuthorization implements AuthorizationInterface
{

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authorize(CurlInstance $curlInstance)
    {
        $curlInstance->setOption(CURLOPT_USERPWD, $this->username . ':' . $this->password);

        return $curlInstance;
    }
}