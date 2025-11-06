<?php

$productsCost = $params[0]; // tej linijki nie ruszamy :)
$type = $params[1]; // tej linijki nie ruszamy :)

$discountAmount = 0;

if ($productsCost > 100 && $type === "gold") {
    $discountAmount = $productsCost * 0.2;
} elseif ($productsCost > 100 && $type === "silver") {
    $discountAmount = $productsCost * 0.1;
}else {
    $discountAmount = 0;
}

echo "Rabat wynosi: {$discountAmount}zł";
