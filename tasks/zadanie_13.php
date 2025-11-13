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

$itemNumberLength = strlen ($start);
$index = $start;

for ($i = 1 ;$i <= $number; $i++){
    if ($itemNumberLength < 4){
        for ($j = $itemNumberLength; $j < 4; $j++){
            $index = "0".$index ;
        }
            
    } else{
        $index = $start;
    }  
    
    echo "ITEM-".$index."\n";
    $start = $start + 1;
    $itemNumberLength = strlen ($start);
    $index = $start;
    
}

//echo "ITEM-0996
//ITEM-0997
//ITEM-0998
//ITEM-0999
//ITEM-1000";

