<?php

$freeDeliveryThreshold = $params[0]; // tej linijki nie ruszamy :)
$price = $params[1]; // tej linijki nie ruszamy :)

$productAdded = 0;
$productSum = 0;

do {
	$productAdded ++;
	$productSum += $price;
	echo 'Produkt dodany do koszyka. Aktualna suma koszyka: ' . $productSum . ' zł' . PHP_EOL;
} while ($productSum < $freeDeliveryThreshold);

echo 'Osiągnięto darmową wysyłkę. Łączna wartość zamówienia: ' . $productSum . ' zł';