<?php

include('vendor/autoload.php');

$login = $argv[1];
$password = $argv[2];
$producer = new \IsysRestClient\Model\Producer(
    [
        'id'            => null,
        'name'          => 'Kamil Tester',
        'site_url'      => 'http;//example.com',
        'logo_filename' => 'kamil.png',
        'ordering'      => null,
        'source_id'     => null,
    ]
);
$request = new \IsysRestClient\Request\CreateOneProducerRequest(
    'http://grzegorz.demos.i-sklep.pl/rest_api/shop_api/v1/producers',
    $producer
);
$request->addHeader(['Content-Type: application/json']);

$client = \IsysRestClient\Client\ClientFactory::createClient($request);
$client->authorize(
    new \IsysRestClient\Authorization\BasicAuthAuthorization($login, $password)
);
try {
    $response = $client->sendRequest();
    var_dump($response->getProducer());
} catch (Exception $ex) {
    var_dump($ex->getCode() . ':' . $ex->getMessage());
}
