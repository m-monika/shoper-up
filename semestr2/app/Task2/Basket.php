<?php

declare(strict_types=1);

namespace App\Task2;

class Basket
{

    private array $items = [];

    public function addProduct(Product $product): void
    {
        $this->items[] = $product;
    }

    public function getSum(): float
    {
        $calc = 0.0;

        foreach ($this->items as $item) {
            $price = $item->getPrice();
            $calc += $price;
        }
        return $calc;
    }
}