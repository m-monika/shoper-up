<?php

$sum = $params[0]; // tej linijki nie ruszamy :)
$shipping = $params[1]; // tej linijki nie ruszamy :)

switch ($shipping) {

    case 'paczkomat':
        $cost = ($sum > 39) ? 0 : 9;
        echo "Koszt dostawy wynosi $cost zł.";
        break;

    case 'kurier':
        $cost = ($sum > 49) ? 0 : 15;
        echo "Koszt dostawy wynosi $cost zł.";
        break;

    case 'sklep':
        echo "Koszt dostawy wynosi 0 zł.";
        break;

    case 'poczta':
        echo "Koszt dostawy wynosi 20 zł.";
        break;

    default:
        echo "Nieprawidłowa metoda dostawy.";
        break;
}