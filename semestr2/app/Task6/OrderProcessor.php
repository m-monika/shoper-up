<?php

declare(strict_types=1);

namespace App\Task6;

class OrderProcessor
{
    public function processOrder(string $orderNumber, float $amount, float $weight, string $address): array
    {
        return [
            'order' => $orderNumber,
            'payment' => '',
            'shipping_cost' => '',
            'shipping' => '',
        ];
    }
}
