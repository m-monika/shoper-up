# Zadanie 9

W tym zadaniu stworzysz system filtrowania produktów według ceny, wykorzystując różne strategie filtrowania implementujące wspólny interfejs.

1. Utwórz w katalogu Filters interfejs o nazwie `PriceFilterInterface`
2. Interfejs powinien mieć zdefiniowaną metodę - `filter(array $products, int $filterPrice): array` - filtruje produkty według ceny i zwraca przefiltrowaną tablicę
3. W katalogu Filters utwórz 4 klasy: `GreaterThanFilter`, `GreaterThanOrEqualFilter`, `LessThanFilter` oraz `LessThanOrEqualFilter`.
4. Wszystkie te 4 klasy powinny implementować interfejs.
5. Klasy powinny zawierać metodę filter z odpowiednią logiką:

- `GreaterThanOrEqualFilter` - Metoda `filter()` zwraca produkty, których cena jest **większa lub równa** `$filterPrice`.
- `GreaterThanFilter` - Metoda `filter()` zwraca produkty, których cena jest **większa** niż `$filterPrice`.
- `LessThanOrEqualFilter` - Metoda `filter()` zwraca produkty, których cena jest **mniejsza lub równa** `$filterPrice`.
- `LessThanFilter` - Metoda `filter()` zwraca produkty, których cena jest **mniejsza** niż `$filterPrice`.

## Klasa `ProductCollection`

* `addProduct(string $name, int $price): void` - dodaje produkt do kolekcji. `$price` jest w groszach.
* `filter(int $filterPrice, PriceFilterInterface $filter): array` - filtruje produkty używając przekazanego filtra i zwraca tablicę produktów. Każdy produkt to tablica asocjacyjna z kluczami:
  - `'name'` - nazwa produktu
  - `'price'` - cena w groszach
* `getProducts(): array` - zwraca wszystkie produkty

------

## Testy

```bash title="Linux & MacBook"
./tests.sh 9
```

```bash title="Windows"
.\tests.ps1 9
```

## Przykład użycia

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Task9\ProductCollection;
use App\Task9\Filters\GreaterThanOrEqualFilter;
use App\Task9\Filters\LessThanFilter;

// Tworzenie kolekcji i dodawanie produktów
$collection = new ProductCollection();
$collection->addProduct('Laptop', 500000);      // 5000,00 zł
$collection->addProduct('Klawiatura', 40000);   // 400,00 zł
$collection->addProduct('Mysz', 35000);         // 350,00 zł
$collection->addProduct('Monitor', 400000);     // 4000,00 zł

// Filtrowanie: cena >= 200000 (2000 zł)
$gteFilter = new GreaterThanOrEqualFilter();
$expensiveProducts = $collection->filter(200000, $gteFilter);

print_r($expensiveProducts);
// Zwróci: Laptop (500000) i Monitor (400000)

// Filtrowanie: cena < 100000 (1000 zł)
$ltFilter = new LessThanFilter();
$cheapProducts = $collection->filter(100000, $ltFilter);

print_r($cheapProducts);
// Zwróci: Klawiatura (40000) i Mysz (35000)
```