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

    /**
     * BasicAuthAuthorization constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
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