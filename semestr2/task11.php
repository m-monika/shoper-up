<?php

declare(strict_types=1);
namespace App\Task11;

require 'vendor/autoload.php';

use App\Task11\Product;
use App\Task11\ProductCollection;

$baseUrl = 'http://localhost:8000/semestr2/task11.php';

$myCollection = new ProductCollection;

$firstProduct = new Product(1, "Piłka", "Piłka do gry w piłkę", 100.15);
$secondProduct = new Product(2, "Ekspres", "Automatyczny ekspres do robienia kawy", 2564.12);
$thirdProduct = new Product(3, "Buty", "Buty do chodzenia", 333.45);

$myCollection->addProduct($firstProduct);
$myCollection->addProduct($secondProduct);
$myCollection->addProduct($thirdProduct);


$id = $_GET['id'] ?? null;

$loader = new \Twig\Loader\FilesystemLoader('templates/task11');
$twig = new \Twig\Environment($loader);

if  (!$id) {
    echo $twig->render('products.html.twig', ['collection' => $myCollection, 'baseUrl' => $baseUrl]);
} else {
    $products = $myCollection->getProducts();
    $selectedProduct = null;
    foreach ($products as $product) {
        if ($product->getId() == $id) {
            $selectedProduct = $product;
            break;
        }
    };

    if ($selectedProduct) {
        echo $twig->render('product.html.twig', [
            'baseUrl' => $baseUrl,
            'product' => $selectedProduct,
                ]);
    } else {
        echo $twig->render('error.html.twig', ['baseUrl' => $baseUrl]);
    }
};