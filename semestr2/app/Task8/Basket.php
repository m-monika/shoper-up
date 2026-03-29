<?php

declare(strict_types=1);

namespace App\Task8;

use App\Task8\Coupons\CouponInterface;

class Basket
{
    public function addProduct(Product $product, int $quantity): void
    {
    }

    public function applyCoupon(CouponInterface $coupon): void
    {
    }

    public function getProducts(): array
    {
        return [];
    }

    public function getTotalWithoutDiscount(): float
    {
        $total = 0.0;

        return $total;
    }

    public function getTotalWithDiscount(): float
    {
        $total = $this->getTotalWithoutDiscount();

        return $total;
    }
}
