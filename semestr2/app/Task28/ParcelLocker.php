<?php

declare(strict_types=1);

namespace App\Task28;


class ParcelLocker extends ShippingMethod
{
    public function calculateCost(Order $order): int
    {
        $orderWeight = $order->getWeight();
        $orderCost = $order->getTotalCost();

        if ($orderWeight > 25000) {
            throw new \InvalidArgumentException('Waga zbyt duża dla wybranej formy dostawy');
        }

        if ($orderCost >= 50000) {
            return 0;
        }

        return $this->baseCost;
    }
}