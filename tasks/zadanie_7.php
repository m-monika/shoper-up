<?php

$customerA = $params[0]; // tej linijki nie ruszamy :)
$customerB = $params[1]; // tej linijki nie ruszamy :)

if ($customerA > $customerB) {
echo "Klient A wydał więcej" . "\n";
} elseif ($customerA === $customerB) {
    echo "Klient A wydał tyle samo co klient B" . "\n";
} elseif ($customerA < $customerB) {
    echo "Klient B wydał więcej";
}