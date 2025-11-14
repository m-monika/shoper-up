<?php

/*

Napisz program, 
który dla zmiennej $number za pomocą pętli for wypisuje liczby od $number do 1.

Przykład:
Dla number = 5:
5 4 3 2 1

*/

$number = $params[0]; // tej linijki nie ruszamy :)

for ($i=0;$i < $number ; $i++){

    $pom = $number - $i;
    echo $pom." ";
}
//echo "5 4 3 2 1";

