<?php

declare(strict_types=1);

namespace App\Task7\Discounts;

class PercentageDiscount implements DiscountStrategyInterface
{
    private float $percentage;

    public function __construct(float $percentage)
    {
        $this->percentage = $percentage;
    }

    public function calculate(float $totalAmount): float
    {
        return $totalAmount - ($totalAmount * $this->percentage / 100);
    }
}
