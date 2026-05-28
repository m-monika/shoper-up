<?php

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

$apiUrl = rtrim($baseUrl, '/') . '/webapi/rest/aboutpages';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $apiUrl,
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


$pages = [];
$apiError = null;

if ($curlError) {
    $apiError = "Błąd cURL: " . $curlError;
} elseif ($httpStatusCode !== 200) {
    $apiError = "Błąd API. Kod statusu HTTP: " . $httpStatusCode;
} else {
    $responseData = json_decode($response, true);
    $pages = $responseData['list'] ?? [];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista stron informacyjnych Shoper</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f8f9fa; color: #333; }
        h1 { color: #2c3e50; border-bottom: 2px solid #dee2e6; padding-bottom: 10px; }
        .error { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        ul { list-style-type: none; padding: 0; }
        li { background: #fff; margin-bottom: 10px; padding: 15px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .page-title { font-weight: bold; }
        .page-id { color: #6c757d; margin-right: 10px; }
        .status { padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .active { background-color: #d4edda; color: #155724; }
        .inactive { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

    <h1>Lista stron informacyjnych (Shoper API)</h1>

    <?php if ($apiError): ?>
        <div class="error"><?php echo htmlspecialchars($apiError); ?></div>
    <?php endif; ?>

    <?php if (empty($pages) && !$apiError): ?>
        <p>Brak dostępnych stron informacyjnych.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($pages as $page): ?>
                <li>
                    <div>
                        <span class="page-id">[ID: <?php echo htmlspecialchars($page['page_id']); ?>]</span>
                        <span class="page-title"><?php echo htmlspecialchars($page['name']); ?></span>
                    </div>
                    <div>
                        <span class="status <?php echo $page['active'] ? 'active' : 'inactive'; ?>">
                            <?php echo $page['active'] ? 'Aktywna' : 'Nieaktywna'; ?>
                        </span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>
</html>