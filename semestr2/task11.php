<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Task11\Product;
use App\Task11\ProductCollection;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

$collection = new ProductCollection();
$collection->addProduct(new Product(1, 'Laptop Pro', 'Potężna maszyna do pracy', 4500.00));
$collection->addProduct(new Product(2, 'Mysz RGB', 'Szybka i kolorowa', 150.00));
$collection->addProduct(new Product(3, 'Monitor 4K', 'Krystaliczny obraz', 1200.99));

$baseUrl = 'http://localhost:8000/semestr2/task11.php';
$id = $_GET['id'] ?? null;

if ($id === null) {
    // lista produktów
    echo $twig->render('task11/products.html.twig', [
        'baseUrl' => $baseUrl,
        'products' => $collection->getProducts(),
    ]);
} else {
    // szczegóły produktu
    $product = $collection->getProductById((int)$id);

    if ($product) {
        echo $twig->render('task11/product.html.twig', [
            'baseUrl' => $baseUrl,
            'product' => $product,
        ]);
    } else {
        echo $twig->render('task11/error.html.twig', [
            'baseUrl' => $baseUrl,
            'message' => "Produkt o ID $id nie istnieje w naszym systemie."
        ]);
    }
}