<?php
$products = $params[0]; // tej linijki nie ruszamy :)
$order = $params[1]; // tej linijki nie ruszamy :)

$sortComparator = function (array $a, array $b) use ($order): int {
	if ($order !== 'asc' && $order !== 'desc') {
		return 0;
	}
    $comparison = $a['price'] <=> $b['price'];
    return ($order === 'desc') ? -$comparison : $comparison;
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