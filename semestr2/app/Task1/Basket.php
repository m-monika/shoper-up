<?php

declare(strict_types=1);

namespace App\Task1;

class Basket
{
    private array $items = [];

    public function addProduct(array $product): void
    {
        $this->items[] = $product;
    }

    public function getSum(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += (float)$item['price'] * $item['qty'];
        }
        return $total;
    }
}