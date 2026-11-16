# Audit Menyeluruh — Portal PLTU Indramayu

**Tanggal audit:** 13 November 2026  
**Lingkup:** alur publik, autentikasi, panel admin, portal karyawan, database, keamanan, desain/UI, kualitas kode, dan pengujian.  
**Metode:** pembacaan kode (175 route, controller/model/service/view), inspeksi database `pln_up_imy`, uji HTTP, uji terarah dengan database testing, dan pengecekan statis (Pint).  
**Sifat:** audit baca-saja. Tidak ada perubahan perilaku aplikasi pada laporan ini.

---

## 1. Ringkasan eksekutif

| Metrik | Hasil |
|---|---|
| Route terdaftar | **175** |
| Tabel database aktual | **27** |
| Model / controller utama | User, Tamu, Karyawan, WorkLink, Announcement, News, Role, Permission, dll. |
| Data contoh | 7 user, 1 tamu, 289 karyawan, 5 bidang, 73 jabatan, 9 link kerja |
| Tes yang berhasil dibaca | **646 tes lulus** sebelum run mencapai batas waktu 300 detik |
| Tes gagal | **12 tes** pada 3 file (kelas/fitur yang sudah dihapus atau assertion UI usang) |
| File tidak lolos Pint | **114 file** |
| Temuan kritis | **2** (kredensial/PII di repo, eskalasi hak akses mandiri) |
| Temuan tinggi | **5** |
| Temuan sedang | **10+** |

**Kesimpulan singkat:** arsitektur utama (Laravel, RBAC per aksi, pemisahan portal/admin, dokumen privat, cache publik, transaksi pendaftaran akun) sudah cukup matang. Namun masih ada **dua masalah kritis**, beberapa celah otorisasi/data scoping, ketidaksesuaian batas upload produksi, dan hutang teknis pengujian/dokumentasi yang harus diselesaikan sebelum dianggap aman untuk produksi.

---

## 2. Daftar temuan (prioritas)

