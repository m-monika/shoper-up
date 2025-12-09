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

function codeValid(string $code) : bool{
    
    if (strlen($code) !==6){
        return false;
    }
    if ($code[2] !== '-'){
        return false;
    }

    $firstPart = substr($code, 0, 2);
    $secPart = substr($code, 3, 3);
    
    if(!is_numeric($firstPart) || !is_numeric($secPart)){
        return false;
    }
    return true;
}

foreach ($postcodes as $code){
   if (codeValid($code)) {
    echo "Kod poprawny\n";
    }else {
        echo "Kod niepoprawny\n";
    }
}