<?php

declare(strict_types=1);

namespace Tests\Task29;

use App\Task29\Basket;
use App\Task29\Product;
use PHPUnit\Framework\TestCase;

class DiscountableTest extends TestCase
{
    // --- Discountable::applyDiscount ---

    public function testApplyDiscountThrowsExceptionForNegativeValue(): void
    {
        $product = new Product('A', 100.0);
        $this->expectException(\InvalidArgumentException::class);
        $product->applyDiscount(-1);
    }

    public function testApplyDiscountThrowsExceptionForValueAbove100(): void
    {
        $product = new Product('A', 100.0);
        $this->expectException(\InvalidArgumentException::class);
        $product->applyDiscount(101);
    }

    public function testApplyDiscountAcceptsBoundaryValueZero(): void
    {
        $product = new Product('A', 100.0);
        $product->applyDiscount(0);
        $this->assertEquals(100.0, $product->getFinalPrice());
    }

    public function testApplyDiscountAcceptsBoundaryValue100(): void
    {
        $product = new Product('A', 100.0);
        $product->applyDiscount(100);
        $this->assertEquals(0.0, $product->getFinalPrice());
    }

    // --- Product::getFinalPrice ---

    public function testProductGetFinalPriceWithoutDiscountReturnsOriginalPrice(): void
    {
        $product = new Product('Koszulka', 100.0);
        $this->assertEquals(100.0, $product->getFinalPrice());
    }

    public function testProductGetFinalPriceAppliesDiscount(): void
    {
        $product = new Product('Koszulka', 100.0);
        $product->applyDiscount(10);
        $this->assertEquals(90.0, $product->getFinalPrice());
    }

    public function testProductGetFinalPriceDoesNotModifyOriginalPrice(): void
    {
        $product = new Product('Koszulka', 100.0);
        $product->applyDiscount(50);
        $this->assertEquals(100.0, $product->getPrice());
    }

    public function testProductGetFinalPriceFor25PercentDiscount(): void
    {
        $product = new Product('Buty', 200.0);
        $product->applyDiscount(25);
        $this->assertEquals(150.0, $product->getFinalPrice());
    }

    // --- Basket::getTotalPrice ---

    public function testBasketGetTotalPriceReturnsZeroForEmptyBasket(): void
    {
        $basket = new Basket();
        $this->assertEquals(0.0, $basket->getTotalPrice());
    }

    public function testBasketGetTotalPriceSumsFinalPricesOfProducts(): void
    {
        $basket = new Basket();
        $p1 = new Product('A', 100.0);
        $p1->applyDiscount(10); // → 90
        $p2 = new Product('B', 200.0); // → 200
        $basket->addProduct($p1);
        $basket->addProduct($p2);
        $this->assertEquals(290.0, $basket->getTotalPrice());
    }

    public function testBasketGetTotalPriceIsNotAffectedByBasketDiscount(): void
    {
        $basket = new Basket();
        $basket->addProduct(new Product('A', 100.0));
        $basket->applyDiscount(50);
        $this->assertEquals(100.0, $basket->getTotalPrice());
    }

    // --- Basket::getFinalPrice ---

    public function testBasketGetFinalPriceWithoutDiscountEqualsTotalPrice(): void
    {
        $basket = new Basket();
        $basket->addProduct(new Product('A', 100.0));
        $basket->addProduct(new Product('B', 50.0));
        $this->assertEquals(150.0, $basket->getFinalPrice());
    }

    public function testBasketGetFinalPriceAppliesBasketDiscount(): void
    {
        $basket = new Basket();
        $basket->addProduct(new Product('A', 100.0));
        $basket->addProduct(new Product('B', 100.0));
        $basket->applyDiscount(10);
        $this->assertEquals(180.0, $basket->getFinalPrice());
    }

    public function testBasketGetFinalPriceAppliesBothProductAndBasketDiscounts(): void
    {
        $basket = new Basket();
        $p = new Product('A', 100.0);
        $p->applyDiscount(20); // 100 → 80
        $basket->addProduct($p);
        $basket->applyDiscount(25); // 80 → 60
        $this->assertEquals(60.0, $basket->getFinalPrice());
    }

    public function testBasketGetFinalPriceFor100PercentDiscountReturnsZero(): void
    {
        $basket = new Basket();
        $basket->addProduct(new Product('A', 999.0));
        $basket->applyDiscount(100);
        $this->assertEquals(0.0, $basket->getFinalPrice());
    }
}
