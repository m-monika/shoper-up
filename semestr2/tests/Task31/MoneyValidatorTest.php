<?php

declare(strict_types=1);

namespace Tests\Task31;

use App\Task31\MoneyValidator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MoneyValidatorTest extends TestCase
{
    public function testValidateAmountPassesForZeroAndPositiveValues(): void
    {
        MoneyValidator::validateAmount(0);
        MoneyValidator::validateAmount(1);
        MoneyValidator::validateAmount(99999);

        self::assertTrue(true);
    }

    public function testValidateAmountThrowsOnNegativeValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        MoneyValidator::validateAmount(-1);
    }

    public function testValidateCurrencyPassesForSupportedCurrencies(): void
    {
        MoneyValidator::validateCurrency('PLN');
        MoneyValidator::validateCurrency('EUR');
        MoneyValidator::validateCurrency('USD');
        MoneyValidator::validateCurrency('GBP');

        self::assertTrue(true);
    }

    public function testValidateCurrencyThrowsOnUnsupportedCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);

        MoneyValidator::validateCurrency('JPY');
    }

    public function testIsCurrencySupportedReturnsTrueForAllowedCurrencies(): void
    {
        self::assertTrue(MoneyValidator::isCurrencySupported('PLN'));
        self::assertTrue(MoneyValidator::isCurrencySupported('EUR'));
        self::assertTrue(MoneyValidator::isCurrencySupported('USD'));
        self::assertTrue(MoneyValidator::isCurrencySupported('GBP'));
    }

    public function testIsCurrencySupportedReturnsFalseForUnknownCurrency(): void
    {
        self::assertFalse(MoneyValidator::isCurrencySupported('JPY'));
    }

    public function testValidateChecksBothAmountAndCurrency(): void
    {
        MoneyValidator::validate(1000, 'PLN');

        self::assertTrue(true);
    }

    public function testValidateThrowsWhenAmountIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        MoneyValidator::validate(-100, 'PLN');
    }

    public function testValidateThrowsWhenCurrencyIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        MoneyValidator::validate(100, 'JPY');
    }
}
