<?php

/*
Napisz program, który obliczy cenę brutto na podstawie stawki VAT zależnej od kategorii produktu. Użyj instrukcji match.
Stawki VAT (zmyślone) dla kategorii:
- elektronika: 22%
- odzież: 22%
- żywność: 8%
- książki: 5%
- czasopisma: 5%
- pozostałe: 23%

Zmienne:
$net - cena netto
$category - kategoria produktu

Przykład:

$net = 100;
$category = 'odzież';

Cena brutto wynosi 122 zł.

*/

$net = $params[0]; // tej linijki nie ruszamy :)
$category = $params[1]; // tej linijki nie ruszamy :)

$vat = match ($category){
    'elektronika' => 22,
    'odzież' => 22,
    'żywność' => 8,
    'książki' => 5,
    'czasopisma' => 5,
    default => 23,
};

$brutto = $net * $vat / 100 + $net;
echo "Cena brutto wynosi ".$brutto." zł.";