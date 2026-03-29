<?php

declare(strict_types=1);

namespace App\Materials\Route;

use App\Materials\Route\Vehicle\VehicleInterface;

class RouteGenerator
{
    /**
     * Generuje trasę jazdy między dwoma punktami dla wybranego pojazdu
     */
    public function generateRoute(
        VehicleInterface $vehicle,
        Point $startPoint,
        Point $endPoint
    ): string {
        $distance = $this->calculateDistance($startPoint, $endPoint);
        $estimatedTime = $this->calculateEstimatedTime($distance, $vehicle);

        return sprintf(
            "Trasa z %s do %s\nŚrodek transportu: %s\nDystans: %.2f km\nSzacowany czas: %.2f min",
            $startPoint->getName(),
            $endPoint->getName(),
            $vehicle->getName(),
            $distance,
            $estimatedTime
        );
    }

    /**
     * Oblicza dystans między dwoma punktami (wzór Haversine)
     */
    private function calculateDistance(Point $start, Point $end): float
    {
        $earthRadius = 6371; // km

        $latFrom = deg2rad($start->getLatitude());
        $lonFrom = deg2rad($start->getLongitude());
        $latTo = deg2rad($end->getLatitude());
        $lonTo = deg2rad($end->getLongitude());

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Oblicza szacowany czas podróży w minutach
     */
    private function calculateEstimatedTime(float $distance, VehicleInterface $vehicle): float
    {
        $averageSpeed = $vehicle->getAverageSpeed();

        if ($averageSpeed <= 0) {
            return 0.0;
        }

        return ($distance / $averageSpeed) * 60; // konwersja na minuty
    }
}
