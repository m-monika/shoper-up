<?php

declare(strict_types=1);

namespace App\Task6\Shipping;

class ShippingService
{
    private string $courier;

    public function __construct(string $courier)
    {
        $this->courier = $courier;
    }

    public function calculateCost(float $weight): float
    {
        return $weight * 2.5;
    }

    public function ship(string $address): string
    {
        return "Wysyłka do {$address} przez {$this->courier}";
    }
}
