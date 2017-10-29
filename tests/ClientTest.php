<?php

use IsysRestClient\Client\Client;
use IsysRestClient\Curl\CurlInstanceBuilder;
use IsysRestClient\Request\AbstractRequest;
use IsysRestClient\Request\RequestMethod\RequestMethodMap;
use IsysRestClient\Response\AbstractResponse;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidRequestMethodThrowsInvalidArgumentException()
    {
        $client = new Client(
            $this->getRequestMockWithInvalidMethod(),
            $this->getCurlInstanceBuilderMock($this->getValidCurl())
        );

        $client->sendRequest();
    }

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

    private function getRequestMockWithInvalidMethod()
    {
        return $this->getRequestMock('someSurelyNotValidMethod');
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
        $curl = curl_init($url);

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
