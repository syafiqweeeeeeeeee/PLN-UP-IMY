# SOFTWARE REQUIREMENT DOCUMENTATION (SRD)
## E-PPID PLN — Sistem Informasi Internal UP PLTU Indramayu

---

**Dokumen Versi:** 2.0
**Tanggal:** 1 Oktober 2026 (Revisi besar 2.0 — reposisi tujuan sistem)
**Dibuat Oleh:** Tim Pengembangan
**Diapprove Oleh:** [Nama Approver]

> **Catatan Revisi 2.0:** Pada versi sebelumnya (1.1) sistem diposisikan sebagai
> *portal informasi publik PPID* yang melayani masyarakat umum. Berdasarkan
> perkembangan kebutuhan, **E-PPID PLN kini adalah sistem informasi INTERNAL**
> untuk karyawan dan pengelola UP PLTU Indramayu — bukan web informasi publik.
> Seluruh requirement, arsitektur, dan manual pada dokumen ini telah disesuaikan
> dengan implementasi aktual yang sudah dibangun.

---

## DAFTAR ISI

1. [Pendahuluan](#1-pendahuluan)
2. [Deskripsi Sistem](#2-deskripsi-sistem)
3. [Model Sistem](#3-model-sistem)
4. [Perancangan Sistem](#4-perancangan-sistem)
5. [Spesifikasi Kebutuhan Perangkat Lunak](#5-spesifikasi-kebutuhan-perangkat-lunak)
6. [Spesifikasi Kebutuhan Perangkat Keras](#6-spesifikasi-kebutuhan-perangkat-keras)
7. [Implementasi Sistem](#7-implementasi-sistem)
8. [Manual Book / Petunjuk Penggunaan](#8-manual-book--petunjuk-penggunaan)
9. [Kesimpulan](#9-kesimpulan)

---

## 1. PENDAHULUAN

### 1.1 Latar Belakang

PT PLN Nusantara Power UP PLTU Indramayu (Unit Pembangkitan Tenaga Uap
berkapasitas 3 × 330 MW) membutuhkan sebuah sistem informasi internal yang
memudahkan karyawan mengakses informasi perusahaan, layanan internal, dan alat
kerja digital sehari-hari — sekaligus menyediakan sarana pengelolaan konten dan
operasional front office bagi pengelola.

E-PPID PLN dikembangkan untuk menjawab kebutuhan tersebut: sebuah aplikasi web
internal yang menggabungkan **manajemen konten (CMS)**, **portal karyawan**,
**buku registrasi tamu**, dan **tata kelola akses berbasis role (RBAC)** dalam
satu sistem.

### 1.2 Tujuan Dokumen

Dokumen ini bertujuan untuk:
- Memaparkan requirement dan spesifikasi sistem E-PPID PLN sesuai implementasi aktual
- Menjadi acuan dalam pengembangan, pemeliharaan, dan evolusi sistem
- Menjadi referensi untuk testing dan validasi sistem
- Menjamin kesesuaian sistem dengan kebutuhan pemangku kepentingan internal

### 1.3 Ruang Lingkup

Sistem E-PPID PLN mencakup:
- **Landing page internal** profil UP (Beranda, Tentang Kami, Informasi, FAQ)
- **Portal Karyawan** (area internal ter-autentikasi): informasi, layanan internal, link kerja, profil
- **Panel Admin (CMS)**: berita, pengumuman, galeri, halaman dinamis, menu builder
- **Buku Tamu digital**: registrasi kunjungan, check-in/check-out, dokumen KTP & surat
- **Manajemen pengguna, role & permission** (RBAC per-aksi, delegasi per bidang)
- **Manajemen Link Kerja** per bidang/sub-bidang
- **Log Aktivitas** seluruh aksi CRUD & autentikasi

Yang **di luar** ruang lingkup: pendaftaran akun mandiri oleh publik, layanan
permohonan informasi publik (permohonan/keberatan PPID), dan pembayaran online.

---

## 2. DESKRIPSI SISTEM

### 2.1 Definisi Masalah

Sebelum adanya sistem:
- Informasi internal (berita, pengumuman, SOP layanan) tersebar di grup chat dan dokumen lepas
- Buku tamu kunjungan masih manual (kertas) — sulit direkap, dicari, dan diarsipkan
- Tautan alat kerja (aplikasi operasi, e-procurement, dsb.) tidak terpusat dan berbeda-beda per bidang
- Tidak ada kontrol siapa boleh melihat/mengelola apa (akses seragam untuk semua)
- Perubahan konten website tergantung developer, tidak bisa dikelola non-programmer

### 2.2 Solusi Sistem

E-PPID PLN menyediakan solusi berbasis web:
- **Satu pintu informasi internal** — konten dikelola lewat CMS, target publikasi per konten dapat diarahkan ke publik/portal/keduanya
- **Portal Karyawan** ter-autentikasi — informasi, layanan internal, dan link kerja yang ter-scope sesuai bidang pengguna
- **Buku tamu digital** — registrasi mandiri oleh tamu (termasuk upload KTP & surat permohonan), proses check-in/check-out oleh front office, notifikasi ke pengelola
- **RBAC per-aksi** — setiap endpoint admin dijaga middleware permission; menu sidebar & dashboard adaptif terhadap hak akses
- **Delegasi admin per bidang** — Super Admin (Sekretariat/Humas) memegang kendali penuh; Admin Bidang mengelola konten bidangnya sendiri
- **Log aktivitas otomatis** — jejak audit seluruh aksi CRUD dan login/logout

### 2.3 Pengguna Sistem

| Level Pengguna | Deskripsi | Cara Akses |
|----------------|-----------|------------|
| **Tamu (Guest Book)** | Pengunjung dari instansi/partner yang mendaftarkan kunjungan | Form publik `/layanan/form-registrasi-tamu`, tanpa akun |
| **Karyawan** | Pegawai internal — membaca informasi, layanan internal, dan link kerja sesuai bidangnya | Login `/admin/login`, diarahkan ke `/karyawan/dashboard` |
| **Admin Bidang** | Pengelola konten yang didelegasikan ke satu bidang (pengumuman & link kerja bidangnya) | Login → panel admin (terbatas) |
| **Super Admin (Sekretariat/Humas)** | Pengelola penuh konten & operasional | Login → panel admin |
| **Administrator** | Administrator sistem — akses penuh termasuk user, role, log | Login → panel admin |

> Tidak ada pendaftaran akun mandiri. Akun dibuat oleh Administrator/Super Admin.
> Rincian matriks role × permission dibahas di Bagian 4.4 dan dokumen
> `docs/matriks-role.md`.

---MR4gMQTF6cMZ

## 3. MODEL SISTEM

### 3.1 Diagram Konteks Sistem

```
        +------------------------+        +---------------------------+
        |   TAMU / PENGUNJUNG    |        |      KARYAWAN INTERNAL    |
        | (registrasi kunjungan) |        |  (baca info, link kerja)  |
        +-----------+------------+        +-------------+-------------+
                    |                                   |
                    | HTTPS (tanpa akun)                | HTTPS (login)
                    v                                   v
        +----------------------------------------------------------+
        |                E-PPID PLN (Web Application)               |
        |  Landing Page | Portal Karyawan | Panel Admin | Buku Tamu |
        |  Frontend: Blade + Bootstrap 5                              |
        |  Backend : Laravel 12 (PHP 8.2+)                            |
        +---------------------------+-------------------------------+
                                    |
                                    v
                    +---------------------------+
                    |      MySQL 8 (Docker)     |
                    +---------------------------+
                                    |
                    +---------------------------+
                    |  Front Office & Pengelola |
                    | (check-in, rekap, export) |
                    +---------------------------+
```

### 3.2 Diagram Alir Sistem (Flowchart)

```
                       +----------------------+
                       |   Pengguna membuka   |
                       |      aplikasi        |
                       +----------+-----------+
                                  |
                 +----------------+----------------+
                 |                                 |
                 v                                 v
      +---------------------+          +---------------------+
      | Tamu: form registrasi          | Karyawan/Admin:     |
      | kunjungan (NIK, KTP, surat)    | Login /admin/login  |
      +----------+----------+          +----------+----------+
                 |                                 |
                 v                                 v
      +---------------------+          +---------------------+
      | Data masuk Buku     |          | Role dikenali:      |
      | Tamu + notifikasi   |          | Karyawan?           |
      | ke pengelola        |          +----+-----------+----+
      +---------------------+               |           |
                                       ya   |           | tidak
                                            v           v
                              +------------------+   +--------------------+
                              | PORTAL KARYAWAN  |   |    PANEL ADMIN     |
                              | - Informasi      |   | (sesuai permission)|
                              | - Layanan        |   | - Dashboard        |
                              | - Link Kerja     |   | - Berita/Pengumuman|
                              | - Profil Saya    |   | - Galeri/Halaman   |
                              +------------------+   | - Menu/Pengguna    |
                                                     | - Buku Tamu        |
                                                     | - Link Kerja       |
                                                     | - Log Aktivitas    |
                                                     +--------------------+
```

### 3.3 Arsitektur Sistem

```
+----------------------------------------------------------+
|                      CLIENT SIDE                          |
|  Browser (Chrome, Firefox, Edge, Safari)                 |
|  HTML5, CSS3, JavaScript, Bootstrap 5, Font Awesome 6    |
+---------------------------+------------------------------+
                            | HTTP/HTTPS
                            v
+----------------------------------------------------------+
|                SERVER SIDE (Laravel 12)                  |
|  +----------------+  +----------------+  +-------------+ |
|  | Routes         |  | Controllers    |  | Views       | |
|  | (web.php)      |  | Admin/Auth/    |  | (Blade)     | |
|  |                |  | Karyawan       |  |             | |
|  +----------------+  +----------------+  +-------------+ |
|  Middleware: auth, permission:, role.scope:,              |
|  admin.access, karyawan.access, page.visible,             |
|  throttle (OTP lupa password)                             |
|  Services: MenuBuilderService, PortalContentService,      |
|  ActivityLogger, NotificationService                      |
+---------------------------+------------------------------+
                            |
                            v
+----------------------------------------------------------+
|                DATABASE (MySQL 8)                        |
|  users, roles, permissions, role_user, role_permission,  |
|  departments, news, announcements, galleries, pages,     |
|  page_sections, page_role, menus, tamus, work_links,     |
|  activity_logs, contact_messages, cache, jobs            |
+----------------------------------------------------------+
```

---

## 4. PERANCANGAN SISTEM

### 4.1 Desain Database

#### Tabel: users
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key, Auto Increment |
| name | VARCHAR(255) | Nama lengkap |
| email | VARCHAR(255) | Email (untuk login) |
| role | VARCHAR(255) | Kolom legacy fallback (default `user`) |
| role_id | BIGINT UNSIGNED | FK roles — role utama (fallback RBAC) |
| level_jabatan | VARCHAR(255) | Hirarki: administrator / senior_manager / manager_bidang / staf_spv |
| department | VARCHAR(255) | Kode bidang utama (legacy) |
| department_id | BIGINT UNSIGNED | FK departments — pengikatan bidang (Admin Bidang/Karyawan) |
| sub_department | VARCHAR(255) | Kode sub-bidang (mis. spv_chcb_b) |
| no_hp | VARCHAR(20) | Nomor HP |
| alamat | TEXT | Alamat |
| last_seen_tamu_id | BIGINT UNSIGNED | Penanda notifikasi buku tamu sudah dilihat |
| email_verified_at / password / remember_token / timestamps | — | Standar Laravel |

#### Tabel: roles, permissions, role_permission, role_user
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| roles.id | BIGINT UNSIGNED | Primary Key |
| roles.name | VARCHAR(100) UNIQUE | Nama role: Administrator, Super Admin, Admin Bidang, Karyawan |
| roles.description / status | VARCHAR / TINYINT(1) | Deskripsi & aktif/nonaktif |
| permissions.id | BIGINT UNSIGNED | Primary Key |
| permissions.name | VARCHAR(100) UNIQUE | Kode permission, mis. `news.publish` |
| permissions.display_name / module | VARCHAR(255) | Label & modul pemilik |
| role_permission | pivot | role_id ↔ permission_id |
| role_user | pivot | user_id ↔ role_id (multi-role) |

#### Tabel: departments
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| code | VARCHAR UNIQUE | Kode bidang: operasi, pemeliharaan, engineering, business_support, k3_kam, lingkungan |
| name | VARCHAR(255) | Nama bidang |
| is_active | TINYINT(1) | Aktif / nonaktif |

#### Tabel: news
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| title / slug | VARCHAR | Judul & slug unik |
| category | ENUM | umum, teknis, kegiatan, kepegawaian |
| target_publication | ENUM | public / portal / all (default all) |
| excerpt / content | TEXT / LONGTEXT | Ringkasan & isi |
| image | VARCHAR | Gambar utama (nullable) |
| author / author_user_id | VARCHAR / FK users | Penulis |
| is_published / published_at | BOOLEAN / TIMESTAMP | Status & waktu terbit |
| timestamps | — | Audit waktu |

#### Tabel: announcements
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| title / slug | VARCHAR | Judul & slug unik |
| category | ENUM | umum, teknis, kepegawaian, keuangan, layanan |
| target_publication | ENUM | public / portal / all (default all) |
| excerpt / content | TEXT / LONGTEXT | Ringkasan & isi |
| is_published / published_at | BOOLEAN / TIMESTAMP | Status & waktu terbit |
| author_user_id | FK users | Pembuat |
| department_id | FK departments nullable | Pemilik pengumuman (NULL = global) — dipakai delegasi Admin Bidang |

#### Tabel: galleries
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| judul / deskripsi | VARCHAR / TEXT | Judul & keterangan foto |
| kategori | ENUM | KEGIATAN, FASILITAS, DOKUMENTASI, SEREMONIAL |
| file_gambar | VARCHAR | Path file gambar |
| tanggal_kegiatan | DATE | Tanggal kegiatan |
| status | ENUM | publikasi / draft |

#### Tabel: pages, page_sections, page_role
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| pages.title / slug | VARCHAR | Judul & slug unik |
| pages.status | VARCHAR(20) | draft / published |
| pages.visibility | VARCHAR(20) | public / role_restricted |
| pages.show_in_list | BOOLEAN | Tampil di indeks halaman |
| pages.created_by / updated_by | FK users | Audit pembuat |
| page_sections.type | VARCHAR(30) | banner / text / cards / file / faq |
| page_sections.data | JSON | Konten section |
| page_sections.sort_order | INT | Urutan section |
| page_role | pivot | page_id ↔ role_id (halaman terbatas per role) |

#### Tabel: menus
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| parent_id | FK menus nullable | Hierarki menu (sub-menu) |
| label / type | VARCHAR | Label & tipe target: route / page / url |
| route_name / page_id / url | — | Target sesuai tipe |
| icon | VARCHAR(60) | Kelas Font Awesome |
| sort_order / is_active | INT / BOOLEAN | Urutan & status |
| created_by | FK users | Audit pembuat |

#### Tabel: tamus (Buku Tamu)
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| nik | VARCHAR(16) UNIQUE | NIK / No. KTP |
| nama / instansi | VARCHAR(150) | Identitas tamu |
| no_hp / email | VARCHAR | Kontak (WhatsApp click-to-chat) |
| foto_ktp | VARCHAR | Path KTP (disk private, disajikan via route terproteksi) |
| surat_jalan | VARCHAR nullable | PDF surat permohonan/undangan resmi |
| tujuan_ditemui | VARCHAR(150) | Orang/divisi yang ditemui |
| jumlah_tamu | TINYINT | Jumlah rombongan |
| tanggal_kunjungan | DATETIME nullable | Rencana kunjungan |
| keperluan | TEXT | Maksud & tujuan |
| checked_in_at / checked_out_at | TIMESTAMP nullable | Proses front office |

#### Tabel: work_links
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| title / url | VARCHAR / VARCHAR(500) | Nama & tautan alat kerja |
| description | TEXT nullable | Keterangan |
| icon | VARCHAR | Ikon FontAwesome (default fa-link) |
| category | ENUM | umum (semua karyawan) / khusus (terikat bidang) |
| department / sub_department | VARCHAR nullable | Target bidang/sub-bidang (untuk kategori khusus) |
| is_active | BOOLEAN | Nonaktif = disembunyikan tanpa dihapus |

#### Tabel: activity_logs
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| user_id | FK users nullable | Pembuat aksi (null-safe saat akun dihapus) |
| user_name / user_role | VARCHAR | Snapshot identitas saat aksi |
| module / action | VARCHAR (index) | berita/pengumuman/autentikasi/... ; create/update/delete/publish/login/logout/... |
| description | TEXT | Kalimat manusiawi |
| subject_type / subject_id | VARCHAR / BIGINT | Subjek aksi (polymorphic ringan) |
| ip_address / user_agent | VARCHAR | Metadata request |

#### Tabel: contact_messages
| Nama Field | Tipe Data | Keterangan |
|------------|-----------|------------|
| id | BIGINT UNSIGNED | Primary Key |
| nama / email / telepon | VARCHAR | Identitas pengirim |
| kategori / subjek / pesan | VARCHAR / TEXT | Isi pesan |
| status / read_at | VARCHAR(20) / TIMESTAMP | belum_dibaca / sudah_dibaca |

> Tabel framework bawaan: `cache`, `jobs` (driver database).

### 4.2 Desain Interface

#### 4.2.1 Landing Page (publik, tanpa login)
- **Navbar dinamis** dari Menu Builder (database, fallback hardcoded) + toggle i18n Indonesia/English + dark mode
- **Beranda:** hero profil UP PLTU Indramayu 3×330 MW, section wilayah, layanan informasi, mekanisme pelayanan, footer kontak
- **Tentang Kami:** Profil Perusahaan, Sejarah (timeline), Visi & Misi, Struktur Organisasi
- **Informasi:** Berita (list + detail + terkait), Pengumuman (list + detail), Galeri (kategori + lightbox, paginasi 9/halaman), Informasi Standar Pelayanan
- **Layanan:** FAQ, **Form Registrasi Tamu** (buku tamu digital)
- **Halaman CMS:** `/halaman` (indeks) dan `/halaman/{slug}` — visibilitas draft/role-restricted ditegakkan middleware `page.visible`

#### 4.2.2 Portal Karyawan (`/karyawan/dashboard`)
Area internal terpisah dari panel admin, dibatasi middleware `auth` + `karyawan.access`:
- **Dashboard:** kartu statistik (informasi aktif, layanan tersedia, link kerja terdaftar), informasi terbaru, layanan internal, link kerja sering dipakai
- **Informasi:** pengumuman + berita internal (view-only, kartu dengan gambar/tanggal/"Baca Selengkapnya"), halaman detail + terkait
- **Layanan:** grid layanan internal + detail prosedur, ter-scope hirarki organisasi user
- **Link Kerja:** direktori tautan alat kerja dengan filter tab per kategori; link "umum" untuk semua, link "khusus" ter-scope bidang/sub-bidang; layout filter menyesuaikan level jabatan (Manager bisa pindah sub-bidang, Staf terkunci)
- **Profil Saya:** edit nama, no HP, alamat, ganti password (wajib verifikasi password lama)

#### 4.2.3 Panel Admin (`/admin/dashboard`)
- **Sidebar (fixed left):** logo brand, menu navigasi adaptif permission (modul tanpa permission disembunyikan), footer kembali ke situs
- **Topbar:** breadcrumb, pencarian global (Ctrl+K), lonceng notifikasi buku tamu (polling JSON), info user
- **Dashboard:** welcome card, stat cards, quick actions adaptif, aktivitas terbaru, status sistem, notifikasi
- **Modul konten:** Berita, Pengumuman, Galeri, Halaman (Page + Section builder), Menu Builder
- **Modul operasional:** Data Tamu (list/filter, check-in/out, export, print, dokumen privat), Link Kerja
- **Modul tata kelola:** Pengguna (buat, toggle aktif/nonaktif, hapus), Role & Permission (khusus Super Admin), Log Aktivitas
- **Login:** `/admin/login` dengan modal lupa password berbasis OTP email (rate limit 10x/menit)

### 4.3 Kontrol Akses (RBAC)

Prinsip: **role = akses**, **bidang = organisasi**. Middleware `permission:` menjaga
setiap endpoint admin per aksi; `role.scope:super_admin` membatasi modul sensitif
(user, role, halaman, menu, buku tamu) hanya untuk Super Admin/Administrator;
`role.scope:admin` mengizinkan Admin Bidang dengan scope data di controller.

| Modul / Permission | Karyawan | Admin Bidang | Super Admin / Administrator |
|---|:-:|:-:|:-:|
| Portal (internal.view, news.view, pages.view, applications.view, dashboard.view) | ✅ | ✅ | ✅ |
| Kelola berita (news.create/edit/publish/delete) | ❌ | ❌ | ✅ |
| Kelola pengumuman (announcements.*) | ❌ | ✅ (bidangnya) | ✅ |
| Kelola link kerja (work_links.*) | ❌ | ✅ (bidangnya) | ✅ |
| Kelola galeri (galleries.*) | ❌ | ❌ | ✅ |
| Halaman CMS & Menu Builder (pages.*, menus.*) | ❌ | ❌ | ✅ |
| Buku Tamu (tamu.view/create/checkout/delete) | ❌ | ❌ | ✅ |
| Pengguna & Role (users.*, roles.*) | ❌ | ❌ | ✅ |
| Log Aktivitas (activity_logs.view) | ❌ | ❌ | ✅ |

### 4.4 Spesifikasi Desain Visual

#### 4.4.1 Palet Warna PLN

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

#### 4.4.2 Tipografi
- **Font Family:** Inter (Google Fonts)
- **Ukuran Font:**
  - Heading 1: 2.5rem - 3.2rem
  - Heading 2: 1.75rem - 2rem
  - Heading 3: 1.05rem - 1.15rem
  - Body: 0.88rem - 1rem
  - Small: 0.7rem - 0.82rem

#### 4.4.3 Komponen UI
- **Card:** Border-radius 12px, shadow subtle, border #e5e7eb
- **Button:** Rounded, hover effects, transition 0.2s-0.3s
- **Navigasi:** Dropdown menu dengan animasi fade
- **Status Badge:** Rounded pill, color-coded (published/draft/berkunjung/selesai)

---

## 5. SPESIFIKASI KEBUTUHAN PERANGKAT LUNAK

### 5.1 Requirement Sistem

#### 5.1.1 Functional Requirements

| ID | Requirement | Prioritas | Status |
|----|-------------|-----------|--------|
| FR-001 | Landing page profil UP: beranda, tentang kami (profil/sejarah/visi-misi/struktur), informasi (berita/pengumuman/galeri), FAQ | Tinggi | ✅ Implementasi |
| FR-002 | Navbar dinamis dari Menu Builder (database) dengan i18n Indonesia/English dan dark mode | Sedang | ✅ Implementasi |
| FR-003 | Panel admin dengan dashboard statistik, quick actions adaptif, dan notifikasi | Tinggi | ✅ Implementasi |
| FR-004 | CMS Berita: CRUD + publish/unpublish + target publikasi (publik/portal/keduanya) | Tinggi | ✅ Implementasi |
| FR-005 | CMS Pengumuman: CRUD + publish/unpublish + target publikasi + kepemilikan bidang | Tinggi | ✅ Implementasi |
| FR-006 | CMS Galeri: CRUD kategori + publish/draft + lightbox di halaman publik | Sedang | ✅ Implementasi |
| FR-007 | Halaman dinamis (Page + Section builder: banner/text/cards/file/faq) dengan visibilitas draft/published & public/role-restricted | Tinggi | ✅ Implementasi |
| FR-008 | Menu Builder hierarkis (route/page/url, ikon, urutan, aktif/nonaktif) | Sedang | ✅ Implementasi |
| FR-009 | Portal Karyawan terpisah: dashboard, informasi internal, layanan internal, link kerja, profil — view-only, diarahkan otomatis setelah login | Tinggi | ✅ Implementasi |
| FR-010 | RBAC per-aksi: seluruh route admin dijaga middleware `permission:`; sidebar & dashboard adaptif | Tinggi | ✅ Implementasi |
| FR-011 | Manajemen pengguna: buat akun, toggle status aktif/nonaktif, hapus; tanpa pendaftaran mandiri | Tinggi | ✅ Implementasi |
| FR-012 | Manajemen Role & Permission granular per modul (hanya Super Admin) | Tinggi | ✅ Implementasi |
| FR-013 | Delegasi Admin Bidang: pengumuman & link kerja terbatas pada bidang akun terkait | Sedang | ✅ Implementasi |
| FR-014 | Buku Tamu digital: registrasi mandiri (NIK, KTP, surat permohonan), check-in/check-out, konfirmasi WhatsApp/email, export & print | Tinggi | ✅ Implementasi |
| FR-015 | Dokumen privat tamu (KTP, surat) disajikan via route terproteksi, tidak dapat diakses publik via /storage | Tinggi | ✅ Implementasi |
| FR-016 | Manajemen Link Kerja: kategori umum (semua) dan khusus (per bidang/sub-bidang), toggle aktif | Sedang | ✅ Implementasi |
| FR-017 | Link kerja di portal ter-filter sesuai hirarki organisasi user (level jabatan, bidang, sub-bidang) | Sedang | ✅ Implementasi |
| FR-018 | Log Aktivitas otomatis untuk seluruh aksi CRUD & login/logout; dapat dilihat & dibersihkan admin | Sedang | ✅ Implementasi |
| FR-019 | Lupa password via OTP email (modal AJAX, rate limit 10x/menit per IP) | Sedang | ✅ Implementasi |
| FR-020 | Pencarian global admin (Ctrl+K) dan notifikasi tamu baru di topbar | Rendah | ✅ Implementasi |

#### 5.1.2 Non-Functional Requirements

| ID | Requirement | Target |
|----|-------------|--------|
| NFR-001 | Performance | Load time < 3 detik |
| NFR-002 | Compatibility | Chrome, Firefox, Edge, Safari (versi terbaru) |
| NFR-003 | Responsiveness | Mobile, Tablet, Desktop |
| NFR-004 | Security | Password hashing (bcrypt), CSRF protection, dokumen KTP/surat di disk private + route terproteksi, rate limit OTP, RBAC per-aksi di semua endpoint admin |
| NFR-005 | Availability | 99% uptime pada jam operasional |
| NFR-006 | Auditability | Seluruh aksi tulis tercatat di activity_logs dengan snapshot user |

### 5.2 Technology Stack

| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| Framework PHP | Laravel | 12.x |
| Bahasa Pemrograman | PHP | 8.2+ (image FrankenPHP 8.2) |
| Package Manager | Composer | 2.x |
| Database | MySQL | 8.0 |
| Frontend Framework | Bootstrap | 5 |
| Icon Library | Font Awesome 6, Feather Icons | 6.x |
| CSS/Build Tool | Vite | 7.x |
| Testing | PHPUnit | 11.5 |
| Runtime & Infra | Docker Compose (app + db), FrankenPHP | — |

### 5.3 Struktur Direktori

```
PLN-UP-IMY/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/            # Dashboard, News, Announcement, Gallery,
│   │   │   │                     # Page, PageSection, Menu, User, Role,
│   │   │   │                     # Tamu, WorkLink, ActivityLog, Notification,
│   │   │   │                     # AdminSearch
│   │   │   ├── Auth/             # Login, ForgotPassword (OTP)
│   │   │   ├── Karyawan/         # PortalController (dashboard, informasi,
│   │   │   │                     # layanan, link, profil)
│   │   │   ├── HomeController.php
│   │   │   ├── PageDisplayController.php
│   │   │   ├── TamuController.php
│   │   │   └── TamuDocumentController.php
│   │   ├── Middleware/           # PermissionMiddleware, RoleMiddleware,
│   │   │                         # EnsureKaryawan, EnsureNotKaryawan,
│   │   │                         # EnsurePageVisible
│   │   └── Requests/
│   ├── Models/                   # User, Role, Permission, Department, News,
│   │                             # Announcement, Gallery, Page, PageSection,
│   │                             # Menu, Tamu, WorkLink, ActivityLog, ...
│   └── Services/                 # MenuBuilderService, PortalContentService,
│                                 # ActivityLogger, NotificationService
├── config/
├── database/
│   ├── migrations/               # 25 migrasi (users, RBAC, konten, tamus,
│   │                             # work_links, departments, ...)
│   └── seeders/                  # AdminUserSeeder, KaryawanUserSeeder,
│                                 # PermissionSeeder, MenuSeeder, WorkLinkSeeder
├── docker-compose.yml            # app (FrankenPHP) + db (MySQL 8)
├── Dockerfile
├── public/
├── resources/
│   ├── css/  js/
│   └── views/
│       ├── layouts/              # app (publik), admin, karyawan, navbar, footer
│       ├── admin/                # login, dashboard, news/, announcements/,
│       │                         # galeri/, pages/, menus/, users/, roles/,
│       │                         # tamu/, work_links/, activity-logs/
│       ├── karyawan/             # dashboard, informasi, layanan, link, profil
│       ├── informasi/            # berita, pengumuman, galeri, layanan
│       ├── tentang_kami/         # profil, sejarah, visi_misi, struktur_organisasi
│       ├── layanan/              # faq, form-registrasi-tamu
│       └── pages/                # index, show (CMS)
├── routes/
│   └── web.php
├── tests/Feature/                # 128 test (RBAC, Tamu, Portal, Menu, ...)
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
| Web Server | FrankenPHP / Apache / Nginx | FrankenPHP (bawaan Docker) |
| PHP Version | 8.2+ | 8.3 |
| MySQL Version | 8.0+ | 8.0 |

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
| Docker Desktop | Terpasang & berjalan |
| Node.js | 18+ (untuk build aset) |
| NPM | 9+ |

> Dengan Docker, PHP/Composer/MySQL **tidak perlu** dipasang di mesin developer —
> semuanya tersedia di dalam container.

---

## 7. IMPLEMENTASI SISTEM

### 7.1 Instalasi dan Konfigurasi (Docker — cara utama)

#### 7.1.1 Persyaratan Sebelum Instalasi
- Docker Desktop aktif/berjalan
- Git
- Tidak perlu PHP, Composer, MySQL, maupun Laragon

#### 7.1.2 Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/syafiqweeeeeeeeee/PLN-UP-IMY.git

# 2. Masuk ke direktori project
cd PLN-UP-IMY

# 3. Salin konfigurasi (sudah disetel untuk Docker)
cp .env.example .env

# 4. Bangun image & jalankan container app (FrankenPHP) + db (MySQL 8)
docker compose up -d --build

# 5. Kunci aplikasi + struktur database + akun awal
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link

# 6. Buka di browser: http://localhost:8000
```

#### 7.1.3 Alternatif tanpa Docker (Laragon)

```bash
composer install
cp .env.example .env    # ubah DB_HOST menjadi 127.0.0.1 + sesuaikan kredensial lokal
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve       # http://127.0.0.1:8000
```

### 7.2 Konfigurasi Environment

File `.env` utama (nilai bawaan `.env.example` disetel untuk Docker):

```env
APP_NAME="E-PPID PLN"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db            # 127.0.0.1 bila di luar container
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

# Akun Administrator awal (WAJIB diganti sebelum seed produksi)
ADMIN_EMAIL=email-anda@domain.com
ADMIN_PASSWORD=password-yang-kuat

MAIL_*                # notifikasi OTP lupa password (opsional)
```

Koneksi database dari aplikasi pengelola (HeidiSQL/DBeaver): host `127.0.0.1`,
port **3307**, user `root`, password `root` (port host sengaja 3307 agar tidak
tabrakan dengan MySQL Laragon).

### 7.3 Akun Default (Seeder)

| Akun | Email | Password | Keterangan |
|---|---|---|---|
| Administrator | `admin@example.com` | `password123` | login admin `/admin/login` |
| Karyawan | `opaladzmii@gmail.com` | `karyawan123` | login portal `/karyawan/dashboard` |
| Test User | `test@example.com` | `password123` | user biasa (tanpa role admin) |

> **Wajib di produksi:** override `ADMIN_EMAIL` & `ADMIN_PASSWORD` di `.env`
> sebelum `migrate --seed`.

### 7.4 URL Akses Sistem

| Fitur | URL | Method |
|-------|-----|--------|
| Beranda | `/` | GET |
| Tentang Kami | `/tentang-kami/profil-perusahaan`, `/sejarah`, `/visi-misi`, `/struktur-organisasi` | GET |
| Informasi | `/informasi/berita`, `/informasi/pengumuman`, `/informasi/galeri`, `/informasi/layanan` | GET |
| FAQ | `/layanan/faq` | GET |
| Registrasi Tamu (publik) | `/layanan/form-registrasi-tamu` | GET / POST |
| Halaman CMS | `/halaman`, `/halaman/{slug}` | GET |
| Login | `/admin/login` | GET / POST |
| Lupa password (OTP) | `/forgot-password/otp`, `/forgot-password/reset` | POST |
| Portal Karyawan | `/karyawan/dashboard`, `/karyawan/informasi`, `/karyawan/layanan`, `/karyawan/link`, `/karyawan/profil` | GET / PUT |
| Panel Admin | `/admin/dashboard`, `/admin/news`, `/admin/announcements`, `/admin/galeri`, `/admin/pages`, `/admin/menus`, `/admin/users`, `/admin/roles`, `/admin/tamu`, `/admin/work-links`, `/admin/activity-logs` | GET/POST/PUT/PATCH/DELETE |
| Logout | `/admin/logout` | POST |

### 7.5 Testing

```bash
php artisan test
```

Seluruh 128 test harus lulus (mencakup RBAC, buku tamu, portal karyawan, menu,
berita/pengumuman, halaman, dan log aktivitas). Di dalam container, test suite
butuh override koneksi ke host `db`:

```bash
docker compose exec -e DB_HOST=db -e DB_PASSWORD=root app php artisan test
```

---

## 8. MANUAL BOOK / PETUNJUK PENGGUNAAN

### 8.1 Petunjuk Untuk Tamu (Registrasi Kunjungan)

1. Buka halaman utama, pilih menu **Layanan → Form Registrasi Tamu**
2. Isi data: NIK, nama, instansi, no HP (WhatsApp), email (opsional), orang/divisi yang ditemui, jumlah tamu, tanggal & jam kunjungan, keperluan
3. Unggah **foto KTP** dan **surat permohonan/undangan (PDF)** dari instansi
4. Kirim formulir — data masuk ke Buku Tamu dan diteruskan ke pengelola
5. Tunggu konfirmasi dari front office (WhatsApp/email)

### 8.2 Petunjuk Untuk Karyawan

#### 8.2.1 Login Portal
1. Buka `/admin/login` dan masukkan email + password
2. Akun ber-role **Karyawan** otomatis diarahkan ke **Portal Karyawan** (`/karyawan/dashboard`)
3. Portal tidak menyediakan hak kelola — seluruh konten bersifat baca

#### 8.2.2 Menggunakan Portal
- **Dashboard:** ringkasan informasi terbaru, layanan internal, dan link kerja yang relevan untuk Anda
- **Informasi:** baca pengumuman & berita internal; klik "Baca Selengkapnya" untuk detail
- **Layanan:** buka daftar layanan internal; pilih layanan untuk melihat prosedurnya
- **Link Kerja:** gunakan filter tab untuk memilih kategori/bidang; klik kartu untuk membuka alat kerja di tab baru
- **Profil Saya:** ubah nama, no HP, alamat; untuk ganti password wajib memasukkan password lama
- Karyawan **tidak dapat** mengakses `/admin/*` — akan dialihkan kembali ke portal

### 8.3 Petunjuk Untuk Admin / Super Admin

#### 8.3.1 Login & Navigasi
1. Buka `/admin/login`, masuk dengan akun pengelola
2. Sidebar menampilkan **hanya modul yang boleh Anda akses** (berdasarkan permission role)
3. Gunakan pencarian global (Ctrl+K) dan lonceng notifikasi di topbar

#### 8.3.2 Mengelola Konten
- **Berita / Pengumuman:** Tambah → isi judul, kategori, target publikasi (publik / portal karyawan / keduanya), ringkasan, isi, gambar → Simpan → Publish
- **Galeri:** unggah foto, pilih kategori & status (publikasi/draft)
- **Halaman:** buat halaman, susun section (banner, teks, cards, file, FAQ), atur urutan, publish; halaman dapat dibatasi per role
- **Menu:** kelola navbar publik — tambah item (route/halaman/URL), ikon, urutan, sub-menu, aktif/nonaktif

#### 8.3.3 Mengelola Buku Tamu
1. Buka **Data Tamu**; gunakan filter pencarian, rentang tanggal, dan status (berkunjung/selesai)
2. Saat tamu tiba: klik **Check-in**; setelah selesai: **Check-out** (durasi kunjungan tercatat otomatis)
3. Gunakan tombol WhatsApp/email untuk konfirmasi ke tamu
4. Dokumen KTP & surat hanya bisa dibuka dari panel (route terproteksi)
5. Rekap dapat di-**export** (Excel/CSV) atau di-**print**
6. Tamu baru memunculkan notifikasi di lonceng topbar

#### 8.3.4 Mengelola Pengguna & Role (Super Admin)
1. **Pengguna:** Tambah akun (nama, email, password, role, hirarki organisasi: level jabatan, bidang, sub-bidang); toggle aktif/nonaktif; hapus
2. **Role:** buat role baru, atur permission per modul via halaman *Kelola Permission*
3. **Admin Bidang:** beri role *Admin Bidang* + isi bidang akun — ia hanya dapat mengelola pengumuman & link kerja bidangnya

#### 8.3.5 Membaca Log Aktivitas
1. Buka **Log Aktivitas** (menu khusus Administrator)
2. Setiap aksi tercatat: siapa, modul, aksi, deskripsi, IP, waktu
3. Log dapat dihapus per item atau dibersihkan seluruhnya

#### 8.3.6 Lupa Password
1. Di halaman login, klik "Lupa Password"
2. Masukkan email terdaftar → kode OTP dikirim ke email
3. Masukkan OTP + password baru → login kembali dengan password baru

### 8.4 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Halaman tidak muncul | Pastikan container berjalan: `docker compose ps`, refresh halaman |
| CSS/aset tidak ter-load | Jalankan `npm install && npm run build` |
| Error koneksi database | Cek `DB_HOST=db` di `.env` (dalam container) dan status container `db` |
| Test gagal di dalam container | Gunakan override: `docker compose exec -e DB_HOST=db -e DB_PASSWORD=root app php artisan test` |
| Lupa password admin | Gunakan alur OTP di halaman login, atau reset manual oleh Administrator lain |
| Akses ditolak (403) | Periksa permission role Anda di menu Role (hanya Super Admin) atau hubungi Administrator |

---

## 9. KESIMPULAN

E-PPID PLN merupakan **sistem informasi internal** berbasis web untuk UP PLTU
Indramayu yang menyatukan manajemen konten, portal karyawan, buku tamu digital,
dan tata kelola akses dalam satu aplikasi. Sistem ini telah menerapkan:

✅ **CMS Lengkap:** berita, pengumuman, galeri, halaman dinamis, dan menu builder yang dikelola non-programmer
✅ **Portal Karyawan Terpisah:** area internal view-only dengan konten ter-target dan link kerja per bidang
✅ **Buku Tamu Digital:** registrasi mandiri, check-in/out, dokumen privat terproteksi, rekap export/print
✅ **RBAC Per-Aksi:** permission granular di semua endpoint admin + delegasi Admin Bidang
✅ **Audit Penuh:** log aktivitas otomatis seluruh aksi CRUD & autentikasi
✅ **Palet Warna Konsisten & Responsif:** identitas brand PLN di semua perangkat
✅ **Teruji:** 128 automated test (PHPUnit) memastikan perilaku sistem

Sistem siap digunakan dan dapat dikembangkan lebih lanjut sesuai kebutuhan.

---

**Lampiran:**
- A. Struktur Database (Bagian 4.1)
- B. Matriks Role × Akses (`docs/matriks-role.md`)
`- C. Screenshot Antarmuka

---

*Dokumen ini merupakan milik PT PLN (Persero) dan digunakan untuk keperluan pengembangan sistem E-PPID.*
