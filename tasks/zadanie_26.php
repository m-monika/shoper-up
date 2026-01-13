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

function printInvoice(array $products): string
{
    $allProducts = "";
    foreach ($products as $key => $product) {
        $name = $product['name'];
        $qty = $product['qty'];
        $price = (float)($product['price'] / 100);
        $formattedPrice = number_format($price, 2, ',', '');
        $allProducts .= "{$qty}x {$name} ... {$formattedPrice} PLN\n";
    }

    $allProductsPrice = number_format(countCartPrice($products), 2, ',', ' ');

    //struktura paragonu
    $invoice = "--- TWOJE ZAKUPY ---\n";
    $invoice .= $allProducts;
    $invoice .= "--------------------\n";
    $invoice .= "DO ZAPŁATY: $allProductsPrice\n";
    $invoice .= "--------------------";

    return $invoice;
}

function countCartPrice(array $products): float
{
    $sum = 0;
    foreach ($products as $key => $product) {
        $sum += $product['qty'] * $product['price'];
    }
    return $sum / 100;
}

echo printInvoice($cart);