<?php

namespace Tests\Task2;

use App\Task2\Basket;
use App\Task2\Product;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testGetSum(): void
    {
        $basket = new Basket();
        $product1 = new Product('Product 1', 10.0);
        $product2 = new Product('Product 2', 20.0);
        $basket->addProduct($product1);
        $basket->addProduct($product2);
        $this->assertEquals(30.0, $basket->getSum());
    }

    public function testEmptyBasket(): void
    {
        $basket = new Basket();
        $this->assertEquals(0.0, $basket->getSum());
    }

    public function testSingleProduct(): void
    {
        $basket = new Basket();
        $product = new Product('Single', 15.5);
        $basket->addProduct($product);
        $this->assertEquals(15.5, $basket->getSum());
    }

    public function testMultipleProductsWithDecimals(): void
    {
        $basket = new Basket();
        $basket->addProduct(new Product('A', 10.25));
        $basket->addProduct(new Product('B', 20.75));
        $basket->addProduct(new Product('C', 5.0));
        $this->assertEquals(36.0, $basket->getSum());
    }

    public function testProductWithZeroPrice(): void
    {
        $basket = new Basket();
        $basket->addProduct(new Product('Free', 0.0));
        $this->assertEquals(0.0, $basket->getSum());
    }

    public function testProductWithNegativePrice(): void
    {
        $basket = new Basket();
        $basket->addProduct(new Product('Discount', -5.0));
        $this->assertEquals(-5.0, $basket->getSum());
    }

    public function testAddingSameProductMultipleTimes(): void
    {
        $basket = new Basket();
        $product = new Product('Repeat', 7.0);
        $basket->addProduct($product);
        $basket->addProduct($product);
        $this->assertEquals(14.0, $basket->getSum());
    }
}
