<?php

declare(strict_types=1);

namespace App\Task3;

class Money
{
    public function __construct(private int $amount, private string $currency = 'PLN')
    {
    }

    public function getFormatted(): string
    {
        return number_format($this->amount / 100, 2, ',', '') . ' ' . $this->currency;
    }
}
