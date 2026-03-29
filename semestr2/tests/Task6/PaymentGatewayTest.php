<?php

declare(strict_types=1);

namespace Tests\Task6;

use App\Task6\Payment\PaymentGateway;
use PHPUnit\Framework\TestCase;

class PaymentGatewayTest extends TestCase
{
    public function testProcessPaymentReturnsCorrectMessage()
    {
        $gateway = new PaymentGateway('PayU');
        $result = $gateway->processPayment(299.99);

        $this->assertSame(
            'Przetwarzanie płatności 299.99 zł przez PayU',
            $result
        );
    }

    public function testPaymentGatewayWithDifferentProvider()
    {
        $gateway = new PaymentGateway('Przelewy24');
        $result = $gateway->processPayment(599.50);

        $this->assertStringContainsString('Przelewy24', $result);
        $this->assertStringContainsString('599.5', $result);
    }

    public function testPaymentGatewayWithZeroAmount()
    {
        $gateway = new PaymentGateway('PayU');
        $result = $gateway->processPayment(0.0);

        $this->assertStringContainsString('0', $result);
    }
}
