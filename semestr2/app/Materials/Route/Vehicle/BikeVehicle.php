<?php

declare(strict_types=1);

namespace App\Materials\Route\Vehicle;

class BikeVehicle implements VehicleInterface
{
    public function getName(): string
    {
        return 'Rower';
    }

    public function getAverageSpeed(): float
    {
        return 20.0; // km/h
    }

    public function getType(): string
    {
        return 'bike';
    }
}
