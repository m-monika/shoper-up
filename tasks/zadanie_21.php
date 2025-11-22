<?php

$products = $params[0]; // tej linijki nie ruszamy :)
$key = $params[1]; // tej linijki nie ruszamy :)
$sort = $params[2]; // tej linijki nie ruszamy :)

$validKey = ['name', 'price'];
$validSort = ['asc', 'desc'];
$isSorted = false;

if (empty($key) || empty($sort)) {
	
} elseif (!in_array($key, $validKey) || !in_array($sort, $validSort)) {
    echo 'Nieprawidłowy parametr.\n';
    exit;
} else {
	if ($key === 'name') {
        ($sort === 'asc') ? ksort($products) : krsort($products);
    } elseif ($key === 'price') {
        ($sort === 'asc') ? asort($products) : arsort($products);
    }
}

echo 'Liczba produktów: ' . count($products) . PHP_EOL;
foreach ($products as $name => $price) {
    echo $name . " | " . $price . " zł\n";
}