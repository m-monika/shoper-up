<?php

declare(strict_types=1);

namespace App\Task4;

class Order
{
    private string $number;
    private Address $billingAddress;
    private Address $shippingAddress;

    public function __construct(string $number, Address $billingAddress, Address $shippingAddress)
    {
        $this->number = $number;
        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;
    }
    public function isBillingSameAsShipping(): bool
    {
        if($this->billingAddress->getFullAddress() !== $this->shippingAddress->getFullAddress()) 
        {
            return false;
        } else {
            return true;
        }
    }
}