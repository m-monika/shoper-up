<?php

/*
Napisz program, który wyświetla listę produktów z możliwością filtrowania po cenie (używając array_filter):
- cena większa lub równa x zł
- cena mniejsza lub równa x zł

Zmienne:
$products - tablica z danymi produktów (ceny w groszach)
$filterPrice - cena, po której filtrujemy (w groszach)
$filterMode - rodzaj filtrowania: większa lub równa (gte) / mniejsza lub równa (lte) jak nic to nie zwracać nic


Przykład:

$products = [
    [
        'name' => 'Laptop',
        'price' => 500000,
    ],
    [
        'name' => 'Klawiatura',
        'price' => 40000,
    ],
    [
        'name' => 'Mysz',
        'price' => 35000,
    ],
    [
        'name' => 'Monitor',
        'price' => 400000,
    ],
];

$filterPrice = 200000;
$filterMode = 'gte';

Wynik:

Laptop: 5000,00 zł
Monitor: 4000,00 zł
*/

$products = $params[0]; // tej linijki nie ruszamy :)
$filterPrice = $params[1]; // tej linijki nie ruszamy :)
$filterMode = $params[2]; // tej linijki nie ruszamy :)


$filteredArray = array_filter($products, function ($product) use ($filterPrice, $filterMode) {

    if ($filterMode == 'gte' && $product['price'] >= $filterPrice) {
    return true;
    } elseif ($filterMode == 'lte' && $product['price'] <= $filterPrice) {
    return true;
    } else {
    return false;
    }});

if (function_exists('finalPriceCalc') == false) {
function finalPriceCalc(int $price): string {
    return number_format($price * 0.01, 2, ",", "") . ' zł';
}}

if ($filteredArray) {

    foreach ($filteredArray as $value) {
        echo $value['name'] . ': ' . finalPriceCalc($value['price']) . PHP_EOL;
    }
}