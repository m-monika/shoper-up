<?php

declare(strict_types=1);

namespace App\Task2;

class Basket
{
    private array $basketProducts = [];
    private float $basketPrice = 0.00;

    public function addProduct(Product $product): void
    {
        $this->basketProducts[] = $product;
    }

    public function getSum(): float
    {
        foreach ($this->basketProducts as $product) {
            $this->basketPrice += $product->getPrice();
        }
        return $this->basketPrice;
    }
}
