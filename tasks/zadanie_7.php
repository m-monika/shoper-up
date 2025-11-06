<?php
$customerA = $params[0]; // tej linijki nie ruszamy :)
$customerB = $params[1]; // tej linijki nie ruszamy :)

if ($customerA > $customerB) {
     echo "Klient A wydał więcej" . PHP_EOL;
} elseif ($customerA == $customerB) {
     echo "Klient A wydał tyle samo co klient B" . PHP_EOL;
} else {
     echo "Klient B wydał więcej" . PHP_EOL;
}