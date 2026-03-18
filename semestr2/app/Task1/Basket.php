<?php

declare(strict_types=1);

namespace App\Task1;

class Basket
{
    private array $products = [];
    public function addProduct(array $product): void
    {
        $this->products[] = $product;
    }

    public function getSum(): float
    {
        $sum = 0.0;

        foreach ($this->products as $product){
            $price = $product['price'];
            $qty = $product['qty'];

            $sum += $price * $qty;
        }

        return $sum;
    }
}
