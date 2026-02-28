# Zadanie 1

Klasa Basket - reprezentuje koszyk zakupowy.
Klasa ma metodę addProduct do dodawania produktów do koszyka oraz metodę getSum do obliczania łącznej kwoty do zapłaty.
Metoda addProduct przyjmuje tablicę (array) z informacjami o produkcie, takimi jak nazwa, cena i ilość.

```php
$product = [
    'name' => 'Chleb',
    'price' => 800,
    'qty' => 2,
];
```

Zmień kod klasy Basket tak, aby metoda addProduct przyjmowała tablicę z informacjami o produkcie i dodawała go do koszyka. 
Następnie zaimplementuj metodę getSum, która oblicza łączną kwotę do zapłaty na podstawie dodanych produktów.
