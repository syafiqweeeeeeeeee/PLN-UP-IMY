# Matriks Role × Akses — Portal Internal UP Indramayu

> Acuan untuk menentukan role mana yang perlu dibuat di sistem (Role Management).
> Dibuat: 2026-09-16 · Berdasarkan struktur divisi dari bagan organisasi.

---

## 1. Prinsip dasar

1. **Role = akses** ("boleh ngapain"), **Grup = organisasi** ("bagian tim apa").
   Jangan membuat role baru hanya karena divisinya beda — buat role baru hanya jika **aksesnya** beda.
2. **24 divisi ≠ 24 role.** Divisi dikelompokkan per fungsi; setiap klaster diarahkan ke role yang sama kecuali tugasnya menuntut akses berbeda.
3. Identitas divisi (HR vs Mesin 1, dsb.) nanti bisa ditampung modul **Grup Karyawan** bila konten internal perlu ditargetkan per unit — bukan lewat role.

---

## 2. Klasterisasi divisi (24 divisi → 6 klaster)

| Klaster | Divisi | Jumlah |
|---|---|---|
| **Operasi & Produksi** | Produksi A, B, C, D · CHCB A, B, C, D · SO · RenOps · Rend. Har · Kimia & Lab | 12 |
| **Pemeliharaan (Maintenance)** | Mesin 1 · Mesin 2 · Listrik · Konin · MO · CBM · MMRK | 7 |
| **Niaga & Pengadaan** | Niaga BB · Pengadaan | 2 |
| **Logistik** | Inventori, Kontrol & Gudang | 1 |
| **Kantor & Pendukung** | SDM Umum CSR · Keuangan | 2 |
| **Pimpinan** | Kepala UP / koordinator unit | — |

---

## 3. Matriks akses per role

Legend: ✅ = punya permission · ❌ = tidak

| Modul / Permission | Karyawan | Pimpinan | Editor Konten | Administrator |
|---|:-:|:-:|:-:|:-:|
| `dashboard.view` | ✅ | ✅ | ✅ | ✅ |
| `news.view` | ✅ | ✅ | ✅ | ✅ |
| `news.create` / `news.edit` | ❌ | ❌ | ✅ | ✅ |
| `news.publish` | ❌ | ❌ | ✅ | ✅ |
| `news.delete` | ❌ | ❌ | ❌ ¹ | ✅ |
| `pages.view` | ✅ | ✅ | ✅ | ✅ |
| `pages.create` / `pages.edit` | ❌ | ❌ | ✅ | ✅ |
| `pages.delete` | ❌ | ❌ | ❌ | ✅ |
| `internal.view` (halaman internal) | ✅ | ✅ | ✅ | ✅ |
| `applications.view` (aplikasi internal) | ✅ | ✅ | ✅ | ✅ |
| `applications.create/edit/delete` | ❌ | ❌ | ❌ | ✅ |
| `menus.*` (menu builder) | ❌ | ❌ | ❌ | ✅ |
| `groups.*` (kelola grup karyawan) | ❌ | ❌ | ❌ | ✅ |
| `users.*` / `roles.*` | ❌ | ❌ | ❌ | ✅ |
| `activity_logs.view` | ❌ | ✅ | ❌ | ✅ |
| `settings.view` / `settings.edit` | ❌ | ❌ | ❌ | ✅ |

¹ Hapus dibiarkan milik Administrator agar konten tidak terhapus tanpa kontrol. Bisa diubah nanti.

**Catatan:** jumlah baris matriksnya memang sedikit berbeda untuk tiap role — justru itu tujuannya. Perbedaan akses hanya muncul di **Editor Konten** (boleh buat/edit/publish) dan **Pimpinan** (bisa lihat log aktivitas). Sisanya identik.

---

## 4. Role yang perlu dibuat — final list

| # | Role | Status | Deskripsi | Isi permission |
|---|---|---|---|---|
| 1 | **Karyawan** | ✅ sudah ada (seeder) | Default semua divisi | `dashboard.view`, `news.view`, `pages.view`, `internal.view`, `applications.view`, `logout` |
| 2 | **Pimpinan** | 🆕 buat baru | Kepala UP / koordinator — pantau saja | Karyawan + `activity_logs.view` |
| 3 | **Editor Konten** | 🆕 buat baru | PIC publikasi konten (kemungkinan dari SDM Umum CSR) | Karyawan + `news.create`, `news.edit`, `news.publish`, `pages.create`, `pages.edit` |
| 4 | **Administrator** | ✅ sudah ada (seeder) | Kelola sistem penuh | semua permission |
| 5 | **Viewer** (publik) | ✅ sudah ada | Pengunjung web publik tanpa login | bukan role sistem — tanpa login |

**Hasil: hanya 2 role baru yang perlu dibuat** (Pimpinan, Editor Konten). 24 divisi cukup diarahkan ke role **Karyawan**.

---

## 5. Pemetaan divisi → role default

| Divisi | Role default |
|---|---|
| Produksi A–D, CHCB A–D, SO, RenOps, Rend. Har, Kimia & Lab | Karyawan |
| Mesin 1, Mesin 2, Listrik, Konin, MO, CBM, MMRK | Karyawan |
| Niaga BB, Pengadaan | Karyawan |
| Inventori, Kontrol & Gudang | Karyawan |
| SDM Umum CSR, Keuangan | Karyawan *(+ Editor Konten untuk PIC publikasi)* |
| Kepala UP / koordinator unit | Pimpinan |

