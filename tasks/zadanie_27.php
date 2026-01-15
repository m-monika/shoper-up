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

function normalizeUser($user)
{
    $user['username'] = trim($user['username']);
    $user['email'] = strtolower(trim($user['email']));

    return $user;
}

function isValidUsername($username)
{
    return strlen($username) >= 3;
}

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function isValidPassword($password1, $password2)
{
    if (strlen($password1) < 10) {
        return false;
    }

    return $password1 === $password2;
}

$newUser = normalizeUser($newUser);

$usernameOk = isValidUsername($newUser['username']);
$emailOk = isValidEmail($newUser['email']);
$passwordOk = isValidPassword($newUser['password1'], $newUser['password2']);

if ($usernameOk && $emailOk && $passwordOk) {
    echo $newUser['username'] . " (" . $newUser['email'] . ") został zarejestrowany\n";
} else {
    echo "Niepoprawne dane\n";
}