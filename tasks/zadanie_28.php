<?php

/*
Otrzymujesz JSON-a z danymi klientów z systemu X, które trzeba zaimportować do systemu Y.
Twoim zadaniem jest przetworzenie tej listy, normalizacja danych (naprawienie błędów formatowania), walidacja i odrzucenie rekordów, które są niekompletne.
Musisz też wygenerować raport końcowy, który powie, ilu użytkowników udało się zaimportować, a ilu odrzucono i dlaczego.
Raport powinien być w formacie json.

Normalizacja:
- first_name, last_name - usuwamy białe znaki z początku i końca, pierwsza litera wielka, pozostałe litery małe
- email - usuwamy białe znaki z początku i końca, małe litery
- phone - zaczyna się od +48, potem same cyfry
- type - w systemie X to int, w systemie Y to string (standard, vip), musimy zmienić stringa na inta:
    1 -> standard
    2 -> vip
    każda inna wartość lub brak wartości -> standard

Walidacja:
- first_name, last_name - min. 2 znaki
- email - poprawny adres email (filter_var)
- phone - zaczyna się od +48, następnie 9 cyfr
- type - standard lub vip
w przypadku niepoprawnej walidacji zwracamy komunikat "Invalid field"

Dane wejściowe:
string $clientsJson- string w formacie json zawierający dane klientów do zaimportowania

Przykład:
[
  {
    "first_name": "  ADAM ",
    "last_name": "Nowak",
    "email": "Adam.Nowak@example.com",
    "phone": "500-123-456"
  },
  {
    "first_name": "Ewa",
    "last_name": "",
    "email": "bledny-email",
    "phone": "600123456",
    "type": 1
  },
  {
    "first_name": "Piotr",
    "last_name": "Kowalski",
    "email": "piotr.k@example.com",
    "phone": "+48 700 123 456",
    "type": 2
  }
]
przekazany w formie:
$clientsJson = '[{"first_name":"  ADAM ","last_name":"Nowak","email":"Adam.Nowak@example.com","phone":"500-123-456"},{"first_name":"Ewa","last_name":"","email":"bledny-email","phone":"600123456","type":1},{"first_name":"Piotr","last_name":"Kowalski","email":"piotr.k@example.com","phone":"+48 700 123 456","type":2},{"first_name":"Pawe\u0142","last_name":"NOWAK ","email":"pawelnowakk@example.com","phone":"+90 700 123 456","type":1}]';

Oczekiwany rezultat (raport) składający się z części:
- summary - zawiera informacje o całkowitej liczbie przetworzonych rekordów oraz o liczbie rekordów przetworzonych pozytywnie i negatywnie
- details - zawiera wyniki dla każdego wiersza:
    status oraz znormalizowane dane klienta (w przypadku walidacji pozytywnej)
    status, listę błędów oraz dane wejściowe klienta (w przypadku walidacji negatywnej)
o następującej strukturze (json):
{
  "summary": {
    "total": 4,
    "success": 2,
    "error": 2
  },
  "details": [
    {
      "status": "success",
      "data": {
        "first_name": "Adam",
        "last_name": "Nowak",
        "email": "adam.nowak@example.com",
        "phone": "+48500123456",
        "type": "standard"
      }
    },
    {
      "status": "error",
      "errors": {
        "email": "Invalid field",
        "last_name": "Invalid field"
      },
      "data": {
        "first_name": "Ewa",
        "last_name": "",
        "email": "bledny-email",
        "phone": "600123456",
        "type": 1
      }
    },
    {
      "status": "success",
      "data": {
        "first_name": "Piotr",
        "last_name": "Kowalski",
        "email": "piotr.k@example.com",
        "phone": "+48700123456",
        "type": "vip"
      }
    },
    {
      "status": "error",
      "errors": {
        "phone": "Invalid field"
      },
      "data": {
        "first_name": "Paweł",
        "last_name": "NOWAK ",
        "email": "pawelnowakk@example.com",
        "phone": "+90 700 123 456",
        "type": 1
      }
    }
  ]
}

zwrócony w formie:
{"summary":{"total":4,"success":2,"error":2},"details":[{"status":"success","data":{"first_name":"Adam","last_name":"Nowak","email":"adam.nowak@example.com","phone":"+48500123456","type":"standard"}},{"status":"error","errors":{"email":"Invalid field","last_name":"Invalid field"},"data":{"first_name":"Ewa","last_name":"","email":"bledny-email","phone":"600123456","type":1}},{"status":"success","data":{"first_name":"Piotr","last_name":"Kowalski","email":"piotr.k@example.com","phone":"+48700123456","type":"vip"}},{"status":"error","errors":{"phone":"Invalid field"},"data":{"first_name":"Pawe\u0142","last_name":"NOWAK ","email":"pawelnowakk@example.com","phone":"+90 700 123 456","type":1}}]}
*/

