<?php

namespace IsysRestClient\Authorization;

use InvalidArgumentException;

abstract class AbstractAuthorization
{
    abstract public function authorize($curlHandler);

    protected function validateHandler($curlHandler)
    {
        if (!is_resource($curlHandler)) {
            throw new InvalidArgumentException("Variable must be of type `resource`");
        }
    }
}