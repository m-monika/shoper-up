<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{
    private array $items = [];
    public function __construct(private string $number = '')
    {
    }

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function getShippingCost(): int
    {
        return $this->calculateItemsTotal() >= 15000 ? 0 : 1500;
    }

    public function calculateItemsTotal(): int
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getTotalPrice();
        }

        return $total;
    }

    public function calculateGrandTotal(): int
    {
        return $this->calculateItemsTotal() + $this->getShippingCost();
    }
}
