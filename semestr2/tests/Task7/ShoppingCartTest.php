<?php

declare(strict_types=1);

namespace Tests\Task7;

use App\Task7\ShoppingCart;
use App\Task7\Discounts\PercentageDiscount;
use App\Task7\Discounts\FixedAmountDiscount;
use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    public function testAddItemAddsProductToCart()
    {
        $discount = new PercentageDiscount(10);
        $cart = new ShoppingCart($discount);

        $cart->addItem('Laptop', 1000.0);

        $items = $cart->getItems();
        $this->assertCount(1, $items);
        $this->assertSame('Laptop', $items[0]['name']);
        $this->assertSame(1000.0, $items[0]['price']);
    }

    public function testGetTotalBeforeDiscountCalculatesCorrectly()
    {
        $discount = new PercentageDiscount(10);
        $cart = new ShoppingCart($discount);

        $cart->addItem('Laptop', 1000.0);
        $cart->addItem('Mysz', 50.0);

        $this->assertSame(1050.0, $cart->getTotalBeforeDiscount());
    }

    public function testGetTotalAfterDiscountWithPercentageDiscount()
    {
        $discount = new PercentageDiscount(20);
        $cart = new ShoppingCart($discount);

        $cart->addItem('Laptop', 1000.0);

        $this->assertSame(800.0, $cart->getTotalAfterDiscount());
    }

    public function testGetTotalAfterDiscountWithFixedDiscount()
    {
        $discount = new FixedAmountDiscount(50);
        $cart = new ShoppingCart($discount);

        $cart->addItem('Klawiatura', 200.0);
        $cart->addItem('Mysz', 100.0);

        $this->assertSame(250.0, $cart->getTotalAfterDiscount());
    }

    public function testGetItemsReturnsArrayOfProducts()
    {
        $discount = new PercentageDiscount(10);
        $cart = new ShoppingCart($discount);

        $cart->addItem('Produkt 1', 100.0);
        $cart->addItem('Produkt 2', 200.0);

        $items = $cart->getItems();
        $this->assertIsArray($items);
        $this->assertCount(2, $items);
    }

    public function testEmptyCartReturnsZeroTotal()
    {
        $discount = new PercentageDiscount(10);
        $cart = new ShoppingCart($discount);

        $this->assertSame(0.0, $cart->getTotalBeforeDiscount());
        $this->assertSame(0.0, $cart->getTotalAfterDiscount());
    }
}
