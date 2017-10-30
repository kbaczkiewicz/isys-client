<?php

namespace IsysRestClient\Response;

use IsysRestClient\Model\Producer;

class CreateOneProducerResponse extends AbstractResponse
{
    public function getProducer(): Producer
    {
        return Producer::createByArray($this->body['data']['producer']);
    }
}
