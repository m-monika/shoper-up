<?php

declare(strict_types=1);

namespace App\Task1;

class Basket
{
    private array $basketProducts = [];
    private float $basketSum = 0.00;

    public function addProduct(array $product): void
    {
        $this->basketProducts[] = $product;
    }

    public function getSum(): float
    {
        foreach ($this->basketProducts as $products => $product) {
            $this->basketSum += ($product['qty'] * $product['price']);
        }
        return $this->basketSum;
    }
}
