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
        $totalPrice = 0.0;
        foreach ($this->products as $index => $product) {
            $totalPrice += $product->getFinalPrice();
        }
        return $totalPrice;
    }

    public function getFinalPrice(): float
    {
        $totalPrice = $this->getTotalPrice();
        $finalPrice = $this->calculatePriceWithDiscount($totalPrice);
        return $finalPrice;
    }
}
