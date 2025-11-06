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

// Case with +48 - need to check it before using is_numeric

if (str_starts_with($phoneNumber, "+48") && strlen($phoneNumber) == 12) {
    // Need to check if last 9 chars are numeric
    $valueForCheck = substr($phoneNumber, -9);
    if (is_numeric($valueForCheck)) {
        echo "Poprawny";
        exit();
    } else {
        echo "Niepoprawny";
        exit();
    }
}

// Without "+" it's safe to call is_numeric

if (is_numeric($phoneNumber) == false) {
    echo "Niepoprawny";
    exit();
}

// Ensuring that we are dealing with int

$phoneNumber = (int)$phoneNumber;

// Now we can check if the number is within correct range

if ($phoneNumber > 100000000 && $phoneNumber < 999999999) {
    echo "Poprawny";
} else {
    echo "Niepoprawny";
}