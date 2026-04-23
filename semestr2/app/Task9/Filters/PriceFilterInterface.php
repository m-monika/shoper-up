<?php

namespace App\Task9\Filters;

interface PriceFilterInterface
{
    public function filter(array $products, int $filterPrice): array;
}