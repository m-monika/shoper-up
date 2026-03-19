<?php

declare(strict_types=1);

namespace App\Task2;

class Basket
{
    private array $basketProducts = [];

    public function addProduct(Product $product): void
    {
        $this->basketProducts[] = $product;
    }

    public function getSum(): float
    {
        $basketPrice = 0.00;
        foreach ($this->basketProducts as $product) {
            $basketPrice += $product->getPrice();
        }
        return $basketPrice;
    }
}
