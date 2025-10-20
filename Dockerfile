# Gunakan PHP 8.3 dengan FPM
FROM php:8.3-fpm

# Install ekstensi dan utilitas yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install dependensi PHP
RUN composer install --no-dev --optimize-autoloader

# Build aset frontend jika kamu punya package.json
RUN if [ -f package.json ]; then npm install && npm run build; fi

# Set permission storage dan bootstrap
RUN chmod -R 775 storage bootstrap/cache

# Jalankan server Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}

EXPOSE 8000
