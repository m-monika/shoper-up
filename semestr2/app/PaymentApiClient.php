<?php

namespace App;

class PaymentApiClient 
{
    private string $api_key = 'test';
    private bool $connectionStatus = false;

    public function __construct(string $apiKey) 
    {
        if ($this->api_key === $apiKey) {
            $this->connectionStatus = true;
            echo 'Zalogowano.';
        } else {
            echo 'Błąd autoryzacji.';
        }
    }

    public function createPayment(int $amount): void
    {
        if ($this->connectionStatus === true) {
            echo "Utworzono płatność na kwotę $amount";
        } else {
            echo "Błąd połączenia.";
        }
    }

    public function __destruct()
    {
        $this->connectionStatus = false;
        echo 'Wylogowano.';
    }

}
