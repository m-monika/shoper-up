<?php

/*
Napisz program który wygeneruje paragon dla podanego koszyka produktów

Zmienne:
$cart - tablica reprezentująca koszyk z produktami


Przykład:

$cart = [
    [
        'name' => 'Chleb',
        'price' => 800,
        'qty' => 2,
    ],
    [
        'name' => 'Mleko',
        'price' => 400,
        'qty' => 3,
    ],
    [
        'name' => 'Czekolada',
        'price' => 500,
        'qty' => 1,
    ]
];

Wynik:

--- TWOJE ZAKUPY ---
2x Chleb ... 8,00 PLN
3x Mleko ... 4,00 PLN
1x Czekolada ... 5,00 PLN
--------------------
DO ZAPŁATY: 33,00
--------------------
*/

$cart = $params[0]; // tej linijki nie ruszamy :)

if(function_exists('formatPrice') == false) {
    function formatPrice (int $productPrice): string {
        return number_format($productPrice / 100, 2, ',', '');
}
}

if(function_exists('showProducts') == false) {
    function showProducts (array $cartProductsList): string {
        $listOfProducts = '';
        foreach($cartProductsList as $product) {
            $listOfProducts .= $product['qty'] . "x " . $product['name'] . " ... " . formatPrice($product['price']) . " PLN" . PHP_EOL;
        }
        return $listOfProducts;
    }
}

if(function_exists('sumProducts') == false) {
    function sumProducts (array $cartProductsList): int {
        $cartPrice = 0;
        foreach ($cartProductsList as $product) {
            $cartPrice += $product['qty'] * $product['price'];
        }
        return $cartPrice;
    }
}

if(function_exists('receiptPrint') == false) {
    function receiptPrint (array $cartProducts): string {
        $receiptBoilerplate = 
        [
            $title = '--- TWOJE ZAKUPY ---',
            $divider = '--------------------',
            $summary = 'DO ZAPŁATY: '
        ];

        return $title . PHP_EOL . showProducts($cartProducts) . $divider . PHP_EOL . $summary . formatPrice(sumProducts($cartProducts)) . PHP_EOL . $divider;
    }
}

echo receiptPrint($cart);