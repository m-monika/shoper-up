<?php

declare(strict_types=1);

namespace App\Task28;

class ParcelLocker extends ShippingMethod
{
    public function calculateCost(Order $order): int
    {
        if ($order->getWeight() > 25000) {
            throw new \InvalidArgumentException('Zamówienie jest za ciężkie.');
        }

        if ($order->getTotalCost() >= 50000) {
            return 0;
        }

        return $this->baseCost;
    }
}
