<?php

$sum = $params[0]; // tej linijki nie ruszamy :)
$shipping = $params[1]; // tej linijki nie ruszamy :)

$freePaczkomat = 39;
$freeKurier = 49;
$shippingCost = null;
$paczkomatCost = 9;
$kurierCost = 15;
$sklepCost = 0;
$pocztaCost = 20;

switch ($shipping) {
	case 'paczkomat':
		if ($sum > $freePaczkomat) {
			$shippingCost = 0;
		} else {
            $shippingCost = $paczkomatCost;
        } 
		break;
	case 'kurier':
		if ($sum > $freeKurier) {
			$shippingCost = 0;
		} else {
			$shippingCost = $kurierCost;
		}
		break;
	case 'sklep':
		$shippingCost = $sklepCost;
		break;
	case 'poczta':
		$shippingCost = $pocztaCost;
		break;
	default:
		echo 'Nieprawidłowa metoda dostawy.';
		break;
}

if ($shippingCost === 0) {
	echo "Koszt dostawy wynosi 0 zł.\n";
} elseif ($shippingCost !== null) {
	echo "Koszt dostawy wynosi " . $shippingCost . " zł.\n";
}