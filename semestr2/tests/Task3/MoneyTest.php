<?php

declare(strict_types=1);

namespace Tests\Task3;

use App\Task3\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testFormatsAmountWithDefaultCurrency(): void
    {
        $money = new Money(15000);
        $this->assertSame('150,00 PLN', $money->getFormatted());
    }

    public function testFormatsAmountWithCustomCurrency(): void
    {
        $money = new Money(49900, 'EUR');
        $this->assertSame('499,00 EUR', $money->getFormatted());
    }

    public function testFormatsZeroAmountCorrectly(): void
    {
        $money = new Money(0);
        $this->assertSame('0,00 PLN', $money->getFormatted());
    }
}
