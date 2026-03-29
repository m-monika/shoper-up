<?php

declare(strict_types=1);

namespace Tests\Task8;

use App\Task8\Coupons\FixedAmountCoupon;
use PHPUnit\Framework\TestCase;

class FixedAmountCouponTest extends TestCase
{
    public function testApplyDiscountWithFixedAmount()
    {
        $coupon = new FixedAmountCoupon(20);
        $result = $coupon->applyDiscount(100.00);

        $this->assertSame(80.00, $result);
    }

    public function testApplyDiscountDoesNotReturnNegative()
    {
        $coupon = new FixedAmountCoupon(150);
        $result = $coupon->applyDiscount(100.00);

        $this->assertSame(0.00, $result);
    }

    public function testApplyDiscountWithExactAmount()
    {
        $coupon = new FixedAmountCoupon(100);
        $result = $coupon->applyDiscount(100.00);

        $this->assertSame(0.00, $result);
    }

    public function testApplyDiscountWithLargeAmount()
    {
        $coupon = new FixedAmountCoupon(50);
        $result = $coupon->applyDiscount(500.00);

        $this->assertSame(450.00, $result);
    }
}