| No | Tingkat | Area | Temuan | Bukti / dampak | Rekomendasi |
|---|---|---|---|---|---|
| 1 | **KRITIS** | Rahasia & privasi | Binlog recovery database (±34 MB) ter-commit ke Git dan dapat diputar ulang menjadi data penuh (hash password, email, no. HP, sesi, tamu). | `git ls-files` menemukan **24 file** `storage/recovery-20260928/*.sql`; `full-replay.sql` berisi event `BINLOG` untuk database `pln_up_imy`. Sebaliknya, `backup_pln_up_imy.sql` dan `backup_nama_database_anda.sql` **tidak tracked** — keduanya diabaikan `.gitignore:22` (`backup_*.sql`) dan hanya ada di working tree. `jabatans.sql` tracked tetapi hanya master jabatan. | Purge `storage/recovery-20260928` dari history Git (`git filter-repo`/BFG), hapus dump lokal, rotasi seluruh password, invalidasi session/remember token, audit akses repo, dan perluas pola ignore. |
| 2 | **KRITIS** | Otorisasi | Admin Bidang/Karyawan dapat memberi **direct permission apa pun** ke akunnya sendiri lewat self-edit. | `UserController@update`: cabang non-Super Admin tetap memanggil `syncDirectPermissions($user, $request, $user->role)`. Uji probe mengirim `permissions[]=tamu.delete`; baris `user_has_permissions` tersimpan. Rantai lanjutan dapat memberi `roles.edit` lalu mengelola role. | Hanya Super Admin yang boleh mengubah role/direct permission. Pada self-edit non-super, **jangan** memanggil sinkronisasi permission dari request; pertahankan permission lama. Tambahkan regression test. |
| 3 | **TINGGI** | Autentikasi | Akun yang dinonaktifkan tetap bisa login. | Status aktif dipetakan ke `users.email_verified_at`, tetapi `LoginController` tidak memeriksanya. Probe login akun `unverified` menghasilkan `302` dan `AUTH=YES`. Seluruh 7 akun saat ini `email_verified_at = NULL`, sehingga penegakan langsung akan mengunci semua akun. | Tambahkan kolom/status aktif yang eksplisit atau backfill `email_verified_at` lebih dulu, lalu tolak login akun nonaktif, hapus sesi aktifnya, dan blokir OTP reset untuk akun nonaktif. |
| 4 | **TINGGI** | Operasional upload | Batas upload PHP di container (2 MB / post 8 MB) lebih kecil daripada validasi aplikasi (dokumen 10 MB, gambar 5 MB). | `docker exec projek-pln-app-1 php -i` → `upload_max_filesize=2M`, `post_max_size=8M`; validasi memakai `max:10240` dan `max:5120`. Dokumen tamu wajib sehingga pengunjung dengan file 2–10 MB gagal tanpa pesan yang jelas. | Set `upload_max_filesize=12M` dan `post_max_size=16M` di `docker/php-prod.ini`/image, samakan untuk Caddy, lalu uji upload 3 MB, 6 MB, dan 11 MB. |
| 5 | **TINGGI** | Data scoping | Akun tanpa pengikatan bidang **melihat seluruh** data lintas bidang. | `ScopedToUserDepartment` langsung `return` bila `bidangCode() === null`; `WorkLink`/`Announcement` tidak terfilter. Probe dengan user Karyawan tanpa bidang: `WorkLink::count()=1`, `Announcement::count()=1` untuk data bidang lain. User id 5 di database juga tanpa bidang. | Akun tanpa bidang hanya boleh melihat konten `umum`/global; jangan pernah bypass. Backfill `department_id`/`bidang_id`, atau tampilkan pesan “hubungi admin” bila belum terikat. |
| 6 | **TINGGI** | Privasi portal | Halaman Data Tamu di portal karyawan memakai controller admin tanpa scoping; dokumen tamu mana pun dapat diunduh dengan menebak ID. | `Karyawan\TamuController` mewarisi seluruh query admin (NIK, HP, email, keperluan, dokumen). Route `karyawan/tamu/{tamu}/dokumen` hanya dijaga `tamu.view`, tanpa pencocokan `orang_ditemui_user_id`. | Untuk non-front-office, batasi daftar & dokumen ke tamu yang menunjuk akun sendiri. Pisahkan permission front-office dan tambahkan guard pada route dokumen. |
| 7 | **TINGGI** | Logika bisnis | NIK dibuat unik seumur hidup, sehingga tamu yang pernah datang tidak bisa mendaftar lagi. | Validasi publik dan admin: `unique:tamus,nik`; pesan “NIK ini sudah terdaftar sebelumnya.” Tidak ada mekanisme kunjungan ulang. | Ubah ke identitas tamu + tabel kunjungan, atau izinkan banyak baris per NIK dengan kunci unik gabungan (NIK + jadwal) dan validasi anti-duplikat pada slot yang sama. |
| 8 | **SEDANG** | Otorisasi konten | Detail pengumuman lintas bidang dapat dibuka lewat URL langsung. | `Admin\AnnouncementController@show` dan `Karyawan\AnnouncementController@show` tidak memanggil `authorizeAnnouncementAccess`; `resolveRouteBinding` sengaja melewati global scope. | Panggil guard scoping pada `show`, atau gunakan policy/route binding yang konsisten. |
| 9 | **SEDANG** | Ekspor | CSV tamu memiliki penomoran salah setelah 500 baris, status tidak akurat, dan rawan formula injection. | `$i = 0` di dalam `chunk(500)`; kolom status hanya `Selesai/Berkunjung` sehingga “Menunggu/Ditolak” dilabeli “Berkunjung”; nilai dari tamu ditulis mentah ke CSV. | Pindahkan counter ke luar chunk; petakan status lengkap; prefix `'` untuk nilai yang diawali `= + - @`; tambahkan test ekspor >500 baris. |
| 10 | **SEDANG** | Statistik tamu | “Aktif” dan filter “Berkunjung” salah hitung. | Statistik memakai `checked_out_at IS NULL` tanpa syarat check-in/disetujui; `Tamu::scopeStatus('berkunjung')` juga tidak mewajibkan `checked_in_at`. Data saat ini: 1 tamu disetujui, belum check-in, jadwal sudah lewat, tetap dihitung aktif. | Definisikan satu status kunjungan yang konsisten (`disetujui + checked_in_at != NULL + checked_out_at = NULL`) dan gunakan di statistik/filter. |
| 11 | **SEDANG** | Skema database | Tabel `jabatans` tidak memiliki FK maupun index yang dideklarasikan migrasi. | `SHOW CREATE TABLE jabatans` hanya berisi PRIMARY KEY; migrasi `2026_10_19_000002` tercatat sudah dijalankan. `bidang_id`/`parent_id` dapat menjadi yatim bila diubah di luar aplikasi. | Buat migrasi perbaikan idempoten untuk menambah index dan FK, atau bangun ulang database dengan `migrate:fresh` setelah backup. |
| 12 | **SEDANG** | Keamanan tampilan | Stored DOM XSS pada modal pratinjau admin. | Pratinjau “Petakan kode legacy” dan “Petakan ke Master” menyisipkan `row.nama`/nama bidang ke `innerHTML` tanpa escape. | Gunakan `textContent` atau fungsi escape yang sudah ada; sanitasi nama master saat input; tambahkan CSP. |
| 13 | **SEDANG** | Autentikasi/sesi | Beberapa alur status akun tidak konsisten. | `MustChangePassword` tidak mengecualikan logout (komentar menyebut dikecualikan, kode tidak); reset password via OTP tidak membersihkan `must_change_password`; menonaktifkan akun tidak menghapus sesi aktif. | Tambahkan pengecualian logout, bersihkan flag setelah reset, dan hapus session user saat akun dinonaktifkan/dihapus. |
| 14 | **SEDANG** | Otorisasi area admin | Akun tanpa role tetap dapat masuk “cangkang” admin. | `EnsureNotKaryawan` meneruskan akun tanpa role; `admin/dashboard`, `admin/settings`, `admin/search`, `admin/notifications` tidak memakai permission. Database memiliki `Test User` tanpa `role_id` yang dapat login. | Tolak akun tanpa role di login/middleware, atau wajibkan `dashboard.view`; hapus/Nonaktifkan akun test dari produksi. |
| 15 | **SEDANG** | Keamanan HTTP | Header keamanan tidak ada; proxy dipercaya secara wildcard. | Respons tidak memuat CSP, X-Frame-Options, HSTS, Referrer-Policy; `X-Powered-By` terlihat; cookie sesi tanpa `Secure` pada konfigurasi lokal; `trustProxies(at: '*')`. | Tambahkan middleware security headers, set `SESSION_SECURE_COOKIE=true` di HTTPS, batasi trusted proxy ke IP/range proxy nyata, matikan `expose_php`. |
| 16 | **SEDANG** | Kebijakan RBAC | Admin Bidang dapat mengubah pengumuman global (`department_id = NULL`). | `authorizeAnnouncementAccess` meloloskan pengumuman global untuk semua Admin Bidang, termasuk edit/delete/publish. | Tegaskan kebijakan: jika pengumuman global milik Super Admin, tolak Admin Bidang untuk data `department_id = NULL`; jika tidak, dokumentasikan sebagai keputusan resmi. |
| 17 | **RENDAH** | Privasi API publik | Endpoint dependen dropdown mengembalikan NID dan `user_id` staf tanpa autentikasi/throttle. | `/api/get-karyawan` mengembalikan `nid`, `user_id`; `/api/get-pegawai` dapat dipakai enumerasi nama. | Kembalikan hanya `id` + nama yang diperlukan; tambahkan throttle dan pertimbangkan token formulir. |
| 18 | **RENDAH** | Kualitas pengujian | Suite test tidak hijau dan lambat; dokumentasi test usang. | 12 tes gagal: 8 `NotRandomEmailRuleTest` (kelas `App\Rules\NotRandomEmail` sudah tidak ada), 3 `MenuTreeCacheTest` (`MenuBuilderService` tidak ada), 1 `PortalContentManagementTest` (label “Master Bidang” sudah berubah). Run penuh tidak selesai dalam 300 detik. | Hapus/perbarui tes untuk fitur yang sudah dihapus; perbaiki assertion UI; pertimbangkan SQLite in-memory/parallel test; jalankan di CI. |
| 19 | **RENDAH** | Dokumentasi | README dan laporan white-box tidak sesuai kode saat ini. | README menyebut 537 tes “harus lulus”, unggah “foto KTP & surat PDF” terpisah, dan Administrator “akses penuh kecuali user/role”; implementasi memakai satu dokumen gabungan dan RBAC yang berbeda. `docs/laporan-white-box-testing.md` masih merujuk MenuBuilderService/Page/NotRandomEmail. | Perbarui README, dokumentasi deployment, dan laporan test; tandai dokumen historis dengan jelas. |
| 20 | **RENDAH** | Desain & performa | Halaman sangat besar dan sulit dirawat; ketergantungan CDN tanpa SRI. | Form registrasi tamu ±223 KB HTML; 2.164 baris CSS inline di empat file utama; 728 atribut `style=`; 128 `onclick=`; 91 tag `<script>`; Bootstrap/FontAwesome/SweetAlert/Google Fonts dari CDN. | Pindahkan CSS/JS ke aset ter-build, kurangi inline handler (addEventListener), tambahkan SRI/preconnect, ukur LCP/CLS di mobile. |
| 21 | **RENDAH** | Aksesibilitas | Belum ada skip-link dan umpan balik flash belum seragam untuk pembaca layar. | Tidak ditemukan skip-link; hanya 6 `aria-modal`; 24 `<button>` tanpa `type`; 40 gambar dengan 39 `alt`. | Tambahkan skip-link, `aria-live` untuk flash/toast, `type="button"` pada tombol non-submit, audit alt dan fokus keyboard. |
| 22 | **RENDAH** | Ketahanan data | Operasi file + database tidak atomik. | Upload tamu disimpan sebelum insert; update berita/galeri menghapus file lama sebelum update DB; gagal DB dapat meninggalkan file yatim atau kehilangan file lama. | Simpan file baru lebih dulu, gunakan transaksi, hapus file lama setelah commit; tambahkan pembersihan file yatim. |
| 23 | **RENDAH** | Kredensial default | Password default dan akun contoh masih terdokumentasi/ter-commit di skrip. | `README.md` mencantumkan `password123`/`karyawan123`; banyak `tools/cdp_*.js` memuat password default; seeder membuat akun contoh. | Wajibkan override produksi, paksa ganti password, jangan seed akun contoh di produksi, gunakan secret manager. |

