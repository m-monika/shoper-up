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

function isValidPostcode(string $postcode): bool 
{
	if (strlen($postcode) !== 6) {
        return false;
    }
    
    if (substr($postcode, 2, 1) !== '-') {
        return false;
    }
    
	$part1 = substr($postcode, 0, 2);
    if (!is_numeric($part1)) {
        return false;
    }

    $part2 = substr($postcode, 3, 3);
    if (!is_numeric($part2)) {
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