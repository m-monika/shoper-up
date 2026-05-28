<?php

declare(strict_types=1);

namespace App\Task27;

class OrderNotification extends Notification 
{
    public function __construct(
        protected string $recipient,
        protected string $message,
        protected string $orderNumber
    ) {
        parent::__construct($recipient, $message);
    }

    public function format(): string {
        $parrent_message = parent::format();
        return $parrent_message . "\nZamówienie: {$this->orderNumber}";

    }
}