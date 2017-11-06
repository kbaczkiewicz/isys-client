<?php

namespace IsysRestClient\Response;

use IsysRestClient\Model\Producer;

class CreateOneProducerResponse extends AbstractResponse
{
    public function getContent(): array
    {
        return [Producer::createByArray($this->body['data']['producer'])];
    }
}
