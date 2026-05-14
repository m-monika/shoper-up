<?php

declare(strict_types=1);

namespace App\Task4;

class Order
{
    public function __construct(
        private string $number,
        private Address $billingAddress,
        private Address $shippingAddress,
    ) {
    }

    public function isBillingSameAsShipping(): bool
    {
        return $this->billingAddress->getFullAddress() === $this->shippingAddress->getFullAddress();
    }
}
