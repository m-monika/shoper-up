<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$url = $_ENV['API_URL'];
$token = $_ENV['API_TOKEN'];

$aboutpages = 'webapi/rest/aboutpages/';
$endpoint = $url . $aboutpages;

if (!empty($_GET['id'])) {

    $aboutPageId = $_GET['id'];
    
    $client = HttpClient::create();
    $response = $client->request('DELETE', $endpoint . htmlentities($aboutPageId), [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 3,
    ]);

    $status = $response->getStatusCode();
    $content = $response->getContent();

    echo "StatusCode:" . $status . PHP_EOL . "<br>";
    echo "Response:" . $content . PHP_EOL . "<br>";

} elseif (empty($_GET['id'])) {
    echo "Parametr jest wymagany.";
}
