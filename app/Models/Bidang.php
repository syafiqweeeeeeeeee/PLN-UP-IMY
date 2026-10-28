<?php

namespace App\Models;

use App\Models\Concerns\Hierarchical;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * MASTER BIDANG — satu baris per nama bidang, boleh berhirarki
 * (parent_id → bidangs.id, NULL untuk bidang tingkat teratas).
 *
 * Tabel baru yang terpisah dari `departments` (katalog Bidang Utama
 * RBAC) dan dari kolom string `karyawans.bidang` (master data HR) —
 * keduanya tidak diubah oleh fitur ini. Kolom `karyawans.bidang` hanya
 * DIBACA untuk proteksi penghapusan (bidang yang masih dipakai data
 * karyawan tidak boleh dihapus).
 */
class Bidang extends Model
{
    use Hierarchical;

    protected $fillable = [
        'nama',
        'parent_id',
        'department_code',
        'sub_department_code',
    ];

    /**
     * Pemetaan nama Master Bidang → [department_code, sub_department_code]
     * untuk kolom legacy (`users.department` / `users.sub_department`).
     *
     * Daftar yang sama dengan migrasi add_legacy_codes_to_bidangs_table
     * (di sini dipakai ulang oleh fitur "Petakan Kode Legacy" pada panel
     * Master Bidang — baris yang dibuat MANUAL lewat form admin tidak
     * pernah dilewati migrasi itu, jadi kodenya masih NULL).
     *
     * - `null` pada department_code berarti baris itu MEMANG sengaja
     *   tanpa kode (induk umum seperti "PLTU INDRAMAYU") — jangan
     *   menebak kode untuk baris ini.
     * - Baris yang tidak ada di daftar ini diwarisi otomatis dari induk
     *   lewat departmentCode(); hanya baris tanpa induk berkode yang
     *   butuh pemetaan sendiri.
     *
     * @var array<string, array{0: string|null, 1: string|null}>
     */
    public const LEGACY_NAME_CODES = [
        'PLTU INDRAMAYU' => [null, null],

        // ── Engineering ────────────────────────────────────────────
        'BIDANG ENJINIRING' => ['engineering', null],
        'SUB BIDANG  SYSTEM OWNER TURBINE & AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG SYSTEM OWNER BOILER & AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG SYSTEM OWNER COMMON AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG COMPONENT ANALYST' => ['engineering', 'asmen_cbm'],
        'SUB BIDANG CONDITION BASED MAINTENANCE' => ['engineering', 'asmen_cbm'],
        'SUB BIDANG MANAJEMEN MUTU & KINERJA' => ['engineering', 'asmen_mmrk'],
        'SUB BIDANG MANAJEMEN RISIKO & KEPATUHAN' => ['engineering', 'asmen_mmrk'],

        // ── Operasi ────────────────────────────────────────────────
        'BIDANG OPERASI' => ['operasi', null],
        'SUB BIDANG RENDAL OPERASI' => ['operasi', 'asmen_renops'],
        'SUB BIDANG PRODUKSI A' => ['operasi', 'asmen_prod_a'],
        'SUB BIDANG PRODUKSI B' => ['operasi', 'asmen_prod_b'],
        'SUB BIDANG PRODUKSI C' => ['operasi', 'asmen_prod_c'],
        'SUB BIDANG PRODUKSI D' => ['operasi', 'asmen_prod_d'],
        'SUB BIDANG KIMIA & LABORATORIUM' => ['operasi', 'asmen_kimia_lab'],
        'SUB BIDANG BAHAN BAKAR' => ['operasi', 'asmen_niaga_bb'],
        'SUB BIDANG COAL & ASH HANDLING A' => ['operasi', 'spv_chcb_a'],
        'SUB BIDANG COAL & ASH HANDLING B' => ['operasi', 'spv_chcb_b'],
        'SUB BIDANG COAL & ASH HANDLING C' => ['operasi', 'spv_chcb_c'],
        'SUB BIDANG COAL & ASH HANDLING D' => ['operasi', 'spv_chcb_d'],

        // ── Pemeliharaan ──────────────────────────────────────────
        'BIDANG PEMELIHARAAN' => ['pemeliharaan', null],
        'SUB BIDANG RENDAL PEMELIHARAAN' => ['pemeliharaan', 'asmen_rendal_har'],
        'SUB BIDANG OUTAGE MANAGEMENT' => ['pemeliharaan', 'asmen_mo'],
        'SUB BIDANG LISTRIK' => ['pemeliharaan', 'asmen_listrik'],
        'SUB BIDANG KONTROL & INSTRUMEN' => ['pemeliharaan', 'asmen_konin'],
        'SUB BIDANG MESIN 1 BOILER, TURBIN & AAB' => ['pemeliharaan', 'asmen_mesin_1'],
        'SUB BIDANG MESIN 2 SISTEM BAHAN BAKAR & ABU' => ['pemeliharaan', 'asmen_mesin_2'],
        'SUB BIDANG SARANA' => ['pemeliharaan', null],
        'SUB BIDANG LINGKUNGAN' => ['lingkungan', 'lingkungan'],
        'SUB BIDANG K3' => ['k3_kam', 'k3_kam'],
        'SUB BIDANG SUMBER DAYA MANUSIA' => ['business_support', 'asmen_sdm_umum_csr'],
        'SUB BIDANG KEUANGAN' => ['business_support', 'asmen_keuangan'],
        'SUB BIDANG UMUM & CSR' => ['business_support', 'asmen_sdm_umum_csr'],

        // ── Logistik ──────────────────────────────────────────────
        'BIDANG LOGISTIK' => ['business_support', null],
        'SUB BIDANG INVENTORI KONTROL & KATALOGER' => ['pemeliharaan', 'asmen_inventori'],
        'SUB BIDANG PENGADAAN' => ['business_support', 'asmen_pengadaan'],
        'SUB BIDANG ADMINISTRASI GUDANG' => ['pemeliharaan', 'asmen_inventori'],
    ];

