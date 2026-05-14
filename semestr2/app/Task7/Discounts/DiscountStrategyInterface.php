<?php

declare(strict_types=1);

namespace App\Task7\Discounts;

interface DiscountStrategyInterface
{
    public function calculate(float $totalAmount): float;
}