---

## 6. Celah & catatan teknis

1. **~~Permission Pengumuman & Galeri belum ada~~** ✅ (16 Sep 2026) — `announcements.*`, `galleries.*`, dan `contact_messages.*` sudah ditambahkan ke `PermissionSeeder`, dan **semua route admin kini ditegakkan middleware `permission:`** (berita, pengumuman, galeri, users, permohonan, roles). Sidebar & dashboard ikut menyembunyikan modul yang tidak punya permission.
2. **Form user masih single-role.** Pivot `role_user` sudah mendukung multi-role, tapi `UserController` baru sinkron 1 role. Cukup untuk skema di atas (tiap orang ≤ 2 role), tapi kalau mau "Karyawan + Editor" sekaligus perlu diubah jadi multi-select.
3. **Targeting konten per divisi** (pengumuman khusus Operasi saja, dsb.) = pekerjaan modul **Grup Karyawan** (`groups.*` sudah disiapkan di seeder), bukan role tambahan.
4. Permission berakhiran `-x` untuk klaster yang aksesnya nanti ternyata berbeda (mis. Pengadaan boleh tambah aplikasi internal) cukup dicentang via Role Management — tanpa kode.

---

## 7. Keputusan yang perlu ditetapkan

- [ ] **Siapa PIC konten?** (pemegang role Editor Konten — dari divisi mana?)
- [ ] **Apakah ada divisi yang aksesnya benar-benar berbeda** dari baris Karyawan di matriks? (mis. Pengadaan boleh kelola aplikasi internal)
- [ ] **Pengumuman internal per-unit atau untuk semua?** → menentukan apakah modul Grup Karyawan perlu dibangun sekarang atau nanti.

---

## 8. Fitur baru: Tombol Web Eksternal per Divisi

> Requirement: setiap divisi mendapat tombol akses web eksternal, dan URL-nya berbeda-beda per divisi.

**Implikasi desain:** fitur ini TIDAK bisa diselesaikan dengan role. 23 dari 24 divisi berbagi role "Karyawan" — role tidak punya cara membedakan orang Mesin 1 dari orang Keuangan. Butuh entitas **divisi** yang menempel ke user.

**Skema yang diusulkan:**

| Tabel | Isi | Catatan |
|---|---|---|
| `divisions` | id, name, slug, is_active, timestamps | CRUD admin — module *Employee Group*, permission `groups.*` sudah tersedia di seeder |
| `users.division_id` | FK nullable ke divisions | 1 orang 1 divisi; dikosongkan untuk Pimpinan/Admin |
| `applications` | id, name, url, icon, description, sort_order, is_active, timestamps | CRUD admin — permission `applications.*` sudah tersedia di seeder |
| `application_division` | pivot application_id ↔ division_id | Link **tanpa** pemetaan divisi = tampil untuk semua orang |

**Penempatan tombol:**
- Dashboard internal: grid "Aplikasi & Web Eksternal" — tampilkan link global + link divisi user yang login
- Halaman khusus "Aplikasi" — permission `applications.view` memang sudah diberikan ke role Karyawan di matriks

**Dampak ke matriks (bagian 3):** tidak mengubah baris akses apa pun — `applications.view` tetap untuk semua role internal, `applications.create/edit/delete` dan `groups.*` tetap milik Administrator.

**Prinsip penting:** role tetap menjawab "boleh masuk halaman apa", divisi menjawab "konten/link siapa yang relevan". Keduanya berdampingan, tidak saling menggantikan.

### 8.1 Daftar divisi untuk seed awal (24)

Produksi A · Produksi B · Produksi C · Produksi D · CHCB A · CHCB B · CHCB C · CHCB D · SO · RenOps · Rend. Har · Kimia & Lab · Mesin 1 · Mesin 2 · Listrik · Konin · MO · CBM · MMRK · Niaga BB · Pengadaan · Inventori, Kontrol & Gudang · SDM Umum CSR · Keuangan

### 8.2 Contoh pemetaan (ilustrasi)

| Aplikasi (contoh) | URL (ilustrasi) | Divisi penerima |
|---|---|---|
| Sistem Perencanaan Produksi | `https://spp.example.com` | Produksi A–D, SO |
| Portal Pemeliharaan | `https://pm.example.com` | Mesin 1/2, Listrik, Konin, MO, CBM, MMRK |
| E-Procurement | `https://proc.example.com` | Pengadaan |
| SAP Keuangan | `https://sap.example.com` | Keuangan |
| SIM SDM (global) | `https://sdm.example.com` | *(tanpa pemetaan → semua divisi)* |

### 8.3 Kriteria selesai (acceptance)

- [ ] CRUD Divisi & Aplikasi berfungsi di admin (dijaga permission `groups.*` / `applications.*`)
- [ ] Form User punya pilihan divisi; karyawan bisa dipindah divisi
- [ ] Grid dashboard hanya menampilkan aplikasi global + aplikasi divisi user
- [ ] Test: karyawan divisi X tidak melihat aplikasi khusus divisi Y
