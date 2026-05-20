<?php

declare(strict_types=1);

namespace Tests\Task27;

use App\Task27\Notification;
use App\Task27\OrderNotification;
use App\Task27\PromoNotification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    // --- Notification::format ---

    public function testNotificationFormatReturnsCorrectString(): void
    {
        $n = new Notification('jan@example.com', 'Witaj!');
        $this->assertEquals("Do: jan@example.com\nWitaj!", $n->format());
    }

    // --- OrderNotification::format ---

    public function testOrderNotificationFormatIncludesParentOutput(): void
    {
        $n = new OrderNotification('jan@example.com', 'Przyjęto zamówienie.', 'ORD-001');
        $this->assertStringContainsString("Do: jan@example.com\nPrzyjęto zamówienie.", $n->format());
    }

    public function testOrderNotificationFormatAppendsOrderNumber(): void
    {
        $n = new OrderNotification('jan@example.com', 'Przyjęto zamówienie.', 'ORD-001');
        $this->assertStringContainsString('Zamówienie: ORD-001', $n->format());
    }

    public function testOrderNotificationFormatReturnsFullString(): void
    {
        $n = new OrderNotification('jan@example.com', 'Przyjęto zamówienie.', 'ORD-001');
        $expected = "Do: jan@example.com\nPrzyjęto zamówienie.\nZamówienie: ORD-001";
        $this->assertEquals($expected, $n->format());
    }

    public function testOrderNotificationFormatWorksForDifferentOrderNumbers(): void
    {
        $n = new OrderNotification('a@b.com', 'Tekst.', 'ORD-999');
        $this->assertStringContainsString('Zamówienie: ORD-999', $n->format());
    }

    // --- PromoNotification::format ---

    public function testPromoNotificationFormatIncludesParentOutput(): void
    {
        $n = new PromoNotification('jan@example.com', 'Oferta specjalna!', 15);
        $this->assertStringContainsString("Do: jan@example.com\nOferta specjalna!", $n->format());
    }

    public function testPromoNotificationFormatAppendsDiscountPercent(): void
    {
        $n = new PromoNotification('jan@example.com', 'Oferta specjalna!', 15);
        $this->assertStringContainsString('Rabat: 15%', $n->format());
    }

    public function testPromoNotificationFormatReturnsFullString(): void
    {
        $n = new PromoNotification('jan@example.com', 'Oferta specjalna!', 15);
        $expected = "Do: jan@example.com\nOferta specjalna!\nRabat: 15%";
        $this->assertEquals($expected, $n->format());
    }

    // --- PromoNotification — walidacja ---

    public function testPromoNotificationThrowsExceptionForZeroDiscount(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new PromoNotification('a@b.com', 'Tekst.', 0);
    }

    public function testPromoNotificationThrowsExceptionForNegativeDiscount(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new PromoNotification('a@b.com', 'Tekst.', -5);
    }

    public function testPromoNotificationThrowsExceptionForDiscountAbove100(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new PromoNotification('a@b.com', 'Tekst.', 101);
    }

    public function testPromoNotificationAcceptsBoundaryValue1(): void
    {
        $n = new PromoNotification('a@b.com', 'Tekst.', 1);
        $this->assertStringContainsString('Rabat: 1%', $n->format());
    }

    public function testPromoNotificationAcceptsBoundaryValue100(): void
    {
        $n = new PromoNotification('a@b.com', 'Tekst.', 100);
        $this->assertStringContainsString('Rabat: 100%', $n->format());
    }
}
