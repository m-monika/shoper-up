<?php

/*
Napisz program zawierający funkcję, która sprawdza czy podany kod pocztowy jest poprawny.
Program przyjmuje tablicę kodów i dla każdego wypisuje: "Kod poprawny" / "Kod niepoprawny"
Poprawny format kodu pocztowego: 11-111


Zmienne:
$postcodes - tablica kodów pocztowych do sprawdzenia

Przykład:

$postcodes = [
    '',
    '22222',
    'asd',
    '44-432',
    '444-77',
];

Wynik:
Kod poprawny
Kod niepoprawny
Kod niepoprawny
Kod poprawny
Kod niepoprawny

*/

$postcodes = $params[0]; // tej linijki nie ruszamy :)

function postcodeVerify (string $postcode): string
{
    if (
        // sprawdź czy w sumie string składa się z 6 znaków
        strlen($postcode) === 6 &&
        // może być stringiem albo intem
        gettype($postcode) === "string" &&
        // pierwsze dwa znaki musza byc liczba
        is_numeric(substr($postcode, -6, 2)) &&
        // nastepny znak to myslnik
        substr($postcode, -4, 1) === "-" &&
        // kolejne trzy znaki muszą byc liczba
        is_numeric(substr($postcode, -3, 3))
    ) 
    {
        return "Kod poprawny" . PHP_EOL;
    }
    else 
    {
        return "Kod niepoprawny" . PHP_EOL;
    }
}

foreach ($postcodes as $postcode) {
    echo postcodeVerify($postcode);
}