---

## 3. Audit alur utama

| Alur | Status | Catatan |
|---|---|---|
| Beranda, Tentang Kami, FAQ, informasi layanan | **Baik** | Halaman statis/Blade, konten di-escape, cache publik 10 menit. |
| Berita & pengumuman publik | **Baik dengan catatan** | Filter `target_publication` dan `is_published` benar; detail memakai `firstOrFail` sebelum cache. Cache perlu di-flush saat konten berubah (sudah lewat observer). |
| Galeri publik | **Baik** | Hanya status `publikasi`; gambar dari disk publik; cache per halaman. |
| Registrasi tamu publik | **Perlu perbaikan** | Validasi tanggal/libur/jam/dokumen kuat, tetapi NIK unik seumur hidup, batas upload Docker 2 MB, tidak ada kuota slot, dan file bisa yatim bila insert gagal. |
| Login / logout | **Perlu perbaikan** | Rate limit 5 percobaan per email+IP, session regenerate, tetapi akun nonaktif tetap bisa login; logout dapat terblokir oleh `must.password`. |
| Lupa password OTP | **Baik dengan catatan** | OTP di-hash, TTL 10 menit, batas percobaan, cooldown; tetapi reset tidak membersihkan `must_change_password`, akun nonaktif tetap dapat OTP, dan respons 404 membocorkan keberadaan email. |
| Dashboard admin & pencarian | **Baik dengan catatan** | Pencarian mematuhi permission per modul; dashboard dapat diakses akun tanpa role dan memuat seluruh berita/pengumuman untuk mengambil 5 terbaru. |
| Manajemen tamu admin | **Perlu perbaikan** | CRUD, check-in/out, print, dokumen privat, dan guard status sudah ada; statistik “aktif”, filter “berkunjung”, ekspor CSV, dan izin lintas-unit portal masih bermasalah. |
| Verifikasi kunjungan | **Baik dengan catatan** | Satu pihak satu kali untuk portal; admin dapat merevisi status berulang. Status yang sudah check-in masih bisa diubah menjadi ditolak, meninggalkan data kunjungan tidak konsisten. |
| Manajemen berita/pengumuman/galeri | **Baik dengan catatan** | Permission per aksi, target publikasi, slug unik, gambar tervalidasi; detail pengumuman lintas bidang belum dijaga; pengumuman global dapat diubah Admin Bidang. |
| Link kerja | **Baik dengan catatan** | Scoping bidang/jabatan dan guard tulis cukup baik; akun tanpa bidang bocor karena bypass global scope. |
| Data karyawan & master bidang/jabatan | **Baik dengan catatan** | Import CSV/XLSX transaksional, validasi master, pencegahan siklus hierarki; penghapusan karyawan ikut menghapus akun (sesuai spesifikasi) dan `jabatans` tidak memiliki FK/index aktual. |
| Portal karyawan | **Perlu perbaikan** | Tampilan dan scoping konten relatif baik; akun tanpa bidang melihat semua pengumuman/link; Data Tamu memakai query admin tanpa scoping. |
| Manajemen user/role | **Perlu perbaikan** | Kuota Super Admin, proteksi role dasar, guard IDOR detail pengguna sudah ada; eskalasi direct permission, hapus akun sendiri/last Super Admin, dan status nonaktif belum aman. |
| Notifikasi & log aktivitas | **Baik dengan catatan** | Notifikasi per akun dan cache 10 detik; log JSONL dengan rotasi. Log memuat NIK pada deskripsi, dan binlog recovery database ter-commit ke Git. |

