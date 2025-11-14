<?php

$number = $params[0]; // tej linijki nie ruszamy :)
$start = $params[1]; // tej linijki nie ruszamy :)

for ($i = $start; $i < $start + $number; $i++) {
    echo "ITEM-";

    if ($i < 10) {
        echo "000";
    }elseif ($i <100) {
        echo "00";
    }elseif ($i < 1000) {
        echo "0";
   }

echo $i . "\n";

}