<?php

/*

Napisz program, który wspomoże pracę w sklepach. 
Kod ma pomóc w wydawaniu reszty za zakupy. 
Kod powinien przyjmować kwotę odebraną od klienta w groszach, 
sumę produktów również w groszach, natomiast w wyniku 
(czyli kwotę którą należy oddać klientowi) powinien zwrócić kwotę podaną w złotówkach i groszach.

Przykładowo:

Klient daje osobie kasującej produkty 10000 groszy.
Klient kupuje produkty za 8515 groszy.
Kasjerka powinna wydać 14zł i 85 groszy.

Zmodyfikuj poniższy kod tak, aby odpowiednio wyliczyć wartość dla zmiennej $rest, 
która reprezentuje kwotę w złotówkach i $restPennies, która reprezentuje kwotę w groszach.

*/

$givenMoneyByClient = 10000;
$costOfProducts = 8515; 

$rest = ($givenMoneyByClient - $costOfProducts) / 100;
$rest = floor($rest) ; // TODO
$restPennies = ($givenMoneyByClient - $costOfProducts) % 100; // TODO

echo "Kasjerka powinna oddać klientowi: {$rest}zł {$restPennies} groszy.";