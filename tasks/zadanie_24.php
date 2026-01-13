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


// function getFilteredProducts(array $products, float $filterPrice, string $filterMode): array
// {
//     if ($filterMode === 'gte') {

//         $higherPrice = array_filter($products, function($product) use ($filterPrice){
//         return $product['price'] >= $filterPrice;
//         }, ARRAY_FILTER_USE_BOTH);

//         return $higherPrice;

//     } elseif ($filterMode === 'lte') {

//         $lowerPrice = array_filter($products, function($product) use ($filterPrice){
//         return $product['price'] <= $filterPrice;
//         }, ARRAY_FILTER_USE_BOTH);

//         return $lowerPrice;
//     }
// }

// $results = getFilteredProducts($products, $filterPrice, $filterMode);

// foreach ($results as $key => $result) {
//     $decimalPrice = $result['price'] / 100;
//     $formattedPrice = number_format($decimalPrice, 2, ',', '');
//     echo "{$result['name']}: {$formattedPrice} zł\n";
// }

// if (!function_exists('getFilteredProducts')) {
//     function getFilteredProducts(array $products, float $price, string $mode): array
//     {
//         if ($mode === 'gte') {
//             return array_filter($products, function($product) use ($price) {
//                 return $product['price'] >= $price;
//             });
//         } elseif ($mode === 'lte') {
//             return array_filter($products, function($product) use ($price) {
//                 return $product['price'] <= $price;
//             });
//         }
//         return [];
//     }
// }

// $results = getFilteredProducts($products, $filterPrice, $filterMode);

// foreach ($results as $result) {
//     $decimalPrice = $result['price'] / 100;
//     $priceWithDot = sprintf("%0.2f", $decimalPrice);
//     $formattedPrice = str_replace('.', ',', $priceWithDot);
//     echo "{$result['name']}: {$formattedPrice} zł\n";
// }

if (!function_exists('getFilteredProducts')) {
    function getFilteredProducts(array $products, float $filterPrice, string $filterMode): array
    {
        if ($filterMode === 'gte') {

            $higherPrice = array_filter($products, function($product) use ($filterPrice){
            return $product['price'] >= $filterPrice;
            });

            return $higherPrice;

        } elseif ($filterMode === 'lte') {

            $lowerPrice = array_filter($products, function($product) use ($filterPrice){
            return $product['price'] <= $filterPrice;
            });

            return $lowerPrice;
        } else {
            return [];
        }
    }
}

$results = getFilteredProducts($products, $filterPrice, $filterMode);

foreach ($results as $key => $result) {
    $decimalPrice = $result['price'] / 100;
    $formattedPrice = number_format($decimalPrice, 2, ',', '');
    echo "{$result['name']}: {$formattedPrice} zł\n";
}