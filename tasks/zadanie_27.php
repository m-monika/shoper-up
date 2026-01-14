<?php

$newUser = $params[0]; // tej linijki nie ruszamy :)

//usunięcie białych znaków w loginie
$newUser['username'] = trim($newUser['username']);
//usuwanie bialych znaków i zamiana na małe litery w mailu
$newUser['email'] = strtolower(trim($newUser['email']));

$error = [];

//sprawdzanie dlugosci loginu
if (strlen($newUser['username']) < 3) {
	$error[] = "Niepoprawne dane";
}

//sprawdzanie emalia
if (!filter_var($newUser['email'], FILTER_VALIDATE_EMAIL)) {
	$error[] = "Niepoprawne dane";
}

//sprawdzanie dlugości hasła
if (strlen($newUser['password1']) < 10) {
	$error[] = "Niepoprawne dane";
}

//sprawdzanie czy obydwa hasła są takie same
if ($newUser['password1'] !== $newUser['password2']) {
	$error[] = "Niepoprawne dane";
}

if (empty($error)) {
	echo $newUser['username'] . ' (' . strtolower(trim($newUser['email'])) . ')' . ' został zarejestrowany';
} else {
	echo "Niepoprawne dane";
}