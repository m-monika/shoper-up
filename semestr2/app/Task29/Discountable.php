<?php

declare(strict_types=1);

namespace App\Task29;

trait Discountable
{
    private int $discountPercent = 0;

    public function applyDiscount(int $percent): void
    {
        if ($percent < 0 or $percent > 100) {
            throw new \InvalidArgumentException('Nieprawidłowy rabat');
        } else {
            $this->discountPercent = $percent;
        }
    }

    public function calculatePriceWithDiscount(float $price): float
    {
        return $price - ($price * ($this->discountPercent * 0.01));
    }
}
