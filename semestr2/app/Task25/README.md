# Zadanie 25

1. W pliku `task25.php` napisz kod, który będzie korzystał ze zmiennej globalnej `API_URL` oraz `API_TOKEN` (patrz [curl.php](../../curl.php)).
2. W pliku napisz kod, który będze pobierał z parametru $_GET['id'] id strony informacyjnej.
3. Jeśli parametr nie został podany należy wyświetlić komunikat, że parametr jest wymagany.
4. Następnie należy wykonać usunięcie strony informacyjnej o podanym ID w sklepie za pomocą API.

**http://localhost:8000/semestr2/task25.php?id=5** - po wejściu na ten link powinno wyświetlić odpowiedź z API.

[Dokumentacja](https://developers.shoper.pl/developers/api/resources/aboutpages/delete)