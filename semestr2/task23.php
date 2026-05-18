<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$url = $_ENV['API_URL'];
$token = $_ENV['API_TOKEN'];

$aboutpages = 'webapi/rest/aboutpages';

$endpoint = $url . $aboutpages;

$client = HttpClient::create();
$response = $client->request('GET', $endpoint, [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 3,
]);

$content = $response->getContent();
$data = json_decode($content);

foreach($data->list as $page) {
    echo $page->name . PHP_EOL . "</br>";
}