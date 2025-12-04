<?php

$clients = $params[0]; // tej linijki nie ruszamy :)

function message($client) {
    $imie = $client['name'];
    
  
    if (isset($client['vip']) && $client['vip'] === true) {
        return "Cześć " . $imie . "! Mamy super ofertę specjalnie dla klientów VIP! Odwiedź nasz sklep!";
    } else {
        
        return "Witaj " . $imie . ", sprawdź naszą ofertę! Odwiedź nasz sklep!";
    }
}

foreach ($clients as $client) {
    echo message($client);
    echo "\n";
}