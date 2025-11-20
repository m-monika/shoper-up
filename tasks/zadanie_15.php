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

foreach ($shops as $store => $price) {
  $shopsCount = count($shops);
    for ($i = 0; $i < $shopsCount; $i++) {
      for ($j = $i + 1; $j < $shopsCount; $j++ ) {
        if ($shops[$i]['price'] > $shops[$j]['price']) {
          //nie chcemy zgubić i
          $temporary = $shops[$i];
          //skoro i jest mniejsze niz j, to j ma byc wyzej na liscie sortowania
          $shops[$i] = $shops[$j];
          //a w miejsce i idzie trzymana wartosc w j, bo j była większa
          $shops[$j] = $temporary;
          
        }
      }
    }
}

echo "Najlepsza oferta: " . $shops[0]['store'] . " — " . $shops[0]['price'] . " zł";