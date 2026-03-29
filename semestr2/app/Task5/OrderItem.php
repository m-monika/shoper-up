<?php

declare(strict_types=1);

namespace App\Task5;

class OrderItem
{

    private string $productName;
    private int $quantity;
    private int $price;

    public function __construct(string $productName, int $quantity, int $price)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
        $this->price = $price;
    }
    public function getTotalPrice(): int
    {
        return $this->quantity * $this->price;
    }
}
