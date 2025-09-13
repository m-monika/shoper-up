<?php
$taskId = $argv[1] ?? null;

if (!is_numeric($taskId)) {
    echo "Numer zadania musi być liczbą." . PHP_EOL;
    die();
}

$filePath = "tasks/zadanie_{$taskId}.php";

if (!file_exists($filePath)) {
    echo "Zadanie {$filePath} nie istnieje." . PHP_EOL;
    die();
}

$tasksResults = [
    0 => "Hello World!"
];

ob_start();
include $filePath;
$output = ob_get_clean();

if (trim($output) === $tasksResults[$taskId]) {
    echo "BRAWO!" . PHP_EOL;
} else {
    echo "Oczekiwany wynik jest inny :("
        . PHP_EOL
        . PHP_EOL
        . "Oczekiwany wynik:"
        . PHP_EOL
        . $tasksResults[$taskId]
        . PHP_EOL
        . PHP_EOL
        . "Uzyskany wynik:"
        . PHP_EOL
        . $output
        . PHP_EOL;
}
