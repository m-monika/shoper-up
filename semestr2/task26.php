<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__."/.env");

$url = $_ENV['API_URL_PREMIUM'];
$token = $_ENV['API_TOKEN_PREMIUM'];

$body = ['key' => 'MySuperMetafield', 'namespace' => 'MySuperMetafield', 'type' => 3];
$bodyJson = json_encode($body);

$client = HttpClient::create();
$response = $client->request('POST', $url . "metafields/system", [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 5,
    'body' => $bodyJson
]);

$statusCode = $response->getStatusCode();

if ($statusCode == 200) {
    echo "Poprawnie dodano metafield ID";
    $metafieldId = $response->getContent();
    echo $metafieldId;
} else {
    echo "Wystąpił problem z dodaniem metafielda";
    echo $response->getContent();
    die();
}

echo "<br />";

$body = ['metafield_id' => $metafieldId, 'value' => 'Bardzo ważne informacje z metafielda', 'type' => 3];
$bodyJson = json_encode($body);

$response = $client->request('POST', $url . "metafield-values", [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 5,
    'body' => $bodyJson
]);

$statusCode = $response->getStatusCode();

if ($statusCode == 200) {
    echo "Poprawnie dodano wartość do metafielda ID";
    $metafieldValueId = $response->getContent();
    echo $metafieldValueId;
} else {
    echo "Wystąpił problem z dodaniem wartości do metafielda";
    echo $response->getContent();
    die();
}