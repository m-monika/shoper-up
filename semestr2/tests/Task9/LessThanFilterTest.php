<?php

declare(strict_types=1);

namespace Tests\Task9;

use App\Task9\Filters\LessThanFilter;
use PHPUnit\Framework\TestCase;

class LessThanFilterTest extends TestCase
{
    public function testFilterReturnsProductsWithPriceLessThan()
    {
        $filter = new LessThanFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 500000],
            ['name' => 'Mysz', 'price' => 35000],
            ['name' => 'Klawiatura', 'price' => 40000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertCount(2, $result);
    }

    public function testFilterExcludesProductWithExactPrice()
    {
        $filter = new LessThanFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 100000],
            ['name' => 'Mysz', 'price' => 50000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertCount(1, $result);
        $values = array_values($result);
        $this->assertSame('Mysz', $values[0]['name']);
    }

    public function testFilterReturnsEmptyArrayWhenNoMatch()
    {
        $filter = new LessThanFilter();
        $products = [
            ['name' => 'Laptop', 'price' => 500000],
        ];

        $result = $filter->filter($products, 100000);

        $this->assertEmpty($result);
    }
}

