<?php

declare(strict_types=1);

namespace App\Task7\Discounts;

class NoDiscount
{
    public function calculate(float $totalAmount): float
    {
        return $totalAmount;
    }
}
