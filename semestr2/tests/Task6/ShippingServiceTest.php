<?php

declare(strict_types=1);

namespace Tests\Task6;

use App\Task6\Shipping\ShippingService;
use PHPUnit\Framework\TestCase;

class ShippingServiceTest extends TestCase
{
    public function testCalculateCostReturnsCorrectAmount()
    {
        $service = new ShippingService('DHL');
        $cost = $service->calculateCost(2.0);

        $this->assertSame(5.0, $cost);
    }

    public function testCalculateCostWithDifferentWeight()
    {
        $service = new ShippingService('InPost');
        $cost = $service->calculateCost(1.5);

        $this->assertSame(3.75, $cost);
    }

    public function testShipReturnsCorrectMessage()
    {
        $service = new ShippingService('DHL');
        $result = $service->ship('ul. Pawia 9, 31-154 Kraków');

        $this->assertSame(
            'Wysyłka do ul. Pawia 9, 31-154 Kraków przez DHL',
            $result
        );
    }

    public function testShippingServiceWithDifferentCourier()
    {
        $service = new ShippingService('InPost');
        $result = $service->ship('ul. Floriańska 15, Kraków');

        $this->assertStringContainsString('InPost', $result);
        $this->assertStringContainsString('ul. Floriańska 15', $result);
    }
}
