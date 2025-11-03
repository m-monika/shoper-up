<?php

/*

TODO

*/

$customerA = $params[0];
$customerB = $params[1];

if ($customerA > $customerB) {
    echo "Klient A wydał więcej";
} elseif ($customerA == $customerB) {
    echo "Klient A wydał tyle samo co klient B";
} else {
    echo "Klient B wydał więcej";
}