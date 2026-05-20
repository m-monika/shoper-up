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
        // TODO
    }

    public function getFinalPrice(): float
    {
        // TODO
    }
}
