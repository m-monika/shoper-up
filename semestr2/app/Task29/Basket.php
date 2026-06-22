<?php

declare(strict_types=1);

namespace App\Task29;

class Basket
{
    use Discountable;

    private array $products = [];

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotalPrice(): float
    {
        $sum = 0.0;
        foreach($this->products as $product) {
            $sum += $product->getFinalPrice();
        }
        return $sum;
    }

    public function getFinalPrice(): float
    {
        $sum = 0.0;
        foreach($this->products as $product) {
            $sum += $product->getFinalPrice();
        }
        return $this->calculatePriceWithDiscount($sum);
    }
}
