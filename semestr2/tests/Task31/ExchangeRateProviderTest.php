<?php

declare(strict_types=1);

namespace Tests\Task31;

use App\Task31\ExchangeRateProvider;
use App\Task31\Money;
use InvalidArgumentException;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

final class ExchangeRateProviderTest extends TestCase
{
    protected function setUp(): void
    {
        ExchangeRateProvider::resetStats();
    }

    public function testGetRateReturnsOneForSameCurrencyWithoutChangingStats(): void
    {
        $rate = ExchangeRateProvider::getRate('PLN', 'PLN');

        self::assertSame(1.0, $rate);
        self::assertSame(
            ['cache_hits' => 0, 'api_calls' => 0],
            ExchangeRateProvider::getCacheStats()
        );
    }

    public function testGetRateThrowsOnUnsupportedFromCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ExchangeRateProvider::getRate('JPY', 'PLN');
    }

    public function testGetRateThrowsOnUnsupportedToCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ExchangeRateProvider::getRate('PLN', 'JPY');
    }

    public function testGetRateThrowsWhenRateDoesNotExistInTable(): void
    {
        $this->expectException(OutOfBoundsException::class);

        ExchangeRateProvider::getRate('EUR', 'USD');
    }

    public function testGetRateCachesValueAndCountsApiCallOnFirstAccess(): void
    {
        $rate = ExchangeRateProvider::getRate('PLN', 'EUR');

        self::assertSame(0.23, $rate);
        self::assertSame(
            ['cache_hits' => 0, 'api_calls' => 1],
            ExchangeRateProvider::getCacheStats()
        );
    }

    public function testGetRateCountsCacheHitOnSecondAccess(): void
    {
        ExchangeRateProvider::getRate('PLN', 'EUR');
        $second = ExchangeRateProvider::getRate('PLN', 'EUR');

        self::assertSame(0.23, $second);
        self::assertSame(
            ['cache_hits' => 1, 'api_calls' => 1],
            ExchangeRateProvider::getCacheStats()
        );
    }

    public function testConvertReturnsMoneyInTargetCurrency(): void
    {
        $price = new Money(12999, 'PLN');

        $converted = ExchangeRateProvider::convert($price, 'EUR');

        self::assertSame('EUR', $converted->getCurrency());
        self::assertSame((int) round(12999 * 0.23), $converted->getAmount());
    }

    public function testConvertToSameCurrencyKeepsAmountAndDoesNotChangeStats(): void
    {
        $price = new Money(5000, 'USD');

        $converted = ExchangeRateProvider::convert($price, 'USD');

        self::assertSame('USD', $converted->getCurrency());
        self::assertSame(5000, $converted->getAmount());
        self::assertSame(
            ['cache_hits' => 0, 'api_calls' => 0],
            ExchangeRateProvider::getCacheStats()
        );
    }

    public function testConvertThrowsOnUnsupportedTargetCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $price = new Money(1000, 'PLN');
        ExchangeRateProvider::convert($price, 'JPY');
    }

    public function testConvertUsesCachedRateOnRepeatedCalls(): void
    {
        $price = new Money(10000, 'PLN');

        ExchangeRateProvider::convert($price, 'USD'); // api_calls +1
        ExchangeRateProvider::convert($price, 'USD'); // cache_hits +1

        self::assertSame(
            ['cache_hits' => 1, 'api_calls' => 1],
            ExchangeRateProvider::getCacheStats()
        );
    }

    public function testClearCacheClearsOnlyCacheWithoutResettingCounters(): void
    {
        ExchangeRateProvider::getRate('PLN', 'EUR'); // api_calls +1
        ExchangeRateProvider::getRate('PLN', 'EUR'); // cache_hits +1
        ExchangeRateProvider::clearCache();

        self::assertSame(
            ['cache_hits' => 1, 'api_calls' => 1],
            ExchangeRateProvider::getCacheStats()
        );
    }

    public function testAfterClearCacheSameRateTriggersNewApiCall(): void
    {
        ExchangeRateProvider::getRate('PLN', 'EUR'); // api_calls +1
        ExchangeRateProvider::clearCache();
        ExchangeRateProvider::getRate('PLN', 'EUR'); // api_calls +1 again

        self::assertSame(
            ['cache_hits' => 0, 'api_calls' => 2],
            ExchangeRateProvider::getCacheStats()
        );
    }

    public function testResetStatsClearsCacheAndResetsCounters(): void
    {
        ExchangeRateProvider::getRate('PLN', 'EUR');
        ExchangeRateProvider::getRate('PLN', 'EUR');
        ExchangeRateProvider::resetStats();

        self::assertSame(
            ['cache_hits' => 0, 'api_calls' => 0],
            ExchangeRateProvider::getCacheStats()
        );
    }
}
