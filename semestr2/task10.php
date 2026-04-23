<?php
declare(strict_types=1);
namespace App\Task10;

require 'vendor/autoload.php';

use App\Task10\Product;
use App\Task10\Basket;

$produktTestowy = new Product("Test", 60.44);
$innyProdukt = new Product("Inny", 90.22);
$trzeciProdukt = new Product("Kolejny", 110.77);

$basket1 = new Basket();
$basket1->addProduct($produktTestowy);
$basket1->addProduct($innyProdukt);
$basket1->addProduct($trzeciProdukt);

$loader = new \Twig\Loader\FilesystemLoader('templates/task10');

$twig = new \Twig\Environment($loader);

echo $twig->render('basket.html.twig', ['basket' => $basket1]);