# Deployment Produksi — Coolify (Proxmox, on-premises)

Dokumen ini menerapkan `AGENTS_deploy.md` pada aplikasi E-PPID PLN. Isinya
kontrak deploy, konfigurasi yang sudah disiapkan di repo, dan hal-hal yang
**wajib dikerjakan manusia** (infrastruktur, DNS, secret, backup).

> Aturan dasar: perubahan source boleh otomatis, tetapi perubahan
> infrastruktur/produksi yang destruktif memerlukan persetujuan manusia.
> Agen tidak melakukan deploy, SSH ke VM produksi, atau mengubah secret.

## 1. Stack terdeteksi

| Komponen | Nilai |
|---|---|
| Framework | Laravel 12 (`composer.json`, PHP `^8.2`) |
| Frontend | Blade + Bootstrap 5 + CSS/JS statis (tanpa build tool) |
| Web server | FrankenPHP (`dunglas/frankenphp:1-php8.2`) |
| Database | MySQL 8.0 (wajib; sesi, cache, queue, dan data aplikasi di DB) |
| Storage | Filesystem lokal `storage/app` (dokumen tamu, galeri) |
| Health route | `GET /up` (`bootstrap/app.php`) |

## 2. Port internal

- Aplikasi listen di `0.0.0.0:8000` (FrankenPHP `php-server`).
- **Port 8000 tidak di-publish ke host** di `docker-compose.prod.yml`; hanya
  `expose`. Trafik masuk lewat proxy Coolify (Traefik) di 80/443.
- Port database (3306) tidak dipublish sama sekali. Jangan menambahkan
  `ports: "3306:3306"` tanpa persetujuan eksplisit.

## 3. Strategi build

`Dockerfile` multi-stage:

| Target | Dipakai oleh | Isi |
|---|---|---|
| `development` | `docker-compose.yml` (lokal) | Composer dev deps, bind mount kode |
| `vendor` | internal | `composer install --no-dev --prefer-dist` |
| `production` | `docker-compose.prod.yml`, Coolify | vendor produksi, opcache, non-root `www-data`, entrypoint, healthcheck |

Runtime produksi (deterministik, tanpa input interaktif):

```
docker/entrypoint.sh
  → siapkan direktori storage
  → php artisan storage:link
  → php artisan migrate --force        (hanya jika RUN_MIGRATIONS=true, ada retry)
  → php artisan optimize               (config/route/view cache)
  → exec frankenphp php-server --listen 0.0.0.0:8000 --root public/
```

## 4. File yang disiapkan

| File | Perubahan |
|---|---|
| `Dockerfile` | Multi-stage; versi runtime di-pin (`1-php8.2`, bukan `latest`); opcache; user non-root; `EXPOSE 8000`; `HEALTHCHECK /up`; entrypoint; `LOG_CHANNEL=stderr` |
| `docker/entrypoint.sh` | Migrasi opsional + retry, symlink storage, cache config/route/view |
| `docker/php-prod.ini` | `expose_php=Off`, opcache produksi |
| `docker-compose.prod.yml` | Tanpa bind mount/port publik; MySQL privat; volume `app_storage`, `db_data`; env wajib dari luar |
| `docker-compose.yml` | Ditandai dev-only + `target: development` |
| `.env.example` | Template lokal diperjelas; nama variabel entrypoint ditambahkan (tanpa nilai rahasia) |
| `.dockerignore` | `.env.production` tidak masuk build context |
| `README.md` | Petunjuk menjalankan container produksi |

Dev compose tetap memakai port 8000/3307/8080 untuk kenyamanan lokal. Itu
**bukan** konfigurasi produksi.

## 5. Environment variable yang wajib diisi

Diisi di **Coolify → Environment Variables** (atau `.env` VM untuk compose).
Jangan pernah commit nilainya.

| Variabel | Wajib | Catatan |
|---|---|---|
| `APP_KEY` | ya | `php artisan key:generate --show` (sekali per environment) |
| `APP_URL` | ya | `https://<domain>` — dipakai untuk URL aset & email |
| `APP_ENV` | ya | `production` (sudah default di image) |
| `APP_DEBUG` | ya | `false` (sudah default di image) |
| `DB_CONNECTION` | ya | `mysql` |
| `DB_HOST` | ya | `db` (compose) atau hostname DB privat |
| `DB_PORT` | ya | `3306` |
| `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` | ya | user DB non-root, hak minimum |
| `DB_ROOT_PASSWORD` | ya* | hanya untuk service `db` bawaan compose |
| `LOG_CHANNEL` | ya | `stderr` |
| `SESSION_DRIVER`, `CACHE_STORE`, `QUEUE_CONNECTION` | ya | `database` |
| `SESSION_SECURE_COOKIE` | ya | `true` (akses via HTTPS) |
| `MAIL_*` | opsional | OTP lupa password; `MAIL_MAILER=log` bila belum ada SMTP |
| `ADMIN_EMAIL` / `ADMIN_PASSWORD` | saat seed awal | jangan pakai nilai contoh `admin@example.com` / `password123` |
| `RUN_MIGRATIONS` | ya | `false` default; `true` hanya saat rilis yang migrasinya sudah direview |
| `MIGRATION_MAX_ATTEMPTS`, `MIGRATION_RETRY_DELAY` | opsional | default `10`, `5` detik |

