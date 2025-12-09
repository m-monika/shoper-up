<?php

$products = $params[0]; // tej linijki nie ruszamy :)
$filterPrice = $params[1]; // tej linijki nie ruszamy :)
$filterMode = $params[2]; // tej linijki nie ruszamy :)

$filterCallback = function (array $product) use ($filterPrice, $filterMode): bool {
    $currentPrice = $product['price'];
    switch ($filterMode) {
        case 'gte':
            return $currentPrice >= $filterPrice;
        case 'lte':
            return $currentPrice <= $filterPrice;
        default:
            return false;
    }
};

$filteredProducts = array_filter($products, $filterCallback);

if (!empty($filteredProducts)) {
    foreach ($filteredProducts as $product) {
        $priceInZloty = $product['price'] / 100;
        $formattedPrice = number_format($priceInZloty,  2, ',', '');
        echo sprintf(
            "%s: %s zł\n", 
            $product['name'], 
            $formattedPrice
        );
    }
} else {
    return 0;
}