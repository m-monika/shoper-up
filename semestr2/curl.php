<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$url = $_ENV['API_URL'];
$token = $_ENV['API_TOKEN'];

echo "Url: {$url},<br />Token: {$token}<br /><br /><br />";

$client = HttpClient::create();
$response = $client->request('GET', $url, [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 3,
]);
echo "Http Response Code: " . $response->getStatusCode() . '<br />';
echo "Content:<br />";
echo $response->getContent();