<?php

declare(strict_types=1);

require './vendor/autoload.php';

function dump($data)

{
echo '<br/>
    <div style=
        "
        display: inline-block;
        background: lightgray;
        padding: 0 10px;
        border: 1px solid black;
    ">
<pre>';
print_r($data);
echo '</pre>
    </div>
    <br/>';
};

use App\Task11\Product;
use App\Task11\ProductCollection;

$product1 = new Product (1, 'Laptop', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sem ipsum, feugiat eget nibh eu, placerat pharetra nibh. Quisque ut metus nunc. Pellentesque ultrices molestie urna, quis venenatis velit. Fusce sed nunc risus. Suspendisse id lacinia ipsum, eu sollicitudin tortor.', 2000);

$product2 = new Product (2, 'Monitor','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sem ipsum, feugiat eget nibh eu, placerat pharetra nibh. Quisque ut metus nunc. Pellentesque ultrices molestie urna, quis venenatis velit. Fusce sed nunc risus. Suspendisse id lacinia ipsum, eu sollicitudin tortor.', 1399);

$product3 = new Product (3, 'Mysz','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sem ipsum, feugiat eget nibh eu, placerat pharetra nibh. Quisque ut metus nunc. Pellentesque ultrices molestie urna, quis venenatis velit. Fusce sed nunc risus. Suspendisse id lacinia ipsum, eu sollicitudin tortor.', 250);

$product4 = new Product (4, 'Klawiatura','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sem ipsum, feugiat eget nibh eu, placerat pharetra nibh. Quisque ut metus nunc. Pellentesque ultrices molestie urna, quis venenatis velit. Fusce sed nunc risus. Suspendisse id lacinia ipsum, eu sollicitudin tortor.', 900);

$collection = new ProductCollection();

$collection->addProduct($product1);
$collection->addProduct($product2);
$collection->addProduct($product3);
$collection->addProduct($product4);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates/task11');
$twig = new \Twig\Environment($loader);

$baseUrl = 'http://localhost:8000/semestr2/task11.php';
$template = '';

$page= $_GET['page'] ?? 'product_list';
$id = $_GET['id'] ?? null;

if($page === 'product_list') {
    $template = 'products.html.twig';
} elseif($page === 'product') {
    $product = $collection->getProductById((int)$id);

    if($product === null){
        $template = 'error.html.twig';
    } else {
        $template = 'product.html.twig';
    }
} else {
    $template = 'error.html.twig';
}

echo $twig->render($template, [
    'collection' => $collection->getProducts(),
    'baseUrl' => $baseUrl,
    'page' => $page,
    'id' => $id
]);