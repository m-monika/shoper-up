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

function checkPostcode( string $check) : bool
{
    if (strlen($check) !== 6){
        return false;

    }elseif (substr($check, 2, 1) !== "-"){
        return false;
        
    }else{
        return true;
    }
}

foreach ($postcodes as $check) {
       if (checkPostcode($check)){
        echo "Kod poprawny" .PHP_EOL;
       
    }else{
        echo "Kod niepoprawny" .PHP_EOL;
       }
        
}