<?php


require 'vendor/autoload.php';

use App\Task6\OrderProcessor;
use App\Task6\Payment\PaymentGateway as Payment;
use App\Task6\Shipping\ShippingService as Shipping;


$paymentGateway = new Payment("Blik");
$shippingService = new Shipping("DPD");

$processor = new OrderProcessor($paymentGateway, $shippingService);
$result = $processor->processOrder('ORD-2026-001', 299.99, 1.5, 'ul. Pawia 9, Kraków');
print_r($result);