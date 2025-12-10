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

function productFiltered (string $filterMode, array $products, int $filterPrice) {
    if ($filterMode === 'gte') {
        return array_filter($products, function($product) use ($filterPrice, $filterMode) {
            return $product['price'] >= $filterPrice;
        });
    } elseif ($filterMode === 'lte') {
        return array_filter($products, function($product) use ($filterPrice, $filterMode) {
            return $product['price'] <= $filterPrice;
        });
    }
}

function showProduct (array $product): string {
    return $product['name'] . ": " . $product['price'] . " zł" . PHP_EOL;
}

function currencyChange (array $product):array {
    $product['price'] = $product['price'] / 100;
    return $product;
}

$filteredProducts = productFiltered($filterMode, $products, $filterPrice);


foreach ($filteredProducts as $product) {
    (float) $product = currencyChange($product);
    echo showProduct($product);    
}