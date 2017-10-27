<?php

namespace IsysRestClient\Request\Method;

use ReflectionClass;

class RequestMethodMap
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    public static function getList()
    {
        $reflection = new ReflectionClass(__CLASS__);
        return $reflection->getConstants();
    }
}
