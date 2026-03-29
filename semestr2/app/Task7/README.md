# Zadanie 7

## Część 1

### 1. Interfejs `DiscountStrategyInterface`

Namespace: `App\Task7\Discounts`

Zdefiniuj interfejs z metodą:

* `calculate(float $totalAmount): float` - oblicza kwotę po zastosowaniu rabatu

### 2. Klasy implementujące interfejs

Dodaj interfejs dla `PercentageDiscount`, `FixedAmountDiscount`, `NoDiscount`.

### Testy

```bash title="Linux & MacBook"
./tests.sh 7
```

```bash title="Windows"
.\tests.ps1 7
```

## Część 2: Implementacja w task7.php

W pliku `semestr2/task7.php`:

1. Załaduj plik `vendor/autoload.php`
2. Zaimportuj klasy używając `use`
3. Stwórz dwa koszyki:
   - Jeden z rabatem procentowym (np. 20% - `PercentageDiscount`)
   - Drugi z rabatem stałym (np. 50 zł - `FixedAmountDiscount`)
   - Trzeci bez rabatu (`NoDiscount`)
4. Dodaj produkty do koszyków
5. Wyświetl wyniki (produkty `getItems`, suma przed rabatem `getTotalBeforeDiscount`, suma po rabacie `getTotalAfterDiscount`)

### Przykład użycia

```php
<?php

// ...

// Koszyk z rabatem 20%
$percentageDiscount = new PercentageDiscount(20);
$cart1 = new ShoppingCart($percentageDiscount);
$cart1->addItem('Laptop', 3000.00);
$cart1->addItem('Mysz', 150.00);

echo "Przed rabatem: " . $cart1->getTotalBeforeDiscount() . " zł\n";
echo "Po rabacie: " . $cart1->getTotalAfterDiscount() . " zł\n";
```

### Oczekiwany wynik

```
Koszyk z rabatem 20%:
Przed rabatem: 3150 zł
Po rabacie: 2520 zł
```

### Sprawdzenie

Po zaimplementowaniu klas wejdź na:

**http://localhost:8000/semestr2/task7.php**
