# Zadanie 28
Mamy klasy:
- `Order` z właściwościami `weight` (waga w gramach) i `value` (wartość zamówienia w groszach)
- `ShippingMethod` (abstrakcyjna), która w konstruktorze ustawia bazowy koszt wysyłki.

Dodaj dwie klasy dziedziczące: `Courier` i `ParcelLocker`, które implementują metodę `calculateCost(Order $order): int` zgodnie z poniższymi zasadami:
- `Courier`:
    - jeśli waga zamówienia przekracza **10 kg**, za każdy rozpoczęty kilogram nadwagi naliczana jest dopłata **5 zł**
    - w przeciwnym razie zwracany jest koszt bazowy
- `ParcelLocker`:
    - jeśli waga zamówienia przekracza **25 kg**, rzuć wyjątek `\InvalidArgumentException` z dowolnym komunikatem
    - jeśli wartość zamówienia wynosi co najmniej **500 zł**, dostawa jest darmowa (zwróć `0`)
    - w pozostałych przypadkach zwróć koszt bazowy