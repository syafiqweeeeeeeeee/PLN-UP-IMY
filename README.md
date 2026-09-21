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
- PHP >= 8.2, Composer, MySQL (disarankan: [Laragon](https://laragon.org) di Windows)

### Langkah

```bash
# 1. Clone & dependensi
composer install
npm install && npm run build   # opsional (asset umumnya sudah di public/)

# 2. Konfigurasi
cp .env.example .env           # sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate

# 3. Database + seed
php artisan migrate --seed

# 4. Storage untuk upload galeri
php artisan storage:link

# 5. Jalankan
php artisan serve              # http://127.0.0.1:8000
```

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
