<?php

/*

https://www.php.net/manual/en/book.strings.php

Mamy do dyspozycji poniższą zmienną $text
Używając poznanych funkcji operujących na stringach wyświetl na ekran poniższy tekst:

SHOPERUP! PROGRAMOWANIE PHP - LEKCJA 3
shoperUp! Programowanie PHP - Lekcja 3
Programowanie PHP
ShoperUp!ProgramowaniePHP-Lekcja3
3 ajckeL - PHP einawomargorP !pUrepohS
38

*/


$text = "ShoperUp! Programowanie PHP - Lekcja 3";


echo strtoupper(substr($text, 0,9));
echo strtoupper(substr($text, 9,29)) . "<br>";
echo strtolower(substr($text, 0,9));
echo substr($text, 9,29) . "<br>";
echo ucfirst(substr($text, 9,18)). "<br>";
echo str_replace(" ", "", $text) . "<br>";
echo strrev($text) ."<br>";
echo strlen($text);