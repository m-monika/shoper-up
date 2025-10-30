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

echo strtoupper($text) . "\n";
echo lcfirst($text) . "\n";
echo substr($text, 10, 17) . "\n";
echo str_replace(" ", "", $text) . "\n";
echo strrev($text) . "\n";
echo strlen($text);
