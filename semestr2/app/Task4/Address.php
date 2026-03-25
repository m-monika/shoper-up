<?php

declare(strict_types=1);

namespace App\Task4;

class Address
{
    private string $street;
    private string $city;
    private string $zipCode;

    public function __construct(string $street, string $city, string $zipCode)
    {
        $this->street = $street;
        $this->city = $city;
        $this->zipCode = $zipCode;
    }
    public function getFullAddress(): string
    {
        return $this->street .", " . $this->zipCode . " " . $this->city;
    }
}