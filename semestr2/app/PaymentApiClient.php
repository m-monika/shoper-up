<?php

declare(strict_types=1);

namespace App;

class PaymentApiClient
{
    private string $apiKey = '';
    private bool $valid = false;
    public function __construct(string $apiKey)
    {

        $this->apiKey = $apiKey;

        if ($apiKey == 'superSekretnyKlucz') {
            $this->valid = true;
        } else {
            $this->valid = false;
        }

    }

    public function createPayment(int $amount): void
    {
        if ($this->valid == true) {
            echo 'Utworzono płatność na kwotę: ' . $amount . ",00 \n";
        } else {
            echo 'Błąd połączenia';
        }

    }
}
