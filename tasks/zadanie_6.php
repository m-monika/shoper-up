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

$gross = ($shirtCount * $shirt) + ($hatCount * $hat) + ($glovesCount * $gloves);
$net = $shirt / (1 + $shirtVat/100) * $shirtCount + $hat / (1 + $hatVat/100 * $hatCount) + $gloves / (1 + $glovesVat/100) * $glovesCount;

$gross = round($gross);
$net = round($net);



echo "Suma brutto: $gross\nSuma netto: $net";