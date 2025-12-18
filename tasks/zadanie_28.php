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
- phone - zaczyna się od +48, następnie 9 cyfr (dokleić +48 jak nie ma)
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

// normalize provided data entry and return updated array
function normalizeData(array $dataArray): array {

  if (!isset($dataArray['type']) || $dataArray['type'] == 1) {
    $type = "standard";
  } else {
    $type = "vip";
  }

  if (function_exists('nameNormalize') == false) {
  function nameNormalize(string $name): string {
    $name = trim($name);
    $name = strtolower($name);
    $name = ucfirst($name);
    return $name;
  }
  }

  $first_name = nameNormalize($dataArray['first_name']);
  $last_name = nameNormalize($dataArray['last_name']);

  $email = trim($dataArray['email']);
  $email = strtolower($email);

  if (function_exists('phoneNormalize') == false) {
    function phoneNormalize(string $phone): string {

      $specialChars = array("-", " ", ".");
      $phone = str_replace($specialChars, "", $phone);

      if (str_starts_with($phone, "+48") && strlen($phone) == 12 && is_numeric(substr($phone, -11, 11))) {
        return $phone;
      } elseif (strlen($phone) == 9 && is_numeric($phone)) {
        return '+48' . $phone;
      } else { 
        return "not_valid";
      }
    }
    }

    $phone = phoneNormalize($dataArray['phone']);

    $dataArray = [
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'phone' => $phone,
      'type' => $type
    ];

    return $dataArray;
}

// validates the data entry and return array with status & data
function validateData(array $dataArray, array $dataArrayOriginal): array {
  $d = $dataArray;
  $do = $dataArrayOriginal;

  $statusFlag = true;

  $details = [
    'status' => '',
    'errors' => [],
    'data' => [ 
      'first_name' => $d['first_name'],
      'last_name' => $d['last_name'],
      'email' => $d['email'],
      'phone' => $d['phone'],
      'type' => $d['type']
    ]
  ];

  if (strlen($d['first_name']) < 2) {
    $details['errors']['first_name'] = 'Invalid field';
    $statusFlag = false;
  }
  // email field is not in order (!)
  if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
    $details['errors']['email'] = 'Invalid field';
    $statusFlag = false;
  }
  if (strlen($d['last_name']) < 2) {
    $details['errors']['last_name'] = 'Invalid field';
    $statusFlag = false;
  }
  if ($d['phone'] == 'not_valid') {
    $details['errors']['phone'] = 'Invalid field';
    $statusFlag = false;
  }
  if ($d['type'] != 'standard' && $d['type'] != 'vip') {
    $details['errors']['type'] = 'Invalid field';
    $statusFlag = false;
    }

  if (!$statusFlag) {
    $details['status'] = 'error';
    // if there is any error with data, we need to pass original data into the raport
    $details['data'] = [ 
      'first_name' => $do['first_name'],
      'last_name' => $do['last_name'],
      'email' => $do['email'],
      'phone' => $do['phone'],
      'type' => $do['type']
    ];
  } elseif ($statusFlag) {
    $details['status'] = 'success';
    unset($details['errors']);
  }

  return $details;

}


// this function process received JSON data, normalize it, verify it and then returning report in json string //
function processApiCall(string $reveicedJsonString): string {

  $decodedArray = json_decode($reveicedJsonString, true);

  $totalCount = 0;
  $successCount = 0;
  $errorCount = 0;

  $raport = [
    'summary' => [
      'total' => 0,
      'success' => 0,
      'error' => 0
    ],
    'details' => []
    ];

  foreach ($decodedArray as $entry) {
    $totalCount ++;
    $givenArray = $entry;
    $normalizedArray = normalizeData($entry);
    
    $entryRaport = validateData($normalizedArray, $givenArray);

    if ($entryRaport['status'] == 'error') {
      $errorCount ++;
    } elseif ($entryRaport['status'] == 'success') {
      $successCount ++;
    }

    $raport['details'][] = $entryRaport;

  }

  $raport['summary']['total'] = $totalCount;
  $raport['summary']['success'] = $successCount;
  $raport['summary']['error'] = $errorCount;

  return json_encode($raport);

}

$apiResponse = processApiCall($clientsJson);

echo $apiResponse;