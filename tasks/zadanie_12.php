<?php

$number = $params[0]; // tej linijki nie ruszamy :)

if ($number > 1)
for ($number; $number >= 1; $number--) {
 echo  $number . " ";
}else{
    for ($number; $number <= 1; $number++)
 echo  $number . " ";
    }