<?php
$number = $params[0]; // tej linijki nie ruszamy :)

// upewniamy się, że $number jest integer
$number = (int) $number;

if ($number > 0) {
    for ($i = $number; $i >= 1; $i--) {
        echo $i;
        if ($i > 1) {
            echo " ";
        }
    }
}
// ą
