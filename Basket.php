<?php

class Basket {
    private array $products = [];

    public function addProduct(Product $product): void {
        $this->products[] = $product;
    }

    public function getSum(): float {
        $sum = 0.0;
        foreach ($this->products as $product) {
            $sum += $product->getPrice();
        }
        return $sum;
    }
}