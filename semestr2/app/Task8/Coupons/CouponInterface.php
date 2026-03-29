<?php

declare(strict_types=1);

namespace App\Task8\Coupons;

interface CouponInterface
{
    public function applyDiscount(float $totalAmount): float;
}
