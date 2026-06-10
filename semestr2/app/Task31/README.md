# Zadanie 31

W systemie e-commerce ceny przechowujemy jako obiekty `Money`.  
Przeliczanie walut realizuje osobna klasa dostawcy kursów (symulacja NBP API) z cache statycznym.  
Walidacja danych finansowych ma być wydzielona do osobnej klasy.

## Money

Klasa reprezentuje kwotę w konkretnej walucie.

### Właściwości
- `amount` (int, kwota w najmniejszej jednostce, np. grosze/centy)
- `currency` (string, kod waluty)

### Konstruktor
`__construct(int $amount, string $currency)`

- Konstruktor **nie wykonuje walidacji samodzielnie**.
- Ma delegować walidację do `MoneyValidator`.

### Metody
- `public function getAmount(): int`
- `public function getCurrency(): string`
- `public function equals(Money $other): bool`
- `public function __toString(): string`

Format `__toString()`:
- ma zwracać kwotę w **jednostkach nominalnych** (`amount / 100`)
- dokładnie 2 miejsca po przecinku
- separator dziesiętny: `.`
- format końcowy: `"{nominalAmount} {currency}"`

Przykłady:
- `12999` + `PLN` -> `"129.99 PLN"`
- `500` + `EUR` -> `"5.00 EUR"`
- `0` + `USD` -> `"0.00 USD"`

## MoneyValidator

Osobna klasa odpowiedzialna za walidację danych pieniężnych.

### Stałe
- `ALLOWED_CURRENCIES = ['PLN', 'EUR', 'USD', 'GBP']`

### Metody statyczne
- `public static function validateAmount(int $amount): void`
  - kwota musi być `>= 0`
  - w przeciwnym razie `\InvalidArgumentException`
- `public static function validateCurrency(string $currency): void`
  - waluta musi być na liście `ALLOWED_CURRENCIES`
  - w przeciwnym razie `\InvalidArgumentException`
- `public static function isCurrencySupported(string $currency): bool`
  - zwraca `true/false`
- `public static function validate(int $amount, string $currency): void`
  - metoda pomocnicza, wywołuje obie walidacje

## ExchangeRateProvider

Klasa odpowiada za pobieranie kursów i ich cache.

### Stałe i pola statyczne
- `private const MOCK_NBP_TABLE = [...]`  
  (symulacja kursów NBP; tabela klucz -> kurs)
- `private static array $rateCache = [];`  
  klucz: `"{from}_{to}"`, wartość: `float`
- `private static int $apiCallsCount = 0;`
- `private static int $cacheHitsCount = 0;`

### Wymagane kursy w `MOCK_NBP_TABLE`
Dodaj przynajmniej:
- `PLN_EUR => 0.23`
- `PLN_USD => 0.25`
- `PLN_GBP => 0.20`
- `EUR_PLN => 4.35`
- `USD_PLN => 4.00`
- `GBP_PLN => 5.00`

### Zasady liczenia statystyk
- `api_calls` zwiększa się **tylko wtedy**, gdy kurs **nie był** w cache i został pobrany z `MOCK_NBP_TABLE`.
- `cache_hits` zwiększa się **tylko wtedy**, gdy kurs został znaleziony w `rateCache`.
- Dla przypadku `from === to` (kurs `1.0`) **nie zwiększaj** ani `api_calls`, ani `cache_hits`.

### Metody
- `public static function getRate(string $from, string $to): float`
  - waliduje waluty przez `MoneyValidator::isCurrencySupported()`
  - jeśli `from === to`, zwraca `1.0`
  - najpierw sprawdza cache:
    - jeśli trafienie: zwiększa `cacheHitsCount` i zwraca kurs
  - jeśli kursu nie ma w cache:
    - pobiera z `MOCK_NBP_TABLE`,
    - zapisuje do cache,
    - zwiększa `apiCallsCount`
  - jeśli kurs nie istnieje w tabeli: rzuć `\OutOfBoundsException`
- `public static function convert(Money $money, string $targetCurrency): Money`
  - waliduje walutę docelową
  - pobiera kurs przez `getRate()`
  - oblicza nową kwotę jako `round(amount * rate)` i zwraca nowy obiekt `Money`
- `public static function clearCache(): void`
  - czyści tylko `rateCache`
  - **nie zeruje** liczników `apiCallsCount` i `cacheHitsCount`
- `public static function getCacheStats(): array`  
  zwraca:
  ```php
  [
      'cache_hits' => int,
      'api_calls' => int,
  ]
  ```
- `public static function resetStats(): void`
  - czyści cache
  - zeruje `apiCallsCount`
  - zeruje `cacheHitsCount`

## Przykład użycia

```php
ExchangeRateProvider::resetStats();

$price = new Money(12999, 'PLN');

$eur1 = ExchangeRateProvider::convert($price, 'EUR'); // miss -> api_calls +1
$eur2 = ExchangeRateProvider::convert($price, 'EUR'); // hit  -> cache_hits +1

echo $price; // "129.99 PLN"
echo $eur1;  // np. "29.89 EUR"

print_r(ExchangeRateProvider::getCacheStats());
// ['cache_hits' => 1, 'api_calls' => 1]
```