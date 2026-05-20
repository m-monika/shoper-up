# Zadanie 29
Dodajemy mechanizm rabatowania do systemu e-commerce. Rabat może dotyczyć pojedynczego produktu lub całego koszyka. Aby uniknąć duplikacji kodu, wykorzystaj Trait.
Wartość rabatu może wynosić od 0% do 100%, w przeciwnym razie aplikacja powinna rzucić wyjątek: `\InvalidArgumentException`.

## Discountable
zaimplementuj metody:
- `applyDiscount(int $percent): void` - ustawia wartość rabatu w procentach, sprawdzając, czy jest ona poprawna (0-100). Jeśli wartość jest niepoprawna, rzuca wyjątek `\InvalidArgumentException`.
- `calculatePriceWithDiscount(float $price): float` - oblicza cenę po zastosowaniu rabatu na podstawie oryginalnej ceny.

## Product
zaimplementuj metodę `getFinalPrice(): float`, która zwraca cenę produktu po zastosowaniu rabatu.

## Basket
zaimplementuj metody:
- `getTotalPrice(): float` - oblicza łączną cenę wszystkich produktów w koszyku (uwzględniająć rabaty na poszczególnych produktach).
- `getFinalPrice(): float` - oblicza cenę całego koszyka po zastosowaniu rabatu na koszyk.