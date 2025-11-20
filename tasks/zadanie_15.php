<?php

/*

Pod zmienną $shops masz tablicę sklep - cena dla wybranego produktu:
[
  ["store" => "Sklep A", "price" => 1200],
  ["store" => "Sklep B", "price" => 1250],
  ["store" => "Sklep C", "price" => 1190]
]

Zadanie:
Znajdź sklep z najniższą ceną i wyświetl wynik:
Najlepsza oferta: Sklep C — 1190 zł

*/

$shops = $params[0]; // tej linijki nie ruszamy :)

$lowestPrice = null;
$bestStore = null;

foreach ($shops as $key => $value) {
  $currentName = $value["store"];
  $currentPrice = $value["price"];

  if ($lowestPrice == false or $bestStore == false) {
    $lowestPrice = $currentPrice;
    $bestStore = $currentName;
  }

  if ($currentPrice < $lowestPrice) {
    $lowestPrice = $currentPrice;
    $bestStore = $currentName;
  }

}

echo "Najlepsza oferta: " . $bestStore . " — " . $lowestPrice . " zł";

