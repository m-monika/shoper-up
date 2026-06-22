<?php

declare(strict_types=1);

namespace App\Task29;

class Product
{
    use Discountable;

    public function __construct(
        private string $name,
        private float $price,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getFinalPrice(): float
    {
        return $this->calculatePriceWithDiscount($this->price);
    }
}
