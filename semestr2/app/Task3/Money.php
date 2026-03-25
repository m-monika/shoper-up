<?php

declare(strict_types=1);

namespace App\Task3;

class Money
{
    public int $amount;
    public string $currency;

    public function __construct(int $amount = 0, string $currency = 'PLN')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): float 
    {
        return $this->amount / 100;
    }
    public function getFormatted(): string
    {
        return number_format($this->getAmount(), 2, ',', '') . " " . $this->currency;
    }
}
