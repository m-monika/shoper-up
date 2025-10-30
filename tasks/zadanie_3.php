<?php
declare(strict_types=1);
mb_internal_encoding('UTF-8');

$s = "ShoperUp! Programowanie PHP – Lekcja 3";

echo mb_strtoupper($s) . PHP_EOL;

function mb_lcfirst(string $str): string {
    return mb_strtolower(mb_substr($str, 0, 1)) . mb_substr($str, 1);
}
echo mb_lcfirst($s) . PHP_EOL;

$start = mb_strpos($s, '! ') + 2;
$end   = mb_strpos($s, ' – ');
echo mb_substr($s, $start, $end - $start) . PHP_EOL;

echo str_replace(' ', '', $s) . PHP_EOL;

function mb_strrev(string $str): string {
    preg_match_all('/./u', $str, $m);
    return implode('', array_reverse($m[0]));
}
echo mb_strrev($s) . PHP_EOL;

echo mb_strlen($s) . PHP_EOL;
