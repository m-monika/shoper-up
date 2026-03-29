<?php

declare(strict_types=1);

namespace Tests\Task8;

use App\Task8\Basket;
use App\Task8\Product;
use App\Task8\Coupons\PercentageCoupon;
use App\Task8\Coupons\FixedAmountCoupon;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testAddProductAddsProductToCart()
    {
        $cart = new Basket();
        $product = new Product('Laptop', 3000.00);

        $cart->addProduct($product, 1);

        $products = $cart->getProducts();
        $this->assertCount(1, $products);
        $this->assertSame($product, $products[0]['product']);
        $this->assertSame(1, $products[0]['quantity']);
    }

    public function testAddProductIncreasesQuantityForSameProduct()
    {
        $cart = new Basket();
        $product = new Product('Laptop', 3000.00);

        $cart->addProduct($product, 1);
        $cart->addProduct($product, 2);

        $products = $cart->getProducts();
        $this->assertCount(1, $products);
        $this->assertSame(3, $products[0]['quantity']);
    }

    public function testAddProductAddsMultipleDifferentProducts()
    {
        $cart = new Basket();
        $laptop = new Product('Laptop', 3000.00);
        $mouse = new Product('Mysz', 150.00);

        $cart->addProduct($laptop, 1);
        $cart->addProduct($mouse, 2);

        $products = $cart->getProducts();
        $this->assertCount(2, $products);
    }

    public function testGetTotalWithoutDiscountCalculatesCorrectly()
    {
        $cart = new Basket();
        $laptop = new Product('Laptop', 3000.00);
        $mouse = new Product('Mysz', 150.00);

        $cart->addProduct($laptop, 1);
        $cart->addProduct($mouse, 2);

        // 3000 * 1 + 150 * 2 = 3300
        $this->assertSame(3300.00, $cart->getTotalWithoutDiscount());
    }

    public function testGetTotalWithDiscountReturnsCorrectAmountWithPercentageCoupon()
    {
        $cart = new Basket();
        $product = new Product('Laptop', 1000.00);
        $cart->addProduct($product, 1);

        $coupon = new PercentageCoupon(10);
        $cart->applyCoupon($coupon);

        // 1000 - 10% = 900
        $this->assertSame(900.00, $cart->getTotalWithDiscount());
    }

    public function testGetTotalWithDiscountReturnsCorrectAmountWithFixedCoupon()
    {
        $cart = new Basket();
        $product = new Product('Laptop', 1000.00);
        $cart->addProduct($product, 1);

        $coupon = new FixedAmountCoupon(200);
        $cart->applyCoupon($coupon);

        // 1000 - 200 = 800
        $this->assertSame(800.00, $cart->getTotalWithDiscount());
    }

    public function testGetTotalWithDiscountReturnsSameAsWithoutDiscountWhenNoCoupon()
    {
        $cart = new Basket();
        $product = new Product('Laptop', 1000.00);
        $cart->addProduct($product, 1);

        $this->assertSame(1000.00, $cart->getTotalWithDiscount());
        $this->assertSame($cart->getTotalWithoutDiscount(), $cart->getTotalWithDiscount());
    }

    public function testApplyCouponReplacesExistingCoupon()
    {
        $cart = new Basket();
        $product = new Product('Laptop', 1000.00);
        $cart->addProduct($product, 1);

        // Pierwszy kupon 10%
        $coupon1 = new PercentageCoupon(10);
        $cart->applyCoupon($coupon1);
        $this->assertSame(900.00, $cart->getTotalWithDiscount());

        // Drugi kupon 200 zł - powinien zastąpić pierwszy
        $coupon2 = new FixedAmountCoupon(200);
        $cart->applyCoupon($coupon2);
        $this->assertSame(800.00, $cart->getTotalWithDiscount());
    }

    public function testGetProductsReturnsEmptyArrayForEmptyCart()
    {
        $cart = new Basket();

        $this->assertSame([], $cart->getProducts());
    }

    public function testGetTotalWithoutDiscountReturnsZeroForEmptyCart()
    {
        $cart = new Basket();

        $this->assertSame(0.0, $cart->getTotalWithoutDiscount());
    }

    public function testComplexScenarioWithMultipleProductsAndCoupon()
    {
        $cart = new Basket();
        $laptop = new Product('Laptop', 3000.00);
        $mouse = new Product('Mysz', 150.00);
        $keyboard = new Product('Klawiatura', 200.00);

        $cart->addProduct($laptop, 1);
        $cart->addProduct($mouse, 2);
        $cart->addProduct($keyboard, 1);

        // 3000 + (150 * 2) + 200 = 3500
        $this->assertSame(3500.00, $cart->getTotalWithoutDiscount());

        // Rabat 10%
        $coupon = new PercentageCoupon(10);
        $cart->applyCoupon($coupon);

        // 3500 - 10% = 3150
        $this->assertSame(3150.00, $cart->getTotalWithDiscount());

        // Zmiana na rabat 200 zł
        $fixedCoupon = new FixedAmountCoupon(200);
        $cart->applyCoupon($fixedCoupon);

        // 3500 - 200 = 3300
        $this->assertSame(3300.00, $cart->getTotalWithDiscount());
    }

    public function testGetProductsReturnsCorrectStructure()
    {
        $cart = new Basket();
        $product = new Product('Test', 100.00);
        $cart->addProduct($product, 2);

        $products = $cart->getProducts();

        $this->assertIsArray($products);
        $this->assertArrayHasKey('product', $products[0]);
        $this->assertArrayHasKey('quantity', $products[0]);
        $this->assertInstanceOf(Product::class, $products[0]['product']);
        $this->assertIsInt($products[0]['quantity']);
    }
}
