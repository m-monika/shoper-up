<?php

declare(strict_types=1);

namespace App\Task4;

class Address
{
    public function __construct(string $street, string $city, string $zipCode) 
    {
        $this->street = $street;
        $this->city = $city;
        $this->zipCode = $zipCode;
    }

    public function getFullAddress(): string
    {
        return "{$this->street}, {$this->zipCode} {$this->city}";
    }
}