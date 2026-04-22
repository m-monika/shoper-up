# Zadanie 15

1. Stwórz moduł własny na sklepie, a następnie poniżej w sekcji Rozwiązanie wpisz nazwę modułu oraz link do strony sklepu na którym ten moduł został umieszczony.
2. Moduł powinien mieć: TWIG, konfiguracje, JS oraz tłumaczenia.
3. Dodaj własną konfigurację w zakładce `Kolory i style (Skinstore)`.
4. W `SVE` uzupełnij wartości dla nowo dodanej konfiguracji.
5. W Module własnym oraz w zakładce `Własny styl CSS` należy użyć wartości konfiguracji z `Style` z SVE. Czyli styli systemowych oraz zdefiniowanych w skórce.

```less
header { background-color:@skin_colorOfHeader; } /* variable from theme */
footer { background-color:@primaryColor; } /* variable from system */
:root {
  --skin_colorOfHeader: @skin_colorOfHeader;
}
```

```twig
<p style="background: var(--primaryColor);">
       variable from system
</p>
<p style="background: var(--skin_colorOfHeader);">
       variable from theme
</p>
```

## Linki:

- [Kolory i style](https://storefront.developers.shoper.pl/sve/#colors-and-styles)
- [Systemowo dostępne kolory i style](https://storefront.developers.shoper.pl/sve/style-system-configuration/)

## Rozwiązanie:

Nazwa modułu: ...
Link do sklepu z umieszczonym modułem: ...