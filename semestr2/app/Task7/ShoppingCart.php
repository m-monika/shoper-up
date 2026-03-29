<?php

declare(strict_types=1);

namespace App\Task7;

use App\Task7\Discounts\DiscountStrategyInterface;

class ShoppingCart
{
    private DiscountStrategyInterface $discountStrategy;
    private array $items = [];

    public function __construct(DiscountStrategyInterface $discountStrategy)
    {
        $this->discountStrategy = $discountStrategy;
    }

    public function addItem(string $name, float $price): void
    {
        $this->items[] = [
            'name' => $name,
            'price' => $price,
        ];
    }

    public function getTotalBeforeDiscount(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'];
        }
        return $total;
    }

    public function getTotalAfterDiscount(): float
    {
        $totalBefore = $this->getTotalBeforeDiscount();
        return $this->discountStrategy->calculate($totalBefore);
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
