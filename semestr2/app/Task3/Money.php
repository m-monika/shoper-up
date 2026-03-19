<?php

declare(strict_types=1);

namespace App\Task3;

class Money
{
    public function __construct(private int $amount, private string $currency = 'PLN')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getFormatted(): string
    {
        $decimalValue = $this->amount / 100;
        $formattedAmount = number_format($decimalValue, 2, ',', ' ');
        return "$formattedAmount $this->currency";;
    }
}