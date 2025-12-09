<?php

$products = $params[0]; // tej linijki nie ruszamy :)

$sum = 0;
$lp = 1;

foreach ($products as $product) {
    $name = $product["name"];
    $price = $product["price"];
    $qty = $product["qty"];
    $vat = $product["vat"];

$wartosc = $price * $qty;

echo "Lp. " . $lp . " | " . $name . " | " . $qty . " szt. | " . $price . " zł | VAT " . $vat . "% | brutto: " . $wartosc . " zł\n";

$sum = $sum + $wartosc;

$lp = $lp + 1;
}

echo "SUMA BRUTTO: " . $sum . " zł";