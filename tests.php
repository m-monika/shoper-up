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
            14 => $task_14,
            15 => [
                "Najlepsza oferta: Sklep C — 1190 zł",
                "Najlepsza oferta: Sklep A — 120 zł",
                "Najlepsza oferta: Sklep B — 320 zł"
            ],
            16 => [
                "Lp. 1 | Laptop | 1 szt. | 3000 zł\nLp. 2 | Monitor | 4 szt. | 2800 zł\nLp. 3 | Klawiatura | 2 szt. | 100 zł",
                "Lp. 1 | Laptop | 3 szt. | 9000 zł\nLp. 2 | Monitor | 2 szt. | 1400 zł\nLp. 3 | Klawiatura | 2 szt. | 100 zł",
            ],
            17 => [
                "Produkt sprzedany, pozostało w magazynie: 3 szt.\nProdukt sprzedany, pozostało w magazynie: 2 szt.\nProdukt sprzedany, pozostało w magazynie: 1 szt.\nProdukt sprzedany, pozostało w magazynie: 0 szt.\nProdukt wyprzedany.",
                "Produkt sprzedany, pozostało w magazynie: 0 szt.\nProdukt wyprzedany.",
                "Produkt wyprzedany.",
            ],
            18 => [
                "Produkt dodany do koszyka. Aktualna suma koszyka: 40 zł\nProdukt dodany do koszyka. Aktualna suma koszyka: 80 zł\nProdukt dodany do koszyka. Aktualna suma koszyka: 120 zł\nOsiągnięto darmową wysyłkę. Łączna wartość zamówienia: 120 zł",
                "Produkt dodany do koszyka. Aktualna suma koszyka: 8 zł\nOsiągnięto darmową wysyłkę. Łączna wartość zamówienia: 8 zł",
                "Produkt dodany do koszyka. Aktualna suma koszyka: 50 zł\nOsiągnięto darmową wysyłkę. Łączna wartość zamówienia: 50 zł",
            ],
            19 => [
                "Koszt dostawy wynosi 9 zł.",
                "Nieprawidłowa metoda dostawy.",
                "Koszt dostawy wynosi 0 zł.",
                "Koszt dostawy wynosi 0 zł.",
            ],
            20 => [
                "Cena brutto wynosi 105 zł.",
                "Cena brutto wynosi 610 zł.",
                "Cena brutto wynosi 123000 zł.",
                "Cena brutto wynosi 1.08 zł.",
                "Cena brutto wynosi 0 zł.",
            ],
            21 => [
                "Liczba produktów: 5\nKlawiatura | 300 zł\nLaptop | 3000 zł\nMonitor | 2500 zł\nMysz | 250 zł\nSłuchawki | 700 zł",
                "Liczba produktów: 5\nHerbata | 12 zł\nChleb | 10 zł\nBanany | 8 zł\nMleko | 5 zł\nWoda | 3 zł",
                "Liczba produktów: 4\nSpodnie | 120 zł\nKurtka | 300 zł\nCzapka | 14 zł\nButy | 250 zł",
                "Liczba produktów: 4\nCzapka | 14 zł\nSpodnie | 120 zł\nButy | 250 zł\nKurtka | 300 zł",
                "Nieprawidłowy parametr.",
            ],
            22 => [
                "Cześć Ala! Mamy super ofertę specjalnie dla klentów VIP! Odwiedź nasz sklep!\nWitaj Jacek, sprawdź naszą ofertę! Odwiedź nasz sklep!\nWitaj Ola, sprawdź naszą ofertę! Odwiedź nasz sklep!",
            ],
            23 => [
                "Kod poprawny\nKod niepoprawny\nKod niepoprawny\nKod poprawny\nKod niepoprawny",
            ],
            24 => [
                "Laptop: 5000,00 zł\nKlawiatura: 400,00 zł\nMonitor: 4000,00 zł",
                "Mysz: 350,00 zł",
                "",
            ],
            25 => [
                "Monitor 27: 5000,00 zł\nLaptop: 3000,00 zł\nKlawiatura USB: 250,00 zł\nMysz bezprzewodowa: 200,00 zł\nKabel HDMI: 30,00 zł",
                "Mysz bezprzewodowa: 200,00 zł\nKlawiatura USB: 250,00 zł\nLaptop: 3000,00 zł\nMonitor 27: 5000,00 zł",
                "Kabel HDMI: 30,00 zł\nKlawiatura USB: 250,00 zł\nMonitor 27: 5000,00 zł\nLaptop: 3000,00 zł",
            ],
            26 => [
                "--- TWOJE ZAKUPY ---\n2x Chleb ... 8,00 PLN\n3x Mleko ... 4,00 PLN\n1x Czekolada ... 5,00 PLN\n--------------------\nDO ZAPŁATY: 33,00\n--------------------",
            ],
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
        $task_15_1 = [
            ["store" => "Sklep A", "price" => 1200],
            ["store" => "Sklep B", "price" => 1250],
            ["store" => "Sklep C", "price" => 1190]
        ];
        $task_15_2 = [
            ["store" => "Sklep A", "price" => 120],
            ["store" => "Sklep B", "price" => 240],
            ["store" => "Sklep C", "price" => 125]
        ];
        $task_15_3 = [
            ["store" => "Sklep A", "price" => 380],
            ["store" => "Sklep B", "price" => 320],
            ["store" => "Sklep C", "price" => 350]
        ];
        $task_16_1 = [
            [
                ["id" => 123, "name" => "Laptop", "price" => 3000, "qty" => 1],
                ["id" => 567, "name" => "Monitor", "price" => 700, "qty" => 2]
            ],
            ["id" => 678, "name" => "Klawiatura", "price" => 50, "qty" => 2],
            567,
            2
        ];
        $task_16_2 = [
            [
                ["id" => 111, "name" => "Laptop", "price" => 3000, "qty" => 1],
                ["id" => 222, "name" => "Monitor", "price" => 700, "qty" => 2]
            ],
            ["id" => 333, "name" => "Klawiatura", "price" => 50, "qty" => 2],
            111,
            2
        ];
        $task_21_1 = [
            [
                'Laptop' => 3000,
                'Monitor' => 2500,
                'Klawiatura' => 300,
                'Mysz' => 250,
                'Słuchawki' => 700,
            ],
            'name',
            'asc',
        ];
        $task_21_2 = [
            [
                'Chleb' => 10,
                'Mleko' => 5,
                'Banany' => 8,
                'Herbata' => 12,
                'Woda' => 3,
            ],
            'price',
            'desc',
        ];
        $task_21_3 = [
            [
                'Czapka' => 14,
                'Spodnie' => 120,
                'Buty' => 250,
                'Kurtka' => 300,
            ],
            'name',
            'desc',
        ];
        $task_21_4 = [
            [
                'Czapka' => 14,
                'Spodnie' => 120,
                'Buty' => 250,
                'Kurtka' => 300,
            ],
            null,
            'desc',
        ];
        $task_21_5 = [
            [
                'Czapka' => 14,
                'Spodnie' => 120,
                'Buty' => 250,
                'Kurtka' => 300,
            ],
            'category',
            null,
        ];
        $task_24_1 = [
            [
                ['name' => 'Laptop', 'price' => 500000],
                ['name' => 'Klawiatura', 'price' => 40000],
                ['name' => 'Mysz', 'price' => 35000],
                ['name' => 'Monitor', 'price' => 400000],
            ], 40000, 'gte',
        ];
        $task_24_2 = [
            [
                ['name' => 'Laptop', 'price' => 500000],
                ['name' => 'Klawiatura', 'price' => 40000],
                ['name' => 'Mysz', 'price' => 35000],
                ['name' => 'Monitor', 'price' => 400000],
            ], 35000, 'lte',
        ];
        $task_24_3 = [
            [
                ['name' => 'Laptop', 'price' => 500000],
                ['name' => 'Klawiatura', 'price' => 40000],
                ['name' => 'Mysz', 'price' => 35000],
                ['name' => 'Monitor', 'price' => 400000],
            ], 100000, 'eq',
        ];
        $task_25_1 = [
            [
                ['name' => 'Kabel HDMI', 'price' => 3000],
                ['name' => 'Klawiatura USB', 'price' => 25000],
                ['name' => 'Mysz bezprzewodowa', 'price' => 20000],
                ['name' => 'Monitor 27', 'price' => 500000],
                ['name' => 'Laptop', 'price' => 300000],
            ], 'desc',
        ];
        $task_25_2 = [
            [
                ['name' => 'Klawiatura USB', 'price' => 25000],
                ['name' => 'Mysz bezprzewodowa', 'price' => 20000],
                ['name' => 'Monitor 27', 'price' => 500000],
                ['name' => 'Laptop', 'price' => 300000],
            ], 'asc',
        ];
        $task_25_3 = [
            [
                ['name' => 'Kabel HDMI', 'price' => 3000],
                ['name' => 'Klawiatura USB', 'price' => 25000],
                ['name' => 'Monitor 27', 'price' => 500000],
                ['name' => 'Laptop', 'price' => 300000],
            ], 'asd',
        ];
        $task_26_1 = [
            [
                [
                    'name' => 'Chleb',
                    'price' => 800,
                    'qty' => 2,
                ],
                [
                    'name' => 'Mleko',
                    'price' => 400,
                    'qty' => 3,
                ],
                [
                    'name' => 'Czekolada',
                    'price' => 500,
                    'qty' => 1,
                ]
            ]
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
            14 => [[$task_14_1], [$task_14_2]],
            15 => [[$task_15_1], [$task_15_2], [$task_15_3]],
            16 => [$task_16_1, $task_16_2],
            17 => [[4], [1], [0]],
            18 => [[100, 40], [1, 8], [0, 50]],
            19 => [[20, 'paczkomat'], [100, 'allegrobox'], [10, 'sklep'], [120, 'kurier']],
            20 => [[100, 'książki'], [500, 'elektronika'], [100000, 'samochody'], [1, 'żywność'], [0, 'odzież']],
            21 => [$task_21_1, $task_21_2, $task_21_3, $task_21_4, $task_21_5],
            22 => [[[
                ['name' => 'Ala', 'vip' => true],
                ['name' => 'Jacek', 'vip' => false],
                ['name' => 'Ola'],
            ]]],
            23 => [[['27-035', '22222', 'asd', '44-432', '444-77']]],
            24 => [$task_24_1, $task_24_2, $task_24_3],
            25 => [$task_25_1, $task_25_2, $task_25_3],
            26 => [$task_26_1],
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
