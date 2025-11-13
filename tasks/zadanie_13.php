<?php

$number = $params[0]; // tej linijki nie ruszamy :)
$start = $params[1]; // tej linijki nie ruszamy :)

for ($i = 0; $i < $number; $i++) {
    $currentNumber = $start + $i;
    $formattedNumber = sprintf('%04d', $currentNumber);
    $id = "ITEM-" . $formattedNumber;
    echo $id . "\n";
}