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

function formatChecker(string $data): bool
{
    if ((strlen($data) == 6) && (ctype_digit($data[0]) && ctype_digit($data[1]) 
        && ctype_digit($data[3]) && ctype_digit($data[4]) 
        && ctype_digit($data[5]) && $data[2] === '-')) {
        return true;
    } else {
        return false;
    }
}

function postalCodesChecker(array $codes): array
{
    $code_status = [];

    foreach ($codes as $code) {
        $code_status[] = formatChecker($code) ? 'Kod poprawny' : 'Kod niepoprawny';
    }

    return $code_status;
}

$results = postalCodesChecker($postcodes);
foreach ($results as $result) {
    echo $result . "\n";
}