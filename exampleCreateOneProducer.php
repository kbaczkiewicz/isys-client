<?php

include('vendor/autoload.php');

use IsysRestClient\Request\CreateOneProducerRequest;
use IsysRestClient\Client\ClientFactory;
use IsysRestClient\Authorization\BasicAuthAuthorization;
use IsysRestClient\Model\Producer;

$login = $argv[1];
$password = $argv[2];
$producer = Producer::createByArray(
    [
        'id'            => null,
        'name'          => 'Test Test',
        'site_url'      => 'http;//example.com',
        'logo_filename' => 'test.png',
        'ordering'      => null,
        'source_id'     => null,
    ]
);
$request = new CreateOneProducerRequest(
    'http://grzegorz.demos.i-sklep.pl/rest_api/shop_api/v1/producers',
    $producer
);
$request->addHeader(['Content-Type: application/json']);

$client = ClientFactory::createClient($request);
$client->authorize(
    new BasicAuthAuthorization($login, $password)
);
try {
    $response = $client->sendRequest();
    var_dump($response->getProducer());
} catch (Exception $ex) {
    var_dump($ex->getCode() . ':' . $ex->getMessage());
}
