<?php

/*
Pod zmienną $products mamy tablicę produktów.
Napisz program, który wyświetli informację o ilości produktów oraz listę produktów posortowaną w zależności od wybranej opcji:
- name: po nazwie
- price: po cenie

sortowanie może być rosnące lub malejące:
- asc: rosnąco
- desc: malejąco

Jeśli któryś z parametrów do sortowania ($key, $sort) nie został podany, wyświetlamy produkty tak, jak zostały podane.
Jeśli któryś z parametrów do sortowania ($key, $sort) nie pasuje do zdefiniowanych, wyświetlamy informację o błędzie: Nieprawidłowy parametr.

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

Liczba produktów: 5
Klawiatura | 300 zł
Laptop | 3000 zł
Monitor | 2500 zł
Mysz | 250 zł
Słuchawki | 700 zł

*/


$products = $params[0]; // tej linijki nie ruszamy :)
$key = $params[1]; // tej linijki nie ruszamy :)
$sort = $params[2]; // tej linijki nie ruszamy :)


if ((isset($key) && ($key !== 'name' && $key !== 'price')) 
    || (isset($sort) && ($sort !== 'asc' && $sort !== 'desc'))){
    echo "Nieprawidłowy parametr.";
}else{
    switch($key){
        case 'name':
            if($sort === 'desc'){
                krsort($products);
            }elseif($sort ==='asc'){
                ksort($products);
            }
            break;
        case 'price':
            if($sort === 'desc'){
                arsort($products);
            }elseif($sort ==='asc'){
                asort($products);
            }
            break;
        }
    $quanity = 0;
    foreach ($products as $list){
        $quanity++; 
    }
    echo "Liczba produktów: " . $quanity . "\n";    

    foreach ($products as $listName => $listPrice){
        echo $listName . ' | ' . $listPrice . " zł" . "\n";
            }
}

