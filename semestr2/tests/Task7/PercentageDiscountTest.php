<?php

declare(strict_types=1);

namespace Tests\Task7;

use App\Task7\Discounts\PercentageDiscount;
use PHPUnit\Framework\TestCase;

class PercentageDiscountTest extends TestCase
{
    public function testCalculateWithTenPercentDiscount()
    {
        $discount = new PercentageDiscount(10);
        $result = $discount->calculate(100.0);

        $this->assertSame(90.0, $result);
    }

    public function testCalculateWithTwentyPercentDiscount()
    {
        $discount = new PercentageDiscount(20);
        $result = $discount->calculate(250.0);

        $this->assertSame(200.0, $result);
    }

    public function testCalculateWithFiftyPercentDiscount()
    {
        $discount = new PercentageDiscount(50);
        $result = $discount->calculate(100.0);

        $this->assertSame(50.0, $result);
    }

    public function testCalculateWithZeroAmount()
    {
        $discount = new PercentageDiscount(10);
        $result = $discount->calculate(0.0);

        $this->assertSame(0.0, $result);
    }
}

