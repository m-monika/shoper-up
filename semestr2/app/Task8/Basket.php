<?php

declare(strict_types=1);

namespace App\Task8;

use App\Task8\Coupons\CouponInterface;

class Basket
{
    private array $products = [];
    private? CouponInterface $activeCoupon = null;

    public function addProduct(Product $product, int $quantity): void
    {
        if (!isset($this->products[$product->getName()])) {
            $this->products[$product->getName()] = array("product" => $product, "quantity" => $quantity);
        } else {
            $this->products[$product->getName()]['quantity'] += $quantity;
        }
        
    }

    public function applyCoupon(CouponInterface $coupon): void
    {
        $this->activeCoupon = $coupon;
    }

    public function getProducts(): array
    {
        return array_values($this->products);
    }

    public function getTotalWithoutDiscount(): float
    {
        $total = 0.0;

        foreach ($this->products as $name => $product) {
            $total = $total + $product['product']->getPrice() * $product['quantity'];
        }

        return $total;
    }

    public function getTotalWithDiscount(): float
    {
        $total = $this->getTotalWithoutDiscount();
        if (!isset($this->activeCoupon)) {
            return $total;
        } else {
            return $this->activeCoupon->applyDiscount($total);
        }
        
    }
}
