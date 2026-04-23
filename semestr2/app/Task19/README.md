# Zadanie 19

1. Stwórz moduł własny na sklepie, a następnie poniżej w sekcji Rozwiązanie wpisz nazwę modułu oraz link do strony sklepu na którym ten moduł został umieszczony.
2. Moduł powinien mieć: TWIG, konfiguracje, JS oraz tłumaczenia.
3. **ZMIEŃ** poniższą konfigurację modułu.
4. Zmień konfigurację tak, aby `Slide title` można było tłumaczyć dla różnych języków (w SVE zmieniając język).
5. Dopisz `Twig` tak, aby wyświetlił wszystkie dodane obrazki razem z tytułem, opisem i przyciskiem który będzie kierował na podany link (o ile zaznaczone `Add button`).
6. Dodaj w SVE tłumaczenia dla `Slide title` w języku polskim oraz angielskim.

- [tłumaczenia](https://storefront.developers.shoper.pl/sve/configuration/#supportstranslations)
- [repeater](https://storefront.developers.shoper.pl/sve/elements/repeater/#elements)

## Konfiguracja modułu

```json
[
  {
    "label": "Slider slides",
    "state": "unfolded",
    "elements": [
      {
        "type": "repeater",
        "name": "slides",
        "label": "Slides",
        "options": {
          "defaultGroupLabel": "Slide",
          "minActiveGroups": 1,
          "maxActiveGroups": 5,
          "elements": [
            {
              "type": "imageUpload",
              "name": "image",
              "label": "Slide background",
              "isRequired": true,
              "options": {
                "requireImageSize": true,
                "allowedExtensions": ["webp", "jpg", "png"]
              }
            },
            {
              "type": "text",
              "name": "title",
              "label": "Slide title"
            },
            {
              "type": "textarea",
              "name": "description",
              "label": "Slide description"
            },
            {
              "type": "text",
              "name": "buttonLabel",
              "label": "Button text"
            },
            {
              "type": "text",
              "name": "url",
              "label": "Target URL"
            }
          ]
        }
      }
    ]
  }
]
```

## Rozwiązanie:

Nazwa modułu: ...
Link do sklepu z umieszczonym modułem: ...