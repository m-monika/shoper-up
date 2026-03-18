<?php

declare(strict_types=1);

namespace Tests\Task3;

use App\Task3\Money;
use App\Task3\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductDelegatesPriceFormattingToMoneyObject(): void
    {
        $price = new Money(9999);
        $product = new Product('Keyboard', $price);
        $this->assertSame('Keyboard', $product->getName());
        $this->assertSame('99,99 PLN', $product->getFormattedPrice());
    }
}
