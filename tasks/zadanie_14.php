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


// echo "Lp. 1 | Laptop | 1 szt. | 3000 zł | VAT 23% | brutto: 3000 zł\n";
// echo "Lp. 2 | Monitor | 2 szt. | 700 zł | VAT 23% | brutto: 1400 zł\n";
// echo "\nSUMA BRUTTO: 4400 zł";

$lp = 1;
$grossSum = 0;
foreach ($products as $basketSummary => $productValue) {
    $gross = $productValue['qty'] * $productValue['price'];
    $grossSum += $productValue['qty'] * $productValue['price'];
    echo "Lp. " . $lp . ' | ' . 
    $productValue['name'] . " | " . 
    $productValue['qty'] . " szt." . " | " .
    $productValue['price'] . " zł" . " | " . 
    'VAT ' . $productValue['vat'] . '%' . " | " .
    'brutto: ' . $gross . " zł" . PHP_EOL;
    $lp++;
    
};
if ($grossSum > 0) {
        echo PHP_EOL . 'SUMA BRUTTO: ' . $grossSum . " zł";
}