web: php artisan config:cache && php artisan route:cache && php artisan migrate --force --seed && php artisan serve --host=0.0.0.0 --port=8080
build: "composer install --optimize-autoloader --no-dev && npm ci && npm run build && php artisan migrate --force --seed"
