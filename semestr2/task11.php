<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use App\Task11\Product;
use App\Task11\ProductCollection;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$products = new ProductCollection();

$products->addProduct(new Product(1, 'Laptop', 'Wydajny laptop do pracy', 4999.99));
$products->addProduct(new Product(2, 'Klawiatura', 'Mechaniczna klawiatura RGB', 399.99));
$products->addProduct(new Product(3, 'Myszka', 'Bezprzewodowa mysz gamingowa', 249.99));

$loader = new FilesystemLoader(__DIR__ . '/templates/task11');
$twig = new Environment($loader);

$baseUrl = 'http://localhost:8000/semestr2/task11.php';

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $product = $products->getProductById((int)$id);
    if ($product === null) {
        echo $twig->render('error.html.twig', [
            'baseUrl' => $baseUrl,
            'message' => 'Produkt o podanym ID nie istnieje.',
        ]);
        exit;
    }
    echo $twig->render('product.html.twig', [
        'baseUrl' => $baseUrl,
        'product' => $product,
    ]);
    exit;
}
echo $twig->render('products.html.twig', [
    'baseUrl' => $baseUrl,
    'products' => $products->getProducts(),
]);