---

## 4. Audit database

| Tabel | Baris | Kunci/index/FK | Catatan |
|---|---:|---|---|
| `users` | 7 | email unik; FK role/bidang/jabatan/department | Tidak ada kolom status aktif eksplisit; semua akun `email_verified_at=NULL`; 1 akun tanpa role; 1 akun tanpa bidang. |
| `tamus` | 1 | NIK unik; FK `orang_ditemui_user_id` ON DELETE SET NULL; index status/tanggal/created/checkout | NIK unik menghalangi kunjungan ulang; tidak ada FK ke `bidangs`/`jabatans`; data contoh disetujui tetapi belum check-in dan jadwalnya sudah lewat. |
| `karyawans` | 289 | NID unik; FK bidang/jabatan RESTRICT; index status+nama | 6 baris belum punya `jabatan_id`; data master cukup lengkap. |
| `jabatans` | 73 | **Hanya PRIMARY KEY** | Migrasi mendefinisikan FK `bidang_id`/`parent_id` dan index, tetapi DDL aktual tidak memilikinya (schema drift). |
| `bidangs` | 5 | PK; self-FK parent RESTRICT; index parent/department_code | Relasi hierarki berfungsi; penghapusan dijaga controller. |
| `work_links` | 9 | FK bidang/jabatan RESTRICT; index category+active | Semua data saat ini kategori umum; tidak ada target khusus yang bisa diuji dengan data nyata. |
| `news`, `announcements` | 0 | slug unik; FK author SET NULL; FK department SET NULL | Belum ada konten untuk uji produksi; kode caching/filter sudah siap. |
| `activity_logs` | 0 | FK user SET NULL; index modul/aksi | Log aktual disimpan sebagai file JSONL di storage, bukan tabel ini. |
| `sessions`, `cache`, `jobs`, `failed_jobs` | — | standar Laravel | Session/cache berbasis database; dump `backup_nama_database_anda.sql` memuat tabel `sessions` (sensitif). |

