<?php

declare(strict_types=1);

namespace App;

class PaymentApiClient
{
    private string $hardcodedApiKey = "U+wfbb#z4w6G2LKC%uH9+6Dhwwbb8e^N";
    private string $givenApiKey = "";
    private bool $status = false;

    public function __construct(string $apiKey) 
    {
        $this->givenApiKey = $apiKey;

        if ($this->givenApiKey == $this->hardcodedApiKey) {
            $this->status = true;
            echo "Zalogowano poprawnie" . PHP_EOL;
        } else {
            echo "Nie udało się zalogować" . PHP_EOL;
        }
    }

    public function __destruct() 
    {
        $this->status = false;
    }

    public function createPayment(int $amount): void {
        if ($this->status == true) {
            echo "Utworzono płatność na kwotę: " . $amount . PHP_EOL;
        }
    }
}