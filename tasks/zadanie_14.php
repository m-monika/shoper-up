<?php
$products = $params[0]; // tej linijki nie ruszamy :)

$totalBrutto = 0;
$lp = 1;

foreach ($products as $product) {
	if ($product['qty'] >= 2) {
		$costBrutto = $product['qty'] * $product['price'];
	}
	else {
		$costBrutto = $product['price'];
	}
	echo "Lp. " . $lp . " | " . $product['name'] . " | " . $product['qty'] . " szt. | " . $product['price'] . " zł | VAT " . $product['vat'] . "% | brutto: " . $costBrutto . " zł\n";
	$lp++;
	$totalBrutto += $costBrutto;
}

echo "\nSUMA BRUTTO: $totalBrutto zł";