<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{

    public function __construct(private string $number) {}

    private array $items = [];

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function calculateItemsTotal(): int
    {
        $count = 0;
        foreach ($this->items as $key => $value) {
            $count = $count + $value->getTotalPrice();
        }
        return $count;
    }

    public function getShippingCost(): int
    {
        
        if ($this->calculateItemsTotal() >= 15000) {
            return 0;
        } else {
            return 1500;
        }
    }

    public function calculateGrandTotal(): int
    {
        return $this->calculateItemsTotal() + $this->getShippingCost();
    }
}
