<?php

class Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class Basket
{
    private array $products = [];
    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getSum(): float
    {
        $sum = 0.0;
        foreach ($this->products as $product) {
            $sum += $product->getPrice();
        }
        return $sum;
    }
}

$product1 = new Product("Laptop", 1500.00);
$product2 = new Product("Smartphone", 500.00);
$product3 = new Product("Headphones", 200.00);

$basket = new Basket();
$basket->addProduct($product1);
$basket->addProduct($product2);
$basket->addProduct($product3);
echo "Total: " . $basket->getSum() . " PLN";