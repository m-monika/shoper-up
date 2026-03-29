<?php

declare(strict_types=1);

namespace Tests\Task8;

use App\Task8\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetNameReturnsCorrectName()
    {
        $product = new Product('Laptop', 3000.00);

        $this->assertSame('Laptop', $product->getName());
    }

    public function testGetPriceReturnsCorrectPrice()
    {
        $product = new Product('Laptop', 3000.00);

        $this->assertSame(3000.00, $product->getPrice());
    }

    public function testProductWithDifferentValues()
    {
        $product = new Product('Mysz', 150.50);

        $this->assertSame('Mysz', $product->getName());
        $this->assertSame(150.50, $product->getPrice());
    }
}
