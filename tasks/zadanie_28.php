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

$systemX = json_decode($clientsJson, true);

if (function_exists('normalizeFirstName') == false) {
    function normalizeFirstName (?array $systemX): ?array {

        $firstName = $systemX['first_name'];
        $firstName = trim($systemX['first_name']);
        $firstName = mb_strtolower($firstName);
        $firstName = ucfirst($firstName);

        return [
            'status' => 'success',
            'key' => 'first_name',
            'value' => $firstName
        ];

        if($firstName === null) {
            return [
                'status' => 'error',
                'key' => 'first_name',
                'error' => 'Invalid field',
                'value' => null
            ];
        }
    }
}


if (function_exists('normalizeLastName') == false) {
    function normalizeLastName (?array $systemX): ?array {

        $lastName = trim($systemX['last_name']);
        $lastName = mb_strtolower($lastName);
        $lastName = ucfirst($lastName);

        return [
                'status' => 'success',
                'key' => 'last_name',
                'value' => $lastName
        ];

        if ($lastName === null) {
            return [
                'status' => 'error',
                'key' => 'last_name',
                'error' => 'Invalid field',
                'value' => null
            ];
        }
    }
}

if (function_exists('normalizeEmail') == false) {
    function normalizeEmail (?array $systemX): ?array {

        $email = $systemX['email'];
        $email = trim($systemX['email']);
        $email = strtolower($email);

        return [
            'status' => 'success',
            'key' => 'email',
            'value' => $email
        ];
        if($email === null) {
            return [
                'status' => 'error',
                'key' => 'email',
                'error' => 'Invalid field',
                'value' => null
            ];
        }
    }
}

if (function_exists('normalizePhone') == false) {
    function normalizePhone (?array $systemX): ?array {
        
        $phone = $systemX['phone'];
        $phone = str_replace([" ", "-"], "", $phone);
        $phone = trim($phone);

        if ((strlen($phone) === 9) &&
            is_numeric($phone)) {
            $phone = '+48' . $phone;
            return [
                'status' => 'success',
                'key' => 'phone',
                'value' => $phone,
            ];
        } elseif ((strlen($phone) === 12) &&
        str_starts_with($phone, '+48') &&
        is_numeric(substr($phone, -9))) {
            return [
                'status' => 'success',
                'key' => 'phone',
                'value' => $phone,
            ];
        } elseif ($phone === null) {
            return [
                'status' => 'error',
                'key' => 'phone',
                'error' => 'Invalid field',
                'value' => null,
            ];
        } else {
            return [
                'status' => 'error',
                'key' => 'phone',
                'error' => 'Invalid field',
                'value' => $phone,
            ];
        }
    }
}

if(function_exists('normalizeType') == false) {
    function normalizeType (array $systemX): array {

        $type = 'standard';

        if(array_key_exists('type', $systemX)){ 
            if($systemX['type'] === 2) {
                $type = 'vip';
            }
        }

        return [
            'status' => 'success',
            'key' => 'type',
            'value' => $type,
        ];
    }
}

if (function_exists('normalizeData') == false) {
    function normalizeData (array $systemX): array {

        $normalizedSystemY = [];

        foreach ($systemX as $client => $clientData) {

            $temporaryClient = [];
            
            $result = normalizeFirstName($clientData);
            $temporaryClient['data']['first_name'] = $result['value'];
            
            $result = normalizeLastName($clientData);
            $temporaryClient['data']['last_name'] = $result['value'];
            

            $result = normalizeEmail($clientData);
            $temporaryClient['data']['email'] = $result['value'];
            

            $result = normalizePhone($clientData);
            $temporaryClient['data']['phone'] = $result['value'];

            $result = normalizeType($clientData);
            $temporaryClient['data']['type'] = $result['value'];

            $normalizedSystemY[$client] = $temporaryClient;
        }
        
        return $normalizedSystemY;
        
    } 
}

$normalizedSystemY = normalizeData($systemX);

if (function_exists('validateFirstName') == false) {
    function validateFirstName (array $normalizedSystemY): array {
        
        if (strlen($normalizedSystemY['data']['first_name']) < 2) {
            return [
                'status' => 'error',
                'key' => 'first_name',
                'error' => 'Invalid field',
                'value' => $normalizedSystemY['data']['first_name'],
            ];
        } else {
            return [
                'status' => 'success',
                'key' => 'first_name',
                'value' => $normalizedSystemY['data']['first_name'],
            ];
        }
    }
}

