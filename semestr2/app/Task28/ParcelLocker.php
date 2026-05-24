<?php

declare(strict_types=1);

namespace App\Task28;

class ParcelLocker extends ShippingMethod {
    public function __construct(
        $baseCost
    ) {
        parent::__construct($baseCost);
    }

    public function calculateCost(Order $order): int 
    {
        if ($order->getWeight() > 25000) {
            throw new \InvalidArgumentException('Przesyłka niemożliwa do realizacji za pomocą tej formy dostawy');
        }
        if ($order->getTotalCost() >= 50000) {
            return 0;
        } else {
            return $this->baseCost;
        }
    }
}