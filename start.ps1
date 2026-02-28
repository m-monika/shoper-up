# Sprawdź czy kontener php-shoper-up jest uruchomiony
docker compose ps | Select-String 'php-shoper-up.*Up' | ForEach-Object {
    Write-Host "Zatrzymuję działający kontener php-shoper-up..."
    docker compose stop php-shoper-up
    docker compose rm -f php-shoper-up
}

Write-Host "Buduję i uruchamiam kontener php-shoper-up..."
docker compose up -d php-shoper-up --build

# Instalacja zależności composer w kontenerze
docker compose exec -u 0 php-shoper-up bash -c "cd /app/semestr2 && php bin/composer install && chown -R 1000:1000 /app/semestr2/vendor"

# Usuń plik pre-commit tylko jeśli istnieje
$preCommit = ".git/hooks/pre-commit"
if (Test-Path $preCommit) {
    Remove-Item $preCommit
}

# Utwórz katalog .git/hooks jeśli nie istnieje
if (!(Test-Path ".git/hooks")) {
    New-Item -ItemType Directory -Path ".git/hooks" | Out-Null
}

# Skopiuj plik pre-commit
if (Test-Path "git/pre-commit") {
    Copy-Item "git/pre-commit" $preCommit
    # Ustaw plik jako nie tylko do odczytu (atrybut wykonywalności w Windows nie jest wymagany)
    attrib -r $preCommit
}
# chown nie jest wymagany na Windows
