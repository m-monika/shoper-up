<?php

declare(strict_types=1);

namespace App\Task2;

class Basket
{
    public array $cartProducts = [];

    public function addProduct(Product $product): void
    {
        $this->cartProducts[] = $product;
    }

    public function getSum(): float
    {
        $sum = 0.0;
        foreach ($this->cartProducts as $product) {
                $sum += $product->getPrice();
            }
        return $sum;
    }
}
