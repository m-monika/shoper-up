<?php
$taskId = $argv[1] ?? null;

class ShoperUpTests
{
    private string $filePath = '';
    private array $tasksResults = [];
    private array $tasksParams = [];

    public function __construct()
    {
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

        $this->tasksResults = [
            0 => "Hello World!",
            1 => $task_1,
            2 => $task_2,
            3 => $task_3,
            4 => $task_4,
            5 => "Kasjerka powinna oddać klientowi: 14zł 85 groszy.",
            6 => "Suma brutto: 139\nSuma netto: 126",
            7 => [
                "Klient B wydał więcej",
                "Klient A wydał więcej",
                "Klient A wydał tyle samo co klient B"
            ],
            8 => [
                "Dostęp przyznany",
                "Brak dostępu",
                "Brak dostępu",
                "Brak dostępu"
            ],
            9 => [
                "Możesz wziąć udział",
                "Możesz wziąć udział",
                "Nie spełniasz warunków",
                "Nie spełniasz warunków",
                "Nie spełniasz warunków",
                "Nie spełniasz warunków",
            ],
            10 => [
                "Rabat wynosi: 40zł",
                "Rabat wynosi: 0zł",
                "Rabat wynosi: 0zł",
                "Rabat wynosi: 20zł",
                "Rabat wynosi: 11zł",
                "Rabat wynosi: 0zł",
                "Rabat wynosi: 0zł",
                "Rabat wynosi: 0zł",
            ]
        ];
        $this->tasksParams = [
            7 => [[100, 200], [200, 100], [100, 100]],
            8 => [["admin", true], ["admin", false], ["user", true], ["user", false]],
            9 => [[true, 19], [true, 18], [true, 17], [false, 19], [false, 18], [false, 15]],
            10 => [[200, "gold"], [100, "gold"], [80, "gold"], [200, "silver"], [110, "silver"], [200, "none"], [100, "none"], [100, "silver"]]
        ];
    }

    public function test($taskId): void
    {
        $this->checkTaskId($taskId);
        if (array_key_exists($taskId, $this->tasksParams)) {
            foreach ($this->tasksParams[$taskId] as $index => $params) {
                $this->testTask($taskId, $index, $params);
            }
        } else {
            $this->testTask($taskId);
        }
    }

    private function checkTaskId($taskId): void
    {
        if (!is_numeric($taskId)) {
            throw new \Exception("Numer zadania musi być liczbą.");
        }

        $filePath = "tasks/zadanie_{$taskId}.php";

        if (!file_exists($filePath)) {
            throw new \Exception("Zadanie {$filePath} nie istnieje.");
        }

        if (!array_key_exists($taskId, $this->tasksResults)) {
            throw new \Exception("Zadanie {$filePath} nie istnieje.");
        }
        
        $this->filePath = $filePath;
    }

    private function testTask(int $taskId, ?int $index = null, ?array $params = null): void
    {
        ob_start();
        include $this->filePath;
        $output = ob_get_clean();
        $output = preg_replace("/\r\n|\r|\n/", PHP_EOL, $output);
        $output = preg_replace("/\t/", "    ", $output);
        if ($index !== null) {
            $message = "Oczekiwany wynik jest inny - dla danych: " . json_encode($params);
            $result = $this->tasksResults[$taskId][$index];
        } else {
            $message = "Oczekiwany wynik jest inny :(";
            $result = $this->tasksResults[$taskId];
        }

        if (trim($output) !== trim($result)) {
            $message = $message
                . PHP_EOL
                . PHP_EOL
                . "Oczekiwany wynik:"
                . PHP_EOL
                . $result
                . PHP_EOL
                . PHP_EOL
                . "Uzyskany wynik:"
                . PHP_EOL
                . $output
                . PHP_EOL;

            throw new Exception($message);
        }
    }
}

$tasks = new ShoperUpTests();
try {
    $tasks->test($taskId);
    echo "Brawo!" . PHP_EOL;
    die(0);
} catch (\Exception $e) {
    echo $e->getMessage();
    die(255);
}
