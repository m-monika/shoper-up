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

$sum =0;
echo '---' . ' TWOJE ZAKUPY ' . '---' . "\n";
foreach ($cart as $product) {
    echo $product['qty'] . 'x ' . $product['name'] . " ... " . number_format($product['price'] /100, 2,',', '') . " PLN" . "\n";
    $sum += $product['price'] * $product['qty'];
}
$separator = "--------------------";
echo $separator . "\n" . "DO ZAPŁATY: " . number_format($sum /100, 2,',', '') . "\n" . $separator;