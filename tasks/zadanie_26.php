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

function receiptGenerator(array $cart): void {

    $finalPriceCalc = fn(int $price): string => number_format($price * 0.01, 2, ',') . ' PLN';

    $showSeparator = function(): void {
        echo("--------------------" . PHP_EOL);
    };

    $total = 0;

    echo "--- TWOJE ZAKUPY ---" . PHP_EOL;

    foreach ($cart as $item) {
        $total = $total + $item['price'] * $item['qty'];
        echo $item['qty'] . 'x ' . $item['name'] . ' ... ' . $finalPriceCalc($item['price']) . PHP_EOL;
    }

    $showSeparator();
    echo 'DO ZAPŁATY: ' . number_format($total * 0.01, 2, ',') . PHP_EOL;
    $showSeparator();

}

receiptGenerator($cart);