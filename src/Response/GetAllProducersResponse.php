<?php

namespace IsysRestClient\Response;

use IsysRestClient\Model\Producer;

class GetAllProducersResponse extends AbstractResponse
{
    public function getProducers()
    {
        $producers = [];
        foreach ($this->body['data']['producers'] as $producerArray) {
            $producers[] = new Producer($producerArray);
        }

        return $producers;
    }
}
