<?php

declare(strict_types=1);

namespace App\Task8\Coupons;

class PercentageCoupon implements CouponInterface
{
    private float $percentage;

    public function __construct(float $percentage)
    {
        $this->percentage = $percentage;
    }

    public function applyDiscount(float $totalAmount): float
    {
        $result = $totalAmount - ($totalAmount * $this->percentage / 100);

        return $result < 0 ? 0 : $result;
    }

    public function discountGetter(): float
    {
        return $this->percentage;
    }
}
