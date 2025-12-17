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

if (function_exists('productFiltered') == false) {
    function productFiltered (string $filterMode, array $products, int $filterPrice): array {
    return array_filter($products, function($product) use ($filterPrice, $filterMode) {
        if ($filterMode === 'gte') {
            return $product['price'] >= $filterPrice;
        } elseif ($filterMode === 'lte') {
            return $product['price'] <= $filterPrice;
        } else {
            return false;
        }
    });
}
}

if(function_exists('formatPrice') == false) {
    function formatPrice (int $productPrice): string {
        return number_format($productPrice / 100, 2, ',', '');
}
}

if (function_exists('showProduct') == false) { 
    function showProduct (array $product): string {
        return $product['name'] . ": " . formatPrice($product['price']) . " zł" . PHP_EOL;
}
}

$filteredProducts = productFiltered($filterMode, $products, $filterPrice);

foreach ($filteredProducts as $product) {
    echo showProduct($product);    
}