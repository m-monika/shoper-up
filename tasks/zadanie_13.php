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


for ($i = 0; $i < $number; $i++) {
    $id = $start + $i;
    
    
    if ($id < 10) {
        $id_zera = "000" . $id;
    } elseif ($id < 100) {
        $id_zera = "00" . $id;
    } elseif ($id < 1000) {
        $id_zera = "0" . $id;
    } else {
        $id_zera = $id;
    }
    
    echo "ITEM-" . $id_zera . "\n";
}