# syntax=docker/dockerfile:1

# Versi runtime di-pin ke major 1 PHP 8.2 (jangan pakai `latest`).
# Ganti lewat --build-arg bila perlu upgrade terkontrol.
ARG FRANKENPHP_VERSION=1-php8.2
FROM dunglas/frankenphp:${FRANKENPHP_VERSION} AS base

# Ekstensi PHP: MySQL + zip (dibutuhkan Composer untuk mengekstrak paket)
# + gd (test membuat gambar dummy) + intl (Carbon::translatedFormat &
# Number/Number::format serta Number::fileSize agar tidak melempar
# RuntimeException di docker/phpunit) + opcache untuk produksi.
# curl dipakai HEALTHCHECK. gosu tidak diperlukan karena produksi berjalan
# langsung sebagai user `www-data`.
# Source apt dialihkan ke HTTPS untuk menghindari 403 dari CDN Debian
RUN find /etc/apt -name '*.sources' -o -name 'sources.list' \
    | xargs -r sed -ri 's|http://deb\.debian\.org|https://deb.debian.org|g' \
    && apt-get update \
    && apt-get install -y --no-install-recommends curl \
    && rm -rf /var/lib/apt/lists/* \
    && install-php-extensions pdo_mysql zip gd intl \
    && docker-php-ext-enable opcache

# Composer tersedia di dalam container (tidak perlu install Composer di laptop)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

# Dependensi PHP dipasang saat build, sehingga vendor/ ikut ke dalam image
# (rekan setim yang baru clone repo tidak perlu composer install manual)
COPY composer.json composer.lock ./

# ---------------------------------------------------------------------------
# Target development — dipakai docker-compose.yml (bind mount + dev deps).
# ---------------------------------------------------------------------------
FROM base AS development

RUN composer install --no-interaction --no-progress --no-scripts --optimize-autoloader

# Kode aplikasi (saat dev, host menimpanya lewat volume .:/app)
COPY . .

ENV SERVER_NAME=:8000

# ---------------------------------------------------------------------------
# Target produksi — dipakai docker-compose.prod.yml / Coolify.
# ---------------------------------------------------------------------------
FROM base AS vendor

# --no-dev: image produksi tidak membawa PHPUnit, Faker, Debugbar, dll.
RUN composer install --no-dev --no-interaction --no-progress --no-scripts \
    --prefer-dist --optimize-autoloader

FROM base AS production

# Default produksi yang aman. Nilai rahasia (APP_KEY, DB_*, MAIL_*, admin
# awal) WAJIB datang dari environment Coolify — jangan pernah dari image.
# Caddy di dalam FrankenPHP default menulis ke /data & /config milik root;
# arahkan ke storage aplikasi agar user non-root tidak memicu error izin.
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    LOG_STACK=stderr \
    DB_CONNECTION=mysql \
    SERVER_NAME=:8000 \
    XDG_DATA_HOME=/app/storage/framework/caddy/data \
    XDG_CONFIG_HOME=/app/storage/framework/caddy/config

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/php-prod.ini /usr/local/etc/php/conf.d/zz-app-prod.ini

RUN mkdir -p storage/app/public storage/app/private storage/framework/cache/data \
        storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
        storage/framework/caddy/data storage/framework/caddy/config \
    # public/ milik root, jadi symlink storage dibuat saat build (runtime
    # berjalan sebagai www-data dan tidak boleh menulis ke public/).
    && php artisan storage:link \
    && chmod +x /usr/local/bin/entrypoint.sh \
    && chown -R www-data:www-data storage bootstrap/cache

# Jalankan sebagai non-root. Volume bernama mewarisi kepemilikan direktori
# dari image; bind mount host perlu chown 33:33 (lihat docs/deployment-coolify.md).
USER www-data

# Port internal yang didokumentasikan; Coolify/Traefik mem-proxy ke sini.
# Port ini sengaja TIDAK di-publish ke host.
EXPOSE 8000

# GET /up adalah health route bawaan Laravel (bootstrap/app.php) — ringan,
# tanpa autentikasi, dan tidak membocorkan detail internal.
HEALTHCHECK --interval=30s --timeout=5s --start-period=40s --retries=3 \
    CMD curl -fsS http://127.0.0.1:8000/up >/dev/null || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["frankenphp", "php-server", "--listen", "0.0.0.0:8000", "--root", "public/"]
