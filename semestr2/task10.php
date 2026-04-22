<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Task10\Product;
use App\Task10\Basket;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates/task10');
$twig = new \Twig\Environment($loader);

$product_001 = new Product('Mouse Logi', 299.99);
$product_002 = new Product('Keyboard Acer', 499.99);
$product_003 = new Product('ThinkPad Lenovo', 1499.99);

$basket = new Basket();
$basket->addProduct($product_001);
$basket->addProduct($product_002);
$basket->addProduct($product_003);

echo $twig->render('basket.html.twig', ['basket' => $basket]);