<?php

declare(strict_types=1);

namespace App\Task6;

use App\Task6\Payment\PaymentGateway;
use App\Task6\Shipping\ShippingService;

class OrderProcessor
{
    private PaymentGateway $paymentGateway;
    private ShippingService $shippingService;

    public function __construct(PaymentGateway $paymentGateway, ShippingService $shippingService)
    {
        $this->paymentGateway = $paymentGateway;
        $this->shippingService = $shippingService;
    }

    public function processOrder(string $orderNumber, float $amount, float $weight, string $address): array
    {
        return [
            'order' => $orderNumber,
            'payment' => $this->paymentGateway->processPayment($amount),
            'shipping_cost' => $this->shippingService->calculateCost($weight),
            'shipping' => $this->shippingService->ship($address),
        ];
    }
}
