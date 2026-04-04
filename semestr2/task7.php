<?php

require 'vendor/autoload.php';

use App\Task7\ShoppingCart;
use App\Task7\Discounts\PercentageDiscount;
use App\Task7\Discounts\FixedAmountDiscount;
use App\Task7\Discounts\NoDiscount;

function displayCart(string $title, ShoppingCart $cart) {
    echo "--- $title ---\n";
    echo "Produkty: " . implode(', ', array_column($cart->getItems(), 'name')) . "\n";
    echo "Przed rabatem: " . $cart->getTotalBeforeDiscount() . " zł\n";
    echo "Po rabacie: " . $cart->getTotalAfterDiscount() . " zł\n\n";
}

//koszyk nr 1 z rabatem 20%
$cart1 = new ShoppingCart(new PercentageDiscount(20));
$cart1->addItem('Laptop', 3000.00);
$cart1->addItem('Mysz', 150.00);
displayCart("Koszyk z rabatem 20%", $cart1);

//koszyk nr 2 z rabatem 50 zl
$cart2 = new ShoppingCart(new FixedAmountDiscount(50));
$cart2->addItem('Słuchawki', 200.00);
$cart2->addItem('Podkładka', 40.00);
displayCart("Koszyk z rabatem stałym 50 zł", $cart2);

//koszyk nr 3 bez rabatu
$cart3 = new ShoppingCart(new NoDiscount());
$cart3->addItem('Klawiatura', 300.00);
displayCart("Koszyk bez rabatu", $cart3);