if (function_exists('validateLastName') == false) {
    function validateLastName (array $normalizedSystemY): array {
        if (strlen($normalizedSystemY['data']['last_name']) < 2) {
            return [
                'status' => 'error',
                'key' => 'last_name',
                'error' => 'Invalid field',
                'value' => $normalizedSystemY['data']['last_name'],
            ];
        } else {
            return [
                'status' => 'success',
                'key' => 'last_name',
                'value' => $normalizedSystemY['data']['last_name'],
            ];
        }
    }
}

if (function_exists('validateEmail') == false) {
    function validateEmail (array $normalizedSystemY): array {

        $emailSanitized = filter_var($normalizedSystemY['data']['email'], FILTER_SANITIZE_EMAIL);
        $emailValidated = filter_var($emailSanitized, FILTER_VALIDATE_EMAIL);

        if($emailSanitized && $emailValidated) {
            return [
                'status' => 'success',
                'key' => 'email',
                'value' => $emailValidated,
            ];
        } else {
            return [
                'status' => 'error',
                'key' => 'email',
                'value' => $emailValidated,
                'error' => 'Invalid field',
            ];
        }
    }
}

if (function_exists('validatePhone') == false) {
    function validatePhone (array $normalizedSystemY): array {

        $phone = $normalizedSystemY['data']['phone'];

        if((strlen($phone) === 12) &&
            str_starts_with($phone, '+48') &&
            is_numeric(substr($phone, -9)))
        {
            return [
                'status' => 'success',
                'key' => 'phone',
                'value' => $phone,
            ];
        } elseif ((strlen($phone) > 9) &&
        !str_starts_with($phone, '+48') &&
        is_numeric(substr($phone, -9))) {
            return [
                'status' => 'error',
                'key' => 'phone',
                'error' => 'Invalid field',
                'value' => $phone,
            ];
        } elseif ((strlen($phone) > 12) &&
        str_starts_with($phone, '+48') &&
        is_numeric(substr($phone, -9))
        ) 
        {
            return [
                'status' => 'error',
                'key' => 'phone',
                'error' => 'Invalid field',
                'value' => $phone,
            ];
        }
    }
}

if (function_exists('validateType') == false) {
    function validateType (array $normalizedSystemY): array {

        $type = $normalizedSystemY['data']['type'];

        if($type === 'standard' || $type === 'vip') {
            return [
                'status' => 'success',
                'key' => 'type',
                'value' => $type,
            ];
        } else {
            return [
                'status' => 'error',
                'key' => 'type',
                'error' => 'Nieprawidłowy typ usługi',
                'value' => $type,
            ];
        }
    }
}

if (function_exists('validateData') == false) {
    function validateData (array $normalizedSystemY): array {

        $systemY = [];
        $summary = [];

        foreach ($normalizedSystemY as $client => $clientData) {

            $temporaryClient = [
                'status' => null,
                'errors' => null,
                'data' => null,
            ];
            
            $result = validateFirstName($clientData);
            if ($result['status'] === 'error') {
                
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['errors'][$result['key']] = $result['error'];
                $temporaryClient['data']['first_name'] = $result['value'];
                
            } else {
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['data']['first_name'] = $result['value'];
            }

            $result = validateLastName($clientData);
            if ($result['status'] === 'error') {
                
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['errors'][$result['key']] = $result['error'];
                $temporaryClient['data']['last_name'] = $result['value'];
                
            } else {
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['data']['last_name'] = $result['value'];
            }

            $result = validateEmail($clientData);
            if ($result['status'] === 'error') {
                
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['errors'][$result['key']] = $result['error'];
                $temporaryClient['data']['email'] = $result['value'];
                
            } else {
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['data']['email'] = $result['value'];
            }

            $result = validatePhone($clientData);
            if ($result['status'] === 'error') {
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['errors'][$result['key']] = $result['error'];
                $temporaryClient['data']['phone'] = $result['value'];
            } else {
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['data']['phone'] = $result['value'];
            }

            $result = validateType($clientData);
            if ($result['status'] === 'error') {
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['errors'][$result['key']] = $result['error'];
                $temporaryClient['data']['type'] = $result['value'];
            } else {
                $temporaryClient['status'] = $result['status'];
                $temporaryClient['data']['type'] = $result['value'];
            }

            if($temporaryClient['errors'] === null) {
                unset($temporaryClient['errors']);
            } else {
                $temporaryClient['status'] = 'error';
            }
            
            $systemY[$client] = $temporaryClient;

            $summary = [
                'total' => count($systemY),
                'success' => 0,
                'error' => 0,
            ];

            foreach($systemY as $client) {
                if($client['status'] === 'success') {
                    $summary['success']++;
                } else {
                    $summary['error']++;
                }
            }

            $final = [
                'summary' => $summary,
                'details' => $systemY,
            ];
        }

        return $final;
    }
}

$systemY = validateData($normalizedSystemY);
$systemY = json_encode($systemY);
echo $systemY;