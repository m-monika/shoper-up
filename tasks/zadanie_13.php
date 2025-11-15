<?php

/*

W systemach e-commerce każda pozycja zamówienia (produkt) musi mieć własny, rosnący identyfikator pozycji, np.:
ITEM-0001
ITEM-0002
ITEM-0003
itd.

Twoje zadanie:
Pod zmienną $number znajduje się liczba przedmiotów w zamówieniu.
Używając pętli for, wygeneruj kolejne numery pozycji zamówienia w formacie:
ITEM-XXXX
gdzie XXXX to numer pozycji uzupełniony zerami do 4 cyfr.
Wyświetl wszystkie identyfikatory, każdy w nowej linii.

Pod zmienną $start znajduje się początkowy identyfikator pozycji np. 456.

Przykład:
dla number = 5
start = 996

ITEM-0996
ITEM-0997
ITEM-0998
ITEM-0999
ITEM-1000

*/

$number = $params[0]; // tej linijki nie ruszamy :)
$start = $params[1]; // tej linijki nie ruszamy :)

$prefix = 'ITEM-';

for($i = 1; $i <= $number; $i++) {
    if (strlen($start) == 4) {
        echo $prefix . $start . PHP_EOL;
    } elseif (strlen($start) == 3) {
        echo $prefix . '0' . $start . PHP_EOL;
    } elseif (strlen($start) == 2) {
        echo $prefix . '00' . $start . PHP_EOL;
    } elseif (strlen($start) == 1) {
        echo $prefix . '000' . $start . PHP_EOL;
    }
    $start++;
}