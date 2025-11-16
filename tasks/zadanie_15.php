<?php

/*

Pod zmienną $shops masz tablicę sklep - cena dla wybranego produktu:
[
  ["store" => "Sklep A", 
  "price" => 1200],

  ["store" => "Sklep B",
   "price" => 1250],

  ["store" => "Sklep C", 
  "price" => 1190]
]

Zadanie:
Znajdź sklep z najniższą ceną i wyświetl wynik:
Najlepsza oferta: Sklep C — 1190 zł

*/

$shops = $params[0]; // tej linijki nie ruszamy :)

$lowestprice = 10000000;

foreach ($shops as $key => $value){
	
  if (is_array($value)){
    
    $store = "" ;
    $price = 0 ;

    foreach ($value as $key2 => $value2){

      if ($key2 == "price"){
        $price = $value2;
        }elseif($key2 == "store"){
      	$store = $value2;
        }
      } if ($lowestprice > $price){
  	$lowestprice = $price;
  	$shopname = $store;
      }
    } 
  }echo "Najlepsza oferta: " . $shopname . " - " . $lowestprice . " zł" ;