<?php

declare(strict_types=1);

namespace App\Task29;

use InvalidArgumentException;

trait Discountable
{
    private int $discountPercent = 0;

    public function applyDiscount(int $percent): void
    {
        if ($percent < 0 || $percent > 100) {
            throw new InvalidArgumentException ("Wartość jest niepoprawna.");
        } else {
            $this->discountPercent = $percent;
        }
    }

    public function calculatePriceWithDiscount(float $price): float
    {
        $priceWithDiscount = $price - ($price * $this->discountPercent / 100);
        return (float) $priceWithDiscount;
    }
}
