<?php

/*

Twoim zadaniem jest wyliczenie rabatu dla klientów.
Mamy typ klienta pod zmienną $type, może ona przyjmować wartości "silver" / "gold" / "none".
Jeśli klient jest typu "gold" dostaje rabat 20%.
Jeśli klient jest typu "silver" dostaje rabat 10%.
Jeśli klient jest typu "none" nie dostaje rabatu.

Rabat nalicza się tylko jeśli łączna kwota zakupów przekracza 100zł. 
Pod zmienną $productsCost znajduje się cena w złotówkach.

*/

$productsCost = $params[0]; // tej linijki nie ruszamy :)
$type = $params[1]; // tej linijki nie ruszamy :)

if ($type == "silver" ) {
    $discountAmount = $productsCost * 0.2;
}
elseif ($type == "gold") {
    $discountAmount = $productsCost * 0.1;
}
elseif ($type == "none" || $productsCost <= 100) {
    $discountAmount = 0;
}

echo "Rabat wynosi: {$discountAmount}zł";