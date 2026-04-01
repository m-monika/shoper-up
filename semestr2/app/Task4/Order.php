<?php

declare(strict_types=1);

namespace App\Task4;

class Order
{
    public function __construct(public string $number, public Address $billingAddress, public Address $shippingAddress) 
    {
        $this->number = $number;
        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;
    }

    public function isBillingSameAsShipping(): bool
    {
        return $this->billingAddress->getFullAddress() == $this->shippingAddress->getFullAddress();
    }
}