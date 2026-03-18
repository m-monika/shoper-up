<?php

declare(strict_types=1);

namespace Tests\Task5;

use App\Task5\Order;
use App\Task5\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testShippingIsChargedWhenItemsTotalIsBelowThreshold()
    {
        $order = new Order('ORD-003');
        $order->addItem(new OrderItem('Kabel USB', 1, 2000));
        $this->assertSame(2000, $order->calculateItemsTotal());
        $this->assertSame(1500, $order->getShippingCost());
        $this->assertSame(3500, $order->calculateGrandTotal());
    }

    public function testShippingIsFreeWhenItemsTotalIsAboveOrEqualThreshold()
    {
        $order = new Order('ORD-004');
        $order->addItem(new OrderItem('Kabel USB', 2, 2000));
        $order->addItem(new OrderItem('Mysz', 1, 40000));
        $this->assertSame(44000, $order->calculateItemsTotal());
        $this->assertSame(0, $order->getShippingCost());
        $this->assertSame(44000, $order->calculateGrandTotal());
    }
}
