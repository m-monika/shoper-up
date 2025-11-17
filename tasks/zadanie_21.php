<?php

/*
Pod zmienną $products mamy tablicę produktów.
Napisz program, który wyświetli informację o ilości produktów oraz listę produktów posortowaną w zależności od wybranej opcji:
- name: po nazwie
- price: po cenie

sortowanie może być rosnące lub malejące:
- asc: rosnąco
- desc: malejąco

Zmienne:
$key - klucz, po którym sortujemy (name/price)
$sort - rodzaj sortowania (asc/desc)

Przykład:

$products = [
    'Laptop' => 3000,
    'Monitor' => 2500,
    'Klawiatura' => 300,
    'Mysz' => 250,
    'Słuchawki' => 700,
];

$key = 'name;
$sort = 'asc';

Wyświetl wszystko w formacie:

Znaleziono 5 produktów:
Klawiatura | 300 zł
Laptop | 3000 zł
Monitor | 2500 zł
Mysz | 250 zł
Słuchawki | 700 zł

*/

$products = $params[0]; // tej linijki nie ruszamy :)
$key = $params[1]; // tej linijki nie ruszamy :)
$sort = $params[2]; // tej linijki nie ruszamy :)
