<?php

declare(strict_types=1);

namespace App\Task9\Filters;


class GreaterThanOrEqualFilter implements PriceFilterInterface
{
    public function filter(array $products, int $filterPrice): array
    {
        $filteredProducts = [];

        foreach ($products as $index => $product) {
            if ($product['price'] >= $filterPrice) {
                $filteredProducts[] = $product;
            }
        }

        return $filteredProducts;
    }
}