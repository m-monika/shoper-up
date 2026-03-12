<?php

$product1 = new Product("Laptop", 1500.00);
$product2 = new Product("Smartphone", 500.00);
$product3 = new Product("Headphones", 200.00);

$basket = new Basket();
$basket->addProduct($product1);
$basket->addProduct($product2);
$basket->addProduct($product3);
echo "Total: " . $basket->getSum() . " PLN";