<?php

$consent = $params[0]; // tej linijki nie ruszamy :)
$age = $params[1]; // tej linijki nie ruszamy :)

$consentToParticipate = ($consent === true) && ($age >= 18);

if ($consentToParticipate === true) {
	echo "Możesz wziąć udział";
} else {
	echo "Nie spełniasz warunków";
}