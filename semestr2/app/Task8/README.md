# Zadanie 8

## 1. Klasa `Product`

* `string $name` - nazwa produktu
* `float $price` - cena produktu
* `getName(): string` - zwraca nazwę produktu
* `getPrice(): float` - zwraca cenę produktu

## 2. Interfejs `CouponInterface`

* `applyDiscount(float $totalAmount): float` - oblicza kwotę po zastosowaniu rabatu

## 3. Klasy implementujące interfejs

- `PercentageCoupon` - Konstruktor przyjmuje `float $percentage` (procent rabatu, np. 10 dla 10%).
-  `FixedAmountCoupon` - Konstruktor przyjmuje `float $discountAmount` (stała kwota rabatu).

## 4. Klasa `Basket`

Namespace: `App\Task8`

Zaimplementuj metody:
* `addProduct(Product $product, int $quantity): void` - dodaje produkt do koszyka z określoną ilością. Jeśli produkt już istnieje, zwiększ jego ilość.
* `applyCoupon(CouponInterface $coupon): void` - dodaje kod rabatowy do koszyka. Nowy kod zastępuje poprzedni.
* `getProducts(): array` - zwraca tablicę produktów. Każdy element to tablica asocjacyjna z kluczami:
  - `'product'` - obiekt Product
  - `'quantity'` - ilość produktu
* `getTotalWithoutDiscount(): float` - zwraca sumę kosztów wszystkich produktów (cena × ilość)
* `getTotalWithDiscount(): float` - zwraca sumę po zastosowaniu kodu rabatowego (jeśli został dodany). Jeśli nie ma kodu, zwraca taką samą wartość jak `getTotalWithoutDiscount()`

## Ważne zasady

1. **Kody rabatowe nie łączą się** - może być aktywny tylko jeden kod na raz
2. **Nowy kod zastępuje poprzedni** - wywołanie `applyCoupon()` z nowym kodem usuwa poprzedni
3. **Dodawanie tego samego produktu** - zwiększa ilość, a nie tworzy nowego wpisu
4. **Rabat nie może dać ujemnej kwoty** - minimalna wartość to 0

### Testy

```bash title="Linux & MacBook"
./tests.sh 8
```

```bash title="Windows"
.\tests.ps1 8
```

## Przykład użycia

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Task8\Basket;
use App\Task8\Product;
use App\Task8\Coupons\PercentageCoupon;
use App\Task8\Coupons\FixedAmountCoupon;

// Tworzenie produktów
$laptop = new Product('Laptop Dell XPS', 3000.00);
$mouse = new Product('Mysz Logitech', 150.00);
$keyboard = new Product('Klawiatura', 200.00);

// Tworzenie koszyka
$cart = new Basket();
$cart->addProduct($laptop, 1);
$cart->addProduct($mouse, 2);
$cart->addProduct($keyboard, 1);

echo "Suma bez rabatu: " . $cart->getTotalWithoutDiscount() . " zł\n";
// 3000 + (150 * 2) + 200 = 3500 zł

// Dodanie kodu rabatowego 10%
$coupon = new PercentageCoupon(10);
$cart->applyCoupon($coupon);

echo "Suma z rabatem 10%: " . $cart->getTotalWithDiscount() . " zł\n";
// 3500 - 10% = 3150 zł

// Zmiana kodu rabatowego na stały 200 zł
$fixedCoupon = new FixedAmountCoupon(200);
$cart->applyCoupon($fixedCoupon);

echo "Suma z rabatem 200 zł: " . $cart->getTotalWithDiscount() . " zł\n";
// 3500 - 200 = 3300 zł

// Lista produktów
print_r($cart->getProducts());
```