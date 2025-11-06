<?php

/*

Napisz instrukcje warunkowe które sprawdzą który klient wydał więcej w sklepie
Jeśli klient A wydał więcej, wyświetl na ekranie komunikat "Klient A wydał więcej"
Jeśli kliet A i B wydali tyle samo: "Klient A wydał tyle samo co klient B"
Jeśli klient A wydał mniej niż klient B: "Klient B wydał więcej"

*/

$customerA = $params[0]; // tej linijki nie ruszamy :)
$customerB = $params[1]; // tej linijki nie ruszamy :)

// ...
if ($customerA > $customerB){
    echo "Klient A wydał więcej";
} elseif ($customerA == $customerB) {
    echo "Klient A wydał tyle samo co klient B";
} else {
    echo"Klient B wydał więcej";
}
