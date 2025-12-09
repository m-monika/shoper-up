<?php
$products = $params[0]; // tej linijki nie ruszamy :)
$order = $params[1]; // tej linijki nie ruszamy :)

$sortComparator = function (array $a, array $b) use ($order): int {
    $priceA = $a['price'];
    $priceB = $b['price'];
    $comparison = $priceA <=> $priceB;
    if ($order === 'asc') {
        return $comparison;
    } else {
        return -$comparison;
    }
};

usort($products, $sortComparator);

foreach ($products as $product) {
	$priceInZloty = $product['price'] / 100;
    $formattedPrice = number_format($priceInZloty,  2, ',', '');
    echo sprintf(
        "%s: %s zł\n", 
        $product['name'], 
        $formattedPrice
    );
}