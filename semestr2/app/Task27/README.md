# Zadanie 27

Mamy klasę `Notification`, która reprezentuje podstawowe powiadomienie wysyłane do klienta sklepu.

## Notification

Konstruktor przyjmuje `recipient: string` i `message: string`.
Metoda `format(): string` — zwraca sformatowaną wiadomość w postaci:
  `"Do: {recipient}\n{message}"`

Stwórz klasy:
- `OrderNotification` dziedzicząca po `Notification`, dodająca `orderNumber` (numer zamówienia)
- `PromoNotification` dziedzicząca po `Notification`, dodająca `discountPercent` (procent rabatu, int)

## OrderNotification

Konstruktor przyjmuje `recipient: string`, `message: string` i `orderNumber: string`.  
Użyj `parent::__construct()` do inicjalizacji pól bazowych.

Nadpisz metodę:
- `format(): string` — wywołaj `parent::format()` i dołącz na końcu nową linię:
  `"Zamówienie: {orderNumber}"`

## PromoNotification

Konstruktor przyjmuje `recipient: string`, `message: string` i `discountPercent: int`.  
Rzuć `\InvalidArgumentException` jeśli `discountPercent` jest spoza zakresu `<1, 100>`.  
Użyj `parent::__construct()` do inicjalizacji pól bazowych.

Nadpisz metodę:
- `format(): string` — wywołaj `parent::format()` i dołącz na końcu nową linię:
  `"Rabat: {discountPercent}%"`

## Przykładowe wyniki
```
Do: jan@example.com
Dziękujemy za rejestrację!
```
```
Do: anna@example.com
Twoje zamówienie zostało przyjęte.
Zamówienie: ORD-2024-001
```
```
Do: piotr@example.com
Mamy dla Ciebie specjalną ofertę!
Rabat: 20%
```