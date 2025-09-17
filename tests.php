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

$task_4 = 'SHOPERUP! PROGRAMOWANIE PHP - LEKCJA 4' . $newLine
    . 'shoperUp! Programowanie PHP - Lekcja 4' . $newLine
    . 'Programowanie PHP' . $newLine
    . 'ShoperUp!ProgramowaniePHP-Lekcja4' . $newLine
    . '4 ajckeL - PHP einawomargorP !pUrepohS' . $newLine
    . '38';

$tasksResults = [
    0 => "Hello World!",
    1 => $task_1,
    2 => $task_2,
    3 => 'Kasia ma 25 lat.',
    4 => $task_4
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
