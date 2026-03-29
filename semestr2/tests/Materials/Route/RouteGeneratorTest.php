<?php

declare(strict_types=1);

namespace Tests\Materials\Route;

use App\Materials\Route\Point;
use App\Materials\Route\RouteGenerator;
use App\Materials\Route\Vehicle\BikeVehicle;
use App\Materials\Route\Vehicle\CarVehicle;
use PHPUnit\Framework\TestCase;

class RouteGeneratorTest extends TestCase
{
    private RouteGenerator $routeGenerator;
    private Point $pointWarsaw;
    private Point $pointKrakow;
    private Point $pointGdansk;

    protected function setUp(): void
    {
        $this->routeGenerator = new RouteGenerator();
        
        // Warszawa
        $this->pointWarsaw = new Point('Warszawa', 52.2297, 21.0122);
        
        // Kraków
        $this->pointKrakow = new Point('Kraków', 50.0647, 19.9450);
        
        // Gdańsk
        $this->pointGdansk = new Point('Gdańsk', 54.3520, 18.6466);
    }

    public function testGenerateRouteWithCarVehicle(): void
    {
        $vehicle = new CarVehicle();
        
        $route = $this->routeGenerator->generateRoute(
            $vehicle,
            $this->pointWarsaw,
            $this->pointKrakow
        );
        
        $this->assertStringContainsString('Warszawa', $route);
        $this->assertStringContainsString('Kraków', $route);
        $this->assertStringContainsString('Samochód', $route);
        $this->assertStringContainsString('Dystans:', $route);
        $this->assertStringContainsString('Szacowany czas:', $route);
    }

    public function testGenerateRouteWithBikeVehicle(): void
    {
        $vehicle = new BikeVehicle();
        
        $route = $this->routeGenerator->generateRoute(
            $vehicle,
            $this->pointWarsaw,
            $this->pointKrakow
        );
        
        $this->assertStringContainsString('Warszawa', $route);
        $this->assertStringContainsString('Kraków', $route);
        $this->assertStringContainsString('Rower', $route);
        $this->assertStringContainsString('Dystans:', $route);
        $this->assertStringContainsString('Szacowany czas:', $route);
    }

    public function testGenerateRouteWarszawaToGdansk(): void
    {
        $vehicle = new CarVehicle();
        
        $route = $this->routeGenerator->generateRoute(
            $vehicle,
            $this->pointWarsaw,
            $this->pointGdansk
        );
        
        $this->assertStringContainsString('Warszawa', $route);
        $this->assertStringContainsString('Gdańsk', $route);
        $this->assertStringContainsString('Samochód', $route);
    }

    public function testDifferentVehiclesHaveDifferentEstimatedTimes(): void
    {
        $carVehicle = new CarVehicle();
        $bikeVehicle = new BikeVehicle();
        
        $carRoute = $this->routeGenerator->generateRoute(
            $carVehicle,
            $this->pointWarsaw,
            $this->pointKrakow
        );
        
        $bikeRoute = $this->routeGenerator->generateRoute(
            $bikeVehicle,
            $this->pointWarsaw,
            $this->pointKrakow
        );
        
        // Samochód powinien być najszybszy
        $this->assertNotEquals($carRoute, $bikeRoute);
    }

    public function testShortDistanceWithAllVehicles(): void
    {
        $pointA = new Point('Punkt A', 52.2297, 21.0122);
        $pointB = new Point('Punkt B', 52.2400, 21.0200);
        
        $carVehicle = new CarVehicle();
        $bikeVehicle = new BikeVehicle();
        
        $carRoute = $this->routeGenerator->generateRoute($carVehicle, $pointA, $pointB);
        $bikeRoute = $this->routeGenerator->generateRoute($bikeVehicle, $pointA, $pointB);
        
        $this->assertStringContainsString('Punkt A', $carRoute);
        $this->assertStringContainsString('Punkt B', $carRoute);
        $this->assertStringContainsString('Punkt A', $bikeRoute);
        $this->assertStringContainsString('Punkt B', $bikeRoute);
    }

    public function testRouteFormatContainsAllRequiredInformation(): void
    {
        $vehicle = new CarVehicle();
        
        $route = $this->routeGenerator->generateRoute(
            $vehicle,
            $this->pointWarsaw,
            $this->pointKrakow
        );

        $this->assertMatchesRegularExpression('/Trasa z .+ do .+/', $route);
        $this->assertMatchesRegularExpression('/Środek transportu: .+/', $route);
        $this->assertMatchesRegularExpression('/Dystans: \d+\.\d{2} km/', $route);
        $this->assertMatchesRegularExpression('/Szacowany czas: \d+\.\d{2} min/', $route);
    }

    public function testSamePointsWithDifferentVehicles(): void
    {
        $pointStart = new Point('Start', 50.0, 20.0);
        $pointEnd = new Point('End', 50.1, 20.1);
        
        $vehicles = [
            new CarVehicle(),
            new BikeVehicle(),
        ];
        
        foreach ($vehicles as $vehicle) {
            $route = $this->routeGenerator->generateRoute($vehicle, $pointStart, $pointEnd);
            
            $this->assertStringContainsString('Start', $route);
            $this->assertStringContainsString('End', $route);
            $this->assertStringContainsString($vehicle->getName(), $route);
        }
    }

    public function testVehicleTypesReturnCorrectNames(): void
    {
        $carVehicle = new CarVehicle();
        $bikeVehicle = new BikeVehicle();
        
        $this->assertEquals('Samochód', $carVehicle->getName());
        $this->assertEquals('Rower', $bikeVehicle->getName());
    }

    public function testVehicleTypesReturnCorrectSpeeds(): void
    {
        $carVehicle = new CarVehicle();
        $bikeVehicle = new BikeVehicle();
        
        $this->assertEquals(60.0, $carVehicle->getAverageSpeed());
        $this->assertEquals(20.0, $bikeVehicle->getAverageSpeed());
    }

    public function testVehicleTypesReturnCorrectTypes(): void
    {
        $carVehicle = new CarVehicle();
        $bikeVehicle = new BikeVehicle();
        
        $this->assertEquals('car', $carVehicle->getType());
        $this->assertEquals('bike', $bikeVehicle->getType());
    }

    public function testLongDistanceRouteWithCar(): void
    {
        $vehicle = new CarVehicle();
        
        $route = $this->routeGenerator->generateRoute(
            $vehicle,
            $this->pointGdansk,
            $this->pointKrakow
        );
        
        $this->assertStringContainsString('Gdańsk', $route);
        $this->assertStringContainsString('Kraków', $route);
    }

    public function testLongDistanceRouteWithBike(): void
    {
        $vehicle = new BikeVehicle();
        
        $route = $this->routeGenerator->generateRoute(
            $vehicle,
            $this->pointGdansk,
            $this->pointKrakow
        );
        
        $this->assertStringContainsString('Gdańsk', $route);
        $this->assertStringContainsString('Kraków', $route);
    }
}
