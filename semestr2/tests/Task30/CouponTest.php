<?php

declare(strict_types=1);

namespace Tests\Task30;

use App\Task30\Coupon;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CouponTest extends TestCase
{
    public function testPercentNamedConstructorCreatesProperCoupon(): void
    {
        $expiresAt = new \DateTimeImmutable('2026-06-10');
        $coupon = Coupon::percent('MAY20', 20, $expiresAt, 10000);

        self::assertSame('MAY20', $coupon->getCode());
        self::assertSame(Coupon::TYPE_PERCENT, $coupon->getType());
        self::assertSame(20, $coupon->getValue());
        self::assertSame(10000, $coupon->getMinOrderValue());
        self::assertEquals($expiresAt, $coupon->getExpiresAt());
    }

    public function testFixedNamedConstructorCreatesProperCoupon(): void
    {
        $expiresAt = new \DateTimeImmutable('2026-06-01');
        $coupon = Coupon::fixed('LESS15', 1500, $expiresAt);

        self::assertSame('LESS15', $coupon->getCode());
        self::assertSame(Coupon::TYPE_FIXED, $coupon->getType());
        self::assertSame(1500, $coupon->getValue());
        self::assertSame(0, $coupon->getMinOrderValue());
        self::assertEquals($expiresAt, $coupon->getExpiresAt());
    }

    public function testWelcomeNamedConstructorCreatesExpectedCoupon(): void
    {
        $before = new \DateTimeImmutable('now');
        $coupon = Coupon::welcome();
        $after = new \DateTimeImmutable('now');

        self::assertSame('WELCOME10', $coupon->getCode());
        self::assertSame(Coupon::TYPE_PERCENT, $coupon->getType());
        self::assertSame(10, $coupon->getValue());
        self::assertSame(5000, $coupon->getMinOrderValue());

        $minExpected = $before->modify('+30 days')->getTimestamp();
        $maxExpected = $after->modify('+30 days')->getTimestamp();
        $actual = $coupon->getExpiresAt()->getTimestamp();

        self::assertGreaterThanOrEqual($minExpected, $actual);
        self::assertLessThanOrEqual($maxExpected, $actual);
    }

    public function testConstructorIsPrivate(): void
    {
        $reflection = new \ReflectionClass(Coupon::class);
        $constructor = $reflection->getConstructor();

        self::assertNotNull($constructor);
        self::assertTrue($constructor->isPrivate());
    }

    public function testCouponTypeConstantsHaveExpectedValues(): void
    {
        self::assertSame('percent', Coupon::TYPE_PERCENT);
        self::assertSame('fixed', Coupon::TYPE_FIXED);
    }

    public function testPercentConstructorThrowsOnInvalidValueZero(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Coupon::percent('BAD', 0, new \DateTimeImmutable('2026-06-10'));
    }

    public function testPercentConstructorThrowsOnInvalidValueAboveHundred(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Coupon::percent('BAD', 101, new \DateTimeImmutable('2026-06-10'));
    }

    public function testFixedConstructorThrowsOnInvalidAmount(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Coupon::fixed('BAD', 0, new \DateTimeImmutable('2026-06-10'));
    }

    public function testPercentConstructorThrowsOnEmptyCode(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Coupon::percent('', 10, new \DateTimeImmutable('2026-06-10'));
    }

    public function testCanBeAppliedToReturnsTrueWhenNotExpiredAndMeetsMinimum(): void
    {
        $coupon = Coupon::percent('MAY20', 20, new \DateTimeImmutable('2026-06-10'), 10000);
        $now = new \DateTimeImmutable('2026-05-26');

        self::assertTrue($coupon->canBeAppliedTo(12000, $now));
    }

    public function testCanBeAppliedToReturnsFalseWhenExpired(): void
    {
        $coupon = Coupon::percent('MAY20', 20, new \DateTimeImmutable('2026-05-20'), 10000);
        $now = new \DateTimeImmutable('2026-05-26');

        self::assertTrue($coupon->isExpired($now));
        self::assertFalse($coupon->canBeAppliedTo(12000, $now));
    }

    public function testCanBeAppliedToReturnsFalseWhenOrderBelowMinimum(): void
    {
        $coupon = Coupon::percent('MAY20', 20, new \DateTimeImmutable('2026-06-10'), 10000);
        $now = new \DateTimeImmutable('2026-05-26');

        self::assertFalse($coupon->canBeAppliedTo(9999, $now));
    }

    public function testDiscountAmountForPercentCoupon(): void
    {
        $coupon = Coupon::percent('MAY20', 20, new \DateTimeImmutable('2026-06-10'));

        self::assertSame(2400, $coupon->discountAmount(12000));
    }

    public function testDiscountAmountForFixedCoupon(): void
    {
        $coupon = Coupon::fixed('LESS15', 1500, new \DateTimeImmutable('2026-06-10'));

        self::assertSame(1500, $coupon->discountAmount(12000));
    }

    public function testDiscountAmountIsCappedByOrderValue(): void
    {
        $coupon = Coupon::fixed('BIG', 5000, new \DateTimeImmutable('2026-06-10'));

        self::assertSame(3000, $coupon->discountAmount(3000));
    }

    public function testFinalPriceForPercentCoupon(): void
    {
        $coupon = Coupon::percent('MAY20', 20, new \DateTimeImmutable('2026-06-10'));

        self::assertSame(9600, $coupon->finalPrice(12000));
    }

    public function testFinalPriceForFixedCoupon(): void
    {
        $coupon = Coupon::fixed('LESS15', 1500, new \DateTimeImmutable('2026-06-10'));

        self::assertSame(10500, $coupon->finalPrice(12000));
    }

    public function testFinalPriceCannotGoBelowZero(): void
    {
        $coupon = Coupon::fixed('HUGE', 20000, new \DateTimeImmutable('2026-06-10'));

        self::assertSame(0, $coupon->finalPrice(12000));
    }
}
