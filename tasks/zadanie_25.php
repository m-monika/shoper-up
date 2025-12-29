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

$order = 'desc';

Wynik:

Monitor 27: 5000,00 zł
Laptop: 3000,00 zł
Klawiatura USB: 250,00 zł
Mysz bezprzewodowa: 200,00 zł
Kabel HDMI: 30,00 zł
*/

$products = $params[0]; // tej linijki nie ruszamy :)
$order = $params[1]; // tej linijki nie ruszamy :)


if(function_exists('sortProduct') == false) {
    function sortProduct (array $products, string $order): array {

        if ($order == 'desc') {
            usort($products, fn($firstProduct, $secondProduct) => $secondProduct['price'] <=> $firstProduct['price']);
            return $products;
        } elseif ($order == 'asc') {
            usort($products, fn($firstProduct, $secondProduct) => $firstProduct['price'] <=> $secondProduct['price']);
            return $products;
        } elseif (empty($order)) {
            echo 'Coś poszło nie tak.';
        } elseif ($order != 'desc' && $order != 'asc') {
            return $products;
        }
    }
}

if(function_exists('formatPrice') == false) {
    function formatPrice (int $productPrice): string {
        return number_format($productPrice / 100, 2, ',', '');
}
}

if(function_exists('showProducts') == false) {
    function showProducts (array $sortedProducts): string {
        return $sortedProducts['name'] . ": " . formatPrice($sortedProducts['price']) . " zł" . PHP_EOL;
    }
}

$sortedProducts = sortProduct($products, $order);

foreach ($sortedProducts as $product) {
    echo showProducts($product);
}
