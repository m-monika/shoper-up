<?php

declare(strict_types=1);

namespace App\Task9\Filters;

use App\Task9\Filters\PriceFilterInterface;

class GreaterThanFilter implements PriceFilterInterface
{

    public function filter(array $products, int $filterPrice): array
    {
        $filteredProducts = [];

        foreach($products as $item) {
            if($item['price'] > $filterPrice) {
                $filteredProducts[] = $item;
            }
        }
        return $filteredProducts;
    }
}