<?php

namespace App\Task9\Filters;

class LessThanFilter implements PriceFilterInterface
{
    public function filter(array $products, int $filterPrice): array
    {
        return array_filter($products, function($product) use ($filterPrice) 
        {
            return $product['price'] < $filterPrice;
        });
    }
}