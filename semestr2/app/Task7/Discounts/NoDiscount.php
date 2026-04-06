<?php

declare(strict_types=1);

namespace App\Task7\Discounts;

class NoDiscount implements DiscountStrategyInterface
{
    public function calculate(float $totalAmount): float
    {
        return $totalAmount;
    }
}
