<?php

/*
Napisz program, który wyświetla listę produktów z możliwością posortowania po cenie (używając jednej z funkcji sortujących w php):
- rosnąco
- malejąco

Zmienne:
$products - tablica z danymi produktów (ceny w groszach)
$order - kierunek sortowania (rosnąco/malejąco)


Przykład:

$products = [
    [
        'name' => 'Kabel HDMI',
        'price' => 3000,
    ],
    [
        'name' => 'Klawiatura USB',
        'price' => 25000,
    ],
    [
        'name' => 'Mysz bezprzewodowa',
        'price' => 20000,
    ],
    [
        'name' => 'Monitor 27',
        'price' => 500000,
    ],
    [
        'name' => 'Laptop',
        'price' => 300000,
    ],
];

$order = 'desc'; or asc

Wynik:

Monitor 27: 5000,00 zł
Laptop: 3000,00 zł
Klawiatura USB: 250,00 zł
Mysz bezprzewodowa: 200,00 zł
Kabel HDMI: 30,00 zł
*/

$products = $params[0]; // tej linijki nie ruszamy :)
$order = $params[1]; // tej linijki nie ruszamy :)

if (function_exists('sortProducts') == false) {

function sortProducts(array $productsArray, string $orderType): void {

    $finalPriceCalc = fn(int $price): string => number_format($price * 0.01, 2, ',', '') . ' zł';

    if ($orderType == 'desc') {
        usort($productsArray, fn($a, $b) => $b['price'] <=> $a['price']);
    } elseif ($orderType == 'asc') {
        usort($productsArray, fn($a, $b) => $a['price'] <=> $b['price']);
    }

    foreach ($productsArray as $product) {
        echo $product['name'] . ': ';
        echo $finalPriceCalc($product['price']) . PHP_EOL;
    } 
}
}

sortProducts($products, $order);