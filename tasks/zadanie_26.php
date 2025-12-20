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
$total = 0;

function validProduct(array $product) : string
{
        $name = $product['name'];
        $price = $product['price'];
        $qty = $product['qty'];

    return $qty . "x " .$name . " ... " .number_format($price/100, 2, ',','') . " PLN";
}

function sum(array $cart): string {
    $sum = 0;
    foreach ($cart as $product) {
        $price = $product['price'];
        $qty = $product['qty'];
        $sum += $price * $qty;
    }
    return number_format($sum/100, 2, ',','');
}

echo "--- TWOJE ZAKUPY ---" .PHP_EOL;

foreach ($cart as $product) {
    echo validProduct($product) . PHP_EOL;
}
 $total = sum($cart);

echo "--------------------".PHP_EOL . "DO ZAPŁATY: " . $total .PHP_EOL . "--------------------";