**Integritas relasi secara umum baik:** penghapusan user tidak memutus tamu (SET NULL), penghapusan role tidak memblokir user, penghapusan bidang/jabatan dilindungi RESTRICT atau validasi controller. **Cacat utama:** `jabatans` tidak sesuai migrasi, NIK unik permanen, dan tidak ada kolom status akun yang tegas.

---

## 5. Audit desain / UI

| Aspek | Temuan | Dampak | Rekomendasi |
|---|---|---|---|
| Tema & konsistensi | Tema terang/gelap, komponen tombol/badge/paginasi konsisten, layout publik/admin/portal terpisah. | Kesan profesional dan alur visual jelas. | Pertahankan design token; hindari style inline baru. |
| Responsif | Meta viewport ada; CSS admin/karyawan memiliki 11/4 media query; form tamu memiliki 8 media query. | Dasar responsif sudah ada, tetapi belum ada visual regression test. | Uji 360/768/1024 px untuk form tamu, tabel admin, modal, dan sidebar. |
| Bobot halaman | Form tamu ±223 KB HTML; CSS inline 2.164 baris; 728 `style=`; aset CDN tanpa SRI. | Lambat di jaringan internal/mobile, sulit di-cache, rawan kegagalan CDN. | Pindahkan CSS/JS ke bundel, minifikasi, SRI, dan ukur LCP/CLS. |
| Aksesibilitas | Belum ada skip-link; 24 tombol tanpa `type`; hanya 6 `aria-modal`; flash belum `aria-live`. | Pengguna keyboard/screen reader mengalami hambatan. | Tambahkan skip-link, label/aria, `type="button"`, fokus terlihat, dan audit kontras. |
| Keamanan tampilan | 128 handler `onclick` inline dan tidak ada CSP; pratinjau admin memakai `innerHTML` dari nama master. | Sulit menerapkan CSP; berpotensi stored XSS oleh admin berwenang. | Gunakan event listener, escape semua data, terapkan CSP nonce/hash. |
| Maintainability | Layout admin 1.032 baris, app 776 baris, form tamu 3.192 baris; controller DataKaryawan 1.828 baris. | Perubahan kecil berisiko regresi dan sulit ditinjau. | Pecah menjadi komponen/partial/service; kurangi duplikasi CSS dan JS. |

