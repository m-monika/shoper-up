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

echo "--- TWOJE ZAKUPY ---\n";

$suma = 0;

foreach ($cart as $item) {
    $suma += $item['price'] * $item['qty'];

    $pricePln = number_format($item['price'] / 100, 2, ',', ' ');

    echo $item['qty'] . "x " . $item['name'] . " ... " . $pricePln . " PLN\n";
}

echo "-----------------\n";

$totalPln = number_format($suma / 100, 2, ',', ' ');
echo "DO ZAPŁATY: " . $totalPln . "\n";

echo "-----------------\n";