Staging dan produksi **wajib** memakai database dan kredensial berbeda.

> **Peringatan Compose:** `docker compose -f docker-compose.prod.yml` otomatis
> membaca `.env` di folder proyek. Di mesin developer, file itu berisi
> `DB_HOST=127.0.0.1` (Laragon) sehingga container akan gagal konek DB.
> Di VM produksi pastikan `.env` berisi nilai produksi, atau ekspor variabel
> secara eksplisit (`DB_HOST=db ...`) dan jangan menyalin `.env` lokal.
> Coolify tidak memakai file ini — variabel diisi di UI Coolify.

## 6. Dampak migrasi

- Entrypoint hanya menjalankan `php artisan migrate --force` bila
  `RUN_MIGRATIONS=true`; tidak ada rollback otomatis.
- Migrasi saat ini bersifat aditif, tetapi wajib direview per rilis:
  cari `drop`, `rename`, atau perubahan tipe kolom.
- Migrasi destruktif (drop tabel/kolom, reset data) **tidak boleh** dijalankan
  otomatis. Ajukan Change Plan + backup + rollback yang sudah diuji.
- Sebelum rilis pertama: siapkan backup, lalu jalankan migrasi + seeder admin
  sekali (`php artisan db:seed --force` atau set `ADMIN_*` sebelum seed).

## 7. Storage persisten

| Path | Isi | Volume |
|---|---|---|
| `/app/storage/app` | Dokumen tamu (KTP/surat), galeri, file privat | `app_storage` (wajib) |
| `/var/lib/mysql` | Database | `db_data` (bila pakai DB compose) |

`storage/logs` tidak perlu volume karena log produksi ke stderr. Tanpa volume
`app_storage`, semua dokumen tamu hilang saat container dibuat ulang.

Jika memakai **bind mount** (bukan named volume), jalankan di host:
`chown -R 33:33 <path>` — container berjalan sebagai `www-data` (uid/gid 33).
Ini perubahan izin di host: **HUMAN ACTION REQUIRED**.

## 8. Health check

- Path: `GET /up` → `200 OK` bila aplikasi bisa boot.
- Dipakai `HEALTHCHECK` image (curl, 30s interval, start period 40s).
- Coolify: isi **Health Check Path** = `/up`, port `8000`.
- Endpoint ini tidak mengecek koneksi DB; verifikasi DB dilakukan pada
  checklist di bawah.

## 9. Catatan konfigurasi Coolify

1. Resource baru → **Build Pack: Dockerfile** (bukan Nixpacks), file
   `Dockerfile`, **target `production`**.
2. Ports: `8000` (tanpa publish ke host), domain dengan HTTPS Traefik.
3. Volume: `app_storage` → mount `/app/storage/app`.
4. Env vars: sesuai tabel bagian 5; simpan sebagai secret bila tersedia.
5. **Auto Deploy: matikan** selama branch protection/approval belum tersedia.
6. Jalankan migrasi lewat `RUN_MIGRATIONS=true` pada rilis yang sudah direview,
   lalu kembalikan ke `false` (atau gunakan pre-deployment command Coolify).
7. Database: gunakan resource database privat Coolify, atau service `db` di
   `docker-compose.prod.yml`. Jangan buka 3306 ke publik.
8. Proxmox (8006) dan port manajemen Coolify bukan endpoint aplikasi.

## 10. Checklist verifikasi

Jalankan berurutan; jangan menandai selesai bila ada langkah gagal.

- [ ] `docker compose -f docker-compose.prod.yml build` sukses (target production).
- [ ] `docker compose -f docker-compose.prod.yml config` valid tanpa secret di file.
- [ ] Container app berjalan sebagai `www-data` (`docker compose exec app id`).
- [ ] `docker compose exec app php -v` → PHP 8.2.x.
- [ ] `curl -fsS http://127.0.0.1:8000/up` → 200 (dari dalam container).
- [ ] `curl -I https://<domain>/up` → 200 melalui proxy.
- [ ] Login admin, buka dashboard, dan lakukan satu transaksi inti
      (registrasi tamu / unggah dokumen / buat pengumuman).
- [ ] Dokumen yang diunggah tetap ada setelah `docker compose restart app`.
- [ ] Log muncul di Coolify/`docker logs`, tanpa secret.
- [ ] `SELECT COUNT(*) FROM migrations` sama dengan jumlah file migrasi yang
      disetujui.
