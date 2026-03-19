<?php
require 'semestr2/vendor/autoload.php';
// require 'semestr2/app/PaymentApiClient.php';

$apiClient = new App\PaymentApiClient('superSekretnyKlucz');

$apiClient->createPayment(10000);
$apiClient->createPayment(20000);
$apiClient->createPayment(5000);