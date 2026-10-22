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
