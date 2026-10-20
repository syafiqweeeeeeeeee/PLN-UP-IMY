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
    ];

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
}
