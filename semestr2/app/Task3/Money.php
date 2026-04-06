<?php

declare(strict_types=1);

namespace App\Task3;

class Money
{
    public function __construct(private int $amount, private string $currency = "PLN") {}
    
    public function getFormatted(): string
    {
        $convertedAmount = $this->amount * 0.01;
        $valueStr = str_replace(".", ",", sprintf("%.2f", $convertedAmount));
        return sprintf("%s %s", $valueStr, $this->currency);
    }
}