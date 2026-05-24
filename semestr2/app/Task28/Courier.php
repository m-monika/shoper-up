<?php

declare(strict_types=1);

namespace App\Task28;

class Courier extends ShippingMethod {
    public function __construct(
        $baseCost
    ) {
        parent::__construct($baseCost);
    }

    public function calculateCost(Order $order): int 
    {
        if ($order->getWeight() > 10000) {
            $overweight = ($order->getWeight() - 10000);
            $overweightKilo = (int) ($overweight / 1000);
            $modulo = $overweight % 1000;
            if ($modulo) {
                $surcharge = ($overweightKilo * 500) + 500;
            } else {
                $surcharge = ($overweightKilo * 500);
            }
            return $this->baseCost + $surcharge;
        } else {
            return $this->baseCost;
        }
    }
}