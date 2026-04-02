<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{
    private array $items = [];

    public function __construct(private string $number){}

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
        $orderItemsPrice = 0;

        foreach ($this->items as $key => $item) {
            $orderItemsPrice += $item->getTotalPrice();
        }

        return $orderItemsPrice;
    }

    public function calculateGrandTotal(): int
    {
        return $this->calculateItemsTotal() + $this->getShippingCost();
    }
}
