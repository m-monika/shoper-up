<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__."/.env");

$url = $_ENV['API_URL'];
$token = $_ENV['API_TOKEN'];

$body = ['name' => 'test', 'lang_id' => 1, 'content' => 'Tu jest treść strony testowej'];
$bodyJson = json_encode($body);

$client = HttpClient::create();
$response = $client->request('POST', $url . "aboutpages", [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 5,
    'body' => $bodyJson
]);

echo "Odpowiedź z API: " . $response->getContent();