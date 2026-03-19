<?php

namespace App;

class PaymentApiClient
{
    private const SECRET_KEY = "superSekretnyKlucz";
    private bool $isConnected = false;

    public function __construct(string $apiKey)
    {
        if ($apiKey === self::SECRET_KEY) {
            $this->isConnected = true;
            echo "połączono" . PHP_EOL;
        } else {
            die("błąd autoryzacji" . PHP_EOL);
        }
    }

    public function createPayment(int $amount): void
    {
        if (!$this->isConnected) {
            die("błąd autoryzacji" . PHP_EOL);
        }
        $formattedAmount = number_format($amount, 2, ',', ' ');
            echo "utworzono płatność na kwotę $formattedAmount" . PHP_EOL;
    }

    public function __destruct()
    {
        if ($this->isConnected) {
            $this->isConnected = false;
            echo "błąd połączenia" . PHP_EOL;
        }
    }
}