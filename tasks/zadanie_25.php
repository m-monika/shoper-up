<?php

/*
Napisz program, który wyświetla listę produktów z możliwością posortowania po cenie (używając jednej z funkcji sortujących w php):
- rosnąco
- malejąco

Zmienne:
$products - tablica z danymi produktów (ceny w groszach)
$order - kierunek sortowania (rosnąco/malejąco)


Przykład:

$products = [
    [
        'name' => 'Kabel HDMI',
        'price' => 3000,
    ],
    [
        'name' => 'Klawiatura USB',
        'price' => 25000,
    ],
    [
        'name' => 'Mysz bezprzewodowa',
        'price' => 20000,
    ],
    [
        'name' => 'Monitor 27',
        'price' => 500000,
    ],
    [
        'name' => 'Laptop',
        'price' => 300000,
    ],
];

$order = 'desc';

Wynik:

Monitor 27: 5000,00 zł
Laptop: 3000,00 zł
Klawiatura USB: 250,00 zł
Mysz bezprzewodowa: 200,00 zł
Kabel HDMI: 30,00 zł
*/

$products = $params[0]; // tej linijki nie ruszamy :)
$order = $params[1]; // tej linijki nie ruszamy :)

if($order ==='asc'){
    usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
}elseif($order ==='desc'){
    usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
}
foreach($products as $product){
    echo $product['name'] . ": " . number_format($product['price'] / 100,2,',','') . " zł\n" ;
}