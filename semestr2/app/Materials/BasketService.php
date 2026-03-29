<?php

declare(strict_types=1);

namespace App\Materials;

use App\Task2\Product as ProductFromTask2;
use App\Task3\Product as ProductFromTask3;

class BasketService
{
    private array $products = [];

    public function addProductFromTask2(ProductFromTask2 $product): void
    {
        $this->products[] = $product;
    }

    public function addProductFromTask3(ProductFromTask3 $product): void
    {
        $this->products[] = $product;
    }

    public function countProducts(): int
    {
        return count($this->products);
    }
}
