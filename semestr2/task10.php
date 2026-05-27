<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use App\Task10\Product;
use App\Task10\Basket;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$basket= new Basket();

$basket->addProduct(new Product('Laptop', 349999));
$basket->addProduct(new Product('Myszka', 12999));
$basket->addProduct(new Product('Klawiatura', 24999));

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

echo $twig->render('task10/basket.html.twig', [
    'products' => $basket->getProducts(),
    'sum' => $basket->getTotalPrice(),
]);