<?php

declare(strict_types=1);

namespace App\Task3;

use App\Task3\Money;

class Product
{
    public function __construct(private string $name, private Money $price)
    {
        $this->name = $name;
        $this->price = $price;
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