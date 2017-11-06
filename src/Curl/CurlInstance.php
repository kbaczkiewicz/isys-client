<?php

namespace IsysRestClient\Curl;

class CurlInstance
{
    private $curlHandler;

    public function __construct($url)
    {
        $this->curlHandler = curl_init($url);
    }

    public function setOption(int $option, string $value)
    {
        curl_setopt($this->curlHandler, $option, $value);
    }

    public function setOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $this->setOption($option, $value);
        }
    }

    public function execute()
    {
        return curl_exec($this->curlHandler);
    }

    public function getError()
    {
        return curl_error($this->curlHandler);
    }

    public function getInfo(int $info)
    {
        return curl_getinfo($this->curlHandler, $info);
    }

    public function closeResource()
    {
        curl_close($this->curlHandler);
    }
}
