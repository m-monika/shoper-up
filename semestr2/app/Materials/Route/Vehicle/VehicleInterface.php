<?php

declare(strict_types=1);

namespace App\Materials\Route\Vehicle;

interface VehicleInterface
{
    public function getName(): string;

    public function getAverageSpeed(): float;

    public function getType(): string;
}
