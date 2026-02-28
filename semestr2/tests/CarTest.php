<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Car;

class CarTest extends TestCase
{
    public function testConstructorSetsColor(): void
    {
        $car = new Car('red');
        $this->assertEquals('red', $car->getColor());
    }

    public function testPaintChangesColor(): void
    {
        $car = new Car('blue');
        $car->paint('green');
        $this->assertEquals('green', $car->getColor());
    }
}
