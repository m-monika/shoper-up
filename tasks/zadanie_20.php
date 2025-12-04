<?php

$net = $params[0]; // tej linijki nie ruszamy :)
$category = $params[1]; // tej linijki nie ruszamy :)

$summary=match($category){
    "elektronika" , "odzież" => $net * 1.22,
    "książki" , "czasopisma" => $net * 1.05,
    "żywność" => $net * 1.08,
    default => $net * 1.23,
};
echo "Cena brutto wynosi $summary zł."