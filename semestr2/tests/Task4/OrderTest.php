<?php

declare(strict_types=1);

namespace Tests\Task4;

use App\Task4\Address;
use App\Task4\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testIsBillingSameAsShippingReturnsTrueForIdenticalAddresses(): void
    {
        $billingAddress = new Address('ul. Pawia 9', 'Kraków', '31-154');
        $shippingAddress = new Address('ul. Pawia 9', 'Kraków', '31-154');
        $order = new Order('ORD-001', $billingAddress, $shippingAddress);
        $this->assertTrue($order->isBillingSameAsShipping());
    }

    public function testIsBillingSameAsShippingReturnsFalseForDifferentAddresses(): void
    {
        $billingAddress = new Address('ul. Pawia 9', 'Kraków', '31-154');
        $shippingAddress = new Address('ul. Mickiewicza 21', 'Poznań', '60-835');
        $order = new Order('ORD-002', $billingAddress, $shippingAddress);
        $this->assertFalse($order->isBillingSameAsShipping());
    }
}
