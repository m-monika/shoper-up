# Create .env from .env.default if it does not exist
if (!(Test-Path "semestr2\.env")) {
    if (Test-Path "semestr2\.env.default") {
        Copy-Item "semestr2\.env.default" "semestr2\.env"
        Write-Host "Utworzono plik .env na podstawie .env.default"
    } else {
        Write-Host "UWAGA: Brak pliku semestr2\.env.default - nie mozna utworzyc .env"
    }
}

# Check whether the php-shoper-up container is running
docker compose ps | Select-String 'php-shoper-up.*Up' | ForEach-Object {
    Write-Host "Zatrzymuje dzialajacy kontener php-shoper-up..."
    docker compose stop php-shoper-up
    docker compose rm -f php-shoper-up
}

Write-Host "Buduje i uruchamiam kontener php-shoper-up..."
docker compose up -d php-shoper-up --build

# Install composer dependencies in the container
docker compose exec -u 0 php-shoper-up bash -c "cd /app/semestr2 && php bin/composer install && chown -R 1000:1000 /app/semestr2/vendor"

# Remove pre-commit file only if it exists
$preCommit = ".git/hooks/pre-commit"
if (Test-Path $preCommit) {
    Remove-Item $preCommit
}

# Create .git/hooks directory if it does not exist
if (!(Test-Path ".git/hooks")) {
    New-Item -ItemType Directory -Path ".git/hooks" | Out-Null
}

# Copy pre-commit file
if (Test-Path "git/pre-commit") {
    Copy-Item "git/pre-commit" $preCommit
    # Make sure the file is not read-only. Executable bit is not required on Windows.
    attrib -r $preCommit
}
# chown is not required on Windows
