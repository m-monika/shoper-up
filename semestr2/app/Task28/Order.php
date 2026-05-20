<?php

declare(strict_types=1);

namespace App\Task28;

class Order
{
    public function __construct(
        private int $totalCost,
        private int $weight,
    ) {
    }

    public function getTotalCost(): int
    {
        return $this->totalCost;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }
}
