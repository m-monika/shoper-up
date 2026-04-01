<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{
    private array $items = [];

    private const FREE_SHIPPING_THRESHOLD = 15000;
    private const STANDARD_SHIPPING_COST = 1500; 

    public function __construct(public string $number) {}

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function getShippingCost(): int
    {
        $itemsTotal = $this->calculateItemsTotal();

        if ($itemsTotal >= self::FREE_SHIPPING_THRESHOLD) {
            return 0;
        }

        return self::STANDARD_SHIPPING_COST;
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
