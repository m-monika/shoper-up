<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Task1\Basket;

class BasketTest extends TestCase
{
    public function testAddProductIncreasesProductsCount(): void
    {
        $basket = new Basket();
        $product = [
            'name' => 'Chleb',
            'price' => 800,
            'qty' => 2,
        ];
        $basket->addProduct($product);
        $this->assertEquals(1600, $basket->getSum());
    }

    public function testGetSumWithMultipleProducts(): void
    {
        $basket = new Basket();
        $basket->addProduct(['name' => 'Chleb', 'price' => 800, 'qty' => 2]);
        $basket->addProduct(['name' => 'Masło', 'price' => 500, 'qty' => 1]);
        $this->assertEquals(2100, $basket->getSum());
    }

    public function testGetSumWithEmptyBasket(): void
    {
        $basket = new Basket();
        $this->assertEquals(0, $basket->getSum());
    }
}
