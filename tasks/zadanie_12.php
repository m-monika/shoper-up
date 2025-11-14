<?php

$number = $params[0]; // tej linijki nie ruszamy :)

if ($number > 0) {
    for ($i = $number; $i >= 1; $i--) {
        echo $i;
        if ($i > 1) {
            echo " ";
        }
    }
}