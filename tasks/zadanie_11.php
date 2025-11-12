<?php

/*

Twoim zadaniem jest sprawdzenie czy przekazany numer telefonu
jest prawidłowym polskim numerem telefonu, przy założeniu, 
że akceptujemy numer telefonu w 2 formach:

- 9 cyfr, np. 123456789
- +48xxxxxxxxx

W ramach tego zadania NIE używamy funkcji:
- preg_match

Jeśli numer telefonu jest prawidłowy -> "Poprawny"
Jeśli numer telefonu nie jest prawidłowy -> "Niepoprawny"

Przykłady testowe:

- 123456789 - Poprawny
- "123456789" - Poprawny
- "12345678a" - Niepoprawny
- 12345678 - Niepoprawny
- "+48123456789" - Poprawny
- "+4812345678" - Niepoprawny
- "+4812345678a" - Niepoprawny
- "+as123456789" - Niepoprawny
- "+49123456789" - Niepoprawny

*/

$phoneNumber = $params[0]; // tej linijki nie ruszamy :)

if (is_numeric($phoneNumber) && strlen($phoneNumber)==9) {
    echo "Poprawny".PHP_EOL;
}elseif (is_string($phoneNumber) && strlen($phoneNumber)==12 && substr($phoneNumber, 0, 3 ) == "+48" &&  is_numeric(substr($phoneNumber, 4, 9 ))){
    echo "Poprawny".PHP_EOL;
}else{
    echo "Niepoprawny".PHP_EOL;
}


