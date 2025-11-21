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

$lp = 0;


foreach ($products as $key => $value){
	
    if (is_array($value)) {
    	 
    	 	$name = "";
        	$qty = 0;
        	$vat = 0;
        	$price = 0;
        	
        	
        foreach ($value as $key2 => $value2 ){
        
        	$amount	= $qty * $price ;
        	$sum = $sum + $amount;
        	
            if ($key2 == "name") {
                $name = $value2;
            }elseif ($key2 == "price") {
                $price = $value2;
            }elseif ($key2 == "qty") {
                $qty = $value2;
            }elseif ($key2 == "vat") {
                $vat =$value2;
            }
        
        } echo "Lp. " . ++$lp . " | " . $name . " | " . $qty . " szt. | " . $price . " zł | VAT " . $vat . " | brutto: " . $amount . " zł" . PHP_EOL;
    }
    } echo "SUMA BRUTTO:" . $sum;
