<?php

$phoneNumber = $params[0]; // tej linijki nie ruszamy :)

if (mb_strlen($phoneNumber) === 9 && ctype_digit($phoneNumber)

|| 

(mb_strlen($phoneNumber) === 12 
&& mb_substr($phoneNumber, 0, 3) === "+48"
&& ctype_digit(mb_substr($phoneNumber, 3)))){

echo "Poprawny";
} else {
    echo "Niepoprawny";
}