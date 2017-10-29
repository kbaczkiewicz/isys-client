<?php

use IsysRestClient\Model\Producer;
use PHPUnit\Framework\TestCase;

class ProducerTest extends TestCase
{
    public function testCreatesByArraySuccesfully()
    {
        $this->assertInstanceOf(Producer::class, new Producer($this->getProducerArray()));
    }

    public function testCreateByArrayWithAdditionalFieldsSuccesfully()
    {
        $producerArray = $this->getProducerArray();
        $producerArray['foo'] = 'foo';
        $producerArray['baz'] = 'baz';

        $this->assertInstanceOf(Producer::class, new Producer($producerArray));
    }

    public function canTurnToJsonAndBack()
    {
        $producer = new Producer($this->getProducerArray());
        $jsonString = json_encode($producer->jsonSerialize());
        $this->assertInternalType('string', json_encode($jsonString));
        $this->assertInternalType('array', json_decode($jsonString, true));
    }

    private function getProducerArray()
    {
        return [
            'id'            => 1,
            'name'          => 'Tester',
            'site_url'      => 'http://example.com',
            'logo_filename' => 'file.jpg',
            'ordering'      => 1500,
            'source_id'     => 1,
        ];
    }
}
