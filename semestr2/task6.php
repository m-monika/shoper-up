<?php

require 'semestr2/vendor/autoload.php';

use App\Task6\Payment\PaymentGateway;
use App\Task6\Shipping\ShippingService;
use App\Task6\OrderProcessor;

$paymentGateway = new PaymentGateway('tpay');
$shippingService = new ShippingService('kurier');

$processor = new OrderProcessor($paymentGateway, $shippingService);
$result = $processor->processOrder('ORD-2026-001', 299.99, 1.5, 'ul. Pawia 9, Kraków');
print_r($result);
