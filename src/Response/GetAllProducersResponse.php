<?php

namespace IsysRestClient\Response;

use IsysRestClient\Model\Producer;

class GetAllProducersResponse extends AbstractResponse
{
    public function getContent(): array
    {
        $producers = [];
        foreach ($this->body['data']['producers'] as $producerArray) {
            $producers[] = Producer::createByArray($producerArray);
        }

        return $producers;
    }
}
