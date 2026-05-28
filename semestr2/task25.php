<?php

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    die("Błąd: Parametr 'id' jest wymagany! Wywołaj stronę np. tak: task25.php?id=5");
}

$pageId = (int)$_GET['id'];

if ($pageId <= 0) {
    die("Błąd: Podany parametr 'id' musi być liczbą całkowitą większą od 0.");
}


$envPath = __DIR__ . '/.env';
if (!file_exists($envPath)) {
    die("Błąd: Brak pliku .env w lokalizacji: " . $envPath);
}

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    list($name, $value) = explode('=', $line, 2);
    $_ENV[trim($name)] = trim($value, " \t\n\r\0\x0B\"'");
}


$baseUrl = $_ENV['API_URL'] ?? null;
$token = $_ENV['API_TOKEN'] ?? null;

if (!$baseUrl || !$token) {
    die("Błąd: Brak zdefiniowanych zmiennych API_URL lub API_TOKEN w pliku .env");
}


$apiUrl = rtrim($baseUrl, '/') . '/webapi/rest/aboutpages/' . $pageId;


$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $apiUrl,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $token,
        "Accept: application/json"
    ],
    CURLOPT_TIMEOUT => 5
]);

$response = curl_exec($ch);
$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);


$apiError = null;
$deleteSuccess = false;

if ($curlError) {
    $apiError = "Błąd cURL: " . $curlError;
} elseif ($httpStatusCode !== 200) {
    $apiError = "Błąd API. Serwer zwrócił kod statusu HTTP: " . $httpStatusCode . ". Prawdopodobnie strona o ID " . $pageId . " nie istnieje.";
} else {
    $responseData = json_decode($response, true);
    if ($responseData == 1 || $responseData === true) {
        $deleteSuccess = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Usuwanie strony informacyjnej - Shoper API</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f8f9fa; color: #333; }
        h1 { color: #2c3e50; border-bottom: 2px solid #dee2e6; padding-bottom: 10px; }
        .success { background-color: #d4edda; color: #155724; padding: 20px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; padding: 20px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
        .details { background-color: #e9ecef; padding: 15px; border-radius: 4px; font-family: Courier, monospace; word-break: break-all; }
    </style>
</head>
<body>

    <h1>Rezultat usuwania strony informacyjnej (ID: <?php echo $pageId; ?>)</h1>

    <?php if ($apiError): ?>
        <div class="error">
            <strong>Nie udało się usunąć strony!</strong><br />
            <?php echo htmlspecialchars($apiError); ?>
        </div>
    <?php elseif ($deleteSuccess): ?>
        <div class="success">
            <strong>Sukces!</strong> Strona informacyjna o ID <strong><?php echo $pageId; ?></strong> została trwale usunięta ze sklepu.
        </div>
    <?php else: ?>
        <div class="error">
            <strong>API odpowiedziało w nieoczekiwany sposób.</strong> Sprawdź surowy zrzut poniżej.
        </div>
    <?php endif; ?>

    <h3>Surowa odpowiedź z Shoper API:</h3>
    <div class="details">
        <?php echo htmlspecialchars($response); ?>
    </div>

</body>
</html>