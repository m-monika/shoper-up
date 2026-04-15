<?php

declare(strict_types=1);

namespace App\Task11;

class ProductCollection
{
    private array $products = [];

    public function addProduct(Product $product): void
    {
        $this->products[$product->getId()] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProductById(int $id): ?Product
    {
        return $this->products[$id] ?? null;
    }
}
