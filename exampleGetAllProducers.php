<?php

include('vendor/autoload.php');

use \IsysRestClient\Request\GetAllProducersRequest;
use \IsysRestClient\Client\ClientFactory;
use \IsysRestClient\Authorization\BasicAuthAuthorization;

$login = $argv[1];
$password = $argv[2];
$request = new GetAllProducersRequest(
    'http://grzegorz.demos.i-sklep.pl/rest_api/shop_api/v1/producers'
);
$client = ClientFactory::createClient($request);
$client->authorize(new BasicAuthAuthorization($login, $password));
try {
    $response = $client->sendRequest();
    var_dump($response->getProducers());
} catch (Exception $ex) {
    var_dump($ex->getCode() . ":" . $ex->getMessage());
}
