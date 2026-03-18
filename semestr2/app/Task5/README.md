# Zadanie 5

Klasa `OrderItem` - w konstruktorze przyjmuje `string $productName`, `int $quantity` oraz `int $price` (cena w groszach). Dodaj konstruktor i zaimplementuj metodę `getTotalPrice(): int`, która zwróci wartość pozycji (cena * ilość).

Klasa `Order` - w konstruktorze przyjmuje `string $number`. Dodaj konstruktor i zaimplementuj metody:
* `addItem(): void`, która dodaje pozycję (`OrderItem`) do zamówienia
* `getShippingCost(): int`, która zwróci kosz dostawy, dostawa jest darmowa dla zamówień na kwotę >= 150 zł, w przeciwnym wypadku wynosi 15 zł
* `calculateItemsTotal(): int`, która zwróci sumę zamówienia bez kosztów dostawy
* `calculateGrandTotal(): int`, która zwróci całkowitą sumę zamówienia (items + dostawa)

Przykład użycia:
```php
$item = new OrderItem('Monitor Lenovo', 2, 300000);
$item->getTotalPrice(); // 600000

$order = new Order('ORD-019');
$order->addItem(new OrderItem('Głośnik', 2, 50000));
$order->calculateItemsTotal(); // 100000
$order->getShippingCost(); // 0
$order->calculateGrandTotal(); // 100000
```