<?php

declare(strict_types=1);

require './vendor/autoload.php';

use App\Task10\Product;
use App\Task10\Basket;


$product1 = new Product ('Laptop', 2000);
$product2 = new Product ('Monitor', 1399);
$product3 = new Product ('Mysz', 250);
$product4 = new Product ('Klawiatura', 900);

$basket = new Basket();

$basket->addProduct($product1);
$basket->addProduct($product2);
$basket->addProduct($product3);
$basket->addProduct($product4);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates/task10');
$twig = new \Twig\Environment($loader); 

echo $twig->render('basket.html.twig', ['basket' => $basket->getProducts()]);