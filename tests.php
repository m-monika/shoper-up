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
        $task_13 = [
            "ITEM-0001\nITEM-0002\nITEM-0003",
            "ITEM-0001\nITEM-0002\nITEM-0003\nITEM-0004",
            "ITEM-0009\nITEM-0010\nITEM-0011\nITEM-0012",
            "ITEM-0996\nITEM-0997\nITEM-0998\nITEM-0999\nITEM-1000",
            "ITEM-0098\nITEM-0099\nITEM-0100\nITEM-0101\nITEM-0102",
            "ITEM-0999\nITEM-1000\nITEM-1001\nITEM-1002\nITEM-1003"
        ];
        $task_14 = [
            "Lp. 1 | Laptop | 1 szt. | 3000 zł | VAT 23% | brutto: 3000 zł"
            . "\nLp. 2 | Monitor | 2 szt. | 700 zł | VAT 23% | brutto: 1400 zł"
            . "\n\nSUMA BRUTTO: 4400 zł",

            "Lp. 1 | Rękawiczki | 2 szt. | 30 zł | VAT 23% | brutto: 60 zł"
            . "\nLp. 2 | Bluza | 3 szt. | 100 zł | VAT 7% | brutto: 300 zł"
            . "\nLp. 3 | Koszulka | 2 szt. | 50 zł | VAT 22% | brutto: 100 zł"
            . "\n\nSUMA BRUTTO: 460 zł"
        ];

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
            ],
            11 => [
                'Poprawny',
                'Poprawny',
                'Niepoprawny',
                'Niepoprawny',
                'Poprawny',
                'Niepoprawny',
                'Niepoprawny',
                'Niepoprawny',
                'Niepoprawny'
            ],
            12 => ['5 4 3 2 1', '3 2 1', '7 6 5 4 3 2 1', '1', '', ''],
            13 => $task_13,
            14 => $task_14
        ];
        $task_14_1 = [
            ["name" => "Laptop", "price" => 3000, "qty" => 1, "vat" => 23],
            ["name" => "Monitor", "price" => 700, "qty" => 2, "vat" => 23]
        ];
        $task_14_2 = [
            55 => ["name" => "Rękawiczki", "price" => 30, "qty" => 2, "vat" => 23],
            77 => ["name" => "Bluza", "price" => 100, "qty" => 3, "vat" => 7],
            34 => ["name" => "Koszulka", "price" => 50, "qty" => 2, "vat" => 22]
        ];
        $this->tasksParams = [
            7 => [[100, 200], [200, 100], [100, 100]],
            8 => [["admin", true], ["admin", false], ["user", true], ["user", false]],
            9 => [[true, 19], [true, 18], [true, 17], [false, 19], [false, 18], [false, 15]],
            10 => [[200, "gold"], [100, "gold"], [80, "gold"], [200, "silver"], [110, "silver"], [200, "none"], [100, "none"], [100, "silver"]],
            11 => [
                [123456789],
                ["123456789"],
                ["12345678a"],
                [12345678],
                ["+48123456789"],
                ["+4812345678"],
                ["+4812345678a"],
                ["+as123456789"],
                ["+49123456789"]
            ],
            12 => [[5], [3], [7], [1], [0], [-5]],
            13 => [[3, 1], [4, 1], [4, 9], [5, 996], [5, 98]],
            14 => [[$task_14_1], [$task_14_2]]
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
