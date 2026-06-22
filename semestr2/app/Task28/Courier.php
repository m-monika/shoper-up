<?php

declare(strict_types=1);

namespace App\Task28;


class Courier extends ShippingMethod
{
    public function calculateCost(Order $order): int
    {
        $orderWeight = $order->getWeight();
        $maxFreeWeight = 10000;

        if ($orderWeight > $maxFreeWeight) {
            $overweight = $orderWeight - $maxFreeWeight;

            $extraKilos = (int) ceil($overweight / 1000);
            $surcharge = $extraKilos * 500;

            return $this->baseCost + $surcharge;
        }

        return $this->baseCost;
    }
}
