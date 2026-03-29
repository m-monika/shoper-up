<?php

declare(strict_types=1);

namespace Tests\Task8;

use App\Task8\Coupons\PercentageCoupon;
use PHPUnit\Framework\TestCase;

class PercentageCouponTest extends TestCase
{
    public function testApplyDiscountWithTenPercent()
    {
        $coupon = new PercentageCoupon(10);
        $result = $coupon->applyDiscount(100.00);

        $this->assertSame(90.00, $result);
    }

    public function testApplyDiscountWithTwentyPercent()
    {
        $coupon = new PercentageCoupon(20);
        $result = $coupon->applyDiscount(250.00);

        $this->assertSame(200.00, $result);
    }

    public function testApplyDiscountWithFiftyPercent()
    {
        $coupon = new PercentageCoupon(50);
        $result = $coupon->applyDiscount(100.00);

        $this->assertSame(50.00, $result);
    }

    public function testApplyDiscountWithDecimalPercentage()
    {
        $coupon = new PercentageCoupon(15.5);
        $result = $coupon->applyDiscount(200.00);

        $this->assertSame(169.00, $result);
    }
}
