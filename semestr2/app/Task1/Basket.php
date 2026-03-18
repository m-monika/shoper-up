<?php

declare(strict_types=1);

namespace App\Task1;

class Basket
{
    public array $cartProducts = [];

    public function addProduct(array $product): void
    {
        $this->cartProducts[] = $product;
    }

    public function getSum(): float
    {
        $sum = 0.0;
        if (!empty($this->cartProducts)) {
            foreach ($this->cartProducts as $product) {
                $sum += $product['price'] * $product['qty'];
            }
        }
        return $sum;
    }
}