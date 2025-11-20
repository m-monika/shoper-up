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

$bestPrice = null;
$bestShop = null;


foreach ($shops as $shop){
    if ($bestShop === null || $shop['price'] < $bestPrice){
      $bestShop = $shop['store'];
      $bestPrice = $shop['price'];
        }
}
echo 'Najlepsza oferta: ' . $bestShop . " — " . $bestPrice . " zł";