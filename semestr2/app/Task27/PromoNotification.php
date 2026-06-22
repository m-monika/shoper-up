<?php

declare(strict_types=1);

namespace App\Task27;


class PromoNotification extends Notification
{
    public function __construct(string $recipient, string $message, private int $discountPercent)
    {
        if ($discountPercent < 1 || $discountPercent > 100) {
            throw new \InvalidArgumentException('The discount percentage is out of the correct range.');
        }
        parent::__construct($recipient, $message);
    }

    public function format(): string
    {
        return parent::format() . "\nRabat: {$this->discountPercent}%";
    }
}