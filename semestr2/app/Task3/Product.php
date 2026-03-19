<?php

declare(strict_types=1);

namespace App\Task3;

class Product
{
    public function __construct(private string $name, private Money $price)
    {
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
