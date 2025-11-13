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

$start2 = $start; //98
$itemNumberLength = strlen ($start2); //2
$index1 = $start2; //98

for ($i = 1 ;$i <= $number; $i++){ //1-5

    if ($itemNumberLength < 4){
        for ($j = $itemNumberLength; $j < 4; $j++){
            $index1 = "0".$index1 ;
        }
            
    } else{
        $index1 = $start2;
    }  
    
    echo "ITEM-".$index1."\n";
    $start2 = $start2 + 1;
    $itemNumberLength = strlen ($start2);
    $index1 = $start2;
    
}

//echo "ITEM-0996
//ITEM-0997
//ITEM-0998
//ITEM-0999
//ITEM-1000";

