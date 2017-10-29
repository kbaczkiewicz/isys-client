<?php

namespace IsysRestClient\Response;

use IsysRestClient\Model\Producer;

class CreateOneProducerResponse extends AbstractResponse
{
    public function getProducer(): Producer
    {
        return new Producer($this->body['data']['producer']);
    }
}
