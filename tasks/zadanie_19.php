<?php

/*
Napisz program, który oblicza koszt dostawy w zależności od wybranej metody dostawy i sumy zamówienia. Użyj instrukcji switch.

Zmienne:
$sum - suma zamówienia
$shipping - metoda dostawy

Koszty dostawy:
- paczkomat: 9 zł
- kurier: 15 zł
- sklep: 0 zł
- poczta: 20 zł

Jeśli zostanie wybrana inna metoda dostawy, program wyświetla komunikat:
Nieprawidłowa metoda dostawy.

Wysyłka jest darmowa, jeśli:
- wybrana metoda to 'paczkomat' i suma zamówienia przekracza 39 zł
- wybrana metoda to 'kurier' i suma zamówienia przekracza 49 zł

Jeśli wysyłka jest darmowa wyświetlamy komunikat:
Koszt dostawy wynosi 0 zł.

Przykład:

$sum = 20;
$shipping = 'paczkomat';

Koszt dostawy wynosi 9 zł.

*/

$sum = $params[0]; // tej linijki nie ruszamy :)
$shipping = $params[1]; // tej linijki nie ruszamy :)

switch($shipping){

    case 'paczkomat':
        echo "Koszt dostawy wynosi 9 zł.";
        break;
    case 'kurier':
        echo "Koszt dostawy wynosi 15 zł.";
        break;
    case 'poszta':
        echo "Koszt dostawy wynosi 20 zł.";
        break;

    case 'sklep':
        echo "Koszt dostawy wynosi 0 zł.";
        break;
    if($shipping == 'paczkomat' && $sum > 39) {
        echo "Koszt dostawy wynosi 0 zł.";
    } elseif ($shipping == 'kurier' && $sum > 49){
        echo "Koszt dostawy wynosi 0 zł.";
    } else {
        echo "Nieprawidłowa metoda dostawy.";
    }
}