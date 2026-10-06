# E-PPID PLN — Sistem Informasi Internal UP PLTU Indramayu

Aplikasi web internal untuk PT PLN Nusantara Power UP PLTU Indramayu berbasis
Laravel. Sistem menyatukan **manajemen konten (CMS)**, **Portal Karyawan**,
**Buku Tamu digital**, dan **tata kelola akses berbasis role (RBAC)** dalam satu
aplikasi — bukan web informasi publik untuk masyarakat umum.

> Repositori sistem mengikuti reposisi pada SRD versi 2.0
> (`SRD_E-PPID_PLN.md`): fokus pada kebutuhan internal — informasi karyawan,
> layanan internal, alat kerja, dan operasional front office.

## Fitur Utama

### Landing Page (tanpa login)
- Beranda profil UP PLTU Indramayu 3×330 MW, Tentang Kami (Profil, Sejarah, Visi & Misi, Struktur Organisasi)
- Informasi: Berita, Pengumuman, Galeri (dengan kategori & lightbox), Informasi Standar Pelayanan
- Layanan: FAQ dan **Form Registrasi Tamu** (buku tamu digital — pintu masuk tunggal kunjungan)
- Halaman CMS dinamis dengan visibilitas per-role (draft/terbit/terbatas)
- Navbar dinamis dari Menu Builder + i18n Indonesia/English + dark mode

### Buku Tamu Digital
- Registrasi mandiri oleh tamu: NIK, data instansi, unggah **foto KTP** & **surat permohonan (PDF)**
- Check-in / check-out oleh front office — durasi kunjungan tercatat otomatis
- Konfirmasi kunjungan via WhatsApp (click-to-chat) & email
- Notifikasi tamu baru di lonceng topbar admin (polling live)
- Rekap: filter pencarian/tanggal/status, **export CSV**, dan print
- Dokumen KTP & surat disajikan lewat route terproteksi (tidak bisa diakses publik via `/storage`)

### Portal Karyawan (`/karyawan/dashboard`)
Area internal terpisah dari panel admin, hanya untuk akun ber-role **Karyawan**:
- Login karyawan otomatis diarahkan ke portal (bukan dashboard admin)
- Karyawan diblokir dari `/admin/*` (redirect balik ke portal)
- Tab Informasi: pengumuman & berita internal (view-only, kartu dengan gambar, tanggal, "Baca Selengkapnya")
- Tab Layanan: grid layanan internal (Pengajuan Cuti, Layanan IT, Fasilitas, dll) + detail prosedur — ter-scope hirarki organisasi user
- Tab Link Kerja: tautan alat kerja dari tabel `work_links` (kategori **umum** untuk semua + **khusus** per bidang/sub-bidang) dengan filter tab JavaScript; layout filter menyesuaikan level jabatan
- Profil Saya: edit nama, no HP, alamat, dan ganti password (verifikasi password lama)

### Panel Admin (`/admin/login`)
- Dashboard dengan statistik, quick actions adaptif permission, aktivitas terbaru, & notifikasi
- CRUD Berita, Pengumuman, Galeri (+ publish/unpublish + target publikasi: publik / portal / keduanya)
- Halaman dinamis (Page + Section builder: banner, text, cards, file, FAQ)
- Menu Builder (navbar publik dari database)
- Manajemen Data Tamu (check-in/out, export, print, dokumen privat)
- Manajemen Link Kerja (kategori umum & khusus per bidang/sub-bidang)
- Manajemen User (buat akun, toggle aktif/nonaktif, hapus — tanpa pendaftaran mandiri)
- Role & Permission granular per modul (khusus Super Admin)
- Delegasi **Admin Bidang**: pengelola Pengumuman & Link Kerja terbatas pada bidang akunnya
- Log Aktivitas (pencatatan otomatis aksi CRUD & login/logout)
- Pencarian global admin (Ctrl+K) + lupa password via OTP email (rate limit 10x/menit)

## Peran Pengguna

| Peran | Akses |
|---|---|
| Tamu | Form registrasi kunjungan tanpa akun (`/layanan/form-registrasi-tamu`) |
| Karyawan | Portal Karyawan (baca informasi, layanan, link kerja) |
| Admin Bidang | Panel admin terbatas: Pengumuman & Link Kerja bidangnya |
| Super Admin (Sekretariat/Humas) | Panel admin penuh kecuali manajemen user/role |
| Administrator | Akses penuh termasuk User, Role, dan Log Aktivitas |

Matriks lengkap: `docs/matriks-role.md` · Spesifikasi: `SRD_E-PPID_PLN.md`

## Teknologi

- Laravel 12 (Blade + Bootstrap 5, tanpa SPA framework)
- MySQL 8, sesi & cache berbasis database
- Font Awesome 6, Feather Icons, Vite
- Docker Compose: app **FrankenPHP** + db MySQL 8

## Instalasi

### Prasyarat
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) aktif/berjalan
- Git
- Tidak perlu PHP, Composer, MySQL, maupun Laragon — semuanya ada di dalam container

