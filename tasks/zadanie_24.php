<?php

/*
Napisz program, który wyświetla listę produktów z możliwością filtrowania po cenie (używając array_filter):
- cena większa lub równa x zł
- cena mniejsza lub równa x zł

Zmienne:
$products - tablica z danymi produktów (ceny w groszach)
$filterPrice - cena, po której filtrujemy (w groszach)
$filterMode - rodzaj filtrowania: większa lub równa (gte) / mniejsza lub równa (lte)


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



$filterProducts = array_filter($products, function($product) use ($filterPrice, $filterMode) {

    if ($filterMode === 'gte') {
        return $product['price'] >= $filterPrice;
    }

    if ($filterMode === 'lte') {
        return $product['price'] <= $filterPrice;
    }

    return true;
});

if ($filterMode === 'gte') {
    usort($filterProducts, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($filterMode === 'lte') {
    usort($filterProducts, fn($a, $b) => $b['price'] <=> $a['price']);
}

foreach ($filterProducts as $product) {
    $name = $product['name'];
    $price = $product['price'];

    echo $name . ': ' . number_format($price / 100, 2, ',', ' ') . " zł" . PHP_EOL;
}