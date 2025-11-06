<?php

$consent = $params[0]; // tej linijki nie ruszamy :)
$age = $params[1]; // tej linijki nie ruszamy :)

if ($age >= "18" && $consent === true) {
echo "Możesz wziąć udział";
} else {
    echo "Nie spełniasz warunków";
}