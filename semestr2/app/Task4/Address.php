<?php

declare(strict_types=1);

namespace App\Task4;

class Address
{
    public function __construct(string $street, string $city, string $zipCode) {}

    public function getFullAddress(): string
    {
        return sprintf('%s, %s %s', $this->street, $this->zipCode, $this->city);
    }
}
