<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__."/.env");

$url = $_ENV['API_URL'];
$token = $_ENV['API_TOKEN'];

if (! $_GET["id"]) {
    echo "Należy podać parametr ID";
    die();
}

$page = $_GET["id"];

$client = HttpClient::create();
$response = $client->request('DELETE', $url . "aboutpages/" . $page, [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 5,
]);

$statusCode = $response->getStatusCode();

if ($statusCode == 200) {
    echo "Poprawnie usunięto stronę informacyjną";
} else {
    echo "Wystąpił problem z usunięciem strony informacyjnej, najprawdopodobniej nie istnieje strona z takim ID";
}