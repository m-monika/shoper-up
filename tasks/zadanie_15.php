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
  $minPrice = null;
  $shopName = null;
  foreach ($shops as $storeInfo) {
      if ($minPrice === null || $minPrice > $storeInfo['price']){
           $minPrice = $storeInfo['price'];
           $shopName = $storeInfo['store'];
          }
        }
      };

      // testtest

echo "Najlepsza oferta: " . $shopName . " — " . $minPrice . " zł";