#!/bin/bash

# Sprawdź czy kontener php-shoper-up jest uruchomiony
if docker compose ps | grep -q 'php-shoper-up.*Up'; then
  echo "Kontener php-shoper-up jest już uruchomiony."
else
  echo "Kontener php-shoper-up nie jest uruchomiony. Uruchamiam start.sh..."
  ./start.sh
fi

echo "Odświeżam autoloader composera w kontenerze..."
docker compose exec php-shoper-up /bin/bash -c "cd /app/semestr2 && ./bin/composer dump-autoload && ./bin/composer clear-cache"

if [[ $# -eq 1 && $1 =~ ^[0-9]+$ ]]; then
  TEST_DIR="/app/semestr2/tests/Task$1"
  echo "Uruchamiam testy z katalogu: $TEST_DIR"
  docker compose exec -T php-shoper-up /app/semestr2/vendor/bin/phpunit --colors=always "$TEST_DIR"
else
  echo "Uruchamiam całą pulę testów."
  docker compose exec -T php-shoper-up /app/semestr2/vendor/bin/phpunit --colors=always /app/semestr2/tests
fi
