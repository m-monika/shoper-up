<?php

declare(strict_types=1);

namespace App\Task28;

use InvalidArgumentException;

class ParcelLocker extends ShippingMethod 
{
    public function __constuct (int $baseCost)
    {
        parent::__construct($baseCost);
    }

    public function calculateCost(Order $order): int 
    {
        if($order->getWeight()/1000 > 25) {
            throw new InvalidArgumentException('Wystąpił nieoczekiwany błąd');
        } elseif ($order->getTotalCost()/100 >= 500) {
            return 0;
        } else {
            return $this->baseCost;
        }
    }
}
