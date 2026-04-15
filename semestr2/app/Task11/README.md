# Zadanie 11

W pliku `semestr2/task11.php`:

1. Załaduj plik `vendor/autoload.php`
2. Zaimportuj klasy z `App\Task11\Product` i `App\Task11\ProductCollection` używając `use`
3. Stwórz kolekcję produktów i dodaj do niej obiekty klasy `Product` (id + nazwa + opis + cena)
4. Dodaj obsługę `twig` i wyrenderuj szablon `semestr2/templates/task11/products.html.twig`, który pokaże produkty (lista lub tabela)
5. Kliknięcie w produkt powinno kierować na nowy widok karty produktu: `semestr2/templates/task11/product.html.twig`, który:
   * pokazuje szczegóły produktu (nazwa, opis, cena)
   * zawiera link "Powrót", który kieruje z powrotem do listy produktów
   * jeśli produkt o danym id nie istnieje, wyrenderuj szablon `semestr2/templates/task11/error.html.twig` z komunikatem błędu
6. Widoki powinny dziedziczyć ze wspólnego szablonu `semestr2/templates/task11/base.html.twig`, który definiuje bloki (które można lub trzeba nadpisać w poszczególnych widokach:
   * `title`
   * `css`
   * `content`
   * `footer`

### Linki
linki budujemy w następujące sposób:
```php
$baseUrl = 'http://localhost:8000/semestr2/task11.php';
echo $twig->render('products.html.twig', [
        'baseUrl' => $baseUrl,
        'products' => $products,
    ]);
```

```twig
<a href="{{ baseUrl }}">
<a href="{{ baseUrl }}?id=3}">
```

obsługa parametru `id` w `semestr2/task11.php`:
```php
$id = $_GET['id'] ?? null;
```

**http://localhost:8000/semestr2/task11.php**
