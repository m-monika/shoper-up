<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Task6\Payment\PaymentGateway as Payment;
use App\Task6\Shipping\ShippingService as Shipping;
use App\Task6\OrderProcessor as OrderProcessor;

$shippingService = new Shipping('DPD');
$paymentGateway = new Payment('Autopay');
$processor = new OrderProcessor($paymentGateway, $shippingService);
$result = $processor->processOrder('ORD-2026-001', 299.99, 1.5, 'ul. Pawia 9, Kraków');
print_r($result);