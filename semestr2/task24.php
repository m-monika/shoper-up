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
$response = $client->request('POST', $endpoint, [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
    'json' => [
        'name' => 'To jest nowa strona informacyjna',
        'lang_id' => 1,
        'active' => true,
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porta interdum dui, eu bibendum augue mattis in. Suspendisse ornare lobortis ligula quis lobortis. Etiam lobortis quis enim ut pellentesque.',
        'seo_title' => 'Test SEO Title',
        'seo_description' => 'Test SEO Description'
    ],
    'timeout' => 3,
]);

$status = $response->getStatusCode();
$content = $response->getContent();

echo "StatusCode:" . $status . PHP_EOL . "<br>";
echo "Response:" . $content . PHP_EOL . "<br>";


