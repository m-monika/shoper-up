<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

$url = ($_ENV['API_URL']) . '/webapi/rest/aboutpages';
$token = $_ENV['API_TOKEN'];

$client = HttpClient::create();
$response = $client->request('GET', $url, [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 3,
]);

echo $response->getContent();
