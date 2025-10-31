<?php

/*

Napisz kod, który ma za zadanie wygenerowanie sumy brutto oraz netto cen produktów znajdujących się w koszyku.

W koszyku znajduje się:
- 2 koszulki po 17zł brutto, VAT: 3%,
- 1 czapka po 40zł brutto, VAT: 23%,
- 5 par rękawiczek po 13zł brutto, VAT: 7%.

Kwoty te zaokrąglimy sobie do pełnych złotówek za pomocą funkcji round().

Do wyliczenia kwot wykorzystaj poniższe zmienne.

*/

$shirtCount = 2;
$shirt = 17;
$shirtVat = 3;

$hatCount = 1;
$hat = 40;
$hatVat = 23;

$glovesCount = 5;
$gloves = 13;
$glovesVat = 7;

$gross = 0;   // TODO
$gross = $shirt * $shirtCount + $hat * $hatCount + $gloves * $glovesCount;
$net = 0;     // TODO
// netto = brutto / (1 + vat/100)
$netShirt = $shirt / (1 + $shirtVat/100);
$netHat = $hat / (1 + $hatVat/100);
$netGloves = $gloves / (1 + $glovesVat/100);
$net = $netShirt * $shirtCount + $netHat * $hatCount + $netGloves * $glovesCount;

$gross = round($gross);
$net = round($net);

echo "Suma brutto: $gross\nSuma netto: $net";