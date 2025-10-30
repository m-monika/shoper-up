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

echo strtoupper($text)  . "\n";                                                    // zamienia wszystkie litery w stringu na duże
echo lcfirst($text)  . "\n";                                                              // zamienia pierwszą literę w stringu na małą
echo substr($text, 10, -11)  . "\n";                                                                                 // zwraca fragment stringa
echo str_replace(" ","", $text)  . "\n";                   // zamienia szukany fragment stringa 
echo strrev($text)  . "\n";                                                                                                  // wyświetla string od tyłu
echo strlen($text)  . "\n";                                                                                                  // zwraca długość stringa
