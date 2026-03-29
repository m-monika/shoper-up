<?php

declare(strict_types=1);

namespace App\Materials\Route\Vehicle;

class CarVehicle implements VehicleInterface
{
    public function getName(): string
    {
        return 'Samochód';
    }

    public function getAverageSpeed(): float
    {
        return 60.0; // km/h
    }

    public function getType(): string
    {
        return 'car';
    }
}
