<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{
    private string $number;
    public array $items = [];

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function getShippingCost(): int
    {
        if ($this->calculateItemsTotal() >= 15000) 
        {
            return 0;
        } else {
            return 1500;
        }
    }

    public function calculateItemsTotal(): int
    {
        $sum = 0;
        if (!empty($this->items)) {
            foreach ($this->items as $product) {
                $sum += $product->getTotalPrice();
            }
        }
        return $sum;
    }

    public function calculateGrandTotal(): int
    {
        return $this->calculateItemsTotal() + $this->getShippingCost();
    }
}