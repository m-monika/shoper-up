<?php

$stock = $params[0]; // tej linijki nie ruszamy :)

while ($stock > 1) {
    $stock--; 
    echo "Produkt sprzedany, pozostało w magazynie $stock szt." . "\n";
}

echo "Produkt wyprzedany";