<?php
require 'vendor/autoload.php';

use App\Task6\Payment\PaymentGateway as Payment;
use App\Task6\Shipping\ShippingService as Shipping;
use App\Task6\OrderProcessor;

$paymentGateway = new Payment("Przelew");
$shippingService = new Shipping("OrlenPaczkaDziałająca");

$processor = new OrderProcessor($paymentGateway, $shippingService);
$result = $processor->processOrder('ORD-2026-001', 299.99, 1.5, 'ul. Pawia 9, Kraków');
print_r($result);