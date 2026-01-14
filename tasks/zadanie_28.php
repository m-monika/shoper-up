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

$clientsJson = $params[0]; // tej linijki nie ruszamy :)

$clients = json_decode($clientsJson, true);

$report = [
    "summary" => [
        "total" => count($clients),
        "success" => 0,
        "error" => 0
    ],
    "details" => []
];

function normalizeName($value): string {
    $value = trim($value);
    $value = strtolower($value);
    return ucfirst($value);
}

function normalizeEmail($email): string {
    return strtolower(trim($email));
}

function normalizePhone($phone): string {
    $digits = "";
    for ($i = 0; $i < strlen($phone); $i++) {
        if (is_numeric($phone[$i])) {
            $digits .= $phone[$i];
        }
    }

    if (substr($digits, 0, 2) === "48") {
        return "+".$digits;
    }

    return "+48".$digits;
}

function normalizeType($type): string {
    if ($type == 2) return "vip";
    return "standard";
}

function validateName($value): bool {
    return strlen($value) >= 2;
}

function validateEmail($email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validatePhone($phone): bool {
    if (substr($phone, 0, 3) !== "+48") return false;
    if (strlen($phone) !== 12) return false;

    for ($i = 3; $i < 12; $i++) {
        if (!is_numeric($phone[$i])) {
            return false;
        }
    }

    return true;
}

function validateType($type): bool {
    return $type === "standard" || $type === "vip";
}

foreach ($clients as $client) {

    $original = $client;

    $client["first_name"] = normalizeName($client["first_name"] ?? "");
    $client["last_name"] = normalizeName($client["last_name"] ?? "");
    $client["email"] = normalizeEmail($client["email"] ?? "");
    $client["phone"] = normalizePhone($client["phone"] ?? "");
    $client["type"] = normalizeType($client["type"] ?? null);

    $errors = [];
    if (!validateEmail($client["email"])) $errors["email"] = "Invalid field";
    if (!validateName($client["first_name"])) $errors["first_name"] = "Invalid field";
    if (!validateName($client["last_name"])) $errors["last_name"] = "Invalid field";
    if (!validatePhone($client["phone"])) $errors["phone"] = "Invalid field";
    if (!validateType($client["type"])) $errors["type"] = "Invalid field";

    if (count($errors) === 0) {
        $report["summary"]["success"]++;
        $report["details"][] = [
            "status" => "success",
            "data" => $client
        ];
    } else {
        $report["summary"]["error"]++;
        $report["details"][] = [
            "status" => "error",
            "errors" => $errors,
            "data" => $original
        ];
    }
}

echo json_encode($report);