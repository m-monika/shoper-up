<?php

declare(strict_types=1);

namespace App\Task4;

class Address
{
    public function __construct(private string $street, private string $city, private string $zipCode){}

    public function getFullAddress(): string
    {
        return $this->street . ', ' . $this->zipCode . ' ' . $this->city;
    }
}
