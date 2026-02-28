# Zadanie 2

Klasa Basket - reprezentuje koszyk zakupowy.
Klasa ma metodę addProduct do dodawania produktów do koszyka oraz metodę getSum do obliczania łącznej kwoty do zapłaty.
Metoda addProduct powinna przyjmować obiekt klasy Product, który zawiera informacje o produkcie: nazwę, cenę.

Przykład użycia:

```php
$product = new Product('Chleb', 8);
$basket = new Basket();
$basket->addProduct($product);
```

Zmień kod klasy Basket tak, aby metoda addProduct przyjmowała obiekt klasy Product i dodawała go do koszyka.
Następnie zaimplementuj metodę getSum, która oblicza łączną kwotę do zapłaty na podstawie dodanych produktów.
