<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Task7\Discounts\NoDiscount;
use App\Task7\Discounts\FixedAmountDiscount;
use App\Task7\Discounts\PercentageDiscount;
use App\Task7\ShoppingCart;

//koszyk 1
$percentageDiscount = new PercentageDiscount(50);
$percentageDiscountCart = new ShoppingCart($percentageDiscount);
$percentageDiscountCart->addItem('Monitor Lenovo', 800.00);
$percentageDiscountCart->addItem('Mysz Bloody', 200.00);
$percentageDiscountCart->addItem('GeForce 1060i', 1200.00);
$items = $percentageDiscountCart->getItems();

echo "Koszyk z rabatem 50%:" . '<br>' . '<br>';
foreach ($items as $key => $item) {
    echo "Produkt: " . $item['name'] . '<br>' . "Cena: " . $item['price'] . 'zł' . '<br>' . '<br>';
}
echo "Przed rabatem: " . $percentageDiscountCart->getTotalBeforeDiscount() . "zł" . '<br>';
echo "Po rabacie: " . $percentageDiscountCart->getTotalAfterDiscount() . "zł" . '<br>' . '<br>';
echo "-------------------------------------------------------------------------------------" . '<br>' . '<br>';

//koszyk 2
$fixedAmountDiscount = new FixedAmountDiscount(200);
$fixedAmountDiscountCart = new ShoppingCart($fixedAmountDiscount);
$fixedAmountDiscountCart->addItem('Monitor Lenovo', 800.00);
$fixedAmountDiscountCart->addItem('Mysz Bloody', 200.00);
$fixedAmountDiscountCart->addItem('GeForce 1060i', 1200.00);
$items = $fixedAmountDiscountCart->getItems();

echo "Koszyk ze stałą kwotą rabatu 200 zł:" . '<br>' . '<br>';
foreach ($items as $key => $item) {
    echo "Produkt: " . $item['name'] . '<br>' . "Cena: " . $item['price'] . 'zł' . '<br>' . '<br>';
}
echo "Przed rabatem: " . $fixedAmountDiscountCart->getTotalBeforeDiscount() . "zł" . '<br>';
echo "Po rabacie: " . $fixedAmountDiscountCart->getTotalAfterDiscount() . "zł" . '<br>' . '<br>';
echo "-------------------------------------------------------------------------------------". '<br>' . '<br>';

//koszyk 3
$noDiscount = new NoDiscount();
$noDiscountCart = new ShoppingCart($noDiscount);
$noDiscountCart->addItem('Monitor Lenovo', 800.00);
$noDiscountCart->addItem('Mysz Bloody', 200.00);
$noDiscountCart->addItem('GeForce 1060i', 1200.00);
$items = $noDiscountCart->getItems();

echo "Koszyk bez rabatu:" . '<br>' . '<br>';
foreach ($items as $key => $item) {
    echo "Produkt: " . $item['name'] . '<br>' . "Cena: " . $item['price'] . 'zł' . '<br>' . '<br>';
}
echo "Przed rabatem: " . $noDiscountCart->getTotalBeforeDiscount() . "zł" . '<br>';
echo "Po rabacie: " . $noDiscountCart->getTotalAfterDiscount() . "zł" . '<br>' . '<br>';
