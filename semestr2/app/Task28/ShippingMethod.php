<?php

declare(strict_types=1);

namespace App\Task28;

abstract class ShippingMethod
{
    public function __construct(
        protected int $baseCost,
    ) {
    }

    abstract public function calculateCost(Order $order): int;
}
