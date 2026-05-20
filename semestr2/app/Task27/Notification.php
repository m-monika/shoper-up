<?php

declare(strict_types=1);

namespace App\Task27;

class Notification
{
    public function __construct(
        protected string $recipient,
        protected string $message,
    ) {
    }

    public function format(): string
    {
        return "Do: $this->recipient\n$this->message";
    }
}
