<?php

/*

Napisz program, który wyświetli na ekranie:

    *
   ***
  *****
 *******
*********

*/
$star = "*";
$space = " ";

echo str_repeat ($space, 4) . $star. "\n";
echo str_repeat ($space, 3) . str_repeat ($star, 3), "\n";
echo str_repeat ($space, 2) . str_repeat ($star, 5), "\n";
echo str_repeat ($space, 1) . str_repeat ($star, 7). "\n";
echo str_repeat ($star, 9). "\n";