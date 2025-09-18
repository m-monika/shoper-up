# shoper-up

1. [Wymagania](#wymagania)
    1. [GIT](#git)
    2. [GitHub](#github)
    3. [Visual Studio Code](#visual-studio-code)
    4. [Docker](#docker)
2. [Zadania](#zadania)
3. [Materiały do lekcji](./lessons/lessons.md)

------------------

## Wymagania

### GIT

[Instalacja](https://git-scm.com/downloads)

W przypadku problemów skorzystaj z [ChatGPT](https://chatgpt.com) i wpisz np. `Jak zainstalować GIT na Windows?`

#### MacOS

```bash title="MacOS"
brew install git
git --version
```

#### Windows

Pobieramy plik instalacyjny ze strony i go uruchamiamy. Następnie otwieramy PowerShell* i wpisujemy

```bash
git --version
```

*PowerShell - monażna otworzyć:
1. Kliknij przycisk Start (ikona Windows w lewym dolnym rogu).
2. Wpisz PowerShell.
3. Wybierz Windows PowerShell z listy.

### GitHub

1. Zakładamy darmowe konto na stronie [GitHub](https://github.com)
2. Dla wygody można podpiąć klucze SSH według [instrukcji](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account)

Jeśli z krok 2 będzie problematyczny, możesz skorzystać z pomocy ChatGPT wpisując:

> Jak wygenerować klucz SSH na Windows, a następnie podpiąć je pod konto na GitHub krok po kroku

### Visual Studio Code

Darmowe narzędzie do edytowania kodu

[Instalacja](https://code.visualstudio.com)

### Docker

[Instalacja](https://www.docker.com/products/docker-desktop/)

Po instalacji otwieramy `Terminal` / `PowerShell`

```bash
cd shoper-up
docker compose up
```

[localhost:8000](http://localhost:8000)

## Zadania

Zadania umieszczamy w katalogu `tasks` pod nazwą `zadanie_NUMER_ZADANIA.php`.

Weryfikujemy zadanie poprzez uruchomienie Docker'a, a następnie sprawdzenie zadania poprzez wpisanie:

```bash
docker exec -it php-shoper-up php tests.php NUMER_ZADANIA
```