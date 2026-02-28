# Sprawdź czy kontener php-shoper-up jest uruchomiony
$containerUp = docker compose ps | Select-String 'php-shoper-up.*Up'
if ($containerUp) {
    Write-Host "Kontener php-shoper-up jest już uruchomiony."
} else {
    Write-Host "Kontener php-shoper-up nie jest uruchomiony. Uruchamiam start.ps1..."
    .\start.ps1
}

Write-Host "Odświeżam autoloader composera w kontenerze..."
docker compose exec php-shoper-up bash -c "cd /app/semestr2 && ./bin/composer dump-autoload && ./bin/composer clear-cache"

if ($args.Count -eq 1 -and $args[0] -match '^[0-9]+$') {
    $TEST_DIR = "/app/semestr2/tests/Task$($args[0])"
    Write-Host "Uruchamiam testy z katalogu: $TEST_DIR"
    docker compose exec -T php-shoper-up /app/semestr2/vendor/bin/phpunit --colors=always $TEST_DIR
} else {
    Write-Host "Uruchamiam całą pulę testów."
    docker compose exec -T php-shoper-up /app/semestr2/vendor/bin/phpunit --colors=always /app/semestr2/tests
}

