<?php

declare(strict_types=1);

namespace Tests\Task7;

use App\Task7\Discounts\NoDiscount;
use PHPUnit\Framework\TestCase;

class NoDiscountTest extends TestCase
{
    public function testCalculateReturnsOriginalAmount()
    {
        $discount = new NoDiscount();
        $result = $discount->calculate(100.0);

        $this->assertSame(100.0, $result);
    }

    public function testCalculateWithDifferentAmount()
    {
        $discount = new NoDiscount();
        $result = $discount->calculate(250.50);

        $this->assertSame(250.50, $result);
    }

    public function testCalculateWithZeroAmount()
    {
        $discount = new NoDiscount();
        $result = $discount->calculate(0.0);

        $this->assertSame(0.0, $result);
    }

    public function testCalculateWithLargeAmount()
    {
        $discount = new NoDiscount();
        $result = $discount->calculate(9999.99);

        $this->assertSame(9999.99, $result);
    }
}
