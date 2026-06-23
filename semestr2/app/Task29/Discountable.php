<?php

declare(strict_types=1);

namespace App\Task29;

trait Discountable
{
    private int $discountPercent = 0;

    public function applyDiscount(int $percent): void
    {
        if ($percent < 0 || $percent > 100) {
            throw new \InvalidArgumentException("Wartość procentowa rabatu nie mieści się w przedziale od 0 do 100");
        } else {
            $this->discountPercent = $percent;
        }
    }

    public function calculatePriceWithDiscount(float $price): float
    {
        $priceWithDiscount = $price -  ($price * $this->discountPercent / 100.00);
        return $priceWithDiscount;
    }
}
