# Laporan White-Box Testing — Portal PLTU Indramayu

**Tanggal:** 2 November 2026
**Kode diuji:** commit `96763dd` ("syafiq 30 oktober — memperbarui seeder hari libur dan menyelaraskanya")
**Runner:** PHPUnit (Laravel 12.69.1), DB `pln_up_imy_testing`, `php artisan test`

---

## 1. Ringkasan eksekutif

| Metrik | Baseline (HEAD 96763dd) | Setelah test putih-box baru |
| --- | --- | --- |
| Lulus | 400 | **433** (+33) |
| Gagal | 5 | 5 (identik, pre-existing) |
| Risky | 156 | 156 (tidak bertambah) |
| Assertions | 2.717 | **2.852** (+135) |
| Durasi | 207,79 s | 115,90 s |

White-box testing berfokus pada **jalur kontrol internal** yang sebelumnya tidak tersentuh unit test:
layanan (`app/Services`), aturan validasi (`app/Rules`), dan mekanisme cache/observer.
Semua 33 test baru **lulus penuh** dan tidak menambah jumlah test *risky*.

---

## 2. Analisis struktur internal (control flow)

### 2.1 Services

| Kelas | Baris | Logika bercabang | Status cakupan sebelumnya |
| --- | --- | --- | --- |
| `MasterOrgMatcher` | 167 | Pemetaan teks lama → master bidang/jabatan: `EMPTY / MATCHED / UNMAPPED / AMBIGUOUS` | **Tidak ada test langsung** |
| `PublicPageCache` | 78 | Version-tag cache: `version()` init, `flush()` (null→1 lalu increment), `remember()` berversi | **Tidak ada test langsung** |
| `MenuBuilderService` | 247 | Fallback default saat tabel kosong, filter menu tak valid, **cache tree per-user + `flushTree()`** | Rendering teruji (MenuTest), **jalur cache tidak** |
| `NotificationService` | 147 | Hitung tamu belum dibaca per akun, item draft, cache 10 detik | Tercakup TopbarTest |
| `PortalContentService` | 668 | Scoping work link per level | Tercakup KaryawanPortalTest |
| `ActivityLogger` | 509 | Rotasi baris, filter baca, pencarian | Tercakup ActivityLogTest |
| `XlsxReader` | 706 | Parser ZIP+XML, deteksi BOM, delimiter | Tercakup DataKaryawanTest |

### 2.2 Rules & Models

- `App\Rules\NotRandomEmail` — 5 cabang heuristik (tanpa `@`, akronim pendek, tanpa vokal, rantai konsonan ≥5, rasio >5:1) — **tidak ada test**.
- `App\Models\Permission::ACTION_ALIASES` / `resolveAlias()` — resolusi alias aksi (`news.publish`→`news.edit`, fallback `hari_libur.*`→`tamu.*`) — tercakup sebagian (RbacTest, HariLiburTest).
- `App\Models\Page::isAccessibleBy()` — draft / public / role_restricted tanpa role — tercakup PageTest.
- Model scope (`Karyawan::scopeFiltered`, `Tamu::scopeSearch`, `ActivityLog::scopeFilter`) — tercakup lewat feature test eksisting.

---

## 3. Test putih-box baru (33 test, semua lulus)

### 3.1 Unit

**`tests/Unit/NotRandomEmailRuleTest.php` — 8 test**
Menguji urutan cabang di `NotRandomEmail::validate()`:

| Cabang | Kondisi | Ekspektasi | Test |
| --- | --- | --- | --- |
| 0 | tanpa `@` / local-part kosong | lolos (diselesaikan rule `email`) | `test_tanpa_tanda_at_…` |
| 0b | local-part ≤ 3 huruf (`hrd`, `adm`, `cs`, angka murni) | lolos | `test_local_part_pendek_…` |
| 1 | tanpa vokal (`xqzw`, `kjhgfd`) | **gagal** | `test_local_part_tanpa_vokal_…` |
| 2 | rantai konsonan ≥ 5 (`asdfgh`, `zxcvbnm`) | **gagal** | `test_rantai_konsonan_panjang_…` |
| 2 (negatif) | rantai dipotong vokal (`christopher`) | lolos | `test_rantai_konsonan_pendek_…` |
| 3 | rasio konsonan:vokal > 5 (`bcdafgh` = 6/1) | **gagal** | `test_rasio_konsonan_…` |
| lolos | nama manusiawi + angka diabaikan dari rasio | lolos | 2 test |

**`tests/Unit/PublicPageCacheTest.php` — 5 test**
- `key()` menginisialisasi versi ke 1 saat kunci kosong → `public.pages.<kunci>.v1`.
- `flush()` pada kondisi null hanya menginisialisasi (tidak langsung 2), selanjutnya increment; versi yang sudah ada dihormati.
- `remember()` mengeksekusi callback **sekali** (hit), lalu dihitung ulang setelah `flush()` — membuktikan kunci lama ditinggalkan basi tanpa wildcard flush.
- `TTL_MINUTES` = 10 dipakai bila argumen menit tidak diberikan.

