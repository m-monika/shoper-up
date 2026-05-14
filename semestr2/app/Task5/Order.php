<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{
    private const FREE_SHIPPING_THRESHOLD = 15000;
    private const SHIPPING_COST = 1500;

    private array $items = [];

    public function __construct(
        private string $number,
    ) {
    }

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function getShippingCost(): int
    {
        if ($this->calculateItemsTotal() >= self::FREE_SHIPPING_THRESHOLD) {
            return 0;
        }

        return self::SHIPPING_COST;
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
