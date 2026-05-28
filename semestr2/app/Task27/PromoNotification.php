<?php

declare(strict_types=1);

namespace App\Task27;

class PromoNotification extends Notification 
{
    public function __construct(
        protected string $recipient,
        protected string $message,
        protected int $discountPercent,
    ) {
        parent::__construct($recipient, $message);
        if ($discountPercent < 1 or $discountPercent > 100) {
        throw new \InvalidArgumentException('An error has occurred.');
        }
    }

    public function format(): string {
        $parrent_message = parent::format();
        return $parrent_message . "\nRabat: {$this->discountPercent}%";

    }
}