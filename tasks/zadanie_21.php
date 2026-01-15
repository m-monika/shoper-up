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


if (!function_exists('sort_products')) {
    function sort_products(array $products, ?string $key, ?string $sort): array|string
    {
        
        if (($key !== null && $key !== 'name' && $key !== 'price') || 
            ($sort !== null && $sort !== 'asc' && $sort !== 'desc')) {
            return "Nieprawidłowy parametr.";
        }

        if (is_null($key) || is_null($sort)) {
            return print_products($products);
        }

        $sortedProducts = $products;

        if ($key == 'name' && $sort == 'asc') {
            ksort($sortedProducts);
            return print_products($sortedProducts);
        }

        if ($key == 'name' && $sort == 'desc') {
            krsort($sortedProducts);
            return print_products($sortedProducts);
        }

        if ($key == 'price' && $sort == 'asc') {
            asort($sortedProducts);
            return print_products($sortedProducts);
        }

        if ($key == 'price' && $sort == 'desc') {
            arsort($sortedProducts);
            return print_products($sortedProducts);
        }
    }
}

if (!function_exists('print_products')) {
    function print_products(array $products): string
    {
        $listProduct = count_products($products);
        foreach ($products as $name => $price) {
            $listProduct .= "$name | $price zł\n";
        }
        return $listProduct;
    }
}

if (!function_exists('count_products')) {
    function count_products(array $products): string
    {
        $productsQty = count($products);
        return "Liczba produktów: $productsQty\n";
    }
}

echo sort_products($products, $key, $sort);