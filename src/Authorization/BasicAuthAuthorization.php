<?php

namespace IsysRestClient\Authorization;

class BasicAuthAuthorization extends AbstractAuthorization
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

    public function authorize($curlHandler)
    {
        $this->validateHandler($curlHandler);
        curl_setopt($curlHandler, CURLOPT_USERPWD, $this->username . ":" . $this->password);

        return $curlHandler;
    }
}