---

## 6. Hasil pengujian & kualitas

| Pemeriksaan | Perintah | Hasil |
|---|---|---|
| Suite test | `DB_HOST=127.0.0.1 DB_PORT=3307 php artisan test` | **610 lulus, 12 gagal** (277,75 detik). 12 kegagalan = 8 `NotRandomEmailRuleTest`, 3 `MenuTreeCacheTest`, 1 assertion usang `PortalContentManagementTest`. |
| NotRandomEmailRuleTest | filter test | 8 gagal — `App\Rules\NotRandomEmail` tidak ada. |
| MenuTreeCacheTest | filter test | 3 gagal — `App\Services\MenuBuilderService` tidak ada. |
| PortalContentManagementTest | filter test | 1 gagal — assertion mencari teks “Master Bidang” yang sudah tidak dirender. |
| Gaya kode | `vendor/bin/pint --test` | 114 file tidak sesuai (app 54, tests 39, database 13, dll.). |
| CI | `.github/workflows` | Tidak ada pipeline CI. |
| Uji HTTP | `curl` halaman publik/login | 200 untuk halaman publik; admin tanpa login → 302 ke login; tidak ada security header. |

**Keterbatasan audit:** tidak ada pengujian beban, pengujian browser visual, atau pemindaian DAST. Temuan keamanan diverifikasi dengan probe sementara yang sudah dihapus dari working tree. Dua belas kegagalan suite adalah tes usang untuk kelas/label yang sudah dihapus — bukan regresi dari perbaikan 13 November 2026.

