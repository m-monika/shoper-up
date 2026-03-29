<?php

declare(strict_types=1);

namespace Tests\Task9;

use App\Task9\ProductCollection;
use App\Task9\Filters\GreaterThanOrEqualFilter;
use App\Task9\Filters\GreaterThanFilter;
use App\Task9\Filters\LessThanOrEqualFilter;
use App\Task9\Filters\LessThanFilter;
use PHPUnit\Framework\TestCase;

class ProductCollectionTest extends TestCase
{
    public function testAddProductAddsProductToCollection()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Laptop', 500000);

        $products = $collection->getProducts();
        $this->assertCount(1, $products);
        $this->assertSame('Laptop', $products[0]['name']);
        $this->assertSame(500000, $products[0]['price']);
    }

    public function testAddProductAddsMultipleProducts()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Laptop', 500000);
        $collection->addProduct('Mysz', 35000);
        $collection->addProduct('Monitor', 400000);

        $products = $collection->getProducts();
        $this->assertCount(3, $products);
    }

    public function testFilterWithGreaterThanOrEqualFilter()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Laptop', 500000);
        $collection->addProduct('Klawiatura', 40000);
        $collection->addProduct('Mysz', 35000);
        $collection->addProduct('Monitor', 400000);

        $filter = new GreaterThanOrEqualFilter();
        $result = $collection->filter(200000, $filter);

        $this->assertCount(2, $result);
    }

    public function testFilterWithGreaterThanFilter()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Laptop', 500000);
        $collection->addProduct('Monitor', 200000);
        $collection->addProduct('Mysz', 35000);

        $filter = new GreaterThanFilter();
        $result = $collection->filter(200000, $filter);

        $this->assertCount(1, $result);
        $values = array_values($result);
        $this->assertSame('Laptop', $values[0]['name']);
    }

    public function testFilterWithLessThanOrEqualFilter()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Laptop', 500000);
        $collection->addProduct('Klawiatura', 40000);
        $collection->addProduct('Mysz', 35000);

        $filter = new LessThanOrEqualFilter();
        $result = $collection->filter(100000, $filter);

        $this->assertCount(2, $result);
    }

    public function testFilterWithLessThanFilter()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Laptop', 500000);
        $collection->addProduct('Klawiatura', 100000);
        $collection->addProduct('Mysz', 50000);

        $filter = new LessThanFilter();
        $result = $collection->filter(100000, $filter);

        $this->assertCount(1, $result);
        $values = array_values($result);
        $this->assertSame('Mysz', $values[0]['name']);
    }

    public function testGetProductsReturnsEmptyArrayForEmptyCollection()
    {
        $collection = new ProductCollection();

        $this->assertSame([], $collection->getProducts());
    }

    public function testFilterReturnsEmptyArrayWhenNoMatch()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Mysz', 35000);

        $filter = new GreaterThanOrEqualFilter();
        $result = $collection->filter(100000, $filter);

        $this->assertEmpty($result);
    }

    public function testComplexScenarioWithMultipleFilters()
    {
        $collection = new ProductCollection();
        $collection->addProduct('Laptop', 500000);
        $collection->addProduct('Klawiatura', 40000);
        $collection->addProduct('Mysz', 35000);
        $collection->addProduct('Monitor', 400000);
        $collection->addProduct('Słuchawki', 150000);

        // Test >= 200000
        $gteFilter = new GreaterThanOrEqualFilter();
        $expensive = $collection->filter(200000, $gteFilter);
        $this->assertCount(2, $expensive);

        // Test < 100000
        $ltFilter = new LessThanFilter();
        $cheap = $collection->filter(100000, $ltFilter);
        $this->assertCount(2, $cheap);

        // Test > 100000 AND <= 400000
        $gtFilter = new GreaterThanFilter();
        $medium = $collection->filter(100000, $gtFilter);
        $this->assertCount(3, $medium);
    }
}

