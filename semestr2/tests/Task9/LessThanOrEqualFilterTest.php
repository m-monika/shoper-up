<?php

declare(strict_types=1);

namespace Tests\Task9;

use App\Task9\Filters\LessThanOrEqualFilter;
use PHPUnit\Framework\TestCase;

class LessThanOrEqualFilterTest extends TestCase
{
    public function testFilterReturnsProductsWithPriceLessOrEqual()
    {
        $filter = new LessThanOrEqualFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 500000],
            ['name' => 'Mysz', 'price' => 35000],
            ['name' => 'Klawiatura', 'price' => 40000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertCount(2, $result);
    }

    public function testFilterIncludesProductWithExactPrice()
    {
        $filter = new LessThanOrEqualFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 200000],
            ['name' => 'Mysz', 'price' => 100000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertCount(1, $result);
        $values = array_values($result);
        $this->assertSame('Mysz', $values[0]['name']);
    }

    public function testFilterReturnsEmptyArrayWhenNoMatch()
    {
        $filter = new LessThanOrEqualFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 500000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertEmpty($result);
    }
}

