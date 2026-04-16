<?php

declare(strict_types=1);

namespace App\Task8;

use App\Task8\Coupons\CouponInterface;

class Basket
{
    private array $items = [];
    private ?CouponInterface $coupon = null;

    public function addProduct(Product $product, int $quantity): void
    {
        $productId = spl_object_hash($product);

        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity'] += $quantity;
        } else {
            $this->items[$productId] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
    }

    public function applyCoupon(CouponInterface $coupon): void
    {   
        $this->coupon = $coupon;
    }

    public function getProducts(): array
    {
        return array_values($this->items);
    }

    public function getTotalWithoutDiscount(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    public function getTotalWithDiscount(): float
    {
        $total = $this->getTotalWithoutDiscount();

        if ($this->coupon === null) {
            return $total;
        }

        return $this->coupon->applyDiscount($total);
    }
}
