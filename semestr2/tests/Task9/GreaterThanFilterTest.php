<?php

declare(strict_types=1);

namespace Tests\Task9;

use App\Task9\Filters\GreaterThanFilter;
use PHPUnit\Framework\TestCase;

class GreaterThanFilterTest extends TestCase
{
    public function testFilterReturnsProductsWithPriceGreaterThan()
    {
        $filter = new GreaterThanFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 500000],
            ['name' => 'Mysz', 'price' => 35000],
            ['name' => 'Monitor', 'price' => 400000],
        ];

        $result = $filter->filter($products, 200000);

        $this->assertCount(2, $result);
    }

    public function testFilterExcludesProductWithExactPrice()
    {
        $filter = new GreaterThanFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 200000],
            ['name' => 'Monitor', 'price' => 300000],
        ];

        $result = $filter->filter($products, 200000);

        $this->assertCount(1, $result);
        $values = array_values($result);
        $this->assertSame('Monitor', $values[0]['name']);
    }

    public function testFilterReturnsEmptyArrayWhenNoMatch()
    {
        $filter = new GreaterThanFilter();
        $products = [
            ['name' => 'Mysz', 'price' => 35000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertEmpty($result);
    }
}

