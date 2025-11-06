<?php

/*

Napisz skrypt, który sprawdza, czy użytkownik może wziąć udział w konkursie.
Warunki udziału:
- wiek ≥ 18
- użytkownik zaznaczył zgodę na przetwarzanie danych ($consent = true)

Jeśli warunki są spełnione → "Możesz wziąć udział"
Jeśli nie → "Nie spełniasz warunków"

*/

$consent = $params[0]; // tej linijki nie ruszamy :)
$age = $params[1]; // tej linijki nie ruszamy :)

// ...

if ($consent == true && $age >= 18) {
    echo "Możesz wziąć udział";
} else {
    echo "Nie spełniasz warunków";
}