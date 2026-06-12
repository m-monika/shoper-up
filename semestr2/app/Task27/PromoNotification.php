<?php

declare(strict_types=1);

namespace App\Task27;

use InvalidArgumentException;

class PromoNotification extends Notification
{
    public function __construct(
        string $recipient,
        string $message,
        protected int $discountPercent
    ) {
        parent::__construct($recipient, $message);

        if ($this->discountPercent < 1 || $this->discountPercent > 100) {
            throw new InvalidArgumentException('Błędny zakres');
        }
    }

    public function format(): string
    {
        return "Do: {$this->recipient}\n{$this->message}" . PHP_EOL . "Rabat: {$this->discountPercent}%";
    }
}