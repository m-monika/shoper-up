<?php

declare(strict_types=1);

namespace App\Task5;

class OrderItem
{

    public function __construct(private string $productName, private int $quantity, private int $price) {}

    public function getTotalPrice(): int
    {
        return $this->quantity * $this->price;
    }
}
