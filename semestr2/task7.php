<?php

require 'vendor/autoload.php';

use App\Task7\Discounts\FixedAmountDiscount;
use App\Task7\Discounts\NoDiscount;
use App\Task7\Discounts\PercentageDiscount;
use App\Task7\ShoppingCart;


//koszyk 20%
$percentageDiscount = new PercentageDiscount(20);
$cart1 = new ShoppingCart($percentageDiscount);
$cart1->addItem('Laptop', 3000.00);
$cart1->addItem('Mysz', 150.00);

echo "Koszyk z rabatem 20%".PHP_EOL;
echo "Produkty: ".PHP_EOL;
$items = $cart1->getItems();
foreach ($items as $item)
    {
        echo $item['name'] . PHP_EOL;
    }


echo "Przed rabatem: " . $cart1->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart1->getTotalAfterDiscount() . " zł\n";



//koszyk 50zł
$fixedAmountDiscount = new FixedAmountDiscount(50);
$cart2 = new ShoppingCart($fixedAmountDiscount);
$cart2->addItem('Laptop', 3000.00);
$cart2->addItem('Mysz', 150.00);

echo "Koszyk z rabatem 50 zł ".PHP_EOL;
echo "Produkty: ".PHP_EOL;
$items = $cart2->getItems();
foreach ($items as $item)
    {
        echo $item['name'] . PHP_EOL;
    }


echo "Przed rabatem: " . $cart2->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart2->getTotalAfterDiscount() . " zł\n";


//koszyk 3

$noDiscount = new NoDiscount(50);
$cart2 = new ShoppingCart($noDiscount);
$cart2->addItem('Laptop', 3000.00);
$cart2->addItem('Mysz', 150.00);

echo "Koszyk bez rabatu ".PHP_EOL;
echo "Produkty: ".PHP_EOL;
$items = $cart2->getItems();
foreach ($items as $item)
    {
        echo $item['name'] . PHP_EOL;
    }


echo "Przed rabatem: " . $cart2->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart2->getTotalAfterDiscount() . " zł\n";