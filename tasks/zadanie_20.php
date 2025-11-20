<?php

$net = $params[0]; // tej linijki nie ruszamy :)
$category = $params[1]; // tej linijki nie ruszamy :)

$productVat = match ($category) {
	'elektronika' => 0.22,
	'odzież' => 0.22,
	'żywność' => 0.08,
	'książki' => 0.05,
	'czasopisma' => 0.05,
	default => 0.23,
};

$grossAmount = $net * (1 + $productVat);

echo 'Cena brutto wynosi ' . $grossAmount . ' zł.';