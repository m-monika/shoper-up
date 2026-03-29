<?php

declare(strict_types=1);

namespace Tests\Task6;

use App\Task6\OrderProcessor;
use App\Task6\Payment\PaymentGateway;
use App\Task6\Shipping\ShippingService;
use PHPUnit\Framework\TestCase;

class OrderProcessorTest extends TestCase
{
    public function testProcessOrderReturnsCorrectArray()
    {
        $payment = new PaymentGateway('PayU');
        $shipping = new ShippingService('InPost');
        $processor = new OrderProcessor($payment, $shipping);

        $result = $processor->processOrder('ORD-001', 299.99, 1.5, 'ul. Pawia 9, Kraków');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('order', $result);
        $this->assertArrayHasKey('payment', $result);
        $this->assertArrayHasKey('shipping_cost', $result);
        $this->assertArrayHasKey('shipping', $result);
    }

    public function testProcessOrderWithCorrectOrderNumber()
    {
        $payment = new PaymentGateway('PayU');
        $shipping = new ShippingService('InPost');
        $processor = new OrderProcessor($payment, $shipping);

        $result = $processor->processOrder('ORD-2026-001', 299.99, 1.5, 'ul. Pawia 9, Kraków');

        $this->assertSame('ORD-2026-001', $result['order']);
    }

    public function testProcessOrderCalculatesShippingCostCorrectly()
    {
        $payment = new PaymentGateway('Przelewy24');
        $shipping = new ShippingService('DHL');
        $processor = new OrderProcessor($payment, $shipping);

        $result = $processor->processOrder('ORD-002', 599.00, 3.2, 'ul. Floriańska 15, Kraków');

        $this->assertSame(8.0, $result['shipping_cost']);
    }

    public function testProcessOrderContainsPaymentInfo()
    {
        $payment = new PaymentGateway('PayU');
        $shipping = new ShippingService('InPost');
        $processor = new OrderProcessor($payment, $shipping);

        $result = $processor->processOrder('ORD-003', 299.99, 1.5, 'ul. Pawia 9, Kraków');

        $this->assertStringContainsString('PayU', $result['payment']);
        $this->assertStringContainsString('299.99', $result['payment']);
    }

    public function testProcessOrderContainsShippingInfo()
    {
        $payment = new PaymentGateway('Przelewy24');
        $shipping = new ShippingService('DHL');
        $processor = new OrderProcessor($payment, $shipping);

        $result = $processor->processOrder('ORD-004', 599.00, 3.2, 'ul. Floriańska 15, Kraków');

        $this->assertStringContainsString('DHL', $result['shipping']);
        $this->assertStringContainsString('ul. Floriańska 15, Kraków', $result['shipping']);
    }
}

