# 🛠️ Developer Guide — E-PPID PLN (Laravel 12)

Dokumen ini adalah **panduan lengkap untuk developer** yang bekerja pada
proyek E-PPID PLN: mulai dari setup lingkungan, penjelasan arsitektur,
penjelasan struktur **database**, sistem **RBAC (Role-Based Access Control)**,
sampai **SOP langkah-demi-langkah menambah module/fitur baru** beserta
contoh kodenya.

> Semua contoh memakai contoh fiktif modul **`laporan`** (Laporan).
> Ganti dengan nama modulmu sendiri.

**Daftar Isi**

1. [Ringkasan Proyek](#1-ringkasan-proyek)
2. [Tech Stack & Cara Setup](#2-tech-stack--cara-setup)
3. [Struktur Folder & Alur Request](#3-struktur-folder--alur-request)
4. [Penjelasan Database (ERD & Tabel)](#4-penjelasan-database)
5. [Sistem RBAC — Cara Kerja Hak Akses](#5-sistem-rbac)
6. [Daftar Fitur Lengkap (per modul)](#6-daftar-fitur-lengkap)
7. [SOP Menambah Module Baru](#7-sop-menambah-module-baru)
8. [SOP Menambah Kolom Aksi Baru](#8-sop-menambah-aksi-baru)
9. [Testing](#9-testing)
10. [Troubleshooting](#10-troubleshooting)

---

## 1. Ringkasan Proyek

**E-PPID PLN** adalah aplikasi web berbasis **Laravel 12** untuk pengelolaan
website PPID (Pejabat Pengelola Informasi dan Dokumentasi) unit pembangkit
PLN UP Indramayu. Aplikasi punya **dua area besar**:

| Area | URL | Isi |
|---|---|---|
| **Portal Publik** | `/` | Landing page: berita, pengumuman, galeri, halaman statis, buku tamu (registrasi tamu), informasi publik |
| **Admin Panel** | `/admin` | CMS: kelola berita, pengumuman, galeri, halaman, menu, data tamu, pengguna, role, link kerja, log aktivitas, pengaturan |
| **Portal Karyawan** | `/dashboard`-an | Portal internal: konten internal, link kerja per bidang, aplikasi internal, notifikasi |

**Aktor (role) yang ada — HANYA 3:**

| Role | Siapa | Cakupan Akses |
|---|---|---|
| `Super Admin` | Sekretariat / Humas | **Penuh** — seluruh fitur & menu Admin Panel |
| `Admin Bidang` | Pengelola delegated ke satu Bidang Utama | Terbatas menu **Pengumuman** & **Link Kerja**, data dibatasi bidangnya sendiri |
| `Karyawan` | Seluruh pegawai | Portal Karyawan. Bisa diberi **direct permission ekstra** → masuk Admin Panel parial ("setengah admin") |

> Role legacy `Administrator` masih dikenali sebagai setara `Super Admin`
> (kompatibilitas akun lama), tapi **tidak bisa dibuat lagi** dari UI —
> barisnya sudah dihapus dari DB via migrasi `2026_10_06_000002_remove_administrator_role`.

---

## 2. Tech Stack & Cara Setup

### 2.1 Tech Stack

| Komponen | Teknologi | Versi |
|---|---|---|
| Framework | Laravel | 12.x (PHP ≥ 8.2) |
| Database | MySQL | 8.0 (via Laragon) |
| Frontend | Blade template + Bootstrap/Tailwind util + FontAwesome | — |
| Asset bundler | Vite | — |
| Testing | PHPUnit | 11.x |
| Linter | Laravel Pint (`vendor/bin/pint`) | — |
| Runtime | Laragon (Apache 2.4 + PHP 8.3 + MySQL 8) | — |

> ⚠️ Proyek ini **TIDAK** menggunakan paket permission pihak ketiga
> (spatie/laravel-permission dsb. tidak ada di `composer.json`). RBAC-nya
> **dibuat sendiri (custom)** dengan tabel custom + helper di
> `app/Models/User.php` dan `App\Models\Role`.

### 2.2 Setup Pertama Kali (Laragon — cara utama)

Semua konfigurasi sudah disiapkan. Cukup:

```bash
# 1. Copy & isi .env (sudah disediakan template .env.example, disetel untuk Laragon)
cp .env.example .env

# 2. Install dependensi PHP
composer install

# 3. Setup Laravel
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
```

Nyalakan **Apache & MySQL** dari menu Laragon, lalu buka
**http://PLN-UP-IMY.test** (vhost otomatis Laragon, `DocumentRoot` → `public/`).

**Koneksi database (development-only, jangan pakai di produksi!):**

```
DB_HOST=127.0.0.1     # MySQL Laragon
DB_PORT=3306
DB_DATABASE=pln_up_imy
DB_USERNAME=root
DB_PASSWORD=          # Laragon: root tanpa password
# Dari host (mis. DBeaver/HeidiSQL): host=127.0.0.1, port=3306
# Database testing (phpunit.xml): pln_up_imy_testing
```

**Akun admin awal** — dari konstanta di `.env` (WAJIB diganti di produksi):

```
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=password123
```

**Alternatif: Docker (cadangan)** — `Dockerfile` + `docker-compose.yml` tetap
ada di repo. Jalankan `docker compose up -d --build` lalu buka
`http://localhost:8000`. Blok `environment` di `docker-compose.yml`
menimpa kunci `DB_*` (menunjuk container `db:3306`, database
`nama_database_anda`), jadi `.env` tidak perlu diubah.

### 2.3 Perintah Harian

| Perintah | Fungsi |
|---|---|
| Laragon → **Start All** | Nyalakan Apache (port 80) + MySQL (port 3306) |
| `docker compose up -d` / `down` | Nyalakan / matikan container (cadangan) |
| `composer dev` | Jalankan 4 proses sekaligus: `php artisan serve` + queue listener + log pail + `npm run dev` |
| `php artisan test` | Jalankan seluruh test suite |
| `vendor/bin/pint` | Auto-format kode (PHP) |
| `php artisan optimize:clear` | Bersihkan semua cache (route, config, view, event) |

### 2.4 Konsep Cache Laravel — sering bikin bingung

Laravel **me-cache** route & config saat mode produksi. Saat pengembangan,
kalau route baru "tidak muncul" atau `.env` yang diubah tidak berefek,
jalankan:

```bash
php artisan optimize:clear
```

---

## 3. Struktur Folder & Alur Request

### 3.1 Alur satu Request (big picture)

```
Browser
   │  HTTP request (GET /admin/news)
   ▼
routes/web.php                          ← URL → Controller + middleware
   │  middleware: auth → admin.access → permission:news.view
   ▼
app/Http/Controllers/Admin/NewsController.php
   │  Gate::authorize('news.view')      ← defense in depth (cek ke-2)
   │  Query ke Model
   ▼
app/Models/News.php                     ← Eloquent → tabel `news` di MySQL
   │
   ▼
resources/views/admin/news/index.blade.php
   │  @can('news.edit') → tombol edit tampil/hilang per user
   ▼
HTML dikirim ke browser
```

**3 lapisan pengecekan hak akses** (jangan cuma 1!):

1. **Middleware** di route → `permission:news.view`
2. **Gate di Controller** → `Gate::authorize('news.edit')` sebelum aksi
3. **Blade directive** di view → `@can('news.delete')` untuk tombol/UI

### 3.2 Struktur Folder Penting

```
├── app/
│   ├── Enums/                          # Enum PHP (mis. TamuStatus)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                  # SEMUA controller panel admin
│   │   │   ├── Karyawan/               # Controller portal karyawan
│   │   │   └── Concerns/               # Trait, mis. ScopesToDepartment
│   │   └── Middleware/                 # auth, admin.access, EnsureNotKaryawan
│   ├── Models/                         # Eloquent: User, Role, Permission,
│   │   │                               #   News, Tamu, MasterMenu, dst.
│   └── Support/                        # Helper, mis. ActivityLogger
├── database/
│   ├── migrations/                     # Skema DB (33 file, lihat bab 4)
│   └── seeders/                        # Isi awal DB
│       ├── AdminUserSeeder.php         # Akun admin awal dari .env
│       ├── MasterMenuSeeder.php        # Isi tabel master_menus
│       └── PermissionSeeder.php        # Daftar permission + pasang ke role
├── resources/views/                    # Blade template
│   ├── layouts/                        # admin, karyawan, app (landing)
│   ├── admin/                          # View per module admin
│   ├── karyawan/                       # View portal karyawan
│   └── admin/partials/
│       └── permission-matrix.blade.php # Komponen matriks hak akses ⭐
├── routes/web.php                      # Semua route web
├── tests/Feature/                      # Test RBAC, direct permission, CRUD
└── docker-compose.yml                  # Orkestrasi app + MySQL
```

### 3.3 Konvensi Penamaan yang WAJIB diikuti

| Item | Konvensi | Contoh |
|---|---|---|
| Permission | `<module_key>.<action>` | `news.view`, `tamu.checkout` |
| Titik permission | `view` / `create` / `edit` / `delete` (+ aksi khusus per modul) | |
| Route admin | `admin.<module>.<action>` | `admin.news.index` |
| Route karyawan | `karyawan.<module>.<action>` | `karyawan.tamu.index` |
| Controller | `<Module>Controller.php` di `App\Http\Controllers\Admin\` | `NewsController` |
| View | `resources/views/admin/<module>/` dengan `index`, `create`, `edit`, `form` | `admin/news/index.blade.php` |
| Table pivot | `<a>_<b>` singular | `role_user`, `role_permission` |

---

## 4. Penjelasan Database

> DB Engine: **MySQL 8.0**. Charset/collation mengikuti default Laravel
> (`utf8mb4`). Grafik relasi di bagian 4.3.

### 4.1 Tabel inti — Autentikasi & Pengguna

#### `users` — Akun pengguna (pegawai)

Dibentuk dari **beberapa migrasi bertahap** (bukan satu file):

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint PK | |
| `name`, `email` | string | `email` unique dipakai login |
| `email_verified_at` | timestamp | Kalau NOT NULL → akun **aktif/terverifikasi** |
| `password` | string | Hash bcrypt (cast `hashed`) |
| `must_change_password` | boolean | Di-set true = user dipaksa ganti password saat login |
| `role` | string **(legacy)** | Kolom lama. Masih dibaca sebagai fallback oleh `User::isKaryawan()`, `isAdmin()` |
| `role_id` | FK→roles | Role utama (dipakai bersama pivot `role_user`) |
| `level_jabatan` | string | `senior_manager` / `manager_bidang` / `asisten_manager` / `staf` — lihat `User::LEVEL_JABATAN` |
| `department` | string **(legacy)** | Kode bidang versi lama |
| `department_id` | FK→departments | Bidang Utama tempat akun terikat (di sini = `bidang_id` pada spec) |
| `sub_department` | string | Kode sub-bidang, mis. `spv_chcb_b` (=`sub_bidang_id`) |
| `no_hp`, `alamat` | | Profil |
| `last_seen_tamu_id` | FK→tamus | Penanda terakhir lihat tamu (untuk notifikasi) |
| `notification_settings` | json | Preferensi notifikasi (`desktop`, `weekly`, `pending`) |

Tabel terkait lain dari skeleton Laravel:

- `password_reset_tokens` — token reset password via email
- `sessions` — karena `.env` pakai `SESSION_DRIVER=database`
- `cache`, `cache_locks`, `jobs`, `job_batches`, `failed_jobs` — cache & queue database driver

#### `tamus` — Buku tamu (registrasi kunjungan)

Kolom penting: `nama`, `email`, `no_hp`, `alamat`, `instansi`,
`tanggal_kunjungan`, `foto_ktp` (setelah migrasi `2026_10_01_...` ber-type
**json** — array file), `dokumen_zip` (menggantikan `surat_jalan`),
`status_verifikasi` (migrasi `2026_10_05_...` — siklus verifikasi tamu),
`checkout_at`, `user_id` (petugas penanggung jawab), timestamps.

### 4.2 Tabel RBAC — ⭐ inti sistem hak akses

Empat tabel ini dibuat oleh migrasi `2026_09_10_000001_create_roles_permissions_tables.php`
(tabel `user_has_permissions` dipisah di `2026_10_06_100001_...`):

#### `roles`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | PK | |
| `name` | string(100) unique | `Super Admin`, `Admin Bidang`, `Karyawan` |
| `description` | string nullable | |
| `status` | boolean default 1 | `0` = role dinonaktifkan → permission-nya **diabaikan sistem** (`Role::isInactive()`) |

#### `permissions`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | PK | |
| `name` | string(100) unique | Format `<module>.<action>` — `news.edit`, `tamu.checkout` |
| `display_name` | string | Label di UI: "Edit Berita" |
| `module` | string | Pengelompokan: `News`, `Guest Book` |

#### `role_permission` — pivot: role → permission

| Kolom | Tipe |
|---|---|
| `role_id` | FK→roles, `cascadeOnDelete` |
| `permission_id` | FK→permissions, `cascadeOnDelete` |
| Unique pair | `(role_id, permission_id)` |

#### `role_user` — pivot: user → role

`user_id`, `role_id`, unique pair `(user_id, role_id)`.
Plus fallback kolom `users.role_id` untuk akun lama.

#### `user_has_permissions` — pivot: user → permission (DIRECT permission)

`2026_10_06_100001_create_user_has_permissions_table.php`:

```
user_id        FK→users      cascadeOnDelete
permission_id  FK→permissions cascadeOnDelete
unique (user_id, permission_id)
```

Ini adalah fitur **Direct Permission**: hak akses diatur **per akun** di
form Pengguna (tab "Hak Akses Fitur") lewat matriks ID Menu × CRUD —
**TANPA** perlu membuat role baru.

### 4.3 Tabel `departements` & struktur organisasi

`2026_09_29_100001_create_departments_table_and_bind_users.php` membuat
tabel `departments` (kolom `id`, `code`, `name`, aktif, timestamps) dan
mengikat `users.department_id` ke tabel itu. Master kode bidang juga
terdapat di konstanta `User::DEPARTMENTS`:

```
operasi | pemeliharaan | engineering | business_support | k3_kam | lingkungan
```

Sub-bidang variasi terdapat di konstanta `User::SUB_DEPARTMENTS`
(dependent dropdown di form Pengguna & Link Kerja dibangun dari sana).

### 4.4 Tabel `master_menus` — ⭐ Master ID Menu Sidebar

Dibuat oleh `2026_10_06_000001_create_master_menus_table.php`. **Sumber
tunggal** daftar menu sidebar admin untuk matriks hak akses (Form Role & Form Pengguna).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | PK | **ID menu FIXED** sesuai spec (1–11) |
| `name` | string(100) unique | "Berita", "Data Tamu", dst. |
| `route` | string(150) nullable | Nama route utama menu, mis. `admin.news.index` |
| `icon` | string(100) nullable | Class FontAwesome, mis. `fa-newspaper` |
| `permission_key` | string(100) nullable, **indexed** | Kunci permission modul, mis. `news` |
| `sort_order` | unsigned int default 0 | Urutan tampil |

**Daftar menu ID FIXED:**

| ID | Menu | Route | permission_key |
|---|---|---|---|
| 1 | Dashboard | `admin.dashboard` | `dashboard` |
| 2 | Berita | `admin.news.index` | `news` |
| 3 | Data Tamu | `admin.tamu.index` | `tamu` |
| 4 | Pengumuman | `admin.announcements.index` | `announcements` |
| 5 | Halaman | `admin.pages.index` | `pages` |
| 6 | Menu | `admin.menus.index` | `menus` |
| 7 | Pengguna | `admin.users.index` | `users` |
| 8 | Galeri | `admin.galeri.index` | `galleries` |
| 9 | Link Kerja | `admin.work-links.index` | `work_links` |
| 10 | Log Aktivitas | `admin.activity-logs.index` | `activity_logs` |
| 11 | Role / Hak Akses | `admin.roles.index` | `roles` |

Setiap menu dipecah jadi **4 permission granular** di tabel `permissions`:
`<permission_key>.view` / `.create` / `.edit` / `.delete`
(lihat `MasterMenu::CRUD_ACTIONS`). ⚠️ JANGAN mengubah id 1–11 — ID sudah
dipakai hard-coded di banyak tempat.

### 4.5 Tabel konten

| Tabel | Dibuat oleh | Isi & kolom penting |
|---|---|---|
| `news` | `2026_09_11_000001` | Berita publik: `title`, `slug`, `content`, `image`, `status` (draft/publish), `published_at`, **`target_publication`** (migrasi `2026_09_29_000001`) |
| `announcements` | `2026_09_14_000001` | Pengumuman internal + `target_publication` |
| `galleries` | `2026_09_14_000002` | Album/foto galeri landing |
| `activity_logs` | `2026_09_14_000002` | Audit trail: `user_id`, `action`, `description`, timestamps — diisi via `ActivityLogger::log(...)` |
| `contact_messages` | `2026_09_15_000001` | Pesan dari form kontak landing |
| `pages`, `page_role`, `page_sections` | `2026_09_15_000001` | CMS halaman statis landing; `page_role` membatasi halaman per role |
| `menus` | `2026_09_15_000002` + `_000003` | Menu navigasi landing page + kolom `target` |
| `work_links` | `2026_09_29_000002` | Link kerja per bidang/sub-bidang (dipakai Admin Bidang) |

> Contoh lama `contact_locations` & `contact_social_media` sudah **dihapus**
> lewat migrasi `2026_09_21_000001_drop_contacts_locations_social_media_tables.php`.

### 4.6 ERD — Relasi antar tabel

```
┌──────────────┐         ┌─────────────────────┐
│   users      │         │      roles          │
├──────────────┤         ├─────────────────────┤
│ id        PK │         │ id  PK              │
│ role_id   FK ┼────────►│ name                │
│ department_id│         │ status (0/1)        │
│ level_jabatan│         └──────────┬──────────┘
│ sub_department          │
│ last_seen_tamu_id       │
└───┬──────┬──────┬───────┘
    │      │      │
    │      │      └──── role_user ──────┐
    │      └── user_has_permissions ──┤
    │                    (direct)     │
    │                                 │
    │      ┌───────────────────────┐  │
    │      │ role_permission       │  │
    │      └────────┬──────────────┘  │
    │               │                 │
    │               ▼                 │
    │        ┌─────────────┐          │
    │        │ permissions │◄─────────┘
    │        └─────────────┘  (role_permission)
    │
    │  (users.last_seen_tamu_id)
    ▼
┌──────────────┐        ┌────────────────┐  ┌──────────────┐
│    tamus     │        │  departments   │  │ master_menus │
└──────────────┘        └────────────────┘  └──────────────┘

Tabel konten (news, announcements, galleries, work_links, dst.)
TIDAK ber-FK ke user/role biasanya — cukup dibatasi lewat
permission di controller (atau GlobalScope trait ScopesToDepartment).
```

**Ringkasan relasi:**

- `users ↔ roles` — **banyak-banyak** via `role_user` + fallback `users.role_id`
- `roles ↔ permissions` — **banyak-banyak** via `role_permission`
- `users ↔ permissions` — **banyak-banyak** via `user_has_permissions` (**direct permission**)
- `users → departments` — belongsTo via `department_id`
- `users → tamus` — user menyimpan `last_seen_tamu_id` (flag "sudah dibaca")
- `master_menus` — GRATIS berdiri sendiri (master data); dihubungkan ke
  `permissions` **secara logis** via `permission_key`, bukan FK

### 4.7 Seeding — Siapa Mengisi Apa

| Seeder | Isi apa | Bisa dijalankan berulang? |
|---|---|---|
| `AdminUserSeeder` | Akun admin awal dari env `ADMIN_EMAIL`/`ADMIN_PASSWORD` | aman |
| `PermissionSeeder` | Daftar ~57 permission → `firstOrCreate` ke tabel `permissions`; lalu `syncWithoutDetaching` ke role Super Admin, Admin Bidang, Karyawan | **idempotent** |
| `MasterMenuSeeder` | Isi tabel `master_menus` dari konstanta `MasterMenu::MENUS` pakai `updateOrCreate(['id'=>…])` | **idempotent** |

Jalankan seeder hanya-satu:

```bash
php artisan db:seed --class=PermissionSeeder
php artisan db:seed --class=MasterMenuSeeder
php artisan db:seed --class=AdminUserSeeder
```

Atau semuanya:

```bash
php artisan db:seed
```

> **Kenapa idempotent penting?** Karena seeder sering dijalankan ulang
> (setiap ada menu/permission baru) di lingkungan produksi tanpa takut
> datanya dobel — `firstOrCreate` / `updateOrCreate` tidak membuat duplikat.

---

## 5. Sistem RBAC

### 5.1 Konsep Dasar — Role, Permission & Direct Permission

| Istilah | Arti di sistem ini | Tabel DB |
|---|---|---|
| **Permission** | Kemampuan atomik. Format nama `<module>.<action>`, mis. `news.edit`, `tamu.checkout`. | `permissions` |
| **Role** | Wadah/paket permission yang menempel ke user. Ada 3 role dasar + role kustom buatan admin. | `roles` |
| **Direct Permission** | Permission yang menempel **langsung ke akun** (bukan via role). Berfungsi sebagai *white-list override* per modul — lihat 5.5. | `user_has_permissions` |
| **Matriks Hak Akses** | UI checklist: baris = ID Menu sidebar, kolom = 4 aksi CRUD (`view / create / edit / delete`). Centang = memasang permission `<permission_key>.<aksi>`. | input form → pivot |
| **Master Menu** | Master daftar menu sidebar (11 ID fixed) dengan `permission_key` per modul — sumber baris matriks. | `master_menus` + konstanta `MasterMenu::MENUS` |

**3 Role Dasar** (`RoleController::BASE_ROLE_NAMES`) dibuat oleh seeder dan
**tidak bisa dihapus** dari UI (nama terkunci di form Edit), namun admin
**BEBAS membuat role kustom baru** dari halaman Role:

| Role | Perilaku khusus di kode |
|---|---|
| `Super Admin` | Akses penuh seluruh fitur. **Kuota akun ≤ 3** (`User::MAX_SUPER_ADMIN_ACCOUNTS`). Legacy `Administrator` dihitung setara. |
| `Admin Bidang` | Delegasi per bidang: wajib terikat `department_id`, hanya boleh kelola Pengumuman & Link Kerja bidangnya (`role.scope:admin` menolak yang tanpa bidang). |
| `Karyawan` | Baseline `KARYAWAN_BASELINE_PERMISSIONS` (portal karyawan). Permission **di luar baseline** membuka akses `/admin` ("setengah admin", lihat 5.6). |

Kuota lain: akun Karyawan ber-level jabatan `senior_manager` maksimal **3 akun
aktif** (`User::MAX_SENIOR_MANAGER_ACCOUNTS`).

### 5.2 Struktur Database & Relasi RBAC

Semua tabel inti RBAC dibuat oleh 4 migrasi:

| Tabel | Migrasi | Fungsi |
|---|---|---|
| `roles`, `permissions`, `role_permission`, `role_user` | `2026_09_10_000001_create_roles_permissions_tables` | Inti RBAC klasik |
| `users.role_id` (FK→roles, nullable) | `2026_09_10_000002_add_role_id_to_users_table` | Role utama / fallback akun lama |
| `master_menus` | `2026_10_06_000001_create_master_menus_table` | Master ID Menu Sidebar (id FIXED 1–11) |
| `user_has_permissions` | `2026_10_06_100001_create_user_has_permissions_table` | Pivot Direct Permission per akun |
| (migrasi data) `2026_10_06_000002_remove_administrator_role` | — | Pindahkan semua akun legacy `Administrator` → `Super Admin`, lalu hapus role itu |

**Skema pivot & constraint** (penting saat menulis SQL manual):

```
roles                           permissions
─────────────────────           ────────────────────────────────
id            PK                id              PK
name          UNIQUE(100)       name            UNIQUE(100)  ← format module.action
description   NULL              display_name    NULL  ← label UI
status        BOOL default 1    module          NULL  ← pengelompokan UI
timestamps                      timestamps
```

```
user ──< role_user >────────── role ──< role_permission >────── permission
  │    UNIQUE(user_id,role_id)   │     UNIQUE(role_id,           │
  │         cascadeOnDelete     │          permission_id)       │
  │                             │         cascadeOnDelete       │
  └──< user_has_permissions >─────────────────────────────────────┘
       UNIQUE(user_id,permission_id)
       cascadeOnDelete          ← DIRECT PERMISSION per akun
       + users.role_id  FK→roles  nullOnDelete  (fallback akun lama)
```

Aturan relasi yang WAJIB dipahami:

1. `role_user` & `role_permission` & `user_has_permissions` semuanya
   **cascadeOnDelete** — menghapus role/user/permission otomatis membersihkan
   semua pivot-nya.
2. Tabel `master_menus` **TIDAK ber-FK** ke `permissions`. Hubungannya
   **logis via nama**: `master_menus.permission_key` + aksi → nama permission
   `"{permission_key}.{action}"`. Karena itu, baris menu baru hanya "hidup"
   kalau permission-nya ikut dibuat di tabel `permissions` (lewat seeder).
3. Konstanta `User::SUPER_ADMIN_ROLE` / `DEPARTMENT_ADMIN_ROLE` dipakai
   berulang-ulang di middleware & controller — **jangan rename nama role**
   di database tanpa mengubah konstanta ini.
4. `roles.status = 0` → role dinonaktifkan: semua permission-nya **diabaikan**
   saat pengecekan (`Role::isInactive()`), tanpa perlu menghapus pivot.

### 5.3 Peta Kode — Model & Method Kunci

| File | Kunci yang dipakai |
|---|---|
| `app/Models/User.php` | `hasPermission()` (lihat 5.5), `hasDirectPermission()`, `directPermissionIds()`, `syncPermissions()` (sync pivot `user_has_permissions`), `permissions()` / `roles()` / `role()`, `roleNames()` (pivot + fallback `role_id`), `isSuperAdmin()` / `isDepartmentAdmin()` / `isKaryawan()` / `isAdmin()`, `extraKaryawanPermissions()` / `hasExtraKaryawanPermission()`, konstanta `SUPER_ADMIN_ROLE`, `DEPARTMENT_ADMIN_ROLE`, `ASSIGNABLE_ROLE_NAMES`, `MAX_SUPER_ADMIN_ACCOUNTS`, `MAX_SENIOR_MANAGER_ACCOUNTS`, `KARYAWAN_BASELINE_PERMISSIONS` |
| `app/Models/Role.php` | `permissions()` / `users()` (pivot), `isInactive()`, `hasPermission($name)` |
| `app/Models/Permission.php` | `roles()` (pivot `role_permission`), `fill`: `name`, `display_name`, `module` |
| `app/Models/MasterMenu.php` | `MENUS` (master 11 menu, id fixed; baris id 12 "contoh" di repo saat ini = data uji yang sebaiknya dihapus), `CRUD_ACTIONS` (4 aksi matriks), `permissionNamesFor()` / `matrixPermissionNames()` (daftar nama permission matriks), `matrixForRoleForm()` (matriks untuk form Role & form Pengguna — hanya permission yang benar-benar terdaftar di DB) |
| `app/Providers/AuthServiceProvider.php` | `Gate::before` → semua ability dicek lewat `User::hasPermission()` inilah yang membuat `@can('news.edit')` bekerja; gate khusus `users.edit:self` & `users.delete` |
| `app/Http/Middleware/PermissionMiddleware.php` | Alias `permission:xxx` — cek `hasPermission($permissions[0])`, gagal = `403` |
| `app/Http/Middleware/RoleMiddleware.php` | Alias `role.scope:super_admin/department_admin/admin` |
| `app/Http/Middleware/EnsureNotKaryawan.php` | Alias `admin.access` (pintu `/admin`) |
| `app/Http/Middleware/EnsureKaryawan.php` | Alias `karyawan.access` (pintu `/karyawan`) |
| `app/Http/Controllers/Admin/RoleController.php` | CRUD Role; `syncMatrixPermissions(preserveExtras)` — sinkron matriks → pivot `role_permission` |
| `app/Http/Controllers/Admin/UserController.php` | CRUD Pengguna; `syncDirectPermissions()` — sinkron matriks → pivot `user_has_permissions` |
| `resources/views/admin/partials/permission-matrix.blade.php` | Partial matriks checklist — dipakai form Tambah/Edit **Role** dan tab "Hak Akses Fitur" form **Pengguna** |

### 5.4 Sumber kebenaran (source of truth)

| File | Isinya |
|---|---|
| `app/Models/MasterMenu.php` | Daftar **konstanta** menu sidebar (`MENUS`, 11 id — baris id 12 "contoh" di repo saat ini adalah data uji yang sebaiknya dihapus) + `CRUD_ACTIONS` |
| `database/seeders/MasterMenuSeeder.php` | Mengisi tabel `master_menus` dari konstanta di atas |
| `database/seeders/PermissionSeeder.php` | Membuat daftar permission lalu memberikan ke role |

> ⚠️ Konstanta `MasterMenu::MENUS` berhubungan dengan form matriks Hak
> Akses (`resources/views/admin/partials/permission-matrix.blade.php`) —
> baris baru akan otomatis muncul di matriks. Namun **permission-nya
> HARUS dibuat di `PermissionSeeder`**, jika tidak kolomnya muncul "—".

### 5.5 Logika `hasPermission()` — urutan pengecekan

Method `User::hasPermission($permission)` dipakai oleh Gate (`@can`,
`Gate::authorize`) dan middleware `permission:`. Alurnya (white-list override):

```
cek permission: news.edit
        │
        ▼
1. hasDirectPermission('news.edit')   ← user_has_permissions
        │  YA ──────────────────► ALLOW  (langsung)
        │  TIDAK
        ▼
2. Punya direct permission LAIN modul yang sama? (permissionModule)
        │  YA  ──────────────────► BLOCK  ← override role!
        │      (artinya user pernah mengelola matriks modul ini;
        │       yang tidak dicentang dianggap sengaja dicabut)
        │  TIDAK
        ▼
3. Role permission (role → role_permission) sebagai fallback
        │  role aktif punya news.edit ──► ALLOW
        │  tidak ada ────────────► BLOCK
```

**Contoh konkret** (dari komentar di kode):

- Admin Bidang punya role permission `[news.view, news.edit, news.delete]`.
- Di Direct Permission form Pengguna hanya dicentang `[news.view, news.delete]`.
- Cek `hasPermission('news.edit')` → step 1 gagal, step 2 ketemu direct
  permission `news.*` → **BLOCK** (walaupun role-nya punya).

- Karyawan yang **belum pernah** di-sync direct permission modul `news`.
- `hasPermission('news.edit')` → step 1 gagal, step 2 tidak ada direct
  modul `news` → **fallback ke role** → ikuti permission role-nya.

> Konsekuen praktis: **satu kali** matriks direct permission menu `news`
> disentuh untuk seorang user, seluruh permission `news.*` miliknya jadi
> **didefinisikan oleh matriks itu** — bukan oleh role lagi. Inilah
> mekanisme "setengah admin".

### 5.6 Middleware & Gate — penjaga di semua lapisan

| Middleware | Fungsi |
|---|---|
| `auth` | Login wajib |
| `admin.access` | Hanya admin atau karyawan **ber-permission ekstra** boleh masuk `/admin` |
| `permission:xxx` | Route hanya jika user punya permission xxx |
| `EnsureNotKaryawan` | Karyawan murni (tanpa permission ekstra) **ditolak** di area `/admin` |

Definisi "permission ekstra" — `User::extraKaryawanPermissions()`:
seluruh permission user (direct ∪ role aktif ∪ legacy `role_id`) **minus**
baseline `KARYAWAN_BASELINE_PERMISSIONS`:

```php
public const KARYAWAN_BASELINE_PERMISSIONS = [
    'dashboard.view',
    'news.view',
    'pages.view',
    'internal.view',
    'applications.view',
    'logout',
];
```

Baseline inilah yang di-sync ke role `Karyawan` di `PermissionSeeder`.
Permission **di luar** baseline yang diberikan ke akun Karyawan (lewat
Edit Role atau direct permission) membuat akun itu bisa masuk `/admin`.

### 5.7 Alur Kerja End-to-End

**A. Alur satu request HTTP** (contoh: user klik tombol simpan berita):

```
POST /admin/news  (routes/web.php)
   │  middleware: auth → must.password → admin.access → permission:news.create
   │     admin.access   : Karyawan murni tanpa permission ekstra → ditolak
   │     permission:xxx : User::hasPermission('news.create') → 403 bila gagal
   ▼
NewsController@store → Gate::authorize('news.create')   ← lapis ke-2
   │  Gate::before (AuthServiceProvider) → User::hasPermission()
   ▼
Model/Eloquent → simpan ke MySQL
   ▼
redirect + flash ; view berikutnya memakai @can('news.delete') dst.
   untuk menyembunyikan tombol yang tidak diizinkan (lapis ke-3)
```

**B. Alur mengatur hak akses via Halaman Role** (Super Admin):

```
Role → Tambah/Edit Role  (butuh roles.create / roles.edit + role.scope:super_admin)
   │  form: nama, deskripsi, status + matriks Master Menu × CRUD
   │        (partial permission-matrix.blade.php, data dari
   │         MasterMenu::matrixForRoleForm())
   ▼
RoleController@store / @update
   │  validasi id permission hanya yang milik matriks (intersect)
   ▼  syncMatrixPermissions()
      - store            → sync penuh ke pivot role_permission
      - update           → preserveExtras=true: permission DI LUAR matriks
                           (news.publish, tamu.checkout, dst.) DIPERTAHANKAN
                           — hanya dikelola di halaman "Kelola Permission"
   ▼
@can / permission: di seluruh app langsung menghormati role ini
```

**C. Alur Direct Permission via Form Pengguna** (per akun):

```
Pengguna → Edit (tab "Hak Akses Fitur")   — hanya Super Admin boleh ubah
   │  pre-check checkbox dari User::directPermissionIds()
   ▼
UserController@update → syncDirectPermissions()
   │  role Super Admin / lainnya      → syncPermissions([])  (dikosongkan)
   │  role Admin Bidang / Karyawan    → syncPermissions(intersect
   │                                    submitted ∩ matriks master menu)
   ▼
tabel user_has_permissions ditulis ulang → EFEK LANGSUNG
(tanpa logout): hasPermission(), @can, dan middleware permission:
semuanya membaca data DB real-time
```

### 5.8 Cara Menambahkan Role & Permission secara Manual

Ada 4 cara, dari paling umum sampai paling teknis:

#### 5.8.A Lewat UI — Halaman Kelola Role (dipakai Super Admin sehari-hari)

1. Login sebagai user ber-role `Super Admin` → menu **Role / Hak Akses**
   (butuh permission `roles.view`).
2. **Tambah Role**: klik tombol tambah (permission `roles.create`), isi
   Nama (unik), Deskripsi, Status **Aktif**.
3. Centang matriks **ID Menu × CRUD** sesuai hak akses yang diinginkan
   (mis. untuk role "Editor Berita": Berita → view, create, edit).
4. Simpan → role baru tersimpan di tabel `roles`; centangan matriks
   masuk pivot `role_permission`.
5. Sistem otomatis membawa Anda ke halaman **Kelola Permission** untuk
   memberi permission di luar matriks (mis. `news.publish`) — butuh
   `roles.assign_permission`.
6. Berikan role ke akun: buka **Pengguna → Tambah/Edit** → pilih dropdown
   **Role Pengguna** — sistem menulis `users.role_id` + pivot `role_user`.
7. Verifikasi: login dengan akun tersebut — sidebar hanya menampilkan menu
   yang lolos `@can`, route lain dijaga 403.

> Role Dasar (Super Admin / Admin Bidang / Karyawan) tidak dapat dihapus dan
> namanya terkunci di form Edit — sisanya (role kustom) bebas dihapus.

#### 5.8.B Lewat UI — Direct Permission per Akun (tab "Hak Akses Fitur")

Dipakai ketika hak akses **berbeda antar-orang** dengan role sama (contoh:
"Karyawan SDM boleh kelola berita, Karyawan Sekuriti boleh lihat Data Tamu")
— **TIDAK perlu membuat role baru**.

1. Buka **Pengguna → cari akun → Edit** (hanya Super Admin yang boleh
   mengubah role/permission orang lain).
2. Buka tab **Hak Akses Fitur** → matriks Master Menu × CRUD ditampilkan;
   checkbox yang sudah aktif tercentang dari `directPermissionIds()`.
3. Centang permission yang diinginkan → **Simpan**.
4. Backend (`UserController::update → syncDirectPermissions`):
   - Role **Admin Bidang / Karyawan** → matriks disinkron ke pivot
     `user_has_permissions` (ID di luar matriks ditolak).
   - Role lain (Super Admin dsb.) → direct permission **dikosongkan**
     (`syncPermissions([])`) — Super Admin memang akses penuh via role.
5. Efek tambahan untuk role Karyawan: karena muncul permission **di luar
   baseline** (`extraKaryawanPermissions()` tidak lagi kosong), middleware
   `admin.access` otomatis memperbolehkan akun ini masuk `/admin` — hanya
   menu yang dicentang yang tampak di sidebar.

> ⚠️ Ingat aturan override di 5.5: begitu satu akun punya direct permission
> modul `news` apa pun, seluruh `news.*`-nya dikontrol matriks itu — yang
> tidak dicentang berarti **dicabut**, meskipun role-nya punya.

#### 5.8.C Lewat Kode — PermissionSeeder (sumber permission & role dasar)

Dipakai saat **menambah modul/permission baru** sekalian dengan kodenya.
File: `database/seeders/PermissionSeeder.php`.

1. Tambahkan entri permission ke array `$permissions`:

   ```php
   ['name' => 'laporan.view',   'display_name' => 'Lihat Laporan',   'module' => 'Laporan Management'],
   ['name' => 'laporan.create', 'display_name' => 'Tambah Laporan',  'module' => 'Laporan Management'],
   ['name' => 'laporan.edit',   'display_name' => 'Edit Laporan',    'module' => 'Laporan Management'],
   ['name' => 'laporan.delete', 'display_name' => 'Hapus Laporan',   'module' => 'Laporan Management'],
   ```

2. Berikan ke role di array yang sama:
   - **Super Admin** → tambahkan semua ke `$adminPermissions`.
   - **Admin Bidang** → hanya menu relevan (array explicit di
     `$adminBidang->permissions()->syncWithoutDetaching(...)`).
   - **Karyawan** → hanya lewat konstanta `User::KARYAWAN_BASELINE_PERMISSIONS`
     yang dibaca seeder.

3. Kalau modulnya juga masuk matriks, tambahkan baris ke konstanta
   `MasterMenu::MENUS` di `app/Models/MasterMenu.php` (id unik lanjut
   dari 12) lalu isi tabel `master_menus` via `MasterMenuSeeder`.

4. Jalankan:

   ```bash
   php artisan db:seed --class=PermissionSeeder   # idempotent (firstOrCreate)
   php artisan db:seed --class=MasterMenuSeeder   # updateOrCreate by id
   php artisan optimize:clear
   ```

5. **Jangan lupa route & controller** — permission yang tidak dipakai
   `middleware('permission:...')` / `Gate::authorize` tidak berpengaruh
   apa pun. SOP lengkapnya di Bab 7.

#### 5.8.D Lewat Tinker / SQL — cara manual langsung ke database

Untuk debugging, skenario operasional darurat, atau sekali langsung:

**Tinker (direkomendasikan — pakai API pivot yang sama dengan aplikasi):**

```bash
php artisan tinker

$role = Role::where('name', 'Editor Berita')->first();
$user = User::where('email', 'editor@pln.co.id')->first();

// detail peran:
$role->permissions()->pluck('name');        // isi role_permission
$user->roleNames();                          // pivot role_user + users.role_id
$user->directPermissionNames();              // pivot user_has_permissions
$user->hasPermission('news.edit');           // simulasi cek efektif (lihat 5.5)

// memberi role ke user (pivot role_user):
$user->roles()->sync([$role->id]);
$user->forceFill(['role_id' => $role->id, 'role' => $role->name])->save();

// memberi permission ke role (pivot role_permission):
$role->permissions()->syncWithoutDetaching([1, 2, 3]);

// memberi Direct Permission ke user (pivot user_has_permissions):
$user->syncPermissions(['news.view', 'news.edit']);   // menerima id atau nama
```

**SQL murni** (hanya bila tinker tidak tersedia — ingat semua cukup
memberikan nama permission yang memang ADA di tabel `permissions`):

```sql
-- 1) Buat permission baru
INSERT INTO permissions (name, display_name, module, created_at, updated_at)
VALUES ('laporan.view', 'Lihat Laporan', 'Laporan Management', NOW(), NOW());

-- 2) Pasang permission ke role
INSERT INTO role_permission (role_id, permission_id, created_at, updated_at)
VALUES ((SELECT id FROM roles WHERE name = 'Super Admin' LIMIT 1),
        (SELECT id FROM permissions WHERE name = 'laporan.view' LIMIT 1),
        NOW(), NOW());

-- 3) Pasang role ke user
INSERT INTO role_user (user_id, role_id, created_at, updated_at)
VALUES ((SELECT id FROM users WHERE email = 'operator@pln.co.id' LIMIT 1),
        (SELECT id FROM roles WHERE name = 'Editor Berita' LIMIT 1),
        NOW(), NOW());

-- 4) Direct Permission per akun
INSERT INTO user_has_permissions (user_id, permission_id, created_at, updated_at)
VALUES ((SELECT id FROM users WHERE email = 'editor@pln.co.id' LIMIT 1),
        (SELECT id FROM permissions WHERE name = 'news.edit' LIMIT 1),
        NOW(), NOW());

-- 5) Nonaktifkan role (semua permission-nya otomatis diabaikan
--     tanpa menghapus pivot; aktifkan lagi tanpa perlu pasang ulang)
UPDATE roles SET status = 0 WHERE name = 'Software Tester';
```

Perhatian: semua pivot punya kolom UNIQUE `(user_id, role_id)` /
`(role_id, permission_id)` / `(user_id, permission_id)` — INSERT duplikat
akan ditolak. Cek dengan `SELECT` dahulu, atau gunakan `INSERT IGNORE`.
Jangan lupa isi `created_at` / `updated_at` (kolom NOT NULL).

### 5.9 Katalog Permission Lengkap

Daftar lengkap yang dibuat `PermissionSeeder` (acuan penulisan kode & form hak akses):

| Modul | Permission | Catatan |
|---|---|---|
| Dashboard | `dashboard.view` | Hanya lihat — kolom lain di matriks otomatis "—" |
| Pengguna | `users.view`, `users.create`, `users.edit`, `users.delete` | `users.edit` = kelola status Aktif/Nonaktif |
| Pengguna (aksi khusus) | `user.reset-password` | Terpisah agar dapat didelegasikan sendiri |
| Role | `roles.view`, `roles.create`, `roles.edit`, `roles.delete` | |
| Role (aksi khusus) | `roles.assign_permission` | Akses halaman "Kelola Permission" |
| Berita | `news.view / create / edit / delete` | Kolom `.publish` juga ada |
| Pengumuman | `announcements.view / create / edit / delete` | kolom `.publish` juga ada |
| Galeri | `galleries.view / create / edit / delete` | |
| Link Kerja | `work_links.view / create / edit / delete` | Modul per-bidang |
| Data Tamu | `tamu.view / create / edit / delete` | Aksi khusus: `tamu.checkout` |
| Halaman CMS | `pages.view / create / edit / delete` | Menu sensitif — dilarang untuk Admin Bidang |
| Menu Builder | `menus.view / create / edit / delete` | Menu sensitif — dilarang untuk Admin Bidang |
| Grup Karyawan | `groups.view / create / edit / delete` | |
| Aplikasi | `applications.view / create / edit / delete` | |
| Log Aktivitas | `activity_logs.view`, `activity_logs.delete` | Tidak ada create/edit (sistem yang menulis) |
| Pengaturan | `settings.view`, `settings.edit` | |
| Halaman Internal | `internal.view` | Bagian baseline Karyawan |
| Autentikasi | `logout` | Tanpa prefix modul |

### 5.10 Data Scoping (batas bidang)

Semakin dalam dari RBAC: **Super Admin & Senior Manager** melihat semua
data; sedangkan **Admin Bidang & Karyawan terikat bidang** hanya melihat
data bidang/sub-bidangnya. Yang menentukan adalah
`User::dataScopingLevel()`:

| Level | Siapa | Contoh filter |
|---|---|---|
| `bypass` | Super Admin, Senior Manager | Lihat semua |
| `bidang_sub` | Admin Bidang dengan sub-bidang, Karyawan Asman/Staf | `department_id = X` AND `sub_department = 'asmen_prod_a'` |
| `bidang` | Admin Bidang tanpa sub / Karyawan Manager Bidang | `department_id = X` saja |

Controller modul **per-bidang** memakai trait
`app/Http/Controllers/Concerns/ScopesToDepartment.php` — jangan tulis
logika filter di controller ribet-ribet.

### 5.11 Kolom Penanda Nama di Tabel Pivot (readability markers)

Agar isi pivot mudah dibaca di phpMyAdmin, empat tabel pivot punya
kolom salinan nama (**nullable, tanpa default**):

| Tabel | Kolom penanda | Sumber nilai |
|---|---|---|
| `role_permission` | `role_name`, `permission_name` | `roles.name`, `permissions.name` |
| `role_user` | `user_name`, `role_name` | `users.name`, `roles.name` |
| `user_has_permissions` | `user_name`, `permission_name` | `users.name`, `permissions.name` |
| `page_role` | `page_name`, `role_name` | **`pages.title`** (bukan `name`), `roles.name` |

**Aturan main — kolom ini BUKAN bagian mekanisme RBAC:**

- Seluruh proses aplikasi (sync/attach/`hasPermission`/middleware/Gate)
  tetap memakai ID (`role_id`, `permission_id`, `user_id`, `page_id`).
  Test `PivotNameMarkerTest::test_markers_never_affect_rbac_logic`
  memastikan penanda yang sengaja dibuat basi pun tidak mempengaruhi
  akses apa pun.
- Kolom nullable tanpa default → INSERT lama yang tidak mengirim kolom
  ini tetap berhasil; tidak ada FK/unique constraint lama yang diubah.

**Mekanisme pemeliharaan (2 lapis):**

1. **Insert pivot baru** — relasi memakai
   `App\Models\Relations\BelongsToManyNameMarkers` via trait
   `App\Models\Concerns\HasNameMarkerPivots` (dipakai model `User`,
   `Role`, `Permission`, `Page`). Setiap `attach()` / `sync()` /
   `syncWithoutDetaching()` otomatis mengisi penanda baris baru
   (konfigurasi per relasi lewat `->withNameMarkers(...)`).
2. **Rename sumber** — `App\Observers\NameMarkerObserver` (didaftrkan
   di `AppServiceProvider`) memperbarui penanda di seluruh baris pivot
   terkait saat `roles.name`, `permissions.name`, `users.name`, atau
   `pages.title` berubah. Hanya kolom nama yang berubah yang diproses.

Isi awal (baris existing) di-backfill migration
`2026_10_14_000002_backfill_name_marker_columns_to_pivot_tables`.

**Keterbatasan yang perlu diingat:**

- Tulis **raw SQL** ke tabel pivot (INSERT manual di phpMyAdmin / SQL
  konsol) TIDAK terdeteksi — penanda baris itu tetap NULL sampai
  diisi manual. Jalur yang didukung: semua tulis lewat Eloquent
  (relasi di atas).
- `DB::table('...')->update(...)` pada tabel sumber (bukan model)
  tidak memicu observer → penanda bisa basi; perbaiki dengan
  meng-update lewat model Eloquent.
- Rename mengubah penanda, tapi **tidak** meng-ID-kan ulang apa pun —
  aman untuk data pivot.

---

## 6. Daftar Fitur Lengkap

Bab ini memetakan **seluruh fitur aplikasi** per area, disarikan dari
`routes/web.php`, controller, dan middleware. Gunakan sebagai peta saat
mencari "fitur X ada di file mana".

### 6.1 Portal Publik (tanpa login) — `HomeController`, `PageDisplayController`, `TamuController`

| Fitur | Route | Controller/View | Penjelasan |
|---|---|---|---|
| Landing page utama | `GET /` → `home` | `HomeController@index` | Hero, berita terbaru, pengumuman publik, galeri, statistik tamu |
| Halaman tentang kami (4) | `GET /tentang-kami/{sejarah\|visi-misi\|profil-perusahaan\|struktur-organisasi}` | `HomeController` / view statis | Konten statis profil UP Indramayu |
| Daftar & detail berita | `GET /informasi/berita`, `GET /informasi/berita/{slug}` | Closure route + `informasi/*` view | Hanya `is_published=true` + `forPublic()`; detail menampilkan 3 berita terkait satu kategori |
| Daftar & detail pengumuman | `GET /informasi/pengumuman(/{slug})` | Closure route | Publik **tanpa data-scoping bidang** — global scope `ScopedToUserDepartment` dimatikan eksplisit; konten dikurasi via `target_publication` (`public`/`all`) |
| Galeri publik | `GET /informasi/galeri` | Closure route | `Gallery::published()` paginasi 9, dengan grid + lightbox |
| Halaman CMS dinamis | `GET /halaman`, `GET /halaman/{slug}` | `PageDisplayController@index/show` + middleware `page.visible` | Dua pintu (publik & internal); visibilitas draft / role-terbatas di-enforce server-side (`EnsurePageVisible`) |
| Menu navigasi dinamis | (view composer `layouts.navbar`) | `MenuBuilderService::treeFor(user)` | Navbar publik dibangun dari tabel `menus`; menu ber-target halaman CMS disaring sesuai visibilitas per role |
| FAQ | `GET /layanan/faq` | View statis | |
| **Registrasi tamu publik** | `GET/POST /layanan/form-registrasi-tamu` | `TamuController@create/store` | Buku tamu tanpa login: NIK, instansi, KTP (upload), tujuan ditemui (divisi), jumlah tamu, jadwal |
| API slot tersibuk | `GET /api/booked-slots` | `TamuController@bookedSlots` | JSON daftar jam terblokir per divisi/tanggal — dipakai fetch JS form registrasi; backend validasi ulang via `Tamu::isJamTerblokir agar double booking sama divisi tidak lolos`

### 6.2 Modul Buku Tamu (positif lengkap — kolom penting)

Fitur paling kompleks di aplikasi. Model `app/Models/Tamu.php`:

- **Siklus verifikasi:** `menunggu → disetujui\|ditolak` (`status_verifikasi`, `verified_at`, `verified_by`).
- **Check-in/check-out front office:** `checked_in_at`, `checked_out_at`, durasi kunjungan otomatis (`durasiKunjungan()`).
- **Slot locking:** setiap kunjungan disetujui memblokir rentang 3 jam (`Tamu::DURASI_KUNJUNGAN_JAM`) untuk `tujuan_ditemui` yang sama; divisi berbeda tetap boleh jam sama (`Tamu::jamTerblokir()`).
- **Slot jam:** pagi 08–11 & siang 13–15 (`Tamu::SLOT_JAM`); 12:00–13:00 istirahat.
- **Dokumen privat:** arsip ZIP di disk `private`, tidak bisa diakses via `/storage` — disajikan streaming lewat route ber-auth (`TamuDocumentController@dokumen`).
- **Integrasi WhatsApp:** nomor HP dinormalisasi ke format 62 (`getWaNumberAttribute`), URL click-to-chat sudah terisi pesan disetujui/ditolak (`getWaApproveUrlAttribute`, `getWaRejectUrlAttribute`) — admin tinggal klik.
- **Ekspor & cetak:** `GET admin/tamu/export` (Excel/CSV) dan `GET admin/tamu/print/{style?}` (PDF/berkas cetak).
- **Filter pencarian:** scope `search` (nama/instansi/NIK), `tanggalAntara`, `status` (menunggu/disetujui/ditolak/berkunjung/selesai).

### 6.3 Autentikasi & Manajemen Akun — `app/Http/Controllers/Auth`

| Fitur | Route | Penjelasan |
|---|---|---|
| Login admin/karyawan | `GET/POST /admin/login`, logout `POST /admin/logout` | Satu pintu login untuk semua; redirect setelah login tergantung role (`User::isAdmin()` / `isKaryawan()`) |
| Lupa password via OTP email | `POST /forgot-password/otp`, `POST /forgot-password/reset` (throttle 10/menit) | AJAX JSON dari modal di halaman login; OTP dikirim via `Mail\OtpMail` |
| Ganti password wajib | `GET/POST /account/password/*` + middleware `must.password` | Akun yang passwordnya direset admin (`must_change_password=true`) dihalangi ke halaman ganti password sebelum boleh lanjut ke halaman manapun |
| Halaman register nonaktif | `GET /register` → redirect ke login | Tidak ada pendaftaran mandiri — akun dibuat Super Admin lewat panel |`

### 6.4 Admin Panel (semua di prefix `/admin`, middleware `auth` + `admin.access`)

Middleware alias (didaftarkan di `bootstrap/app.php`):

| Alias | Class | Fungsi |
|---|---|---|
| `admin.access` | `EnsureNotKaryawan` | Karyawan murni (tanpa permission ekstra) ditolak masuk `/admin` |
| `karyawan.access` | `EnsureKaryawan` | Hanya Karyawan murni boleh masuk portal karyawan |
| `role.scope:super_admin` | `RoleMiddleware` | Tolak Admin Bidang (menu sensitif: User, Role, Pages, Menus) |
| `role.scope:admin` | `RoleMiddleware` | Semua admin kecuali Karyawan; Admin Bidang wajib terikat bidang |
| `permission:xxx` | `PermissionMiddleware` | Cek `User::hasPermission()` per aksi |
| `page.visible` | `EnsurePageVisible` | Halaman CMS draft/terbatas disembunyikan |
| `must.password` | `MustChangePassword` | Pemaksa ganti password |

#### Dashboard & utilitas

| Fitur | Route | Penjelasan |
|---|---|---|
| Dashboard statistik | `GET /admin/dashboard` | Statistik tamu/berita/pengumuman + quick actions adaptif permission |
| Pencarian global topbar | `GET /admin/search` | `AdminSearchController` invocable — cari berita/pengumuman/tamu/user dari topbar (Ctrl+K) |
| Notifikasi lonceng | `GET /admin/notifications/poll`, `POST /admin/notifications/seen` | Polling JSON dot & badge live via `NotificationService` (melacak `users.last_seen_tamu_id` per akun); "seen" dicatat saat dropdown dibuka |
| Pengaturan panel | `GET /admin/settings` + PUT `profile`, `notifications`, `password` | Tema tampilan, preferensi notifikasi (kolom JSON `notification_settings`), ganti profil & password |
| Log aktivitas | `GET /admin/activity-logs`, `DELETE /admin/activity-logs/{uuid}`, `DELETE` (clear) | Audit trail semua aksi penting (`ActivityLogger::log`); permission `activity_logs.view` / `.delete` |

#### CRUD konten

| Modul | Route prefix | Permission | Catatan khusus |
|---|---|---|---|
| Berita (news) | `/admin/news` | `news.*` + `news.publish` | Publish/unpublish via `togglePublish`; field `target_publication` (all/public/karyawan); urutan route: statis `create` SEBELUM wildcard `{news}` |
| Pengumuman | `/admin/announcements` | `announcements.*` + `.publish` | Dibungkus `role.scope:admin` — Admin Bidang scoped ke bidangnya (global scope `ScopedToUserDepartment`) |
| Galeri | `/admin/galeri` | `galleries.*` | Toggle status via PATCH; dipakai juga landing publik |
| Link Kerja | `/admin/work-links` | `work_links.*` | Dikelola per bidang/sub-bidang — konsumen utamanya portal karyawan (`PortalContentService`) |

#### Manajemen pengguna, role & hak akses (HANYA Super Admin — `role.scope:super_admin`)

| Fitur | Route | Permission | Penjelasan |
|---|---|---|---|
| Daftar pengguna | `GET users` | `users.view` | Filter/search; kuota Super Admin ≤ 3 (`User::MAX_SUPER_ADMIN_ACCOUNTS`) & Senior Manager ≤ 3 (`MAX_SENIOR_MANAGER_ACCOUNTS`) |
| Tambah pengguna | `GET/POST users/create` | `users.create` | Dropdown role terbatas 3 aktor (`ASSIGNABLE_ROLE_NAMES`); validasi hirarki (level jabatan × bidang × sub-bidang dependent dropdown) |
| Detail pengguna | `GET users/{user}` | – | Selalu terbuka (dipakai profil saya di topbar) |
| Toggle status akun | `PATCH users/{user}/toggle-status` | `users.edit` | Aktif ⇄ Nonaktif (pengganti fitur edit penuh lama) |
| Reset password | `PATCH users/{user}/reset-password` | `user.reset-permission` (terpisah biar bisa didelegasikan) | Password sementara sekali pakai → `must_change_password=true` |
| Hapus pengguna | `DELETE users/{user}` | `users.delete` | |
| Edit profil + Direct Permission | `GET/PUT users/{user}/edit` | `can:users.edit:self` | Pengecualian di `AuthServiceProvider`: user SELALU boleh edit profil sendiri; task mahaksa matriks Direct Permission (tab "Hak Akses Fitur") |
| Kelola role | `GET/POST/PUT/DELETE roles*` | `roles.*` | CRUD Role + toggle status role nonaktif; update permission via `roles.assign_permission` (matriks Master Menu × CRUD) |
| Halaman CMS | `pages.*` | `pages.*` + `role.scope:super_admin` | CRUD halaman + section builder (`PageSectionController` — store/update/move/destroy) |
| Menu Builder | `menus.*` | `menus.*` + `role.scope:super_admin` | CRUD menu landing page + toggle status + move (urutan) |

### 6.5 Portal Karyawan (`/karyawan/*`, middleware `auth` + `karyawan.access`)

Semua halaman view-only KECUALI: profil, dan modul **berita/pengumuman/galeri/tamu** yang diberikan via permission (dropdown "Akses Admin" di layout `karyawan.blade.php`).

| Fitur | Route | Penjelasan |
|---|---|---|
| Dashboard karyawan | `GET /karyawan/dashboard` | Sapaan, statistik, link kerja ter-scope (`PortalContentService::workLinksBalancedFor`) |
| Informasi | `GET /karyawan/informasi(/{type}/{slug})` | Berita & pengumuman internal — type `berita\|pengumuman`, content di-scope bidang untuk pengumuman |
| Layanan internal | `GET /karyawan/layanan(/{slug})` | Panduan/prosedur statis dari `PortalContentService::internalServicesFor()` — ter-scope hirarki user |
| Link Kerja | `GET /karyawan/link` | Link dari tabel `work_links`; aturan scope: Senior Manager/Admin = semua, Manager Bidang = bidang+umum, Asmen/Staf = terkunci sub-bidang sendiri + umum (`PortalContentService::linkAccessFor()`) |
| Profil saya | `GET/PUT /karyawan/profil` | Satu-satunya bagian yang bisa diubah karyawan (nama, no HP, alamat, foto) |
| Kelola Berita (bonus) | `/karyawan/berita/*` | CRUD + publish, REUSE `permission:news.*` — controller `Karyawan\NewsController` |
| Kelola Pengumuman | `/karyawan/pengumuman/*` | Idem, `announcements.*` |
| Kelola Galeri | `/karyawan/galeri/*` | `galleries.*` |
| Data Tamu | `/karyawan/data-tamu/*` | `tamu.*` — controller `Karyawan\TamuController` **extends** controller Admin `TamuController` (logic reuse penuh, layout beda) |

### 6.4.1 Data Karyawan (master data HR — panel admin)

Modul `karyawan_data.*` di **panel admin** (`/admin/data-karyawan`,
tombol sidebar "Data Karyawan" di bagian Manajemen). Permission di luar
matriks admin — assign lewat **Kelola Permission** / Direct Permission;
Super Admin dapat semua secara bawaan (lihat PermissionSeeder):

- **Tabel** `karyawans` (migrasi `2026_10_15_000001`) — 24 kolom
  spesifikasi, `nid` unique string (nol di depan aman), tanggal bertipe
  `date`, tanpa FK ke `users` (data profil ≠ akun login).
- **Model** `App\Models\Karyawan` — `COLUMNS_LABELS` (urutan kolom →
  label), scope `search()`/`filtered()` dipakai daftar & ekspor.
- **Controller** `Admin\DataKaryawanController` — CRUD + `template()`
  (unduh kerangka CSV), `import()` (validasi per baris di memori →
  transaksi; duplikat dilewati tanpa menimpa; ringkasan sukses/gagal/
  duplikat), `export()` (CSV mengikuti filter aktif).
- **Impor** menerima **CSV/TXT ATAU Excel (.xlsx)** dalam satu endpoint
  `POST admin/karyawan_data/import` — pemilihan pembaca dari ekstensi
  file (validasi ekstensi, bukan `mimes:` karena file .xlsx terdeteksi
  fileinfo sebagai `application/zip`). Header 24 kolom dipetakan oleh
  `mapHeaderRow()` yang **dipakai bersama** kedua jalur; tiap baris
  membawa  nomor baris asli untuk laporan error. Jalur XLSX memakai
  service `App\Services\XlsxReader`.
- **Toleransi data historis** (berlaku di & impor CSV maupun XLSX):
  ORGANIK maksimal **100** karakter (dilebarkan lewat migrasi
  `2026_10_16_000001`, kolom `karyawans.organik`); FTE non-angka
  (mis. "PJS") diabaikan jadi kosong — bukan gagal; tanggal
  placeholder sistem lama ("00/00/0000", "0000-00-00") dianggap
  kosong; STATUS KAWIN menerima teks panjang ("Menikah"/"Belum
  Menikah" → K/TK).
- **Service** `App\Services\XlsxReader` — pembaca .xlsx **native tanpa
  ekstensi `zip`**: parsing ZIP manual (End-Of-Central-Directory →
  central directory → local file header, metode store/deflate via
  `gzinflate`) + pembacaan XML (`workbook.xml` → sheet pertama lewat
  relasi, `sharedStrings.xml`, `styles.xml` untuk deteksi format
  tanggal). Sel angka bergaya tanggal diubah dari serial Excel ke
  `Y-m-d`; query XML memakai `local-name()` (bebas namespace) dan
  DOCTYPE ditolak (anti billion-laughs); batas 64MB per arsip
  (anti zip-bomb).
- **View** `admin/data-karyawan/{index,form,show}` — form & detail
  dikelompokkan 5 bagian (Identitas / Pekerjaan / Riwayat Tanggal /
  Kontak / Tambahan).
- Test: `tests/Feature/DataKaryawanTest.php` (35 kasus — CRUD,
  otorisasi, impor CSV (delimiter/BOM/24 kolom/duplikat), impor XLSX
  (parser ZIP native via helper `Tests\Support\XlsxWriter` yang
  menyusun arsip ZIP+XML secara manual), ekspor mengikuti filter).
  Helper: `tests/Support/XlsxWriter.php`.

**Integrasi master Bidang/Jabatan** (migrasi
`2026_10_20_000002_add_org_master_refs_to_karyawans_table`):

- Kolom baru `karyawans.bidang_id` & `jabatan_id` (nullable, FK
  `restrictOnDelete`). Kolom teks `bidang`/`jabatan` **tetap** ada dan
  tetap jadi format impor/ekspor — jangan dihapus.
- Relasi model: `Karyawan::bidangMaster()` / `jabatanMaster()` (sengaja
  tidak dinamai `bidang`/`jabatan` karena atribut teks sudah memakai
  nama itu). Tampilan memakai `bidangLabel()`/`jabatanLabel()` (teks
  lama diutamakan, master jadi cadangan).
- Form memakai select `bidang_id`/`jabatan_id` + hidden `bidang_text`/
  `jabatan_text`. Nilai select: id master, `legacy` (pertahankan teks
  lama), `clear` (kosongkan). Server menurunkan teks dari nama master
  saat id dipilih, dan menolak jabatan yang bukan milik bidang terpilih.
- Filter daftar: nilai `#<id>` memfilter lewat relasi master, nilai teks
  memfilter kolom lama (data belum terpetakan tetap bisa dicari/ekspor).
- Impor: nama dinormalisasi & dicocokkan lewat
  `App\Services\MasterOrgMatcher` — hanya dipetakan bila tepat satu
  kandidat dan jabatan berada di bidang yang sama; ambigu/tidak ada
  dibiarkan `NULL`, teks asli dipertahankan, dan dilaporkan di ringkasan
  impor. Tidak pernah membuat master baru.
- Backfill data lama: `php artisan karyawan:backfill-master` (default
  simulasi) lalu `--apply`. Hanya mengisi kolom id yang masih `NULL`,
  tidak mengubah teks, aman dijalankan ulang.
- Seeder master: `MasterBidangJabatanSeeder` (38 bidang, 5 jabatan —
  data aktual UP Indramayu; idempoten, parent hanya diisi bila kosong).
  Sudah dipanggil dari `DatabaseSeeder`.
- Test integrasi: `tests/Feature/DataKaryawanMasterIntegrationTest.php`
  (20 kasus — validasi silang bidang/jabatan, nilai lama tidak hilang,
  filter master & legacy, pemetaan impor, backfill idempoten, seeder).

### 6.6 Middleware global (bootstrap/app.php)

- MustChangePassword di-append ke grup `web` — semua halaman ber-auth dijaga.
- `trustProxies(at: '*')` — wajib: support ngrok/tunnel agar cookie Secure & CSRF tidak 419.

### 6.7 Service layer yang dipakai lintas modul

| Service | Dipakai untuk |
|---|---|
| `App\Services\ActivityLogger` | Audit trail (`activity_logs`); selalu log SEBELUM delete |
| `App\Services\MenuBuilderService` | Navbar publik dinamis dari tabel `menus` |
| `App\Services\NotificationService` | Isi notifikasi topbar admin (tamu baru/belum dibaca per akun) |
| `App\Services\PortalContentService` | Seluruh konten portal karyawan: link kerja & layanan internal ter-scope hirarki |
| `App\Services\XlsxReader` | Baca file .xlsx impor Data Karyawan tanpa ext-zip (parser ZIP native + DOM XML) |
| `App\Http\Controllers\Concerns\ScopesToDepartment` | Trait filter data per-bidang di controller modul bidang |
| `App\Models\Scopes\ScopedToUserDepartment` | Global scope data-scoping bidang — dimatikan eksplisit di halaman publik pengumuman |
| `App\Support\GrantPermission` | Artisan console command (`php artisan permission:grant?`) untuk bantuan debugging permission |
| View composers | `TopbarComposer` (topbar admin), `KaryawanLayoutComposer` (portal karyawan), `MenuBuilderService` composer (navbar publik) |

---

## 7. SOP Menambah Module Baru

**Sekali lagi: lewatkan langkah 5–7 = penyebab utama "fitur tidak muncul".**

✅ **Checklist ringkas:**

- [ ] 1. Migration + Model
- [ ] 2. Route (`routes/web.php`)
- [ ] 3. Controller (+ `Gate::authorize`)
- [ ] 4. View (Blade)
- [ ] 5. ⭐ `PermissionSeeder`
- [ ] 6. ⭐ `MasterMenu::MENUS`
- [ ] 7. Sidebar Admin
- [ ] 8. (Opsional) Portal Karyawan
- [ ] 9. `php artisan` — migrate + seed
- [ ] 10. Test

---

### 7.1 Migration & Model

```bash
php artisan make:model Laporan -m
```

Edit migration yang baru dibuat di `database/migrations/…_create_laporans_table.php`:

```php
public function up(): void
{
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('ringkasan')->nullable();
        $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('laporans');
}
```

Lalu di model `app/Models/Laporan.php`:

```php
class Laporan extends Model
{
    protected $fillable = ['judul', 'ringkasan', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```

Jalankan:

```bash
php artisan migrate
```

---

### 7.2 Route — guard per aksi

Tambah di `routes/web.php`, di grup admin. **WAJIB** per-aksi middleware
permission (jangan satu grup satu permission untuk create+delete sekaligus):

```php
use App\Http\Controllers\Admin\LaporanController;

// ===== LAPORAN =====
Route::middleware('permission:laporan.view')->group(function () {
    Route::get('laporan', [LaporanController::class, 'index'])
        ->name('admin.laporan.index');
});

Route::middleware('permission:laporan.create')->group(function () {
    Route::get('laporan/create', [LaporanController::class, 'create'])
        ->name('admin.laporan.create');
    Route::post('laporan', [LaporanController::class, 'store'])
        ->name('admin.laporan.store');
});

Route::middleware('permission:laporan.edit')->group(function () {
    Route::get('laporan/{laporan}/edit', [LaporanController::class, 'edit'])
        ->name('admin.laporan.edit');
    Route::put('laporan/{laporan}', [LaporanController::class, 'update'])
        ->name('admin.laporan.update');
});

Route::middleware('permission:laporan.delete')->group(function () {
    Route::delete('laporan/{laporan}', [LaporanController::class, 'destroy'])
        ->name('admin.laporan.destroy');
});
```

> Pattern referensi yang sudah ada: rute `work-links` di `routes/web.php`
> (`admin.work-links.index`, dst.) — ikuti penamaan yang persis sama.

---

### 7.3 Controller — selalu `Gate::authorize`

```bash
php artisan make:controller Admin/LaporanController --resource --model=Laporan
```

Edit `app/Http/Controllers/Admin/LaporanController.php`:

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Support\ActivityLogger;   // sesuaikan namespace bila berbeda
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LaporanController extends Controller
{
    public function index()
    {
        Gate::authorize('laporan.view');   // defense in depth #2

        $laporans = Laporan::with('user')->latest()->paginate(10);

        return view('admin.laporan.index', compact('laporans'));
    }

    public function create()
    {
        Gate::authorize('laporan.create');

        return view('admin.laporan.form');
    }

    public function store(Request $request)
    {
        Gate::authorize('laporan.create');

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
        ]);

        $laporan = Laporan::create($validated + ['user_id' => $request->user()->id]);

        ActivityLogger::log('buat_laporan', "membuat laporan \"{$laporan->judul}\"");

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dibuat.');
    }

    public function edit(Laporan $laporan)
    {
        Gate::authorize('laporan.edit');

        return view('admin.laporan.form', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        Gate::authorize('laporan.edit');

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
        ]);

        $laporan->update($validated);

        ActivityLogger::log('ubah_laporan', "mengubah laporan \"{$laporan->judul}\"");

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        Gate::authorize('laporan.delete');

        // Log DULU sebelum delete — karena model hilang setelahnya:
        ActivityLogger::log('hapus_laporan', "menghapus laporan \"{$laporan->judul}\"");

        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
```

> **Kontroler milik bidang?** Kalau datanya hanya boleh dilihat per
> bidang, pakai trait `ScopesToDepartment`
> (`app/Http/Controllers/Concerns/ScopesToDepartment.php`) — jangan
> tulis ulang filter-nya.

---

### 7.4 View (Blade)

```bash
mkdir -p resources/views/admin/laporan
```

Buat 2 file: `index.blade.php` dan `form.blade.php` (dipakai create & edit).

**index.blade.php** — tombol aksi wajib dibungkus `@can`:

```blade
@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1>Laporan</h1>

    @can('laporan.create')
        <a href="{{ route('admin.laporan.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Laporan
        </a>
    @endcan
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr><th>Judul</th><th>Pembuat</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @foreach ($laporans as $item)
            <tr>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->user?->name }}</td>
                <td>
                    @can('laporan.edit')
                        <a href="{{ route('admin.laporan.edit', $item) }}">Edit</a>
                    @endcan

                    @can('laporan.delete')
                        <form action="{{ route('admin.laporan.destroy', $item) }}"
                              method="POST" style="display:inline"
                              onsubmit="return confirm('Hapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $laporans->links() }}
@endsection
```

**form.blade.php** (dipakai create & edit sekaligus):

```blade
@extends('layouts.admin')

@section('content')
    @php $isEdit = isset($laporan); @endphp

    <h1>{{ $isEdit ? 'Edit' : 'Tambah' }} Laporan</h1>

    <form method="POST"
          action="{{ $isEdit ? route('admin.laporan.update', $laporan)
                             : route('admin.laporan.store') }}">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <input name="judul" value="{{ old('judul', $laporan->judul ?? '') }}" required>

        <textarea name="ringkasan">{{ old('ringkasan', $laporan->ringkasan ?? '') }}</textarea>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.laporan.index') }}">Batal</a>
    </form>
@endsection
```

> Pattern super lengkap bisa dilihat di:
> `resources/views/admin/work_links/index.blade.php`.

---

### 7.5 ⭐ PermissionSeeder — WAJIB

File: `database/seeders/PermissionSeeder.php`

**Step 5a — daftarkan permission baru** ke array `$permissions` di atas:

```php
['name' => 'laporan.view',   'display_name' => 'Lihat Laporan',  'module' => 'Laporan Management'],
['name' => 'laporan.create', 'display_name' => 'Tambah Laporan', 'module' => 'Laporan Management'],
['name' => 'laporan.edit',   'display_name' => 'Edit Laporan',   'module' => 'Laporan Management'],
['name' => 'laporan.delete', 'display_name' => 'Hapus Laporan',  'module' => 'Laporan Management'],
```

**Aturan penamaan:**

```
<permission_key>.<action>
```

`action` umumnya salah satu `view | create | edit | delete`, tapi ada
juga yang khusus per modul: `publish` (news, announcements),
`checkout` (tamu), `reset-password` (user), `assign_permission` (roles),
`logout` (auth, tanpa prefix modul).

> 💡 Menu yang hanya bisa dilihat (mis. Dashboard) cukup dibuat `.view`
> saja. Di matriks hak akses kolom lain otomatis tampak "—".

**Step 5b — berikan permission ke role**, masih di seeder yang sama:

- **Super Admin** → tambahkan 4 permission di atas ke array `$adminPermissions`.
- **Admin Bidang** → hanya kalau memang menu-nya untuk Admin Bidang.
- **Karyawan** → hanya kalau menu juga dibuka di Portal Karyawan
  (biasanya tidak).

```php
// di array $adminPermissions:
'laporan.view', 'laporan.create', 'laporan.edit', 'laporan.delete',
```

Untuk **Admin Bidang**, komit ke array explicit di seeder (baris
`$adminBidang->permissions()->syncWithoutDetaching(...)`).

---

### 7.6 ⭐ MasterMenu — WAJIB (muncul di Matriks Hak Akses)

File: `app/Models/MasterMenu.php` → konstanta `MENUS`.

Tambah 1 baris. **ID harus unik** (lanjut dari terakhir = 13):

```php
['id' => 13, 'name' => 'Laporan', 'route' => 'admin.laporan.index',
 'icon' => 'fa-file-alt', 'permission_key' => 'laporan'],
```

Setelah itu jalankan ulang seeder:

```bash
php artisan db:seed --class=MasterMenuSeeder
```

> Seeder idempotent (pakai `updateOrCreate` by `id`) — aman dipanggil
> berulang tanpa menambah duplikat.

Setelah langkah ini, menu **Laporan** otomatis muncul di:

- Matrix Hak Akses (Form Tambah/Edit Role) → matriks per-ID Menu × CRUD
- Direct Permission (Form Pengguna, tab "Hak Akses Fitur")

...dengan checkbox per-aksi sesuai permission yang terdaftar.

---

### 7.7 Sidebar Admin

File: `resources/views/layouts/admin.blade.php`, sisipkan di blok menu:

```blade
@can('laporan.view')
<a href="{{ route('admin.laporan.index') }}"
   class="sidebar-link @if(request()->routeIs('admin.laporan.*')) active @endif">
    <i class="fas fa-file-alt"></i>
    <span class="link-text">Laporan</span>
</a>
@endcan
```

---

### 7.8 Portal Karyawan (opsional, kalau menu-nya relevan di-hak)

1. Tambahkan permission baseline di `app/Models/User.php`:

   ```php
   public const KARYAWAN_BASELINE_PERMISSIONS = [
       // ...
       'laporan.view',
   ];
   ```

   (Ini otomatis ter-sync ke Karyawan saat `PermissionSeeder` dijalankan,
   karena dia membaca konstanta ini.)

2. Tambahkan link sidebar di `resources/views/layouts/karyawan.blade.php`
   dengan blok `@can('laporan.view')`.

> ⚠️ Permission di luar baseline ini disebut **permission ekstra** dan
> otomatis membuka **akses Panel Admin** untuk akun Karyawan tersebut
> (lihat `EnsureNotKaryawan` & `hasExtraKaryawanPermission()`).

---

### 7.9 Jalankan Perintah

Dalam satu paket setelah semua diedit:

```bash
php artisan migrate                                   # kalau ada tabel/kolom baru
php artisan db:seed --class=PermissionSeeder          # daftar permission × role
php artisan db:seed --class=MasterMenuSeeder          # matriks master menu
php artisan optimize:clear                            # bersihkan cache route/view/config
```

Semua seeder idempotent — aman dijalankan berulang.

**Cek cepat manual:**

1. Login sebagai Super Admin → menu baru muncul di sidebar ✔
2. Halaman Role (Tambah/Edit) → matriks menampilkan 1 baris baru dengan
   checkbox CRUD ✔
3. Halaman Pengguna (tab "Hak Akses Fitur") → menu baru muncul ✔
4. Coba akses route tanpa permission → 403 ✔

---

### 7.10 Akun Karyawan "Setengah-Admin" — kasus spesial

Keinginan "karyawan So & So bisa kelola Link Kerja" didukung **tanpa
role baru**. Cukup:

1. Edit user di `Pengguna → Edit` → tab **Hak Akses Fitur**.
2. Centang **link kerja.view** dsb pada matriks Direct Permission.
3. Karena dia sekarang punya permission yang **di luar baseline**
   Karyawan, middleware `admin.access` otomatis memperbolehkan dia masuk
   `/admin` — hanya menu yang dicentang yang tampak.

---

## 8. SOP Menambah Aksi Baru

Kalau yang ditambah **bukan menu baru** melainkan **kolom aksi baru** di
matriks (mis. "Export"):

1. `app/Models/MasterMenu.php` → `CRUD_ACTIONS`:

   ```php
   public const CRUD_ACTIONS = [
       'view'   => 'Buka Menu (View)',
       'create' => 'Tambah (Create)',
       'edit'   => 'Edit (Update)',
       'delete' => 'Hapus (Delete)',
       'export' => 'Export (Download)',   // ← baru
   ];
   ```

2. `database/seeders/PermissionSeeder.php` → buat permission `key.export`
   untuk menu yang relevan (mis. `news.export`), dan berikan ke role
   yang berhak.

3. `resources/views/admin/partials/permission-matrix.blade.php` →
   - Tambah `<th>Export (Download)</th>` di header
   - Tambah aksinya ke loop: `['view', 'create', 'edit', 'delete', 'export']`
   - `colspan="6"` → menjadi `7`

4. Route + controller buat aksinya:

   ```php
   Route::middleware('permission:laporan.export')->group(function () {
       Route::get('laporan/export', [LaporanController::class, 'export'])
           ->name('admin.laporan.export');
   });
   ```

5. Tambah di controller:

   ```php
   public function export()
   {
       Gate::authorize('laporan.export');
       // logika export CSV/PDF di sini
   }
   ```

---

## 9. Testing

Buat file `tests/Feature/LaporanTest.php`. Ikuti pola yang sudah ada:

- `tests/Feature/RbacTest.php` — uji dasar permission per-role
- `tests/Feature/DirectPermissionTest.php` — uji direct permission & logika override
- `tests/Feature/PortalContentManagementTest.php` — uji CRUD konten

```php
<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanTest extends TestCase
{
    use RefreshDatabase;

    public function test_laporan_index_dibatasi_permission(): void
    {
        $this->get(route('admin.laporan.index'))
            ->assertRedirect(route('login'));          // belum login → redirect
    }

    public function test_karyawan_tanpa_permission_ditolak(): void
    {
        $karyawan = User::factory()->create();          // role Karyawan baseline
        $this->actingAs($karyawan)
            ->get(route('admin.laporan.index'))
            ->assertForbidden();                        // 403
    }

    public function test_super_admin_bisa_akses(): void
    {
        $superAdmin = User::factory()->create();
        $superAdmin->roles()->attach(
            \App\Models\Role::where('name', 'Super Admin')->first()
        );

        Laporan::factory()->count(3)->create();

        $this->actingAs($superAdmin)
            ->get(route('admin.laporan.index'))
            ->assertOk()                                // 200
            ->assertSee('Laporan');
    }
}
```

Jalankan:

```bash
php artisan test --filter=LaporanTest    # satu file
php artisan test                          # seluruh suite
```

> 💡 Karena project belum memakai `Permission::factory()`, permission role
> biasanya dibungkus test-feature di `RbacTest.php` — baca file itu
> dulu untuk melihat setup user & role yang direkomendasikan.

---

## 10. Troubleshooting

| Gejala | Penyebab paling umum | Solusi |
|---|---|---|
| Menu tidak muncul di sidebar | Lupa `@can` / permission belum dibuat di seeder / lupa langkah ⭐ 5–6 | Jalankan ulang `php artisan db:seed --class=PermissionSeeder` & `MasterMenuSeeder` |
| Matriks Hak Akses menampilkan "—" | Permission `<key>.<aksi>` belum dibuat di `PermissionSeeder` | Tambahkan permission, jalankan ulang seeder |
| Checkbox muncul tapi tidak berpengaruh | Route/Controller tidak pakai `Gate::authorize` atau middleware `permission:` | Tambahkan pengecekan di controller & route |
| Akses 403 meski role sudah diisi | Seeder role belum dijalankan ulang | `php artisan db:seed --class=PermissionSeeder` |
| Kode muncul di UI tapi browser error 419 | Form lupa `@csrf` | Tambahkan `@csrf` di dalam `<form>` |
| Cache route lama tetap kepakai | Cache route/config stale | `php artisan optimize:clear` |
| Error "class not found" setelah buat model/controller baru | Composer autoload lama | `composer dump-autoload` |
| Route baru tidak dikenal di `route()` | Cache route belum di-refresh | `php artisan route:clear` atau `optimize:clear` |
| Karyawan tidak bisa masuk /admin padahal sudah di-sync direct permission | Baseline Karyawan sudah meliputi semua permission yang dicentang (tidak ada ekstra) | Pastikan ada minimal 1 permission di luar `KARYAWAN_BASELINE_PERMISSIONS` |
| Data bidang lain masih terlihat oleh Admin Bidang | Controller belum pakai trait `ScopesToDepartment` | Tambahkan trait di controller milik bidang |

---

## 🎯 Ringkasan Cepat (cheat sheet)

```bash
# ================= MENAMBAH MODUL BARU =================
# 1) Uji direktory, kontrol, model, dan migrasi
php artisan make:model Laporan -m
php artisan make:controller Admin/LaporanController --resource --model=Laporan

# 2) Edit file berikut:
#    - database/migrations/...._create_laporans_table.php
#    - app/Models/Laporan.php
#    - routes/web.php                        (middleware permission:laporan.[])
#    - app/Http/Controllers/Admin/LaporanController.php   (Gate::authorize)
#    - resources/views/admin/laporan/{index,form}.blade.php (+ @can)
#    - database/seeders/PermissionSeeder.php              (⭐ permission baru)
#    - app/Models/MasterMenu.php                          (⭐ tier MENUS)
#    - resources/views/layouts/admin.blade.php            (⭐ sidebar)

# 3) Seed & bersih-bersih
php artisan migrate
php artisan db:seed --class=PermissionSeeder
php artisan db:seed --class=MasterMenuSeeder
php artisan optimize:clear

# 4) Test manual + test otomatis
php artisan test
```

*jendela terakir 2026-10-12 — dibuat otomatis oleh Codebuff.
Silakan update saat arsitektur berubah.*
