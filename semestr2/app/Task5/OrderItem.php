<?php

declare(strict_types=1);

namespace App\Task5;

class OrderItem
{
    public function __construct(private string $productName = '', private int $quantity = 0, private int $price = 0)
    {
    }
    public function getTotalPrice(): int
    {
        return $this->price * $this->quantity;
    }
}
