<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Task7\Discounts\FixedAmountDiscount;
use App\Task7\Discounts\NoDiscount;
use App\Task7\Discounts\PercentageDiscount;
use App\Task7\ShoppingCart;

$percentageCart = new ShoppingCart(new PercentageDiscount(20));
$percentageCart->addItem('Laptop', 3000.00);
$percentageCart->addItem('Mysz', 150.00);

$fixedAmountCart = new ShoppingCart(new FixedAmountDiscount(50));
$fixedAmountCart->addItem('Klawiatura', 200.00);
$fixedAmountCart->addItem('Mysz', 100.00);

$noDiscountCart = new ShoppingCart(new NoDiscount());
$noDiscountCart->addItem('Monitor', 800.00);
$noDiscountCart->addItem('Kabel HDMI', 40.00);

$carts = [
    'Koszyk z rabatem 20%' => $percentageCart,
    'Koszyk z rabatem 50 zl' => $fixedAmountCart,
    'Koszyk bez rabatu' => $noDiscountCart,
];

echo '<pre>';

foreach ($carts as $title => $cart) {
    echo $title . ":\n";
    print_r($cart->getItems());
    echo 'Przed rabatem: ' . $cart->getTotalBeforeDiscount() . " zl\n";
    echo 'Po rabacie: ' . $cart->getTotalAfterDiscount() . " zl\n\n";
}

echo '</pre>';
