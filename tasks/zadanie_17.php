<?php

/*
Napisz program, który symuluje sprzedaż produktu w sklepie internetowym, aż do wyczerpania zapasów.
Program powinien wyświetlić informacje o każdorazowej sprzedaży produktu i aktualnym stanie magazynowym.
Gdy nie ma już produktów, wyświetla się informacja: Produkt wyprzedany.

Zmienne:
$stock - aktualny stan magazynowy produktu

Przykład

$stock = 4;

Produkt sprzedany, pozostało w magazynie: 3 szt.
Produkt sprzedany, pozostało w magazynie: 2 szt.
Produkt sprzedany, pozostało w magazynie: 1 szt.
Produkt sprzedany, pozostało w magazynie: 0 szt.
Produkt wyprzedany.

*/

$stock = $params[0]; // tej linijki nie ruszamy :)

$i = $stock;

while ($i > 0){
    echo "Produkt sprzedany, pozostało w magazynie: " . --$i . " szt." . PHP_EOL;
    if ($i === 0){
        echo "Produkt wyprzedany.";
        break;
    }
}