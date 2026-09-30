FROM dunglas/frankenphp:latest-php8.2

# Ekstensi PHP untuk MySQL + zip (dibutuhkan Composer untuk mengekstrak paket)
# Source apt dialihkan ke HTTPS untuk menghindari 403 dari CDN Debian
RUN find /etc/apt -name '*.sources' -o -name 'sources.list' \
    | xargs -r sed -ri 's|http://deb\.debian\.org|https://deb.debian.org|g' \
    && install-php-extensions pdo_mysql zip

# Composer tersedia di dalam container (tidak perlu install Composer di laptop)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

# Dependensi PHP dipasang saat build, sehingga vendor/ ikut ke dalam image
# (rekan setim yang baru clone repo tidak perlu composer install manual)
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-progress --no-scripts --optimize-autoloader

# Kode aplikasi (saat dev, host menimpanya lewat volume .:/app)
COPY . .
