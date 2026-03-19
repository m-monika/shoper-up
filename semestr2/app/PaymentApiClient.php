<?php

namespace App;

class PaymentApiClient
{
    private bool $connected = false;
    private string $apiKey;
    private string $validApiKey = 'superSekretnyKlucz';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        if ($this->apiKey === $this->validApiKey) {
            $this->connected = true;
            echo "Polaczono poprawnie";
        } else {
            echo "Blad autoryzacji";
        }
    }

    public function createPayment(int $amount) : void
    {
        if ($this->connected) {
            echo "Utworzono platnosc na kwote: " . $amount . ",00" . "\n";
        } else {
            echo "Błąd";
        }
    }

}

