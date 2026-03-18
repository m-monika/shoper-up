<?php

declare(strict_types=1);

require_once 'Product.php';

namespace App\Task2;

class Basket
{
    private array $products = [];

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
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
