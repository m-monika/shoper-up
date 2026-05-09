<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{
    private array $items = [];

    public function addItem(OrderItem $item): void
    {}

    public function getShippingCost(): int
    {
        return 0;
    }

    public function calculateItemsTotal(): int
    {
        return 0;
    }

    public function calculateGrandTotal(): int
    {
        return 0;
    }
}
