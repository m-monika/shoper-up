# Zadanie 6

## Część 1:

`App\Task6\OrderProcessor`

Konstruktor powinien przyjąć obiekty `PaymentGateway` oraz `ShippingService`. 

Zaimplementuj metodę:

* `processOrder(string $orderNumber, float $amount, float $weight, string $address): array` - zwraca tablicę z kluczami:

  - `'order'` - numer zamówienia
  - `'payment'` - wynik wywołania `processPayment()`
  - `'shipping_cost'` - wynik wywołania `calculateCost()`
  - `'shipping'` - wynik wywołania `ship()`

### Testy

```bash title="Linux & MacBook"
./tests.sh 6
```

```bash title="Windows"
.\tests.ps1 6
```

## Część 2

W pliku `semestr2/task6.php`:

1. Załaduj plik `vendor/autoload.php`
1. Zaimportuj klasy z `Task6` używając `use`
2. Użyj aliasów dla klas (np. `use App\Task6\Payment\PaymentGateway as Payment;`)
3. Stwórz instancje klas i wywołaj metody
4. Wyświetl wyniki

### Przykład użycia

```php
<?php
// ....
$processor = new OrderProcessor($paymentGateway, $shippingService);
$result = $processor->processOrder('ORD-2026-001', 299.99, 1.5, 'ul. Pawia 9, Kraków');
print_r($result);
// Wyświetl wyniki
```

### Oczekiwany wynik

```
Array
(
    [order] => ORD-2026-001
    [payment] => Przetwarzanie płatności 299.99 zł przez PayU
    [shipping_cost] => 3.75
    [shipping] => Wysyłka do ul. Pawia 9, Kraków przez InPost
)
```

### Sprawdzenie

Po zaimplementowaniu klas wejdź na:

**http://localhost:8000/semestr2/task6.php**

