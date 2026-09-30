# E-PPID PLN — Electronic Pejabat Pengelola Informasi dan Dokumentasi

Portal informasi publik berbasis Laravel untuk UP PLTU Indramayu (PLN Nusantara Power).
Masyarakat dapat mengakses berita, pengumuman, galeri, dan layanan informasi publik;
admin mengelola seluruh konten melalui dashboard CMS.

## Fitur Utama

### Publik
- Beranda, Tentang Kami (Profil, Sejarah, Visi & Misi, Struktur Organisasi)
- Informasi: Berita, Pengumuman, Galeri (dengan kategori & lightbox), Informasi Layanan
- Layanan: Daftar Layanan, FAQ, Simulasi biaya (pasang baru, sambung sementara, ubah daya)
- Halaman CMS dinamis dengan visibilitas per-role (draft/terbit/terbatas)
- Navbar dinamis dari Menu Builder + i18n Indonesia/English + dark mode

### Admin (`/admin/login`)
- Dashboard dengan statistik & log aktivitas terbaru
- CRUD Berita, Pengumuman, Galeri (+ publish/unpublish)
- Halaman dinamis (Page + Section builder)
- Menu Builder (navbar publik dari database)
- Manajemen User, Role & Permission (granular per modul)
- Log Aktivitas (pencatatan otomatis aksi CRUD & login)

### Portal Karyawan (`/karyawan/dashboard`)
Area internal terpisah dari panel admin, hanya untuk akun ber-role **Karyawan**:
- Login karyawan otomatis diarahkan ke portal (bukan dashboard admin)
- Karyawan diblokir dari `/admin/*` (redirect balik ke portal)
- Tab Informasi: pengumuman & berita internal (view-only, kartu dengan gambar, tanggal, "Baca Selengkapnya")
- Tab Layanan: grid layanan internal (Pengajuan Cuti, Layanan IT, Fasilitas, dll) + detail prosedur
- Tab Link Kerja: 10 tautan alat kerja (5 akses umum + 5 per bidang) dengan **filter dropdown/tab** JavaScript
- Profil Saya: edit nama, no HP, alamat, dan ganti password (verifikasi password lama)

## Teknologi

- Laravel 12 (Blade + Bootstrap 5, tanpa SPA framework)
- MySQL, sesi & cache berbasis database
- Font Awesome 6, Feather Icons, Vite

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

`AdminUserSeeder` (dipanggil otomatis oleh `DatabaseSeeder`) membuat akun
Administrator agar fresh install selalu punya akun login:

| Akun | Email | Password | Keterangan |
|---|---|---|---|
| Administrator | `admin@example.com` | `password123` | login admin `/admin/login` |
| Karyawan | `opaladzmii@gmail.com` | `karyawan123` | login portal `/karyawan/dashboard` |
| Test User | `test@example.com` | `password123` | user biasa (tanpa role admin) |

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
| `MAIL_*` | Notifikasi email (opsional) |

## Testing

```bash
php artisan test
```

Seluruh 128 test harus lulus. Test memakai database terpisah sesuai `phpunit.xml`.

## Struktur Penting

```
app/
├── Http/Controllers/Admin/    # CRUD admin (News, Gallery, Page, Menu, Role, ...)
├── Http/Controllers/Karyawan/ # Portal Karyawan (dashboard, informasi, layanan, link, profil)
├── Http/Middleware/           # permission:, page.visible, admin.access, karyawan.access
├── Models/                    # News, Page, Menu, Role, Permission, ActivityLog, ...
└── Services/
    ├── MenuBuilderService.php    # Susunan navbar publik (fallback hardcoded)
    └── PortalContentService.php  # Data statis portal karyawan (layanan & link kerja)
resources/views/
├── layouts/                   # app (publik), admin, karyawan, navbar, footer
├── admin/                     # halaman dashboard admin
├── karyawan/                  # halaman portal karyawan
└── informasi|kontak|layanan/  # halaman publik
database/seeders/              # PermissionSeeder, MenuSeeder, KaryawanUserSeeder
```

## Dokumentasi Tambahan

Lihat `SRD_E-PPID_PLN.md` untuk Software Requirement Document lengkap.
