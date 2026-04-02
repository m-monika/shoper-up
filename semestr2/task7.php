<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Task7\ShoppingCart;
use App\Task7\Discounts\PercentageDiscount;
use App\Task7\Discounts\FixedAmountDiscount;
use App\Task7\Discounts\NoDiscount;

$percentageDiscount = new PercentageDiscount(20);
$cart1 = new ShoppingCart($percentageDiscount);
$cart1->addItem('Laptop', 3000.00);
$cart1->addItem('Mysz', 150.00);

echo "Koszyk z rabatem 20%:\n";
echo "Przed rabatem: " . $cart1->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart1->getTotalAfterDiscount() . " zł\n\n";

$fixedDiscount = new FixedAmountDiscount(50);
$cart2 = new ShoppingCart($fixedDiscount);
$cart2->addItem('Monitor', 800.00);
$cart2->addItem('Klawiatura', 200.00);

echo "Koszyk z rabatem 50 zł:\n";
echo "Przed rabatem: " . $cart2->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart2->getTotalAfterDiscount() . " zł\n\n";


$noDiscount = new NoDiscount();
$cart3 = new ShoppingCart($noDiscount);
$cart3->addItem('Pendrive', 60.00);
$cart3->addItem('Słuchawki', 120.00);

echo "Koszyk bez rabatu:\n";
echo "Przed rabatem: " . $cart3->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart3->getTotalAfterDiscount() . " zł\n";