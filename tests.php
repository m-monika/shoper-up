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

$newLine = PHP_EOL;

$task_1 = 'Piszę w języku PHP' . $newLine
    . 'To jest dolar: $' . $newLine
    . 'A to jest cudzysłów połączony z slashem: "\"';

$task_2 = '    *' . $newLine
    . '   ***' . $newLine
    . '  *****' . $newLine
    . ' *******' . $newLine
    . '*********';

$task_3 = 'SHOPERUP! PROGRAMOWANIE PHP - LEKCJA 3' . $newLine
    . 'shoperUp! Programowanie PHP - Lekcja 3' . $newLine
    . 'Programowanie PHP' . $newLine
    . 'ShoperUp!ProgramowaniePHP-Lekcja3' . $newLine
    . '3 ajckeL - PHP einawomargorP !pUrepohS' . $newLine
    . '38';

$task_4 = 'Pole koła o promieniu 5 wynosi 78.5';

$tasksResults = [
    0 => "Hello World!",
    1 => $task_1,
    2 => $task_2,
    3 => $task_3,
    4 => $task_4,
    5 => "Kasjerka powinna oddać klientowi: 14zł 85 groszy.",
    6 => "Suma brutto: 139\nSuma netto: 126"
];

if (!array_key_exists($taskId, $tasksResults)) {
    echo "Zadanie nie istnieje.";
    die(255);
}

ob_start();
include $filePath;
$output = ob_get_clean();
$output = preg_replace("/\r\n|\r|\n/", $newLine, $output);
$output = preg_replace("/\t/", "    ", $output);

if (trim($output) === trim($tasksResults[$taskId])) {
    echo "BRAWO!" . PHP_EOL;
    exit(0);
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

    exit(255);
}
