<?php

declare(strict_types=1);

namespace App\Task30;

use InvalidArgumentException;

class Coupon
{
    public const string TYPE_PERCENT = 'percent';
    public const string TYPE_FIXED = 'fixed';

    private function __construct(
        private string $code,
        private string $type,
        private int $value,
        private \DateTimeImmutable $expiresAt,
        private int $minOrderValue
    ) {

        $this->expiresAt = $expiresAt;

        if(!$code) {
            throw new \InvalidArgumentException ("Wartość nie może być pusta");
        } else {
            $this->code = $code;
        }

        if ($type != Coupon::TYPE_PERCENT && $type != Coupon::TYPE_FIXED) {
            throw new \InvalidArgumentException("Nieprawidłowa wartość1");
        } elseif ($type === Coupon::TYPE_PERCENT){
            if($value <= 0 || $value > 100) {
                throw new \InvalidArgumentException("Nieprawidłowa wartość 2");
            } else {
                $this->value = $value;
            }
        } elseif ($type === Coupon::TYPE_FIXED) {
            if($value <= 0) {
                throw new \InvalidArgumentException("Nieprawidłowa wartość3");
            } else {
                $this->value = $value;
            }
        } else {
            throw new \InvalidArgumentException("Nieprawidłowa wartość4");
        }

        if ($minOrderValue < 0) {
            throw new \InvalidArgumentException("Nieprawidłowa wartość5");
        } else {
            $this->minOrderValue = $minOrderValue;
        }
    }

    public static function percent(string $code, int $percent, \DateTimeImmutable $expiresAt, int $minOrderValue = 0): self
    {
        return new self($code, self::TYPE_PERCENT, $percent, $expiresAt, $minOrderValue);
    }

    public static function fixed(string $code, int $amount, \DateTimeImmutable $expiresAt, int $minOrderValue = 0): self
    {
        return new self($code, self::TYPE_FIXED, $amount, $expiresAt, $minOrderValue);
    }

    public static function welcome(): self
    {
        $today = new \DateTimeImmutable();
        $expiresAt = $today->modify('+30 days');

        return new self('WELCOME10', self::TYPE_PERCENT, 10, $expiresAt, 5000 );
    }

    public function isExpired(\DateTimeImmutable $now): bool
    {
        if($this->expiresAt < $now) {
            return true;
        } else {
            return false;
        }
    }

    public function canBeAppliedTo(int $orderValue, \DateTimeImmutable $now): bool
    {
        if($orderValue >= $this->minOrderValue && $now < $this->expiresAt) {
            return true;
        } else {
            return false;
        }
    }

    public function discountAmount(int $orderValue): int
    {
        if ($this->type === Coupon::TYPE_PERCENT) {
            $amount = $orderValue * $this->value / 100;
            $diff = $orderValue - $amount;
            if($diff < 0 || $amount > $orderValue) {
                return $orderValue;
            } else {
                return $amount;
            }
        }

        if ($this->type === Coupon::TYPE_FIXED) {

            if($this->value > $orderValue) {
                return $orderValue;
            } else {
                return $this->value;
            }
        }
    }

    public function finalPrice(int $orderValue): int
    {
        $finalPrice = $orderValue - $this->discountAmount($orderValue);

        if ($finalPrice < 0) {
            return 0;
        } else {
            return $finalPrice;
        }
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getMinOrderValue(): int
    {
        return $this->minOrderValue;
    }

    public function getExpiresAt(): \DateTimeImmutable
    {
        return $this->expiresAt;
    }

}    


