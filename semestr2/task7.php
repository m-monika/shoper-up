<?php

declare(strict_types=1);
namespace App\Task7;

require 'vendor/autoload.php';

use App\Task7\Discounts\DiscountStrategyInterface;
use App\Task7\Discounts\FixedAmountDiscount;
use App\Task7\Discounts\NoDiscount;
use App\Task7\Discounts\PercentageDiscount;

$percentageDiscount = new PercentageDiscount(20);
$cart1 = new ShoppingCart($percentageDiscount);
$cart1->addItem('Laptop', 3000.00);
$cart1->addItem('Mysz', 150.00);

$noDiscount = new NoDiscount();
$cart2 = new ShoppingCart($noDiscount);
$cart2->addItem('Laptop', 3000.00);
$cart2->addItem('Mysz', 150.00);

$fixedAmountDiscount = new FixedAmountDiscount(100);
$cart3 = new ShoppingCart($fixedAmountDiscount);
$cart3->addItem('Laptop', 3000.00);
$cart3->addItem('Mysz', 150.00);

echo "Koszyk z rabatem 20%" . "<br>";
echo "Przed rabatem: " . $cart1->getTotalBeforeDiscount() . " zł\n" . "<br>";
echo "Po rabacie: " . $cart1->getTotalAfterDiscount() . " zł\n <br>";

echo "<br><br>";

echo "Koszyk bez rabatu <br>";
echo "Przed rabatem: " . $cart2->getTotalBeforeDiscount() . " zł\n" . "<br>";
echo "Po rabacie: " . $cart2->getTotalAfterDiscount() . " zł\n <br>";

echo "<br><br>";

echo "Koszyk z rabatem stałym 100 zł" . "<br>";
echo "Przed rabatem: " . $cart3->getTotalBeforeDiscount() . " zł\n" . "<br>";
echo "Po rabacie: " . $cart3->getTotalAfterDiscount() . " zł\n <br>";
