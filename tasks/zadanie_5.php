<?php

$givenMoneyByClient = 10000;
$costOfProducts = 8515;

$rest = (int)(($givenMoneyByClient - $costOfProducts) / 100);
$restPennies = ($givenMoneyByClient - $costOfProducts) % 100;

echo "Kasjerka powinna oddać klientowi: {$rest}zł {$restPennies} groszy.";
