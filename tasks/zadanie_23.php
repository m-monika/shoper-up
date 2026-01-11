<?php

/*
Napisz program zawierający funkcję, która sprawdza czy podany kod pocztowy jest poprawny.
Program przyjmuje tablicę kodów i dla każdego wypisuje: "Kod poprawny" / "Kod niepoprawny"
Poprawny format kodu pocztowego: 11-111


Zmienne:
$postcodes - tablica kodów pocztowych do sprawdzenia

Przykład:

$postcodes = [
    '27-035',
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

function isValidPostcode($postcode): bool
{
    if (strlen($postcode) != 6) {
        return false;
    }

    if ($postcode[2] != '-') {
        return false;
    }

    if (!is_numeric($postcode[0]) || !is_numeric($postcode[1])) {
        return false;
    }

    if (!is_numeric($postcode[3]) || !is_numeric($postcode[4]) || !is_numeric($postcode[5])) {
        return false;
    }

    return true;
}

foreach ($postcodes as $postcode) {
    if (isValidPostcode($postcode)) {
        echo "Kod poprawny\n";
    } else {
        echo "Kod niepoprawny\n";
    }
}