/*czyszczenie danych,normalizacja,poprawność pól, raport końcowy, dodałem !function_exists dla pewności tak jak mi AI w bodaj 25 zadaniu podpowiedziało żeby przejść testy
wspomagałem się trochę AI, bo na pewnym etapie pisania już się pogubiłem
czas pisania + testy = ~4h :rotfl:
*/

$clientsJson = $params[0]; // tej linijki nie ruszamy :)

if (!function_exists('normalizeName')) {
    function normalizeName($value)
    {
        $value = trim((string)$value);
        if ($value === '') {
            return '';
        }

        if (function_exists('mb_strtolower') && function_exists('mb_convert_case')) {
            $lower = mb_strtolower($value, 'UTF-8');
            return mb_convert_case($lower, MB_CASE_TITLE, 'UTF-8');
        }

        $lower = strtolower($value);
        return ucfirst($lower);
    }
}

if (!function_exists('normalizeEmail')) {
    function normalizeEmail($value)
    {
        return strtolower(trim((string)$value));
    }
}

if (!function_exists('normalizeType')) {
    function normalizeType($value)
    {
        if ((int)$value === 2) {
            return 'vip';
        }
        return 'standard';
    }
}

if (!function_exists('normalizePhone')) {
    function normalizePhone($value)
    {
        $raw = trim((string)$value);
        if ($raw === '') {
            return '';
        }

        $digits = preg_replace('/\D+/', '', $raw); // usuwanie znakow innych niż cyfry: https://www.php.net/manual/en/function.preg-replace.php (wrzuciłem notke z dokumentacji do AI żeby mi wygenerował właściwą wartość, bo się pogubiłem sam jak to robiłem :D)

        if (strlen($digits) === 11 && substr($digits, 0, 2) === '48') {
            return '+' . $digits;
        }

        if (strlen($digits) === 9) {
            return '+48' . $digits;
        }

        return '+' . $digits;
    }
}

if (!function_exists('isValidName')) {
    function isValidName($value)
    {
        return strlen($value) >= 2;
    }
}

if (!function_exists('isValidEmail')) {
    function isValidEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!function_exists('isValidPhone')) {
    function isValidPhone($value)
    {
        return preg_match('/^\+48\d{9}$/', $value) === 1; //tutaj również ciocia gemini generowała preg_match
    }
}

if (!function_exists('isValidType')) {
    function isValidType($value)
    {
        return $value === 'standard' || $value === 'vip';
    }
}

$clients = json_decode($clientsJson, true);

if (!is_array($clients)) {
    $report = [
        'summary' => [
            'total' => 0,
            'success' => 0,
            'error' => 0,
        ],
        'details' => [],
    ];
    echo json_encode($report);
    exit;
}

$details = [];
$successCount = 0;
$errorCount = 0;

foreach ($clients as $client) {
    $inputData = is_array($client) ? $client : [];

    $firstNameRaw = isset($client['first_name']) ? $client['first_name'] : '';
    $lastNameRaw  = isset($client['last_name']) ? $client['last_name'] : '';
    $emailRaw     = isset($client['email']) ? $client['email'] : '';
    $phoneRaw     = isset($client['phone']) ? $client['phone'] : '';
    $typeRaw      = isset($client['type']) ? $client['type'] : null;

    $firstName = normalizeName($firstNameRaw);
    $lastName  = normalizeName($lastNameRaw);
    $email     = normalizeEmail($emailRaw);
    $phone     = normalizePhone($phoneRaw);
    $type      = normalizeType($typeRaw);

    $errors = [];

    if (!isValidName($firstName)) {
        $errors['first_name'] = 'Invalid field';
    }

    if (!isValidEmail($email)) {
        $errors['email'] = 'Invalid field';
    }

    if (!isValidName($lastName)) {
        $errors['last_name'] = 'Invalid field';
    }

    if (!isValidPhone($phone)) {
        $errors['phone'] = 'Invalid field';
    }

    if (!isValidType($type)) {
        $errors['type'] = 'Invalid field';
    }

    if (count($errors) === 0) {
        $successCount++;

        $details[] = [
            'status' => 'success',
            'data' => [
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'email'      => $email,
                'phone'      => $phone,
                'type'       => $type,
            ],
        ];
    } else {
        $errorCount++;

        $details[] = [
            'status' => 'error',
            'errors' => $errors,
            'data'   => $inputData,
        ];
    }
}

$report = [
    'summary' => [
        'total' => count($clients),
        'success' => $successCount,
        'error' => $errorCount,
    ],
    'details' => $details,
];

echo json_encode($report);

