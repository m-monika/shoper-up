<?php

declare(strict_types=1);

namespace App\Task29;

trait Discountable
{
    private int $discountPercent = 0;

    public function applyDiscount(int $percent): void
    {
        // TODO
    }

    public function calculatePriceWithDiscount(float $price): float
    {
        // TODO
    }
}
