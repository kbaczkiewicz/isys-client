<?php

use IsysRestClient\Client\Client;
use IsysRestClient\Curl\CurlInstanceBuilder;
use IsysRestClient\Request\AbstractRequest;
use IsysRestClient\Request\RequestMethod\RequestMethodMap;
use IsysRestClient\Response\AbstractResponse;
use PHPUnit\Framework\TestCase;
use \IsysRestClient\Curl\CurlInstance;

class ClientTest extends TestCase
{
    /**
     * @expectedException \IsysRestClient\Exception\BadRequestException
     */
    public function testBadRequestCodeInCurlTriggersBadRequestException()
    {
        $client = new Client(
            $this->getValidRequestMock(),
            $this->getCurlInstanceBuilderMock($this->getCurlWith404Code())
        );

        $client->sendRequest();
    }

    /**
     * @expectedException Exception
     */
    public function testCurlErrorTriggersException()
    {
        $client = new Client(
            $this->getValidRequestMock(),
            $this->getCurlInstanceBuilderMock($this->getCurlWithError())
        );

        $client->sendRequest();
    }

    private function getRequestMock($requestMethod)
    {
        $mock = \Mockery::mock(AbstractRequest::class)
            ->shouldReceive('getRequestUrl')
            ->andReturn('http://example.com')
            ->getMock();
        $mock->shouldReceive('getHeaders')
            ->andReturn([])
            ->getMock();
        $mock->shouldReceive('getData')
            ->andReturn('')
            ->getMock();
        $mock->shouldReceive('getExcpectedResponseClassName')
            ->andReturn(AbstractResponse::class)
            ->getMock();
        $mock->shouldReceive('getMethod')
            ->andReturn($requestMethod)
            ->getMock();

        return $mock;
    }

    private function getValidRequestMock()
    {
        return $this->getRequestMock(RequestMethodMap::METHOD_GET);
    }

    private function getCurlInstanceBuilderMock($curl)
    {
        $mock = \Mockery::mock(CurlInstanceBuilder::class)
        ->shouldReceive('getInstance')
            ->andReturn($curl)
            ->getMock();
        $mock->shouldReceive('setRequestMethod')
            ->with(RequestMethodMap::METHOD_GET)
            ->andReturn(Mockery::self())
            ->getMock();
        $mock->shouldReceive('setAdditionalHeaders')
            ->with(array())
            ->andReturn(Mockery::self())
            ->getMock();
        $mock->shouldReceive('setRequestData')
            ->with(RequestMethodMap::METHOD_GET, '')
            ->andReturn(Mockery::self())
            ->getMock();

        return $mock;
    }

    private function getCurl($url)
    {
        $curl = new CurlInstance($url);

        return $curl;
    }

    private function getCurlWithError()
    {
        return $this->getCurl('');
    }

    private function getCurlWith404Code()
    {
        return $this->getCurl('github.com/abcdefUserThatWillNeverEverExist');
    }

    private function getValidCurl()
    {
        return $this->getCurl('example.com');
    }
}
