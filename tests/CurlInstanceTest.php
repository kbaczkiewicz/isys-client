<?php

use IsysRestClient\Curl\CurlInstance;
use PHPUnit\Framework\TestCase;

class CurlInstanceTest extends TestCase
{
    public function testGetStatusCodeFromCurl()
    {
        $curlInstance = new CurlInstance('http://example.com');
        $curlInstance->execute();
        $this->assertEquals(200, $curlInstance->getInfo(CURLINFO_HTTP_CODE));
    }

    public function testGetErrorFromInvalidUrlInCurl()
    {
        $curlInstance = new CurlInstance('haad:\\surelyNotAValidUrl');
        $curlInstance->execute();
        $this->assertNotEmpty($curlInstance->getError());
    }
}
