<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__."/.env");

$url = $_ENV['API_URL'];
$token = $_ENV['API_TOKEN'];

$client = HttpClient::create();
$response = $client->request('GET', $url . "aboutpages", [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 5,
]);

$content = $response->toArray();

$pages = $content["pages"];
$currentPage = 1;
$pagesArray = [];

while ($currentPage <= $pages) {

    $response = $client->request('GET', $url . "aboutpages?page=" . $currentPage, [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'timeout' => 5,
]);

    $currentPage++;
    sleep(1);
    $receviedArray = $response->toArray();
    $list = $receviedArray["list"];

    foreach ($list as $name => $value) {
    echo "ID" . $value["page_id"] . ": " . $value["name"];
    echo "<br />";
}

}