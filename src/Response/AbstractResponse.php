<?php

namespace IsysRestClient\Response;

abstract class AbstractResponse
{
    /**
     * @var array
     */
    protected $body;

    public function __construct($body)
    {
        $this->body = json_decode($body, true);
    }

    abstract public function getContent(): array;
}
