<?php

declare(strict_types=1);

namespace Tests\Task7;

use App\Task7\Discounts\FixedAmountDiscount;
use PHPUnit\Framework\TestCase;

class FixedAmountDiscountTest extends TestCase
{
    public function testCalculateWithFixedDiscount()
    {
        $discount = new FixedAmountDiscount(15);
        $result = $discount->calculate(100.0);

        $this->assertSame(85.0, $result);
    }

    public function testCalculateWithLargeDiscount()
    {
        $discount = new FixedAmountDiscount(50);
        $result = $discount->calculate(200.0);

        $this->assertSame(150.0, $result);
    }

    public function testCalculateDoesNotReturnNegativeValue()
    {
        $discount = new FixedAmountDiscount(150);
        $result = $discount->calculate(100.0);

        $this->assertSame(0.0, $result);
    }

    public function testCalculateWithExactAmount()
    {
        $discount = new FixedAmountDiscount(100);
        $result = $discount->calculate(100.0);

        $this->assertSame(0.0, $result);
    }
}
