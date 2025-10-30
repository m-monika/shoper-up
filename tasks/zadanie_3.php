<?php
$text = "ShoperUp! Programowanie PHP - Lekcja 3";

echo mb_strtoupper($text)  . "\n"; 
echo lcfirst($text)  . "\n";
echo mb_substr($text, 10, 17)  . "\n"; 
echo str_replace(' ', '', $text)  . "\n";
echo strrev($text)  . "\n";
echo mb_strlen($text)  . "\n";