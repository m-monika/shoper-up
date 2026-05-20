<?php

declare(strict_types=1);

namespace Tests\Task28;

use App\Task28\Courier;
use App\Task28\Order;
use App\Task28\ParcelLocker;
use PHPUnit\Framework\TestCase;

class ShippingMethodTest extends TestCase
{
    // --- Courier::calculateCost ---

    public function testCourierCalculateCostReturnsBaseCostForLightOrder(): void
    {
        $courier = new Courier(1500);
        $order = new Order(5000, 1000);
        $this->assertEquals(1500, $courier->calculateCost($order));
    }

    public function testCourierCalculateCostReturnsBaseCostWhenWeightExactlyAtLimit(): void
    {
        $courier = new Courier(1500);
        $order = new Order(5000, 10000);
        $this->assertEquals(1500, $courier->calculateCost($order));
    }

    public function testCourierCalculateCostAddsOneChunkWhenWeightExceedsLimitByOneGram(): void
    {
        $courier = new Courier(1500);
        $order = new Order(5000, 10001); // ceil(1/1000) = 1 → +500
        $this->assertEquals(2000, $courier->calculateCost($order));
    }

    public function testCourierCalculateCostAddsOneChunkForPartialKilogramOverLimit(): void
    {
        $courier = new Courier(1500);
        $order = new Order(5000, 10500); // ceil(500/1000) = 1 → +500
        $this->assertEquals(2000, $courier->calculateCost($order));
    }

    public function testCourierCalculateCostAddsOneChunkForFullKilogramOverLimit(): void
    {
        $courier = new Courier(1500);
        $order = new Order(5000, 11000); // ceil(1000/1000) = 1 → +500
        $this->assertEquals(2000, $courier->calculateCost($order));
    }

    public function testCourierCalculateCostAddsMultipleChunksForHeavyOrder(): void
    {
        $courier = new Courier(1500);
        $order = new Order(5000, 13000); // ceil(3000/1000) = 3 → +1500
        $this->assertEquals(3000, $courier->calculateCost($order));
    }

    public function testCourierCalculateCostScalesWithDifferentBaseCost(): void
    {
        $courier = new Courier(2000);
        $order = new Order(5000, 12000); // ceil(2000/1000) = 2 → +1000
        $this->assertEquals(3000, $courier->calculateCost($order));
    }

    // --- ParcelLocker::calculateCost ---

    public function testParcelLockerCalculateCostReturnsBaseCost(): void
    {
        $parcelLocker = new ParcelLocker(999);
        $order = new Order(10000, 5000);
        $this->assertEquals(999, $parcelLocker->calculateCost($order));
    }

    public function testParcelLockerCalculateCostReturnsFreeShippingWhenTotalCostExactlyAtThreshold(): void
    {
        $parcelLocker = new ParcelLocker(999);
        $order = new Order(50000, 5000);
        $this->assertEquals(0, $parcelLocker->calculateCost($order));
    }

    public function testParcelLockerCalculateCostReturnsFreeShippingWhenTotalCostAboveThreshold(): void
    {
        $parcelLocker = new ParcelLocker(999);
        $order = new Order(75000, 5000);
        $this->assertEquals(0, $parcelLocker->calculateCost($order));
    }

    public function testParcelLockerCalculateCostReturnsBaseCostWhenTotalCostJustBelowThreshold(): void
    {
        $parcelLocker = new ParcelLocker(999);
        $order = new Order(49999, 5000);
        $this->assertEquals(999, $parcelLocker->calculateCost($order));
    }

    public function testParcelLockerCalculateCostDoesNotThrowWhenWeightExactlyAtLimit(): void
    {
        $parcelLocker = new ParcelLocker(999);
        $order = new Order(5000, 25000);
        $this->assertEquals(999, $parcelLocker->calculateCost($order));
    }

    public function testParcelLockerCalculateCostThrowsExceptionWhenWeightExceedsLimit(): void
    {
        $parcelLocker = new ParcelLocker(999);
        $order = new Order(5000, 25001);
        $this->expectException(\Exception::class);
        $parcelLocker->calculateCost($order);
    }

    public function testParcelLockerCalculateCostThrowsExceptionEvenWhenOrderValueAboveThreshold(): void
    {
        $parcelLocker = new ParcelLocker(999);
        $order = new Order(99999, 25001);
        $this->expectException(\InvalidArgumentException::class);
        $parcelLocker->calculateCost($order);
    }
}
