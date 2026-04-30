<?php

declare(strict_types=1);

namespace App\Task8;

use App\Task8\Coupons\CouponInterface;

class Basket
{
    private array $basket = [];
    private ?CouponInterface $coupon = null;

    public function addProduct(Product $product, int $quantity): void
    {
        foreach ($this->basket as $key => $item) {
            if ($item['product']->getName() === $product->getName()) {
                $this->basket[$key]['quantity'] += $quantity;
                return;
            }
        }

        $this->basket[] = [
            'product' => $product,
            'quantity' => $quantity,
        ];
    }

    public function applyCoupon(CouponInterface $coupon): void
    {
        $this->coupon = $coupon;
    }

    public function getProducts(): array
    {
        return $this->basket;
    }

    public function getTotalWithoutDiscount(): float
    {
        $total = 0.0;
        foreach ($this->basket as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    public function getTotalWithDiscount(): float
    {
        $total = $this->getTotalWithoutDiscount();

        if($this->coupon !== null) {
            if($this->coupon->discountGetter() > 0) {
                $total = $this->coupon->applyDiscount($total);
                return $total;
            } else {
                return $total;
            }
        } else {
            return $total;
        }
    }
}
