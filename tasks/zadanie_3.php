<?php
$text = "ShoperUp! Programowanie PHP - Lekcja 3";

echo strtoupper ($text) . "\n";
echo strtolower ($text) . "\n";
echo substr($text, 10, 17)  . "\n";
//echo str_replace("ShoperUp! Programowanie PHP - Lekcja 3",$text)  . "\n"; 
echo strrev($text)  . "\n";
echo mb_strlen($text)  . "\n";

