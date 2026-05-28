<?php

declare(strict_types=1);

namespace Tests\Task31;

use App\Task31\Money;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MoneyTest extends TestCase
{
    public function testCreatesMoneyWithValidData(): void
    {
        $money = new Money(12999, 'PLN');

        self::assertSame(12999, $money->getAmount());
        self::assertSame('PLN', $money->getCurrency());
    }

    public function testConstructorThrowsWhenAmountIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Money(-1, 'PLN');
    }

    public function testConstructorThrowsWhenCurrencyIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Money(1000, 'JPY');
    }

    public function testEqualsReturnsTrueForSameAmountAndCurrency(): void
    {
        $a = new Money(1000, 'PLN');
        $b = new Money(1000, 'PLN');

        self::assertTrue($a->equals($b));
    }

    public function testEqualsReturnsFalseForDifferentAmount(): void
    {
        $a = new Money(1000, 'PLN');
        $b = new Money(1001, 'PLN');

        self::assertFalse($a->equals($b));
    }

    public function testEqualsReturnsFalseForDifferentCurrency(): void
    {
        $a = new Money(1000, 'PLN');
        $b = new Money(1000, 'EUR');

        self::assertFalse($a->equals($b));
    }

    public function testToStringFormatsNominalAmountWithTwoDecimals(): void
    {
        $money = new Money(12999, 'PLN');

        self::assertSame('129.99 PLN', (string) $money);
    }

    public function testToStringFormatsSmallAmounts(): void
    {
        self::assertSame('0.05 EUR', (string) new Money(5, 'EUR'));
        self::assertSame('5.00 EUR', (string) new Money(500, 'EUR'));
        self::assertSame('0.00 USD', (string) new Money(0, 'USD'));
    }
}
