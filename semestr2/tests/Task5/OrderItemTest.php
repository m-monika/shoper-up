<?php

declare(strict_types=1);

namespace Tests\Task5;

use App\Task5\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderItemTest extends TestCase
{
    public function testCalculatesTotalPriceCorrectly(): void
    {
        $item = new OrderItem('Mysz Logitech', 3, 25000);
        $this->assertSame(75000, $item->getTotalPrice());
    }
}
