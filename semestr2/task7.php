<?php

require './vendor/autoload.php';

use App\Task7\Discounts\FixedAmountDiscount;
use App\Task7\Discounts\NoDiscount;
use App\Task7\Discounts\PercentageDiscount;
use App\Task7\ShoppingCart;

$percentage = new PercentageDiscount(20);
$noDiscount = new NoDiscount(0);
$fixedDiscount = new FixedAmountDiscount(5);

$cart1 = new ShoppingCart($percentage);
$cart2 = new ShoppingCart($noDiscount);
$cart3 = new ShoppingCart($fixedDiscount);

$cart1->addItem('Klawiatura', 300.00);
$cart1->addItem('Mysz', 100.00);

$cart2->addItem('Monitor', 3000.00);
$cart2->addItem('Słuchawki', 375.00);

$cart3->addItem('Laptop', 5000.00);
$cart3->addItem('Torba na laptop', 71.00);

echo "Przed rabatem: " . $cart1->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart1->getTotalAfterDiscount() . " zł\n";

echo "Przed rabatem: " . $cart2->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart2->getTotalAfterDiscount() . " zł\n";

echo "Przed rabatem: " . $cart3->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart3->getTotalAfterDiscount() . " zł\n";