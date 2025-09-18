# Przydatne polecenia GIT

- `git add` - dodanie pliku / plików do `stage`
- `git commit -m "wiadomość opisująca commit"` - dodanie plików do history
- `git push` - wysłanie history do zdalnego repozytorium
- `git pull` - pobranie plików ze zdalnego repozytorium
- `git checkout NAZWA_BRANCHA` - zmiana gałęzi na której pracyjemy
- `git checkout -b NAZWA_BRANCHA` - utworzenie nowej gałęzi
- `git status` - sprawdzenie aktualnych zmian
- `git log --pretty=oneline` - sprawdzenie historii
- `git clone REPOZYTORIUM` - sklonowanie na lokalny komputer zdalnego repozytorium

## FLOW

Flow od momentu rozpoczęcia kursu:

### Klonujemy zdalne repozytorium

W tym momencie kopiujemy zdalne repozytorium na nasz komputer

```bash
git clone https://github.com/m-monika/shoper-up.git
```

### Tworzymy nową gałąź

W tym momenciu mamy pobraną najnowszą wersję tego repozytorium - i znajdujemy się na gałęzi `main`.
Tworzymy gałaź o swoim imieniu i nazwisku (bez polskich znaków - w dalszej części dokumentacji będzie ta gałąź nazwana `NAZWA_BRANCHA`). 

To będzie Twoja główna gałąź na cały etap trwania kursu. Przykład:

```bash
git checkout -b monika.mlodzik
```

### Robimy zmianę

Przykładowo - zmieniamy plik `tasks/zadanie_1.php` oraz `tasks/zadanie_2.php`
W tym momencie lokalnie mamy zmienione dwa pliki, które są zmienione tylko lokalnie,
aby posłać je do repozytorium zdalnego musimy je:

1. dodać do `stage`
2. dodajemy pliki do `history`
3. Wysyłamy zmiany na zdalne repozytorium na naszą gałąź

```bash
git add tasks/zadanie_1.php
git add tasks/zadanie_2.php
git commit -m "Wykonanie zadania 1 oraz 2"
git push origin NAZWA_BRANCHA
```

### Pobieranie zmian

W momencie, gdy zostały wprowadzone zmiany na Twojej gałęzi na zdalnym repozytorium należy pobrać zmiany

```bash
git pull origin NAZWA_BRANCHA
```
