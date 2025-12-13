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

function normalizeEmail(string $email): string {
    $trimmedEmail = trim($email);
    return strtolower($trimmedEmail);
}

function validateUsername(string $username): bool {
    if (strlen($username) >= 3) {
        return true;
    } else {
        return false;
    }
}

function validateEmail(string $email): bool {
    $validatedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($validatedEmail) {
        return true;
    } else {
        return false;
    }
}

function validatePassowrd(string $password): bool {
    if (strlen($password) >= 10) {
        return true;
    } else {
        return false;
    }
}

function comparePasswords(string $pass1, string $pass2): bool {
    if ($pass1 == $pass2) {
        return true;
    } else {
        return false;
    }
}

$email = $newUser['email'];
$username = $newUser['username'];
$pass1 = $newUser['password1'];
$pass2 = $newUser['password2'];

$username = normalizeUsername($username);
$email = normalizeEmail($email);

if (!comparePasswords($pass1, $pass2)) {
    echo 'Niepoprawne dane';
    exit();
}

if (validateUsername($username) && validateEmail($email) && validatePassowrd($pass1)) {
    echo $username . ' (' . $email . ') został zarejestrowany';
} else {
    echo 'Niepoprawne dane';
}