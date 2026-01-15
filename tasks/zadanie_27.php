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

function normalizeUsername(string $username): string {
    return trim($username);
}
function normalizeEmail(string $email):string {
    return strtolower(trim($email));
}

function validateUsername(string $username): bool {
    return strlen($username) >= 3;
}
function validateEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validatePasswords(string $p1, string $p2): bool {
    if (strlen($p1) < 10){
        return false;
    }

    if ($p1 !== $p2) {
        return false;
    }
    return true;
}

$newUser['username'] = normalizeUsername ($newUser['username']);
$newUser['email'] = normalizeEmail($newUser['email']);

$isValid =
    validateUsername($newUser['username']) &&
    validateEmail($newUser['email']) &&
    validatePasswords($newUser['password1'], $newUser['password2']);

if ($isValid) {
    echo $newUser['username'] . " (" . $newUser['email'] . ") został zarejestrowany";
} else {
    echo "Niepoprawne dane";
}