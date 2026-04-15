<?php

declare(strict_types=1);

namespace App\Task8\Coupons;

class FixedAmountCoupon implements CouponInterface
{
    private float $discountAmount;

    public function __construct(float $discountAmount)
    {
        $this->discountAmount = $discountAmount;
    }

    public function applyDiscount(float $totalAmount): float
    {

        $result = $totalAmount - $this->discountAmount;

        return $result < 0 ? 0 : $result;
    
    }

    public function discountGetter(): float
    {
        return $this->discountAmount;
    }
}
