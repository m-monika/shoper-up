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

function validatePostCodes(array $postcodes): void {

    $ok = "Kod poprawny" . PHP_EOL;
    $fail = "Kod niepoprawny" . PHP_EOL;

    foreach ($postcodes as $value) {

        if (strlen($value) != 6) {
            echo $fail;
            continue;
        }

        if (is_numeric(substr($value, -6, 2)) == true && 
            is_numeric(substr($value, -3, 3)) == true && 
            (substr($value, -4, 1) == "-")) 
            {
            echo $ok;
            continue;
            } else {
            echo $fail;
        }
        }
    }

validatePostCodes($postcodes);