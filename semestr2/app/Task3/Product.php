<?php

declare(strict_types=1);

namespace App\Task3;

class Product
{
    private Money $price;
    private string $name;

    public function __construct(string $name, Money $price)
    {
        $this->price = $price;
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getFormattedPrice(): string
    {
        return $this->price->getFormatted();
    }
}