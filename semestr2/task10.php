<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Task10\Product;
use App\Task10\Basket;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

try {
    $basket = new Basket();
    
    $basket->addProduct(new Product('Laptop', 3500.00));
    $basket->addProduct(new Product('Myszka', 120.50));
    $basket->addProduct(new Product('Klawiatura', 250.99));

    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    echo $twig->render('task10/basket.html.twig', [
        'products' => $basket->getProducts(),
        'total' => $basket->getTotalPrice()
    ]);

} catch (\Exception $e) {
    echo "Błąd: " . $e->getMessage();
}