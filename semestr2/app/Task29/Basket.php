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
        $count = 0;
        foreach ($this->products as $key => $product) {
            $count += $product->getFinalPrice();
        }
        return $count;
    }

    public function getFinalPrice(): float
    {
        $count = 0;
        foreach ($this->products as $key => $product) {
            $productPrice = $product->getFinalPrice();
            $count += $this->calculatePriceWithDiscount($productPrice);
        }
        return $count;
    }
}
