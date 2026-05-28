<?php

$envPath = __DIR__ . '/.env';
if (!file_exists($envPath)) {
    die("Błąd: Brak pliku .env w lokalizacji: " . $envPath);
}

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue; // pomiń komentarze
    list($name, $value) = explode('=', $line, 2);
    $_ENV[trim($name)] = trim($value, " \t\n\r\0\x0B\"'");
}

$baseUrl = $_ENV['API_URL'] ?? null;
$token = $_ENV['API_TOKEN'] ?? null;

if (!$baseUrl || !$token) {
    die("Błąd: Brak zdefiniowanych zmiennych API_URL lub API_TOKEN w pliku .env");
}

$apiUrl = rtrim($baseUrl, '/') . '/webapi/rest/aboutpages';

$postData = [
    'name'            => 'Nowa strona informacyjna ' . date('Y-m-d H:i:s'), // Nazwa strony (Wymagane)
    'lang_id'         => 1,                                                 // ID języka, zazwyczaj 1 (Wymagane)
    'content'         => '<p>To jest treść nowo utworzonej strony testowej.</p>', // Zawartość strony
    'active'          => true,                                              // Czy ma być aktywna
    'seo_title'       => 'Testowa strona SEO',
    'seo_description' => 'Opis testowej strony informacyjnej',
];

$jsonData = json_encode($postData);

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $apiUrl,
    CURLOPT_POST => true,                               // Ustawienie metody na POST
    CURLOPT_POSTFIELDS => $jsonData,                    // Przekazanie danych w formacie JSON
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $token,
        "Content-Type: application/json",               // Informujemy API, że wysyłamy JSON
        "Accept: application/json"
    ],
    CURLOPT_TIMEOUT => 5
]);

$response = curl_exec($ch);
$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);

$apiError = null;
$insertedId = null;

if ($curlError) {
    $apiError = "Błąd cURL: " . $curlError;
} elseif ($httpStatusCode !== 200) {
    $apiError = "Błąd API. Kod statusu HTTP: " . $httpStatusCode . ". Szczegóły: " . $response;
} else {
    $insertedId = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodawanie strony informacyjnej - Shoper API</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f8f9fa; color: #333; }
        h1 { color: #2c3e50; border-bottom: 2px solid #dee2e6; padding-bottom: 10px; }
        .success { background-color: #d4edda; color: #155724; padding: 20px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; padding: 20px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
        .details { background-color: #e9ecef; padding: 15px; border-radius: 4px; font-family: Courier, monospace; word-break: break-all; }
    </style>
</head>
<body>

    <h1>Rezultat dodawania strony informacyjnej</h1>

    <?php if ($apiError): ?>
        <div class="error">
            <strong>Wystąpił błąd podczas dodawania strony!</strong><br />
            <?php echo htmlspecialchars($apiError); ?>
        </div>
    <?php else: ?>
        <div class="success">
            <strong>Sukces! Strona została pomyślnie dodana do sklepu.</strong><br />
            Utworzono obiekt o ID: <strong><?php echo htmlspecialchars(is_array($insertedId) ? json_encode($insertedId) : $insertedId); ?></strong>
        </div>
    <?php endif; ?>

    <h3>Surowa odpowiedź z Shoper API:</h3>
    <div class="details">
        <?php echo htmlspecialchars($response); ?>
    </div>

    <h3>Wysłane dane (JSON):</h3>
    <div class="details">
        <?php echo htmlspecialchars($jsonData); ?>
    </div>

</body>
</html>