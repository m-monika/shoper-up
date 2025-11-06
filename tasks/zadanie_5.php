<?php

$givenMoneyByClient = 10000;
$costOfProducts = 8515;

$rest = $givenMoneyByClient - $costOfProducts;
$restZloty = intdiv($rest, 100);
$restPennies = $rest % 100;// TODO

echo "Kasjerka powinna oddać klientowi: {$restZloty}zł {$restPennies} groszy.";