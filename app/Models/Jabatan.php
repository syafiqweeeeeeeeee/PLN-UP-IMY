<?php

namespace App\Models;

use App\Models\Concerns\Hierarchical;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * MASTER JABATAN — satu baris per nama jabatan, terikat satu bidang
 * (bidang_id → bidangs.id) dan boleh berhirarki
 * (parent_id → jabatans.id, NULL untuk jabatan tingkat teratas).
 *
 * Terpisah dari kolom string `karyawans.jabatan` — kolom itu hanya
 * DIBACA untuk proteksi penghapusan (jabatan yang masih dipakai data
 * karyawan tidak boleh dihapus), tanpa mengubah data karyawan.
 */
class Jabatan extends Model
{
    use Hierarchical;

    protected $fillable = [
        'nama',
        'bidang_id',
        'parent_id',
    ];

    /** Bidang tempat jabatan ini berada (wajib). */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    /**
     * Jumlah data karyawan (master HR) yang memakai jabatan ini — baik
     * lewat relasi `jabatan_id` maupun lewat kolom teks lama `jabatan`
     * (data yang belum terpetakan). Pembacaan saja, tidak ada perubahan
     * pada tabel karyawans.
     */
    public function karyawanUsage(): int
    {
        return Karyawan::query()
            ->where('jabatan_id', $this->id)
            ->orWhere('jabatan', $this->nama)
            ->count();
    }

    /**
     * Jumlah akun pengguna (tabel users) yang terikat pada jabatan ini
     * lewat `users.jabatan_id` (integrasi form Tambah/Edit Pengguna).
     * Pembacaan saja — dipakai proteksi penghapusan di controller.
     */
    public function userUsage(): int
    {
        return User::query()->where('jabatan_id', $this->id)->count();
    }
}