- [ ] Tidak ada port 3306/8000 yang terbuka ke publik (`ss -tlnp` di host).
- [ ] Backup database + `storage/app` terjadwal dan pernah diuji restore.

## 11. Rollback

1. Simpan log & bukti kegagalan.
2. Identifikasi commit/image terakhir yang sehat (`IMAGE_TAG` sebelumnya).
3. Redeploy image/tag tersebut; jangan hapus image/volume lama.
4. Verifikasi `/up`, login admin, dan satu transaksi inti.
5. Jangan improvisasi rollback database. Restore hanya dari backup yang sudah
   diuji, dan hanya dengan persetujuan manusia.

## 12. Alur branch

- `feature/*` → PR ke `develop` → staging (bila ada) → PR rilis `develop` → `main` → produksi.
- Jangan commit/push langsung ke `main`/`develop`, jangan force-push.
- Merge butuh instruksi eksplisit yang menyebut PR-nya, check CI hijau pada
  revisi terakhir, dan tidak ada review yang belum selesai.
- PR rilis `main` butuh hasil staging/UAT yang tertaut ke SHA yang diuji,
  rencana migrasi/backup/rollback, dan persetujuan rilis.

---

## HUMAN ACTION REQUIRED — Change Plan

Agen tidak boleh mengeksekusi item berikut. Semua butuh persetujuan manusia
dan akses infrastruktur.

### CP-1: Publikasi domain HTTPS ke aplikasi

1. **Objective:** aplikasi dapat diakses via `https://<domain>` melalui proxy Coolify.
2. **Perubahan infrastruktur:** tambah DNS record A/AAAA ke IP publik; tambah
   domain + sertifikat Let's Encrypt di Coolify.
3. **Dampak jaringan/port:** hanya TCP 80/443 yang dibuka; tidak ada port baru.
4. **Risiko data/downtime:** tanpa downtime data; propagasi DNS menunggu TTL.
5. **Backup:** tidak relevan (tidak menyentuh data), catat konfigurasi lama.
6. **Langkah:** buat DNS record → tunggu propagasi → set domain di resource
   Coolify → aktifkan HTTPS → uji `/up`.
7. **Verifikasi:** `curl -I https://<domain>/up` = 200, sertifikat valid,
   redirect HTTP→HTTPS.
8. **Rollback:** hapus domain dari Coolify lalu kembalikan DNS record lama.

### CP-2: Penyimpanan persisten & izin volume

1. **Objective:** data unggahan bertahan lintas deploy/restart.
2. **Perubahan infrastruktur:** buat volume persisten di host/Coolify.
3. **Dampak jaringan/port:** tidak ada.
4. **Risiko data/downtime:** menghapus volume = kehilangan dokumen tamu;
   restart singkat saat memasang volume.
5. **Backup:** backup `storage/app` sebelum migrasi ke volume baru.
6. **Langkah:** buat volume → mount ke `/app/storage/app` → `chown -R 33:33`
   bila bind mount → restart container.
7. **Verifikasi:** unggah dokumen, restart, dokumen masih dapat diakses.
8. **Rollback:** lepas mount, data lama di lokasi sebelumnya tetap utuh.

### CP-3: Backup & retensi produksi

1. **Objective:** data dapat dipulihkan setelah insiden.
2. **Perubahan infrastruktur:** jadwal `mysqldump` + snapshot volume storage
   di luar container, ke penyimpanan terpisah.
3. **Dampak jaringan/port:** tidak ada port publik baru.
4. **Risiko data/downtime:** dump dapat membebani DB; jadwalkan di luar jam sibuk.
5. **Backup:** retensi minimum 7 harian + 4 mingguan, terenkripsi.
6. **Langkah:** pasang job backup, simpan di storage terpisah, uji restore.
7. **Verifikasi:** restore ke DB staging dan cocokkan jumlah baris tabel inti.
8. **Rollback:** hentikan job backup; data produksi tidak berubah.

### CP-4: Mengaktifkan Auto Deploy

1. **Objective:** deploy otomatis dari `main` setelah PR rilis disetujui.
2. **Perubahan infrastruktur:** aktifkan Auto Deploy di Coolify.
3. **Dampak jaringan/port:** tidak ada.
4. **Risiko data/downtime:** deploy yang tidak lolos review bisa langsung
   tayang; restart singkat per rilis.
5. **Backup:** backup sebelum rilis pertama yang otomatis.
6. **Langkah:** pastikan branch protection/approval tersedia → aktifkan Auto
   Deploy hanya untuk `main` → jalankan satu rilis percobaan.
7. **Verifikasi:** commit uji memicu build & healthcheck lulus; riwayat deploy
   tertaut ke commit.
8. **Rollback:** matikan Auto Deploy dan redeploy tag sehat terakhir.
