<?php

/*

Pod zmienną products kryje się lista produktów w koszyku.
W ramach zadania pod zmienną $product - znajduje się nowy produkt jaki klient chce dodać do koszyka.
Dodaj ten produkt do listy produktów.
Klient w ramach koszyka również chce zwiększyć ilość produktu w koszuku.
Pod zmienną $id znajduje się ID produktu dla którego chce zwiększyć ilość produktów.
Pod zmienną $qty znajduje się o ile chce zwiększyć ilość produktów.
Wyświetl zawartość koszyka po operacjach.

Przykład

$products = [
    [
        "id" => 123,
        "name" => "Laptop",
        "price" => 3000,
        "qty" => 1
    ],
    [
        "id" => 567,
        "name" => "Monitor",
        "price" => 700,
        "qty" => 2
    ]
];
$product = [
    "id" => 678,
    "name" => "Klawiatura",
    "price" => 50,
    "qty" => 2
];
$id = 567;
$qty = 2;

Lp. 1 | Laptop | 1 szt. | 3000 zł
Lp. 2 | Monitor | 4 szt. | 2800 zł
Lp. 3 | Klawiatura | 2 szt. | 100 zł

*/

$products = $params[0]; // tej linijki nie ruszamy :)
$product = $params[1]; // tej linijki nie ruszamy :)
$id = $params[2]; // tej linijki nie ruszamy :)
$qty = $params[3]; // tej linijki nie ruszamy :)


echo "Lp. 1 | Laptop | 1 szt. | 3000 zł";
echo "\nLp. 2 | Monitor | 4 szt. | 2800 zł";
echo "\nLp. 3 | Klawiatura | 2 szt. | 100 zł";