<?php

declare(strict_types=1);

namespace App\Task9\Filters;

class LessThanOrEqualFilter implements PriceFilterInterface {
    public function filter(array $products, int $filterPrice): array {
        return array_filter($products, fn($a) => $a['price'] <= $filterPrice);
    }
}