---

## 7. Rencana perbaikan yang disarankan

### Segera (sebelum produksi)
1. Hapus & purge dump SQL dari Git; rotasi semua password dan session/remember token. **(belum)**
2. Tutup eskalasi direct permission pada self-edit; tambahkan regression test. **(selesai 13 Nov 2026)**
3. Tegakkan status akun nonaktif di login dan invalidasi sesi. **(selesai 13 Nov 2026)**
4. Perbaiki batas upload PHP container (12M/16M) dan uji upload nyata.
5. Perbaiki scoping akun tanpa bidang dan akses dokumen tamu di portal.

### Sprint berikutnya
6. Ubah aturan NIK untuk mendukung kunjungan ulang.
7. Perbaiki statistik/filter tamu, ekspor CSV, dan guard `show` pengumuman.
8. Tambahkan FK/index `jabatans` melalui migrasi perbaikan.
9. Escape semua data pada pratinjau `innerHTML`; tambahkan security header.
10. Bersihkan tes usang, perbaiki 12 kegagalan, dan tambahkan CI (test + Pint).

### Jangka menengah
11. Pecah view/controller besar dan pindahkan aset inline ke bundel.
12. Audit aksesibilitas dan uji responsif formal.
13. Perbarui README, matriks role, dan laporan white-box agar sesuai implementasi.

---

## 8. Catatan tentang error Intelephense pada probe

`tests/Feature/TmpInactiveLoginProbeTest.php` adalah **file probe sementara** yang dibuat untuk membuktikan temuan login akun nonaktif, lalu sudah dihapus dari disk. Error `Undefined method 'check'` tetap muncul karena file itu **masih terbuka sebagai tab editor** di VS Code (tercatat di `state.vscdb` workspace) — Intelephense menganalisis buffer tab tersebut, bukan file di disk. Menutup tab itu (Ctrl+W) atau **Developer: Reload Window** akan menghapus diagnostik. Di repositori tidak ada file tersebut: `find . -iname '*TmpInactiveLogin*'` kosong dan `git status` hanya berisi laporan ini.

---

## 9. Perbaikan yang diterapkan (13 November 2026)

| Temuan | Perubahan | Bukti verifikasi |
|---|---|---|
| #2 eskalasi direct permission saat self-edit | `UserController@update` hanya memanggil `syncDirectPermissions()` bila aktor Super Admin; cabang self-edit non-super tidak lagi membaca `permissions[]` dari request. Regression test `test_self_edit_cannot_grant_direct_permissions`. | `DirectPermissionTest` lulus (17 tes). |
| #3 akun nonaktif tetap bisa login | Migrasi `2026_11_13_000001_add_is_active_to_users_table` menambah `users.is_active` (default aktif + backfill 7 akun existing). Login menolak akun nonaktif; middleware `EnsureAccountActive` memutus sesi lama; toggle admin menulis `is_active` dan menghapus baris `sessions`. | `InactiveAccountLoginTest` (3 tes), `UserToggleStatusTest` (7 tes), `UserOrgHierarchyTest` (14 tes) lulus. |
| Tampilan status pengguna | Statistik, badge, dan tombol toggle memakai `is_active()` (label Nonaktif), bukan `email_verified_at`. | `UserToggleStatusTest` + render halaman lulus. |
| #1 klaim dump ter-commit | Dikoreksi: hanya 24 binlog `storage/recovery-20260928/*.sql` yang tracked; `backup_*.sql` di root tidak tracked (diabaikan `.gitignore`). | `git ls-files` / `git check-ignore`. |

Dampak migrasi: seluruh akun existing di-backfill **aktif** agar tidak terkunci (perilaku login sebelum perbaikan). Admin dapat menonaktifkan akun lewat toggle setelah migrasi. Produksi harus menjalankan migrasi ini (`RUN_MIGRATIONS=true` atau `php artisan migrate --force`) sebelum kode baru melayani login.
