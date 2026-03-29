<?php

declare(strict_types=1);

namespace App\Materials\Route;

class Point
{
    public function __construct(
        private string $name,
        private float $latitude,
        private float $longitude
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