### Langkah (Docker)

```bash
# 0. Tarik kode terbaru dari repositori kelompok
git pull

# 1. Salin konfigurasi lokal (sudah disetel untuk Docker, tidak perlu diubah)
cp .env.example .env           # PowerShell: copy .env.example .env

# 2. Bangun image & jalankan container app (FrankenPHP) + db (MySQL 8)
docker compose up -d --build

# 3. Kunci aplikasi + struktur database + akun awal
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link

# 4. Buka di browser
#    http://localhost:8000
```

Koneksi database dari aplikasi pengelola (HeidiSQL/DBeaver): host `127.0.0.1`,
port **3307**, user `root`, password `root` (port host sengaja 3307 agar tidak
tabrakan dengan MySQL Laragon jika masih terpasang).

> Catatan: `php artisan test` di dalam container butuh override koneksi
> (test suite mengarah ke `127.0.0.1:3306`), misal:
> `docker compose exec -e DB_HOST=db -e DB_PASSWORD=root app php artisan test`

### Alternatif tanpa Docker (Laragon)

```bash
composer install
cp .env.example .env           # sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve              # http://127.0.0.1:8000
```

> Catatan Laragon: karena `.env.example` kini berisi konfigurasi Docker
> (`DB_HOST=db`), ubah `DB_HOST` menjadi `127.0.0.1` dan sesuaikan nama
> database/username/password lokal Anda. Data Docker tersimpan di volume
> `dbdata` dan bertahan walau container dimatikan (`docker compose down`).

### Akun Default

`AdminUserSeeder` + `KaryawanUserSeeder` (dipanggil otomatis oleh
`DatabaseSeeder`) membuat akun awal agar fresh install selalu bisa login:

| Akun | Email | Password | Keterangan |
|---|---|---|---|
| Administrator | `admin@example.com` | `password123` | login admin `/admin/login` |
| Admin Bidang Operasi | `admin.operasi@example.com` | `password123` | contoh delegasi Admin Bidang |
| Admin Bidang Pemeliharaan | `admin.pemeliharaan@example.com` | `password123` | contoh delegasi Admin Bidang |
| Karyawan | `opaladzmii@gmail.com` | `karyawan123` | login portal `/karyawan/dashboard` |
| Test User | `test@example.com` | `password123` | user biasa (tanpa role admin) |

`WorkLinkSeeder` juga mengisi 10 link kerja awal (5 kategori umum + 5 khusus
sub-bidang Operasi) untuk Portal Karyawan.

> **Wajib di produksi:** override lewat `.env` sebelum `migrate --seed`:
>
> ```env
> ADMIN_EMAIL=email-anda@domain.com
> ADMIN_PASSWORD=password-yang-kuat
> ```

### Variabel Lingkungan Penting

| Key | Fungsi |
|---|---|
| `DB_*` | Koneksi MySQL |
| `ADMIN_EMAIL` / `ADMIN_PASSWORD` | Akun Administrator awal (seeder) |
| `MAIL_*` | Notifikasi OTP lupa password (opsional) |

## Testing

```bash
php artisan test
```

Seluruh 128 test harus lulus. Test memakai database terpisah sesuai `phpunit.xml`.

## Struktur Penting

```
app/
├── Http/Controllers/Admin/    # CRUD admin (News, Announcement, Gallery, Page,
│                              #   Menu, User, Role, Tamu, WorkLink, ActivityLog)
├── Http/Controllers/Auth/     # Login + lupa password OTP
├── Http/Controllers/Karyawan/ # Portal Karyawan (dashboard, informasi, layanan, link, profil)
├── Http/Controllers/          # TamuController + TamuDocumentController (buku tamu publik & dokumen privat)
├── Http/Middleware/           # permission:, role.scope:, page.visible, admin.access, karyawan.access
├── Models/                    # News, Announcement, Page, Menu, Role, Permission,
│                              #   Tamu, WorkLink, Department, ActivityLog, ...
└── Services/
    ├── MenuBuilderService.php    # Susunan navbar publik (fallback hardcoded)
    ├── PortalContentService.php  # Data portal karyawan (layanan internal & link kerja + scope hirarki)
    ├── ActivityLogger.php        # Pencatat log aktivitas otomatis
    └── NotificationService.php   # Notifikasi tamu baru
resources/views/
├── layouts/                   # app (publik), admin, karyawan, navbar, footer
├── admin/                     # halaman dashboard admin
├── karyawan/                  # halaman portal karyawan
├── informasi|tentang_kami/    # halaman landing page
├── layanan/                   # FAQ + form-registrasi-tamu
└── pages/                     # indeks & detail halaman CMS
database/seeders/              # PermissionSeeder, MenuSeeder, AdminUserSeeder,
                               #   KaryawanUserSeeder, WorkLinkSeeder
```

## Dokumentasi Tambahan

- `SRD_E-PPID_PLN.md` — Software Requirement Document (versi 2.0, reposisi internal)
- `docs/matriks-role.md` — matriks role × permission & keputusan RBAC
