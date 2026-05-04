#!/bin/bash

# Utwórz plik .env na podstawie .env.default jeśli nie istnieje
if [ ! -f semestr2/.env ]; then
  if [ -f semestr2/.env.default ]; then
    cp semestr2/.env.default semestr2/.env
    echo "Utworzono plik .env na podstawie .env.default"
  else
    echo "UWAGA: Brak pliku semestr2/.env.default – nie można utworzyć .env"
  fi
fi

# Sprawdź czy kontener php-shoper-up jest uruchomiony
if docker compose ps | grep -q 'php-shoper-up.*Up'; then
  echo "Zatrzymuję działający kontener php-shoper-up..."
  docker compose stop php-shoper-up
  docker compose rm -f php-shoper-up
fi

echo "Buduję i uruchamiam kontener php-shoper-up..."
docker compose up -d php-shoper-up --build

# Instalacja zależności composer w kontenerze
docker compose exec -u 0 php-shoper-up bash -c "cd /app/semestr2 && php bin/composer install && chown -R 1000:1000 /app/semestr2/vendor"

# Usuń plik pre-commit tylko jeśli istnieje
if [ -f .git/hooks/pre-commit ]; then
  rm .git/hooks/pre-commit
fi

mkdir -p .git/hooks
cp git/pre-commit .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit

if [ "$(id -u)" -eq 0 ]; then
  chown $(id -u):$(id -g) .git/hooks/pre-commit
fi
