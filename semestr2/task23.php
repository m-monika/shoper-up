<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$baseUrl = $_ENV['API_URL'];
$token = $_ENV['API_TOKEN'];

$apiUrl = rtrim($baseUrl, '/') . '/webapi/rest/aboutpages';

$client = HttpClient::create();

try {
    $response = $client->request('GET', $apiUrl, [
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ],
        'timeout' => 3,
    ]);

    if ($response->getStatusCode() === 200) {
        
        $data = $response->toArray();

        echo "<h1>Lista stron informacyjnych</h1>";

        if (!empty($data['list'])) {
            echo "<ul>";
            foreach ($data['list'] as $page) {
                $pageId = htmlspecialchars($page['page_id'] ?? '');
                $title = htmlspecialchars($page['title'] ?? 'Brak tytułu');
                
                echo "<li><strong>[ID: {$pageId}]</strong> {$title}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Brak stron informacyjnych do wyświetlenia.</p>";
        }
    } else {
        echo "<p>Wystąpił błąd API. Kod odpowiedzi: " . $response->getStatusCode() . "</p>";
    }

} catch (\Exception $e) {
    echo "<p>Wystąpił błąd podczas połączenia z API: " . htmlspecialchars($e->getMessage()) . "</p>";
}