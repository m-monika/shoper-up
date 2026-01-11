<?php

/*
Otrzymujesz tablicę asocjacyjną zawierającą dane nowego użytkownika systemu.
Twoim zadaniem jest normalizacja tych danych oraz wykonanie walidacji przy użyciu funkcji wbudowanych i własnych.

Normalizacja:
- username - usuwamy białe znaki z początku i końca (trim)
- email - usuwamy białe znaki z początku i końca, duże litery zamieniamy na małe

Walidacja:
- username - min. 3 znaki
- email - poprawny adres email (filter_var)
- password - min. 10 znaków, podane 2 razy (password1, password2), musi się zgadzać

Dane wejściowe:
array $newUser - tablica asocjacyjna zawierająca dane nowego użytkownika (email, username, password1, password2)

Przykład:
$newUser = [
    'email' => '  x@SHOPER.PL',
    'username' => 'SuperUSER',
    'password1' => 'admin12345',
    'password2' => 'admin12345',
];

SuperUSER (x@shoper.pl) został zarejestrowany

$newUser = [
    'email' => '  x@SHOPER.PL',
    'username' => 'X',
    'password1' => 'admin12345',
    'password2' => '12345admin',
];

Niepoprawne dane

*/

$newUser = $params[0]; // tej linijki nie ruszamy :)

function normalizeUsername (array $newUser): array {
    if (!empty($newUser['username'])){
        $trimedUser = trim($newUser['username']);
        $newUser['username'] = $trimedUser;
        return [
            'success' => true,
            'value' => $newUser['username'],
        ];
    } else {
        return [
            'success' => false,
        ];
    }
}

function normalizeEmail (array $newUser): array {
    if (!empty($newUser['email'])){
        $trimedEmail = trim($newUser['email']);
        $newUser['email'] = $trimedEmail;
        $strtolowerUser = strtolower($newUser['email']);
        $newUser['email'] = $strtolowerUser;
        return [
            'success' => true,
            'value' => $newUser['email'],
        ];
    } else {
        return [
            'success' => false,
        ];
    }
}

function validateUsername (array $newUser): array {
    if ((!empty($newUser['username']) && (strlen($newUser['username']) >= 3)))
    {
        return [
            'success' => true,
            'value' => $newUser['username'],
        ];
    } else {
        return [
            'success' => false,
        ];
    }
}

function validateEmail (array $newUser): array {

    $emailSanitized = filter_var($newUser['email'], FILTER_SANITIZE_EMAIL);
    $emailValidated = filter_var($newUser['email'], FILTER_VALIDATE_EMAIL);

    if($emailSanitized && $emailValidated)
    {
        return [
            'success' => true,
            'value' => $newUser['email'],
        ];
    } else {
        return [
            'success' => false,
        ];
    }
}


function validatePassword (array $newUser): array {
    if ($newUser['password1'] === $newUser['password2'] &&
        strlen($newUser['password1']) >= 10 &&
        strlen($newUser['password2']) >= 10) 
    {
        return [
            'success' => true,
            'value' =>  [
                'pass1' => $newUser['password1'],
                'pass2' => $newUser['password2'],
            ]
        ];
    } else {
        return [
            'success' => false,
        ];
    }
}

function registration (array $newUser): array {
    
    $result = normalizeUsername($newUser);
    if (!$result['success']) return ['success' => false,];
    $newUser['username'] = $result['value'];

    $result = normalizeEmail($newUser);
    if (!$result['success']) return ['success' => false,];
    $newUser['email'] = $result['value'];

    $result = validateUsername($newUser);
    if (!$result['success']) return ['success' => false,];
    
    $result = validatePassword($newUser);
    if (!$result['success']) return ['success' => false,];

    if($result['success']) {
        return [
            'success' => true,
            'user' => $newUser,
        ];
    }
}

$registration = registration($newUser);

// dump($registration);

if ($registration['success']) {
    echo $registration['user']['username'] . " (" . $registration['user']['email'] . ") " . "został zarejestrowany";
} else {
    echo "Niepoprawne dane";
}