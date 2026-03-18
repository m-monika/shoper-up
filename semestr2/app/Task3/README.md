# Zadanie 3

Klasa `Money` - w konstruktorze przyjmuje `int $amount` (kwota w groszach) oraz `string $currency` (kod waluty, np. 'PLN', 'EUR', 'USD', domyślnie 'PLN'). Dodaj konstruktor i zaimplementuj metodę `getFormatted(): string`, która zwróci czytelną kwotę z walutą (np. "150,00 PLN").

Klasa `Product` - w konstruktorze przyjmuje `string $name` oraz obiekt klasy `Money` jako `$price`. Dodaj konstruktor i zaimplementuj metody:
* `getName(): string`, która zwraca nazwę produktu
* `getFormattedPrice(): string`, która zwraca sformatowaną cenę produktu

Przykład użycia:
```php
$price = new Money(35000);
$formattedPrice = $price->getFormatted(); // 350,00 PLN
$product = new Product('Logitech MX Master', $price);
$productName = $product->getName(); // Logitech MX Master
$productPrice = $product->getFormattedPrice(); // 350,00 PLN
```