**`tests/Unit/MasterOrgMatcherTest.php` — 14 test (RefreshDatabase)**
Matriks cabang `resolveBidang()` × `resolveJabatan()`:

| Skenario | bidang_status | jabatan_status |
| --- | --- | --- |
| keduanya valid (` sd m ` vs `Bagian SDM`, case/spasi bebas) | matched | matched |
| bidang null / `''` / whitespace | empty | — |
| bidang tidak ada di master | unmapped (+catatan) | — |
| nama bidang duplikat di master | **ambiguous** (+catatan "lebih dari satu") | — |
| jabatan kosong | matched | empty |
| jabatan tidak ada di master | matched | unmapped |
| bidang tak dikenal + jabatan valid | unmapped | unmapped (catatan "belum dapat dipetakan") |
| bidang ambigu + jabatan valid | ambiguous | **ambiguous** (diwarisi) |
| bidang kosong + jabatan valid | empty | unmapped |
| jabatan terdaftar di bidang lain | matched | **ambiguous** (catatan "bidang lain") |
| jabatan duplikat dalam bidang sama | matched | **ambiguous** (catatan "lebih dari satu di bidang yang sama") |

Ditambah pengujian `normalize()` (rapikan spasi + uppercase) dan sifat index yang dibangun
sekali di constructor (master yang dibuat sesudahnya tidak terbaca oleh instance lama).

### 3.2 Feature

**`tests/Feature/PublicPageCacheInvalidationTest.php` — 3 test**
Jalur invalidasi `News::saved` / `News::deleted` → `PublicPageCache::flush()`:
- List berita di-cache; tulis lewat **query builder** (tanpa event model) sengaja dibuktikan **tidak** mengubah versi → render berikutnya masih basi; `flush()` eksplisit lalu konten baru muncul.
- `News::create` (via model) menaikkan versi tepat 1 → list segar + data lama tetap ada.
- `News::delete` → flush → item hilang dari list; route detail `firstOrFail` tetap 404 (404 tidak datang dari cache).

**`tests/Feature/MenuTreeCacheTest.php` — 3 test**
- `treeFor()` menyimpan cache per-pengguna (`menu.tree.u0` untuk tamu, `menu.tree.u{id}` per akun); `flushTree()` menghapus seluruh kunci.
- Cache tetap **basi** sampai `flushTree()` dipanggil (insert model langsung tidak memicu flush) → tree berubah setelah flush.
- CRUD menu lewat panel admin (`admin.menus.store`) memanggil `flushTree()` → kunci tamu terhapus dan navbar langsung memakai menu baru.

---

## 4. Temuan: akar 5 kegagalan baseline

Kelima kegagalan **pre-existing** (sudah gagal sebelum test baru ditulis) dan seluruhnya bersumber
dari **test yang tidak sinkron dengan perubahan kode/fitur**, bukan dari bug fungsi baru.
Belum diperbaiki — sesuai lingkup sesi ini (investigasi & dokumentasi).

### F-1 · `KaryawanAdminAccessTest > portal nav management items follow permission`
- **Gejala:** karyawan dengan direct permission hanya `tamu.view` tetap melihat "Kelola Berita" di dropdown *Akses Admin* portal (`resources/views/layouts/karyawan.blade.php:520`, `@can('news.view')`).
- **Akar:** `User::KARYAWAN_BASELINE_PERMISSIONS` = `['dashboard.view', 'news.view', 'pages.view']` — `news.view` kini **baseline semua karyawan**, sehingga `hasPermission('news.view')` selalu `true` lewat jalur role (`permissionState()['rolePerms']`). Test berasumsi nav mengikuti *permission ekstra*; desain kini memisahkan baseline vs ekstra.
- **Dampak:** asersi `assertDontSee('Kelola Berita')` untuk sekuriti (dan berpotensi blok karyawan biasa) mustahil lulus.
- **Rekomendasi:** perbarui test agar membedakan item *baseline* (selalu tampil) vs item *ekstra* (`tamu.view`, `announcements.*`, `galleries.*`).

### F-2 & F-3 · `KaryawanPortalTest` (2 test ganti password)
- **Gejala:** PUT `karyawan.profil.update` tanpa `no_hp`/`alamat` di-redirect ke `/` dengan error validasi; test mengharapkan redirect ke `karyawan.profil` dan `session error current_password`.
- **Akar:** `PortalController::updateProfil()` mewajibkan `name`, `no_hp` (max:20), `alamat` (max:500) sebelum blok password dijalankan. Payload test hanya mengirim `name` + field password → gagal di validasi tahap pertama, sehingga cabang `current_password` tidak pernah dicapai.
- **Rekomendasi:** tambahkan `no_hp` & `alamat` pada payload dua test tersebut (atau buat endpoint khusus ganti password bila ingin terpisah dari profil).

