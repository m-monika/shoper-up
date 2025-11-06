<?php

$shirtCount = 2;
$shirt = 17;
$shirtVat = 3;

$hatCount = 1;
$hat = 40;
$hatVat = 23;

$glovesCount = 5;
$gloves = 13;
$glovesVat = 7;

$netShirt = (100 * $shirt)/(100 + $shirtVat);
$netHat = (100 * $hat)/(100 + $hatVat);
$netGloves = (100 * $gloves)/(100 + $glovesVat);

$gross = ($shirtCount * $shirt) + ($hatCount * $hat) + ($glovesCount * $gloves);   // TODO
$net = ($shirtCount * $netShirt) + ($hatCount * $netHat) + ($glovesCount * $netGloves);     // TODO

$gross = round($gross);
$net = round($net);

echo "Suma brutto: $gross\nSuma netto: $net";