#!/bin/sh
# Entrypoint produksi Portal PLTU Indramayu.
# Tugas: siapkan path persisten, opsional migrasi, cache konfigurasi, lalu
# serahkan PID 1 ke FrankenPHP. Tidak ada input interaktif di runtime.
set -eu

log() {
    printf '%s entrypoint: %s\n' "$(date -u +%Y-%m-%dT%H:%M:%SZ)" "$*"
}

# 1. Path persisten: upload dokumen tamu/galeri ada di storage/app.
#    (Volume ini dideklarasikan di docker-compose.prod.yml / Coolify.)
mkdir -p storage/app/public storage/app/private storage/framework/cache/data \
    storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

# 2. Symlink public/storage -> storage/app/public sudah dibuat saat build
#    (public/ milik root). Buat hanya bila belum ada — tidak fatal.
if [ -L public/storage ] || [ -e public/storage ]; then
    log "public/storage sudah ada"
else
    php artisan storage:link >/dev/null 2>&1 || log "storage:link gagal (public/ tidak writable)"
fi

# 3. Migrasi database — opt-in dan tidak destruktif.
#    Set RUN_MIGRATIONS=true hanya setelah migrasi direview. Migrasi yang
#    destruktif tetap butuh approval manusia (lihat AGENTS_deploy.md).
if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    attempt=1
    max_attempts="${MIGRATION_MAX_ATTEMPTS:-10}"
    delay="${MIGRATION_RETRY_DELAY:-5}"

    until php artisan migrate --force --no-interaction; do
        if [ "$attempt" -ge "$max_attempts" ]; then
            log "migrasi gagal setelah ${attempt} percobaan; container dihentikan"
            exit 1
        fi
        log "database belum siap / migrasi gagal; percobaan ulang ke-${attempt} dalam ${delay}s"
        attempt=$((attempt + 1))
        sleep "$delay"
    done
    log "migrasi selesai"
else
    log "RUN_MIGRATIONS bukan 'true' — migrasi dilewati"
fi

# 4. Cache config/route/view agar request tidak membaca ulang env & file.
#    Env dibaca saat start, jadi setiap perubahan env di Coolify harus
#    diikuti restart container.
php artisan optimize --no-interaction

log "menjalankan: $*"
exec "$@"
