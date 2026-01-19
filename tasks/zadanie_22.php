<?php

/*
Napisz program zawierający funkcję, która tworzy wiadomość dla danego klienta. Wiadomość jest różna dla klientów VIP i zwykłych.
VIP: Cześć [imię]! Mamy super ofertę specjalnie dla VIP-ów! Odwiedź nasz sklep!
zwykły: Witaj [imię], sprawdź naszą ofertę! Odwiedź nasz sklep!
Program przyjmuje tablicę klientów i dla każdego tworzy wiadomość.

Zmienne:
$clients - tablica z danymi klientów

Przykład:

$clients = [
    [
        'name' => 'Ala',
        'vip' => true,
    ],
    [
        'name' => 'Jacek',
        'vip' => false,
    ],
    [
        'name' => 'Ola',
    ],
];

Cześć Ala! Mamy super ofertę specjalnie dla VIP-ów! Odwiedź nasz sklep!
Witaj Jacek, sprawdź naszą ofertę! Odwiedź nasz sklep!

*/

$clients = $params[0]; // tej linijki nie ruszamy :)

function createMessage(string $name, bool $isVip): string
{
    return $isVip ?
      "Cześć $name! Mamy super ofertę specjalnie dla klentów VIP! Odwiedź nasz sklep!\n" : 
      "Witaj $name, sprawdź naszą ofertę! Odwiedź nasz sklep!\n";
}

foreach ($clients as $client) {
    $name = isset($client['name']) ? $client['name'] : 'nieznajomy';
    $isVip = isset($client['vip']) && $client['vip'] === true;

    echo createMessage($name, $isVip);
}