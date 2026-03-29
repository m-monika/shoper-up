<?php

declare(strict_types=1);

namespace App\Task6\Payment;

class PaymentGateway
{
    private string $gatewayName;

    public function __construct(string $gatewayName)
    {
        $this->gatewayName = $gatewayName;
    }

    public function processPayment(float $amount): string
    {
        return "Przetwarzanie płatności {$amount} zł przez {$this->gatewayName}";
    }
}
