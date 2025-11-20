<?php

$freeDeliveryThreshold = $params[0]; // tej linijki nie ruszamy :)
$price = $params[1]; // tej linijki nie ruszamy :)
$total = 0;


do {
    $total = $total + $price;
    echo "Produkt dodany do koszyka. Aktualna suma koszyka: $total" . "\n";
} 
while ($total < $freeDeliveryThreshold);
    echo "Osiągnięto darmową wysyłkę. Łączna wartość zamówienia: $total zł";