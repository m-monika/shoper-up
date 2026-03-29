<?php

declare(strict_types=1);

namespace Tests\Task9;

use App\Task9\Filters\GreaterThanOrEqualFilter;
use PHPUnit\Framework\TestCase;

class GreaterThanOrEqualFilterTest extends TestCase
{
    public function testFilterReturnsProductsWithPriceGreaterOrEqual()
    {
        $filter = new GreaterThanOrEqualFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 500000],
            ['name' => 'Mysz', 'price' => 35000],
            ['name' => 'Monitor', 'price' => 400000],
        ];

        $result = $filter->filter($products, 200000);

        $this->assertCount(2, $result);
    }

    public function testFilterIncludesProductWithExactPrice()
    {
        $filter = new GreaterThanOrEqualFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 200000],
            ['name' => 'Mysz', 'price' => 100000],
        ];

        $result = $filter->filter($products, 200000);

        $this->assertCount(1, $result);
        $values = array_values($result);
        $this->assertSame('Laptop', $values[0]['name']);
    }

    public function testFilterReturnsEmptyArrayWhenNoMatch()
    {
        $filter = new GreaterThanOrEqualFilter();
        $products = [
            ['name' => 'Mysz', 'price' => 35000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertEmpty($result);
    }
}

