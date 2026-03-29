<?php

declare(strict_types=1);

namespace App\Task7\Discounts;

class FixedAmountDiscount
{
    private float $discountAmount;

    public function __construct(float $discountAmount)
    {
        $this->discountAmount = $discountAmount;
    }

    public function calculate(float $totalAmount): float
    {
        $result = $totalAmount - $this->discountAmount;
        return $result < 0 ? 0 : $result;
    }
}
