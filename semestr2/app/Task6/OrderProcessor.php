<?php

declare(strict_types=1);

namespace App\Task6;

use App\Task6\Payment\PaymentGateway;
use App\Task6\Shipping\ShippingService;

require 'semestr2/vendor/autoload.php';

class OrderProcessor
{
    private object $payment;
    private object $shipping;

    public function __construct(PaymentGateway $payment, ShippingService $shipping)
    {
        $this->payment = $payment;
        $this->shipping = $shipping;
    }

    public function processOrder(string $orderNumber, float $amount, float $weight, string $address): array
    {
        return [
            'order' => $orderNumber,
            'payment' => $this->payment->processPayment($amount),
            'shipping_cost' => $this->shipping->calculateCost($weight),
            'shipping' => $this->shipping->ship($address),
        ];
    }
}
