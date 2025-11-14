<?php

/*

Napisz kod który użyje zmiennej 
    - $role (oznaczająca rolę w systemie) 
    - $isLogged (oznaczająca czy jest zalogowany)
Jeśli rola jest równa "admin" oraz jest zalogowany to wyświetl na ekranie "Dostęp przyznany"
W każdym innym przypadku wyświetl komunikat "Brak dostępu"

*/

$role = $params[0]; // tej linijki nie ruszamy :)
$isLogged = $params[1]; // tej linijki nie ruszamy :)

// ...

if ($role === "admin" && $isLogged === true)  {
    echo "Dostęp przyznany";
}  else {
    echo "Brak dostępu";
}}
