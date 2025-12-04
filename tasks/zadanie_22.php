<?php

$clients = $params[0]; // tej linijki nie ruszamy :)

function createCustomerMessage(array $client): ?string
{
	$isVIP = isset($client['vip']) && $client['vip'];
	$name = $client['name'];
	
	if ($isVIP)
	{
		$message = "Cześć $name! Mamy super ofertę specjalnie dla klentów VIP! Odwiedź nasz sklep!";
	} else {
		$message = "Witaj $name, sprawdź naszą ofertę! Odwiedź nasz sklep!";
	}
	return $message;
}

foreach ($clients as $client) {
    $message = createCustomerMessage($client);
    echo $message . "\n";
}