#!/usr/bin/env bash
set -euo pipefail

APP_KEY_FILE="/var/www/html/storage/app/.app_key"

mkdir -p \
    /var/www/html/storage/app/public \
    /var/www/html/storage/framework/cache/data \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/testing \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/logs \
    /var/www/html/bootstrap/cache

if [ -z "${APP_KEY:-}" ]; then
    if [ -f "$APP_KEY_FILE" ]; then
        export APP_KEY="$(cat "$APP_KEY_FILE")"
    else
        export APP_KEY="$(php artisan key:generate --show --no-ansi)"
        printf '%s' "$APP_KEY" > "$APP_KEY_FILE"
    fi
fi

echo "Waiting for database..."
until php -r '
$host = getenv("DB_HOST") ?: "mysql";
$port = getenv("DB_PORT") ?: "3306";
$database = getenv("DB_DATABASE") ?: "erp_app";
$username = getenv("DB_USERNAME") ?: "erp_user";
$password = getenv("DB_PASSWORD") ?: "erp_password";
try {
    new PDO("mysql:host={$host};port={$port};dbname={$database}", $username, $password);
    exit(0);
} catch (Throwable $e) {
    exit(1);
}
'; do
    sleep 2
done

php artisan config:clear --no-ansi
php artisan migrate --force --no-interaction --no-ansi

if php -r '
require "/var/www/html/vendor/autoload.php";
$app = require "/var/www/html/bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
exit(Illuminate\Support\Facades\DB::table("roles")->exists() ? 0 : 1);
'; then
    echo "Database already seeded."
else
    php artisan db:seed --force --no-interaction --no-ansi
fi

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
