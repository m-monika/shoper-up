<?php

$role = $params[0]; // tej linijki nie ruszamy :)
$isLogged = $params[1]; // tej linijki nie ruszamy :)

if ($role === "admin" && ($isLogged === "true" || $isLogged === true)) {
echo "Dostęp przyznany";
} else {
    echo "Brak dostępu";
}