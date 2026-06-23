<?php

declare(strict_types=1);

namespace App\Task8;

use App\Task8\Coupons\CouponInterface;

class Basket
{
    private array $products = [];
    private CouponInterface $coupon;

    public function addProduct(Product $product, int $quantity): void
    {
        foreach ($this->products as $index => $item) {
            if ($item['product'] === $product) {
                $this->products[$index]['quantity'] += $quantity;
                return;
            }
        }

        $this->products[] = [
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
        return $this->products;
    }

    public function getTotalWithoutDiscount(): float
    {
        $total = 0.0;

        foreach ($this->products as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }

    public function getTotalWithDiscount(): float
{
        $total = $this->getTotalWithoutDiscount();

        if (isset($this->coupon)) {
            $total = $this->coupon->applyDiscount($total);
        }

        return max(0.0, $total);
    }
}
