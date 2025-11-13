<?php

/*

Napisz program, 
który dla zmiennej $number za pomocą pętli for wypisuje liczby od $number do 1.

Przykład:
Dla number = 5:
5 4 3 2 1

*/

$number = $params[0]; // tej linijki nie ruszamy :)

// echo "5 4 3 2 1";

for ($i = $number; $i >=1; $i--) {
    echo $i . " ";
}
