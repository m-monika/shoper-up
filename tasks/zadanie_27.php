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

function checkUsername(array &$newUser) : bool
{
    $newUser['username'] = trim($newUser['username']);
    return strlen($newUser['username']) >= 3;
}


function checkEmail(array &$newUser) : bool
{
    $newUser['email'] = strtolower(trim($newUser['email']));
    return filter_var($newUser['email'], FILTER_VALIDATE_EMAIL) !== false;
}


function checkPassword(array $newUser) : bool
{
    if (strlen($newUser['password1']) < 10) {
        return false;
    }

    return $newUser['password1'] === $newUser['password2'];
}


function registerUser(array &$newUser)
{
    if (checkUsername($newUser) && checkEmail($newUser) && checkPassword($newUser)) {
        echo $newUser['username'] . " (" . $newUser['email'] . ") został zarejestrowany";
    } else {
        echo "Niepoprawne dane";
    }
}

registerUser($newUser);