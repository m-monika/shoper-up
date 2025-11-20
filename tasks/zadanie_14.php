<?php

/*

Podsumowanie koszyka z różnymi stawkami VAT i obliczeniem łącznej wartości zamówienia
Stwórz program, który:

1. Posiada tablicę koszyka pod zmienną $products
Tablica powinna zawierać kilka produktów, gdzie każdy produkt to tablica asocjacyjna, np.:
- name – nazwa produktu
- price – cena brutto
- qty – ilość
- vat – stawka VAT

2. Za pomocą pętli foreach
Dla każdego produktu oblicz:
wartość brutto pozycji (qty * price)

Przykład:

$products = [
    57 => [
        "name" => "Laptop",
        "price" => 3000,
        "qty" => 1,
        "vat" => 23
    ],
    "test" => [
        "name" => "Monitor",
        "price" => 700,
        "qty" => 2,
        "vat" => 23
    ]
]

Wyświetl wszystko w formacie:
Lp. 1 | Laptop | 1 szt. | 3000 zł | VAT 23% | brutto: 3000 zł
Lp. 2 | Monitor | 2 szt. | 700 zł | VAT 23% | brutto: 1400 zł

SUMA BRUTTO: 4400 zł

*/

$products = $params[0]; // tej linijki nie ruszamy :)

$lpCount = 1;
$s = " | "; // handy separator
$totalPriceCount = 0;

foreach ($products as $key => $value) {
    echo "Lp. " . $lpCount . $s;
    $lpCount++;

    $price = $value["price"];
    $qty = $value["qty"];
    $brutto = $price * $qty;

    echo $value["name"] . $s . $qty . " szt." . $s . $price . " zł" . $s . "VAT " . $value["vat"] . "%" . $s . "brutto: " . $brutto . " zł";
    echo PHP_EOL;

    $totalPriceCount = $totalPriceCount + $brutto;
}

echo PHP_EOL . "SUMA BRUTTO: " . $totalPriceCount . " zł";