# SOFTWARE REQUIREMENT DOCUMENTATION (SRD)
## E-PPID PLN - Electronic Pejabat Pengelola Informasi dan Dokumentasi

---

**Dokumen Versi:** 1.0  
**Tanggal:** September 2026  
**Dibuat Oleh:** Tim Pengembangan  
**Diapprove Oleh:** [Nama Approver]

---

## DAFTAR ISI

1. [Pendahuluan](#1-pendahuluan)
2. [Deskripsi Sistem](#2-deskripsi-sistem)
3. [Model Sistem](#3-model-sistem)
4. [Perancangan Sistem](#4-perancangan-sistem)
5. [Spesifikasi Kebutuhan Perangkat Lunak](#5-spesifikasi-kebutuhan-perangkat-lunak)
6. [Spesifikasi Kebutuhan Perangkat Keras](#6-spesifikasi-kebutuhan-perangkat-lunak)
7. [Implementasi Sistem](#7-implementasi-sistem)
8. [Manual Book / Petunjuk Penggunaan](#8-manual-book--petunjuk-penggunaan)
9. [Kesimpulan](#9-kesimpulan)

---

## 1. PENDAHULUAN

### 1.1 Latar Belakang

Dalam era digital yang terus berkembang, kebutuhan akan transparansi dan akses informasi publik menjadi semakin penting. PT PLN (Persero) sebagai penyelenggara jasa ketenagalistrikan di Indonesia wajib memberikan akses informasi publik sesuai dengan peraturan perundang-undangan yang berlaku.

E-PPID PLN merupakan sistem informasi elektronik yang dirancang untuk memfasilitasi layanan informasi publik secara online, sehingga masyarakat dapat dengan mudah mengakses dokumen, data, dan informasi yang berkaitan dengan pengelolaan informasi publik di lingkungan PT PLN (Persero).

### 1.2 Tujuan Dokumen

Dokumen ini bertujuan untuk:
- Memaparkan requirement dan spesifikasi dari sistem E-PPID PLN
- Menjadi acuan dalam pengembangan dan evolusi sistem
- Menjadi referensi untuk testing dan validasi sistem
- Menjamin kesesuaian sistem dengan kebutuhan pemangku kepentingan

### 1.3 Ruang Lingkup

Sistem E-PPID PLN mencakup:
- Halaman Beranda (Home) dengan informasi umum
- Halaman Tentang Kami (Sejarah, Visi & Misi)
- Dashboard Admin untuk manajemen konten
- Layanan informasi publik online

---

## 2. DESKRIPSI SISTEM

### 2.1 Definisi Masalah

Sebelum adanya E-PPID PLN, proses penyampaian informasi publik dilakukan secara konvensional (tatap muka atau surat menyurat) yang menyebabkan:
- Waktu proses yang lama
- Biaya administrasi lebih tinggi
- Aksesibilitas terbatas untuk masyarakat luas
- Sulitnya monitoring dan pelacakan proses permohonan

### 2.2 Solusi Sistem

E-PPID PLN menyediakan solusi berbasis web yang memungkinkan:
- Pengajuan permohonan informasi publik secara online
- Akses dokumen dan informasi publik secara terbuka
- Proses verifikasi dan penyampaian informasi yang terstruktur
- Dashboard admin untuk manajemen konten dan monitoring

### 2.3User Pengguna

| Level Pengguna | Deskripsi |
|----------------|-----------|
| **Pengunjung Umum** | Masyarakat yang mengakses informasi publik dan pengajuan permohonan |
| **Admin PPID** | Pejabat Pengelola Informasi dan Dokumentasi yang mengelola sistem |
| **Super Admin** | Administrator sistem dengan akses penuh |

---

## 3. MODEL SISTEM

### 3.1 Diagram Konteks Sistem

```
                    +-----------------------------+
                    |      MASYARAKAT UMUM        |
                    |  (Pengunjung/Pengguna)      |
                    +--------------+--------------+
                                   |
                                   | HTTP/HTTPS
                                   v
                    +-----------------------------+
                    |   E-PPID PLN (Web System)   |
                    |  - Frontend (Blade/Bootstrap)|
                    |  - Backend (Laravel)         |
                    |  - Database (MySQL)          |
                    +--------------+--------------+
                                   |
                    +--------------+--------------+
                    |                             |
                    v                             v
        +------------------+            +------------------+
        |  PT PLN (Persero)|            |  Server/Local    |
        |  (Pengguna Data)  |            |  Infrastructure  |
        +------------------+            +------------------+
```

### 3.2 Diagram Alir Sistem (Flowchart)

```
+-------------------+
|   Pengunjung      |
|   Mengakses Web   |
+--------+----------+
         |
         v
+-------------------+
|   Halaman Beranda |
|   (Home Page)     |
+--------+----------+
         |
    +----+----+
    |         |
    v         v
+-------+  +-----------+
|Halaman|  | Admin     |
|Tentang|  | Login     |
|Kami   |  +-----+-----+
    |         |
    v         v
+------+  +------------+
|Sejarah|  | Dashboard  |
| &     |  | Admin      |
|Visi   |  | Panel      |
+------+  +-----+------+
              |
    +---------+---------+
    |                   |
    v                   v
+---------+      +-----------+
|Berita   |      |Pengumuman |
|Halaman  |      |Pengguna   |
|         |      |Galeri     |
+---------+      +-----------+
```

### 3.3 Arsitektur Sistem

```
+----------------------------------------------------------+
|                    CLIENT SIDE                           |
|  Browser (Chrome, Firefox, Edge, Safari)                |
|  - HTML5, CSS3, JavaScript                              |
|  - Bootstrap 5.2.3                                       |
|  - Font Awesome 6.3.0                                    |
+----------------------------------------------------------+
                          |
                          | HTTP Request
                          v
+----------------------------------------------------------+
|                    SERVER SIDE (Laravel)                 |
|  +----------------+  +----------------+  +-------------+ |
|  |   Routes       |  |   Controllers  |  |  Views      | |
|  |   (web.php)    |  |   (PHP)        |  |  (Blade)    | |
|  +----------------+  +----------------+  +-------------+ |
|                          |                               |
|                          v                               |
|  +---------------------------------------------------+  |
|  |              Middleware & Service                 |  |
|  +---------------------------------------------------+  |
+----------------------------------------------------------+
                          |
                          v
+----------------------------------------------------------+
|                    DATABASE (MySQL)                      |
|  - Users Table                                           |
|  - Cache Table                                           |
|  - Jobs Table                                            |
+----------------------------------------------------------+
```

---

## 4. PERANCANGAN SISTEM

### 4.1 Desain Database

#### Tabel: users
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key, Auto Increment |
| name | VARCHAR(255) | Nama pengguna |
| email | VARCHAR(255) | Alamat email |
| email_verified_at | TIMESTAMP | Verifikasi email |
| password | VARCHAR(255) | Password terenkripsi |
| remember_token | VARCHAR(100) | Token remember me |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu Update |

#### Tabel: cache
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| key | VARCHAR(255) | Primary Key |
| value | TEXT | Nilai cache |
| expiration | INT | Waktu kedaluwarsa |

#### Tabel: jobs
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| queue | VARCHAR(255) | Nama antrian |
| payload | LONGTEXT | Data payload |
| attempts | INT | Jumlah percobaan |
| reserved_at | TIMESTAMP | Waktu reservasi |
| available_at | TIMESTAMP | Waktu tersedia |
| created_at | TIMESTAMP | Waktu pembuatan |

### 4.2 Desain Interface

#### 4.2.1 Halaman Beranda (Home)
- **Header/Navbar:** Logo PLN, navigasi menu, tombol login
- **Hero Section:** Pesan utama tentang E-PPID PLN
- **Mekanisme Section:** 4 langkah prosedur layanan informasi publik
- **Quick Menu Section:** 4 kartu layanan utama
- **Statistic Section:** Data statistik (dokumen, permohonan, dll)
- **Footer:** Informasi kontak, tautan penting, media sosial

#### 4.2.2 Halaman Tentang Kami
- **Sejarah:**
  - Page header dengan gradient
  - Timeline interaktif dari tahun 1995-2028
  - Deskripsi peristiwa penting berbentuk kartu

- **Visi & Misi:**
  - Page header dengan gradient
  - Visi card dengan quote styling
  - 4 misi card dengan nomor urut
  - Tombol kembali ke beranda

#### 4.2.3 Dashboard Admin
- **Sidebar (Fixed Left):**
  - Logo brand
  - Menu navigation (Dashboard, Berita, Pengumuman, dll)
  - Badge notifikasi
  - Footer (kembali ke situs)

- **Topbar:**
  - Breadcrumb navigasi
  - Tombol search & notifikasi
  - Informasi user (avatar, nama, role)

- **Main Content:**
  - Welcome card dengan statistik
  - 4 Stat cards (Total Pengguna, Total Halaman, Total Berita, Draft)
  - Quick action buttons (4 aksi cepat)
  - Aktivitas terbaru (list dengan icon)
  - Konten terbaru (list konten)
  - Status sistem (3 item dengan indicator)
  - Notifikasi (list notifikasi)

### 4.3 Spesifikasi Desain Visual

#### 4.3.1 Palet Warna PLN

| Warna | Kode Hex | Penggunaan |
|-------|----------|------------|
| PLN Blue | #005B9C | Warna utama, header, sidebar |
| PLN Blue Dark | #003d6b | Sidebar background, gradient |
| PLN Yellow | #FFE600 | Aksen, badge, highlight |
| PLN Red | #ED1C24 | Notifikasi, badge alert |
| PLN Cyan | #00A3E0 | Aksen sekunder, icon |
| PLN Dark | #1a1a2e | Background section |
| PLN Gray | #F8F9FA | Background alternatif |
| PLN Text | #333333 | Warna teks utama |

#### 4.3.2 Tipografi
- **Font Family:** Inter (Google Fonts)
- **Ukuran Font:**
  - Heading 1: 2.5rem - 3.2rem
  - Heading 2: 1.75rem - 2rem
  - Heading 3: 1.05rem - 1.15rem
  - Body: 0.88rem - 1rem
  - Small: 0.7rem - 0.82rem

#### 4.3.3 Komponen UI
- **Card:** Border-radius 12px, shadow subtle, border #e5e7eb
- **Button:** Rounded, hover effects, transition 0.2s-0.3s
- **Navigasi:** Dropdown menu dengan animasi fade
- **Status Badge:** Rounded pill, color-coded (published/draf/pending)

---

## 5. SPESIFIKASI KEBUTUHAN PERANGKAT LUNAK

### 5.1 Requirement Sistem

#### 5.1.1 Functional Requirements

| ID | Requirement | Prioritas | Status |
|----|-------------|-----------|--------|
| FR-001 | Sistem harus menampilkan halaman beranda yang informatif | Tinggi | ✅ Implementasi |
| FR-002 | Sistem harus memiliki halaman tentang kami (sejarah & visi-misi) | Tinggi | ✅ Implementasi |
| FR-003 | Sistem harus memiliki dashboard admin | Tinggi | ✅ Implementasi |
| FR-004 | Admin dapat melihat statistik sistem | Tinggi | ✅ Implementasi |
| FR-005 | Admin dapat melihat aktivitas terbaru | Tinggi | ✅ Implementasi |
| FR-006 | Admin dapat melihat notifikasi | Tinggi | ✅ Implementasi |
| FR-007 | Sistem harus responsive di semua ukuran layar | Tinggi | ✅ Implementasi |
| FR-008 | Sistem harus memiliki navigasi yang mudah digunakan | Tinggi | ✅ Implementasi |

#### 5.1.2 Non-Functional Requirements

| ID | Requirement | Target |
|----|-------------|--------|
| NFR-001 | Performance | Load time < 3 detik |
| NFR-002 | Compatibility | Chrome, Firefox, Edge, Safari (terbaru) |
| NFR-003 | Responsiveness | Mobile, Tablet, Desktop |
| NFR-004 | Security | HTTPS, password hashing |
| NFR-005 | Availability | 99% uptime |

### 5.2 Technology Stack

| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| Framework PHP | Laravel | 12.69.1 |
| Bahasa Pemrograman | PHP | 8.3.33 |
| Package Manager | Composer | 2.9.7 |
| Database | MySQL | - |
| Frontend Framework | Bootstrap | 5.2.3 |
| Icon Library | Font Awesome | 6.3.0 |
| CSS/Build Tool | Vite | 7.0.7 |
| CSS Framework | Tailwind CSS | 4.0.0 |
| Testing | PHPUnit | 11.5.50 |

### 5.3 Struktur Direktori

```
PLN-UP-IMY/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── DashboardController.php
│   │   │   ├── Controller.php
│   │   │   └── HomeController.php
│   │   └── Middleware/
├── config/
├── database/
├── public/
│   ├── css/
│   │   └── admin.css
│   ├── assets/
│   │   └── images/
│   │       └── logo-pln.png
│   └── index.php
├── resources/
│   ├── css/
│   │   ├── app.css
│   │   └── admin.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── admin/
│       │   └── dashboard.blade.php
│       ├── layouts/
│       │   ├── admin.blade.php
│       │   ├── app.blade.php
│       │   ├── navbar.blade.php
│       │   └── footer.blade.php
│       ├── home.blade.php
│       └── tentang_kami/
│           ├── sejarah.blade.php
│           └── visi_misi.blade.php
├── routes/
│   └── web.php
└── storage/
```

---

## 6. SPESIFIKASI KEBUTUHAN PERANGKAT KERAS

### 6.1 Requirement Server (Production)

| Komponen | Minimum | Rekomendasi |
|----------|---------|-------------|
| Processor | 2 Core | 4 Core |
| RAM | 2 GB | 4 GB |
| Storage | 20 GB | 50 GB |
| OS | Linux (Ubuntu/Debian) | Linux (Ubuntu 22.04+) |
| Web Server | Apache/Nginx | Nginx |
| PHP Version | 8.2+ | 8.3 |
| MySQL Version | 5.7+ | 8.0+ |

### 6.2 Requirement Client (Pengguna)

| Komponen | Minimum |
|----------|---------|
| Browser | Chrome 90+, Firefox 88+, Edge 90+, Safari 14+ |
| Resolution | 1280x720 (minimum), 1920x1080 (optimal) |
| Koneksi Internet | Minimal 512 kbps |

### 6.3 Requirement Development Environment

| Komponen | Nilai |
|----------|-------|
| OS | Windows/Linux/MacOS |
| PHP | 8.2+ |
| Composer | 2.0+ |
| Node.js | 18+ |
| NPM | 9+ |

---

## 7. IMPLEMENTASI SISTEM

### 7.1 Instalasi dan Konfigurasi

#### 7.1.1 Persyaratan Sebelum Instalasi
- PHP 8.2 atau lebih baru
- Composer terinstal
- Node.js dan NPM terinstal
- MySQL Server berjalan
- Extension PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath

#### 7.1.2 Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/syafiqweeeeeeeeee/PLN-UP-IMY.git

# 2. Masuk ke direktori project
cd PLN-UP-IMY

# 3. Install dependencies PHP
composer install

# 4. Setup environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di .env
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=pln_u pymy
#    DB_USERNAME=root
#    DB_PASSWORD=

# 7. Jalankan migration
php artisan migrate

# 8. Install dependencies Node.js
npm install

# 9. Build assets
npm run build

# 10. Setup storage link
php artisan storage:link

# 11. Clear dan optimize cache
php artisan optimize

# 12. Jalankan development server
php artisan serve
```

### 7.2 Konfigurasi Environment

File `.env` yang perlu dikonfigurasi:

```env
APP_NAME="E-PPID PLN"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pln_u pymy
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=database
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### 7.3 URL Akses Sistem

| Fitur | URL | Method |
|-------|-----|--------|
| Beranda | http://localhost/ | GET |
| Sejarah | http://localhost/tentang-kami/sejarah | GET |
| Visi & Misi | http://localhost/tentang-kami/visi-misi | GET |
| Dashboard Admin | http://localhost/admin/dashboard | GET |

---

## 8. MANUAL BOOK / PETUNJUK PENGGUNAAN

### 8.1 Petunjuk Untuk Pengunjung Umum

#### 8.1.1 Mengakses Halaman Beranda
1. Buka browser dan masukkan URL: `http://localhost`
2. Akan ditampilkan halaman beranda dengan informasi umum tentang E-PPID PLN

#### 8.1.2 Melihat Mekanisme Layanan
1. Scroll ke bagian "Mekanisme Pelayanan Informasi Publik"
2. Lihat 4 langkah prosedur:
   - Pengajuan Permohonan
   - Penerimaan & Pencatatan
   - Proses Verifikasi
   - Penyampaian Informasi

#### 8.1.3 Melihat Layanan Tersedia
1. Scroll ke bagian "Layanan Kami"
2. Lihat 4 kartu layanan:
   - Informasi Publik
   - Permohonan Informasi
   - Keberatan Informasi
   - Informasi Serta Merta

#### 8.1.4 Melihat Tentang Kami
1. Klik menu "Tentang Kami" di navbar
2. Pilih:
   - **Sejarah:** Untuk melihat timeline perkembangan perusahaan
   - **Visi & Misi:** Untuk melihat visi dan misi perusahaan

### 8.2 Petunjuk Untuk Admin

#### 8.2.1 Mengakses Dashboard Admin
1. Buka browser dan masukkan URL: `http://localhost/admin/dashboard`
2. Akan ditampilkan dashboard admin dengan informasi ringkasan

#### 8.2.2 Menggunakan Sidebar Navigation
1. Sidebar terletak di sebelah kiri
2. Klik menu untuk navigasi ke section diferentes
3. Menu yang tersedia:
   - Dashboard (aktif)
   - Berita
   - Pengumuman
   - Halaman
   - Pengguna
   - Galeri
   - Dokumen
   - Permohonan
   - Pengaturan

#### 8.2.3 Membaca Notifikasi
1. Notifikasi terletak di panel kanan dashboard
2. Ikon berwarna mengindikasikan jenis notifikasi:
   - 🟡 Yellow: Warning
   - 🔵 Blue: Info
   - 🟢 Green: Success

#### 8.2.4 Memahami Status Sistem
1. Status sistem terletak di panel kanan bawah
2. Indicator berwarna:
   - 🟢 Green: Normal
   - 🟡 Yellow: Warning
   - 🔴 Red: Error

#### 8.2.5 Tombol Kembali ke Situs
1. Di footer sidebar terdapat link "Kembali ke Situs"
2. Klik untuk kembali ke halaman beranda public

### 8.3 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Halaman tidak muncul | Cek koneksi internet, refresh halaman |
| Logo tidak muncul | Pastikan file logo-pln.png ada di public/assets/images/ |
| CSS tidak ter-load | Jalankan `npm run build` atau `npm run dev` |
| Error database | Cek konfigurasi .env dan pastikan MySQL berjalan |

---

## 9. KESIMPULAN

E-PPID PLN merupakan sistem informasi berbasis web yang dirancang untuk memfasilitasi layanan informasi publik secara digital. Sistem ini telah menerapkan:

✅ **Tampilan Modern:** Menggunakan Bootstrap 5 dan desain tailwind yang responsif  
✅ **Navigasi Intuitif:** Struktur menu yang jelas dan mudah digunakan  
✅ **Dashboard Admin:** Panel administrasi dengan statistik dan monitoring  
✅ **Palet Warna Konsisten:** Menggunakan warna brand PLN yang konsisten  
✅ **Mobile Friendly:** Tampilan yang adaptif di semua perangkat  

Sistem ini siap digunakan dan dapat dikembangkan lebih lanjut sesuai kebutuhan.

---

**Lampiran:**
- A. Struktur Database
- B. API Documentation (jika ada)
- C. Screenshot Antarmuka

---

*Dokumen ini merupakan milik PT PLN (Persero) dan digunakan untuk keperluan pengembangan sistem E-PPID.*
