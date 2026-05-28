# Zadanie 30

W systemie e-commerce robimy obsługę kuponów rabatowych.  
Zamiast standardowego konstruktora użyjemy **statycznych named constructorów**.

Tworzymy klasę `Coupon`, która reprezentuje kupon rabatowy dla zamówienia.

## Coupon

Klasa zawiera stałe typu kuponu:
- `TYPE_PERCENT = 'percent'`
- `TYPE_FIXED = 'fixed'`

Klasa przechowuje:
- `code` (kod kuponu, string)
- `type` (typ rabatu, string — tylko jedna ze stałych: `Coupon::TYPE_PERCENT` albo `Coupon::TYPE_FIXED`)
- `value` (wartość rabatu, int)
  - dla `TYPE_PERCENT`: procent (1-100)
  - dla `TYPE_FIXED`: kwota (w groszach, > 0)
- `minOrderValue` (minimalna wartość zamówienia, w groszach, int)
- `expiresAt` (`\DateTimeImmutable`)

### Konstruktor
- Konstruktor ma być `private`.
- Powinien przyjmować komplet danych kuponu.
- Ma walidować dane:
  - `code` nie może być pusty,
  - `type` musi mieć wartość `Coupon::TYPE_PERCENT` albo `Coupon::TYPE_FIXED`,
  - dla `Coupon::TYPE_PERCENT` wartość rabatu musi być w zakresie `<1, 100>`,
  - dla `Coupon::TYPE_FIXED` wartość rabatu musi być większa od `0`,
  - `minOrderValue` nie może być ujemne.
- Przy niepoprawnych danych rzuć `\InvalidArgumentException`.

### Named constructory
Zaimplementuj statyczne metody tworzące obiekty `Coupon`:

- `percent(string $code, int $percent, \DateTimeImmutable $expiresAt, int $minOrderValue = 0): self`  
  Ustawia `type` na `Coupon::TYPE_PERCENT`.
- `fixed(string $code, int $amount, \DateTimeImmutable $expiresAt, int $minOrderValue = 0): self`  
  Ustawia `type` na `Coupon::TYPE_FIXED`.
- `welcome(): self`  
  Tworzy kupon:
  - `code = WELCOME10`
  - `type = Coupon::TYPE_PERCENT`
  - `value = 10`
  - `minOrderValue = 5000`
  - data wygaśnięcia: 30 dni od momentu wywołania

### Metody
Zaimplementuj metody:
- `isExpired(\DateTimeImmutable $now): bool`  
  Zwraca `true`, jeśli kupon jest już po terminie ważności.
- `canBeAppliedTo(int $orderValue, \DateTimeImmutable $now): bool`  
  Zwraca `true` tylko jeśli:
  - kupon nie wygasł,
  - wartość zamówienia jest >= `minOrderValue`.
- `discountAmount(int $orderValue): int`  
  Zwraca wartość rabatu dla zamówienia:
  - dla `Coupon::TYPE_PERCENT`: procent od wartości zamówienia,
  - dla `Coupon::TYPE_FIXED`: stała kwota,
  - rabat nie może przekroczyć wartości zamówienia.
- `finalPrice(int $orderValue): int`  
  Zwraca cenę końcową po rabacie.

> Wszystkie kwoty (`amount`, `orderValue`, `minOrderValue`) są podawane w groszach.

### Gettery
Dodaj gettery:
- `getCode(): string`
- `getType(): string`
- `getValue(): int`
- `getMinOrderValue(): int`
- `getExpiresAt(): \DateTimeImmutable`

## Przykład użycia
```php
$today = new DateTimeImmutable('2026-05-26');

$coupon1 = Coupon::percent('MAY20', 20, new DateTimeImmutable('2026-06-10'), 10000);
$coupon2 = Coupon::fixed('LESS15', 1500, new DateTimeImmutable('2026-06-01'));
$coupon3 = Coupon::welcome();

if ($coupon1->getType() === Coupon::TYPE_PERCENT) {
    // ...
}

$orderValue = 12000; // 120,00 zł

if ($coupon1->canBeAppliedTo($orderValue, $today)) {
    echo $coupon1->finalPrice($orderValue); // 9600
}
```