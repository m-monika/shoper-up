<?php

declare(strict_types=1);

namespace App\Task9;

use App\Task9\Filters\PriceFilterInterface;

class ProductCollection
{
    private array $products = [];

    public function addProduct(string $name, int $price): void
    {
        $this->products[] = [
            'name' => $name,
            'price' => $price,
        ];
    }

    public function filter(int $filterPrice, PriceFilterInterface $filter): array
    {
        return $filter->filter($this->products, $filterPrice);
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