### F-4 · `RbacTest > role creation is disabled`
- **Gejala:** halaman `admin.roles.index` tidak memuat `btn-corp-add" disabled`.
- **Akar:** pembuatan role **diaktifkan kembali**: `routes/web.php:400` membuka `roles/create` & `roles/store` di balik `permission:roles.create`, dan `admin/roles/index.blade.php:117` me-render `<a class="btn-corp btn-corp-add">` pada blok `@can('roles.create')` — tanpa varian `disabled`. Test masih mempertahankan asersi era "role terkunci".
- **Rekomendasi:** balik asersi — admin **dengan** `roles.create` melihat tombol aktif; admin **tanpa** permission tidak melihatnya; `POST roles` tetap 405 bila route store tidak ada.

### F-5 · `TamuTest > store accepts tanggal di luar daftar libur`
- **Gejala:** POST ditolak dengan "Tanggal **09 November 2026** adalah hari libur — Libur Uji Coba", padahal test mendaftarkan libur untuk `hariKerja(5)` dan mengirim `hariKerja(6)`.
- **Akar:** helper `hariKerja()` bergantung pada `now()` + skip akhir pekan. Saat hari uji = Senin 2 Nov 2026: `hariKerja(5)` = 7 Nov (Sabtu) → di-skip → **9 Nov**; `hariKerja(6)` = 8 Nov (Minggu) → di-skip → **9 Nov**. Keduanya **tanggal yang sama**, jadi tanggal yang diblokir kebetulan adalah tanggal yang dikirim. Bug test (date-dependent/flaky), perilaku aplikasi **benar**.
- **Rekomendasi:** buat helper menghasilkan tanggal berbeda (mis. `hariKerja($n)` = hari kerja ke-*n* sejak besok, bukan `now()->addDays($n)`), atau pilih tanggal eksplisit bebas akhir pekan.

---

## 5. Hasil akhir seluruh suite

```
Tests:    5 failed, 156 risky, 433 passed (2852 assertions)
Duration: 115.90s
```

Daftar kegagalan (identik dengan baseline, tanpa regresi baru):

1. `Tests\Feature\KaryawanAdminAccessTest > portal nav management items follow permission` (F-1)
2. `Tests\Feature\KaryawanPortalTest > karyawan can change password with current password` (F-2)
3. `Tests\Feature\KaryawanPortalTest > karyawan password change requires correct current password` (F-3)
4. `Tests\Feature\RbacTest > role creation is disabled` (F-4)
5. `Tests\Feature\TamuTest > store accepts tanggal di luar daftar libur` (F-5)

---

## 6. Catatan kualitas & keterbatasan

- **156 test *risky*** — seluruhnya karena *"Test code or tested code did not close its own output buffer"*
  (panggilan `ob_*` tak tertutup pada sejumlah test render halaman, mis. `UserUnifiedOrgSectionTest`,
  `UserOrgHierarchyTest`, `KaryawanPortalTest`). Tidak menambah test baru ke kelompok ini.
- **Peringatan PHPUnit** — `AdminResetPasswordTest` memakai metadata di doc-comment (`@dataProvider`
  dsb.) yang deprecated dan akan dihapus di PHPUnit 12; belum diubah karena di luar lingkup.
- **Tidak ada pengukuran cakupan kode** (tidak ada `xdebug`/`pcov` di lingkungan ini), sehingga klaim
  cakupan cabang bersifat **analitik** — berdasarkan pembacaan kontrol flow tiap unit dan dipetakan
  ke test, bukan persentase instrumen.
- Test baru bergantung pada DB MySQL `pln_up_imy_testing` dan store cache `array` (dipaksa
  `phpunit.xml`), sesuai konfigurasi suite yang ada.

---

## 7. Rekomendasi lanjutan

1. **Perbaiki 5 test baseline** (F-1…F-5) agar suite kembali hijau — seluruhnya perubahan asersi/payload, bukan perubahan kode produksi.
2. **Buat test `User::hasPermission` level unit** untuk cabang alias (rule 0: baris alias mentah dihormati) dan fallback `rolesEmpty && role_id` (akun legacy tanpa pivot `role_user`) — cabang terakhir belum pernah tercapai test.
3. **Perbaiki helper tanggal** (`hariKerja`) supaya tidak lagi flaky terhadap hari eksekusi.
4. Tambahkan `xdebug`/`pcov` bila ingin angka cakupan instrumen resmi untuk laporan berikutnya.