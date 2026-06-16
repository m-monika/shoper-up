<?php

declare(strict_types=1);

namespace App\Task5;

class OrderItem
{
    public function __construct(public string $productName, public int $quantity, public int $price) {}

    public function getTotalPrice(): int
    {
        return $this->price * $this->quantity;
    }
}
