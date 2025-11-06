<?php

$role = $params[0]; // tej linijki nie ruszamy :)
$isLogged = $params[1]; // tej linijki nie ruszamy :)

$permissionAdmit = ($role === "admin") && ($isLogged === true);

if ($permissionAdmit === true) {
	echo "Dostęp przyznany" . PHP_EOL;
} else {
	echo "Brak dostępu" . PHP_EOL;
}