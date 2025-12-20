<?php

/*
Otrzymujesz JSON-a z danymi klientów z systemu X, które trzeba zaimportować do systemu Y.
Twoim zadaniem jest przetworzenie tej listy, normalizacja danych (naprawienie błędów formatowania), walidacja i odrzucenie rekordów, które są niekompletne.
Musisz też wygenerować raport końcowy, który powie, ilu użytkowników udało się zaimportować, a ilu odrzucono i dlaczego.
Raport powinien być w formacie json.

Normalizacja:
- first_name, last_name - usuwamy białe znaki z początku i końca, pierwsza litera wielka, pozostałe litery małe
- email - usuwamy białe znaki z początku i końca, małe litery
- phone - zaczyna się od +48, potem same cyfry
- type - w systemie X to int, w systemie Y to string (standard, vip), musimy zmienić stringa na inta:
    1 -> standard
    2 -> vip
    każda inna wartość lub brak wartości -> standard

Walidacja:
- first_name, last_name - min. 2 znaki
- email - poprawny adres email (filter_var)
- phone - zaczyna się od +48, następnie 9 cyfr
- type - standard lub vip
w przypadku niepoprawnej walidacji zwracamy komunikat "Invalid field"

Dane wejściowe:
string $clientsJson- string w formacie json zawierający dane klientów do zaimportowania

Przykład:
[
  {
    "first_name": "  ADAM ",
    "last_name": "Nowak",
    "email": "Adam.Nowak@example.com",
    "phone": "500-123-456"
  },
  {
    "first_name": "Ewa",
    "last_name": "",
    "email": "bledny-email",
    "phone": "600123456",
    "type": 1
  },
  {
    "first_name": "Piotr",
    "last_name": "Kowalski",
    "email": "piotr.k@example.com",
    "phone": "+48 700 123 456",
    "type": 2
  }
]
przekazany w formie:
$clientsJson = '[{"first_name":"  ADAM ","last_name":"Nowak","email":"Adam.Nowak@example.com","phone":"500-123-456"},{"first_name":"Ewa","last_name":"","email":"bledny-email","phone":"600123456","type":1},{"first_name":"Piotr","last_name":"Kowalski","email":"piotr.k@example.com","phone":"+48 700 123 456","type":2},{"first_name":"Pawe\u0142","last_name":"NOWAK ","email":"pawelnowakk@example.com","phone":"+90 700 123 456","type":1}]';

Oczekiwany rezultat (raport) składający się z części:
- summary - zawiera informacje o całkowitej liczbie przetworzonych rekordów oraz o liczbie rekordów przetworzonych pozytywnie i negatywnie
- details - zawiera wyniki dla każdego wiersza:
    status oraz znormalizowane dane klienta (w przypadku walidacji pozytywnej)
    status, listę błędów oraz dane wejściowe klienta (w przypadku walidacji negatywnej)
o następującej strukturze (json):
{
  "summary": {
    "total": 4,
    "success": 2,
    "error": 2
  },
  "details": [
    {
      "status": "success",
      "data": {
        "first_name": "Adam",
        "last_name": "Nowak",
        "email": "adam.nowak@example.com",
        "phone": "+48500123456",
        "type": "standard"
      }
    },
    {
      "status": "error",
      "errors": {
        "email": "Invalid field",
        "last_name": "Invalid field"
      },
      "data": {
        "first_name": "Ewa",
        "last_name": "",
        "email": "bledny-email",
        "phone": "600123456",
        "type": 1
      }
    },
    {
      "status": "success",
      "data": {
        "first_name": "Piotr",
        "last_name": "Kowalski",
        "email": "piotr.k@example.com",
        "phone": "+48700123456",
        "type": "vip"
      }
    },
    {
      "status": "error",
      "errors": {
        "phone": "Invalid field"
      },
      "data": {
        "first_name": "Paweł",
        "last_name": "NOWAK ",
        "email": "pawelnowakk@example.com",
        "phone": "+90 700 123 456",
        "type": 1
      }
    }
  ]
}

zwrócony w formie:
{"summary":{"total":4,"success":2,"error":2},"details":[{"status":"success","data":{"first_name":"Adam","last_name":"Nowak","email":"adam.nowak@example.com","phone":"+48500123456","type":"standard"}},{"status":"error","errors":{"email":"Invalid field","last_name":"Invalid field"},"data":{"first_name":"Ewa","last_name":"","email":"bledny-email","phone":"600123456","type":1}},{"status":"success","data":{"first_name":"Piotr","last_name":"Kowalski","email":"piotr.k@example.com","phone":"+48700123456","type":"vip"}},{"status":"error","errors":{"phone":"Invalid field"},"data":{"first_name":"Pawe\u0142","last_name":"NOWAK ","email":"pawelnowakk@example.com","phone":"+90 700 123 456","type":1}}]}
*/

$clientsJson = $params[0]; // tej linijki nie ruszamy :)
