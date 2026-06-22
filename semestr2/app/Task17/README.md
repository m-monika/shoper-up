# Zadanie 17

1. Stwórz moduł własny na sklepie, a następnie poniżej w sekcji Rozwiązanie wpisz nazwę modułu oraz link do strony sklepu na którym ten moduł został umieszczony.
2. Moduł powinien mieć: TWIG, konfiguracje, JS oraz tłumaczenia.
3. **ZMIEŃ** poniższą konfigurację modułu.
4. W konfiguracji dodaj po `Slide description` [checkbox](https://storefront.developers.shoper.pl/sve/elements/checkbox/) o nazwie `Add button?`.
5. W konfiguracji przesuń kontrolki `Button text` oraz `Target URL`, aby były [dziećmi](https://storefront.developers.shoper.pl/sve/configuration/#children) kontrolki `Add button?`.
6. W konfiguracji dodaj [relację](https://storefront.developers.shoper.pl/sve/configuration/#relations) tak aby `Button text` oraz `Target URL` pojawiały się tylko jeśli `Add button?` będzie zaznaczone.
7. Dopisz tłumaczenia do każdego labela w języku polskim oraz angielskim.
8. Dopisz `Twig` tak, aby wyświetlił wszystkie dodane obrazki razem z tytułem, opisem i przyciskiem który będzie kierował na podany link (o ile zaznaczone `Add button?`).

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

## Inspiracje:

### Przykładowe moduły per kontrolki:

- [CategorySelector](https://storefront.developers.shoper.pl/sve/elements/category-selector/#example-of-module)
- [ImageList](https://storefront.developers.shoper.pl/sve/elements/image-list/#example-of-module)
- [inne...](https://storefront.developers.shoper.pl/sve/configuration/#available-element-types)

### Przykładowe moduły Storefront

- [blog_article_title](https://storefront.developers.shoper.pl/modules/blog/blog-article-title/#module-source-code)
- [contact_form](https://storefront.developers.shoper.pl/modules/contact-form/)
- [inne...](https://storefront.developers.shoper.pl/modules/#modules-reference)

## Rozwiązanie:

Nazwa modułu: Zadanie 17
[Link do sklepu z umieszczonym modułem: ...](https://sklep695436.shoparena.pl/)