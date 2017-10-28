<?php

include('vendor/autoload.php');

$login = $argv[1];
$password = $argv[2];
$request = new \IsysRestClient\Request\GetAllProducersRequest(
    'http://grzegorz.demos.i-sklep.pl/rest_api/shop_api/v1/producers'
);
$client = \IsysRestClient\Client\ClientFactory::createClient($request);
$client->authorize(new \IsysRestClient\Authorization\BasicAuthAuthorization($login, $password));
try {
    $response = $client->sendRequest();
    var_dump($response->getProducers());
} catch (Exception $ex) {
    var_dump($ex->getCode() . ":" . $ex->getMessage());
}
