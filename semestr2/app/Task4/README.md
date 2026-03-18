# Zadanie 4

Klasa `Address` - w konstruktorze przyjmuje `string $street` (ulica z numerem), `string $city` oraz `string $zipCode`. Dodaj konstruktor i zaimplementuj metodę `getFullAddress(): string`, która zwróci pełny, sformatowany adres (np. "Pawia 9, 31-154 Kraków").

Klasa `Order` - w konstruktorze przyjmuje `string $number` oraz obiekty klasy `Address` jako `$billingAddress` i `$shippingAddress`. Dodaj konstruktor i zaimplementuj metodę `isBillingSameAsShipping(): bool`, która zwróci `true` lub `false`, w zależności od tego, czy adresy są takie same, czy nie.

Przykład użycia:
```php
$address = new Address('Pawia 9', 'Kraków', '31-154');
$fullAddress = $address->getFullAddress(); // Pawia 9, 31-154 Kraków

$billingAddress = new Address('ul. Pawia 9', 'Kraków', '31-154');
$shippingAddress = new Address('ul. Pawia 9', 'Kraków', '31-154');
$order = new Order('ORD-001', $billingAddress, $shippingAddress);
$order->isBillingSameAsShipping(); // true
```