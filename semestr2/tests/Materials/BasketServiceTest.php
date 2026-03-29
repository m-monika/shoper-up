<?php

declare(strict_types=1);

namespace Tests\Materials;

use App\Materials\BasketService;
use App\Task2\Product as ProductFromTask2;
use App\Task3\Product as ProductFromTask3;
use PHPUnit\Framework\TestCase;

class BasketServiceTest extends TestCase
{
    public function testAddProductFromTask2(): void
    {
        $basket = new BasketService();
        $product = new ProductFromTask2('Laptop', 2500.00);
        
        $basket->addProductFromTask2($product);
        
        $this->assertEquals(1, $basket->countProducts());
    }

    public function testAddProductFromTask3(): void
    {
        $basket = new BasketService();
        $product = new ProductFromTask3();
        
        $basket->addProductFromTask3($product);
        
        $this->assertEquals(1, $basket->countProducts());
    }

    public function testAddMultipleProductsFromTask2(): void
    {
        $basket = new BasketService();
        $product1 = new ProductFromTask2('Laptop', 2500.00);
        $product2 = new ProductFromTask2('Mouse', 50.00);
        $product3 = new ProductFromTask2('Keyboard', 150.00);
        
        $basket->addProductFromTask2($product1);
        $basket->addProductFromTask2($product2);
        $basket->addProductFromTask2($product3);
        
        $this->assertEquals(3, $basket->countProducts());
    }

    public function testAddMultipleProductsFromTask3(): void
    {
        $basket = new BasketService();
        $product1 = new ProductFromTask3();
        $product2 = new ProductFromTask3();
        
        $basket->addProductFromTask3($product1);
        $basket->addProductFromTask3($product2);
        
        $this->assertEquals(2, $basket->countProducts());
    }

    public function testAddMixedProducts(): void
    {
        $basket = new BasketService();
        $productTask2_1 = new ProductFromTask2('Phone', 1500.00);
        $productTask2_2 = new ProductFromTask2('Case', 30.00);
        $productTask3_1 = new ProductFromTask3();
        $productTask3_2 = new ProductFromTask3();
        
        $basket->addProductFromTask2($productTask2_1);
        $basket->addProductFromTask3($productTask3_1);
        $basket->addProductFromTask2($productTask2_2);
        $basket->addProductFromTask3($productTask3_2);
        
        $this->assertEquals(4, $basket->countProducts());
    }

    public function testEmptyBasket(): void
    {
        $basket = new BasketService();
        
        $this->assertEquals(0, $basket->countProducts());
    }

    public function testAddSameProductMultipleTimes(): void
    {
        $basket = new BasketService();
        $product = new ProductFromTask2('Monitor', 800.00);
        
        $basket->addProductFromTask2($product);
        $basket->addProductFromTask2($product);
        $basket->addProductFromTask2($product);
        
        $this->assertEquals(3, $basket->countProducts());
    }

    public function testCountAfterAddingManyProducts(): void
    {
        $basket = new BasketService();
        
        for ($i = 1; $i <= 10; $i++) {
            $basket->addProductFromTask2(new ProductFromTask2("Product $i", $i * 10.0));
        }
        
        for ($i = 1; $i <= 5; $i++) {
            $basket->addProductFromTask3(new ProductFromTask3());
        }
        
        $this->assertEquals(15, $basket->countProducts());
    }
}
