<?php

$text = "ShoperUp! Programowanie PHP - Lekcja 3";

echo strtoupper($text) . "\n";
echo lcfirst($text) . "\n";
echo substr($text, 10, 17) . "\n";
echo str_replace(" ", "", $text) . "\n";
echo strrev ($text) . "\n";
echo str_replace("ShoperUp! Programowanie PHP - Lekcja 3","38", $text) . "\n";