    /**
     * Kode Bidang Utama legacy (`users.department`) untuk baris ini.
     *
     * Master Bidang adalah sumber tunggal unit kerja pada form Pengguna;
     * kolom `department_code` adalah jembatan ke filter data lama
     * (ScopedToUserDepartment / ScopesToDepartment). Baris sub-bidang
     * mewarisi kode bidang induknya bila tidak punya kode sendiri.
     */
    public function departmentCode(): ?string
    {
        if ($this->department_code !== null && $this->department_code !== '') {
            return $this->department_code;
        }

        return $this->parent?->departmentCode();
    }

    /**
     * Kode Sub-Bidang legacy (`users.sub_department`) untuk baris ini.
     * NULL berarti akun hanya terikat level bidang (tidak terkunci sub).
     */
    public function subDepartmentCode(): ?string
    {
        return $this->sub_department_code !== null && $this->sub_department_code !== ''
            ? $this->sub_department_code
            : null;
    }

    /** Apakah baris ini merepresentasikan Sub-Bidang (punya kode sub)? */
    public function isSubBidang(): bool
    {
        return $this->subDepartmentCode() !== null;
    }

    /** Apakah baris ini bisa dipakai sebagai unit kerja akun (punya bidang)? */
    public function hasLegacyScope(): bool
    {
        return $this->departmentCode() !== null;
    }

    /** Jabatan yang berada di bawah bidang ini. */
    public function jabatans(): HasMany
    {
        return $this->hasMany(Jabatan::class);
    }

    /** Link Kerja yang menargetkan bidang ini (tabel work_links). */
    public function workLinks(): HasMany
    {
        return $this->hasMany(WorkLink::class, 'bidang_id');
    }

    /**
     * Jumlah data karyawan (master HR) yang memakai bidang ini — baik
     * lewat relasi `bidang_id` maupun lewat kolom teks lama `bidang`
     * (data yang belum terpetakan). Pembacaan saja, tidak ada perubahan
     * pada tabel karyawans.
     */
    public function karyawanUsage(): int
    {
        return Karyawan::query()
            ->where('bidang_id', $this->id)
            ->orWhere('bidang', $this->nama)
            ->count();
    }

    /**
     * Jumlah akun pengguna (tabel users) yang terikat pada bidang ini
     * lewat `users.bidang_id` (integrasi form Tambah/Edit Pengguna).
     * Pembacaan saja — dipakai proteksi penghapusan di controller.
     */
    public function userUsage(): int
    {
        return User::query()->where('bidang_id', $this->id)->count();
    }
}
