<?php

declare(strict_types=1);

namespace App\Task27;

class PromoNotification extends Notification
{
    public function __construct(
        string $recipient,
        string $message,
        protected int $discountPercent,
    ) {
        if ($discountPercent < 1 || $discountPercent > 100) {
            throw new \InvalidArgumentException('Procent rabatu musi być w zakresie od 1 do 100.');
        }

        parent::__construct($recipient, $message);
    }

    public function format(): string
    {
        return parent::format() . "\nRabat: {$this->discountPercent}%";
    }
}
