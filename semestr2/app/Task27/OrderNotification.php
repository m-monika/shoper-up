<?php

declare(strict_types=1);

namespace App\Task27;

class OrderNotification extends Notification
{
    public function __construct(
        string $recipient,
        string $message,
        protected string $orderNumber,
    ) {
        parent::__construct($recipient, $message);
    }

    public function format(): string
    {
        return parent::format() . "\nZamówienie: {$this->orderNumber}";
    }
}
