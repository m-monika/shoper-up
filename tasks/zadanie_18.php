<?php

/*
Napisz program, który symuluje dodawanie produktu do koszyka w sklepie internetowym, aż do uzyskania progu darmowej dostawy.

Zmienne:
$freeDeliveryThreshold - kwota, jaką trzeba uzyskać, aby dostawa była darmowa.
$price - cena produktu

Przykład

$freeDeliveryThreshold = 100;
$price = 40;

Produkt dodany do koszyka. Aktualna suma koszyka: 40 zł
Produkt dodany do koszyka. Aktualna suma koszyka: 80 zł
Produkt dodany do koszyka. Aktualna suma koszyka: 120 zł
Osiągnięto darmową wysyłkę. Łączna wartość zamówienia: 120 zł

*/

$freeDeliveryThreshold = $params[0]; // tej linijki nie ruszamy :)
$price = $params[1]; // tej linijki nie ruszamy :)

$suma = 0; // wartość koszyka

do {
    $suma = $suma + $price;
    echo "Produkt dodany do koszyka. Aktualna suma koszyka: " . $suma . " zł\n";
} while ($suma < $freeDeliveryThreshold);

echo "Osiągnięto darmową wysyłkę. Łączna wartość zamówienia: " . $suma . " zł";
