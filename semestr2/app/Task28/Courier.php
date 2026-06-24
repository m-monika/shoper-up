<?php

declare(strict_types=1);

namespace App\Task28;

class Courier extends ShippingMethod
{
    public function calculateCost(Order $order): int
    {
        if ($order->getWeight() <= 10000) {
            return $this->baseCost;
        }

        $extraWeight = $order->getWeight() - 10000;
        $extraKilograms = (int) ceil($extraWeight / 1000);

        return $this->baseCost + $extraKilograms * 500;
    }
}
