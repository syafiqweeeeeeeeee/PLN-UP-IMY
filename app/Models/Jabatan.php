<?php

namespace App\Models;

use App\Models\Concerns\Hierarchical;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Level jabatan yang BOLEH dipilih pada "Jabatan yang Ditemui"
     * (form registrasi tamu publik, modal Tambah/Edit Tamu admin, dan
     * portal karyawan). Nama jabatan master TIDAK diganti — hanya
     * level-nya yang dibatasi, sehingga nilai yang tersimpan tetap nama
     * lengkap (mis. "JUNIOR OFFICER KEUANGAN") dan filter "Orang yang
     * Ditemui" (employee_profiles.jabatan) tetap bekerja.
     *
     * @var array<string, string>
     */
    public const TAMU_LEVELS = [
        'asisten_manager' => 'Asisten Manajer',
        'junior'          => 'Junior',
        'staff'           => 'Staff',
    ];

    /**
     * Prefix nama jabatan per level. URUTAN PENTING: level pertama yang
     * cocok menang, jadi "JUNIOR TECHNICIAN ..." tetap Junior (bukan
     * Staff) walau berakhiran TECHNICIAN.
     *
     * "ASISTEN" & "ASSISTANT MANAGER" menangkap variasi penulisan
     * Asisten Manajer; "ASMAN" mengikuti konvensi User::levelJabatanFromJabatanName.
     *
     * @var array<string, array<int, string>>
     */
    private const TAMU_LEVEL_PREFIXES = [
        'asisten_manager' => ['ASMAN', 'ASISTEN', 'ASSISTANT MANAGER'],
        'junior'          => ['JUNIOR'],
        'staff'           => ['OFFICER', 'TECHNICIAN', 'STAFF', 'STAF'],
    ];

    /**
     * Level (asisten_manager|junior|staff) dari sebuah nama jabatan, atau
     * null bila jabatan itu DI LUAR level yang boleh dipilih tamu
     * (mis. "MANAGER OPERASI", "SENIOR MANAGER ...").
     */
    public static function tamuLevel(?string $nama): ?string
    {
        $nama = strtoupper(trim((string) $nama));

        if ($nama === '') {
            return null;
        }

        foreach (self::TAMU_LEVEL_PREFIXES as $level => $prefixes) {
            foreach ($prefixes as $prefix) {
                if (str_starts_with($nama, $prefix)) {
                    return $level;
                }
            }
        }

        return null;
    }

    /**
     * Scope: hanya jabatan pada 3 level yang boleh dipilih tamu
     * (Asisten Manajer, Junior, Staff). Satu sumber aturan untuk
     * partial _jabatan-options (dropdown tampilan), proxy <select> pada
     * form publik, dan validasi TamuController::store.
     */
    public function scopeForTamu(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            foreach (self::TAMU_LEVEL_PREFIXES as $prefixes) {
                foreach ($prefixes as $prefix) {
                    $q->orWhere('nama', 'like', $prefix . '%');
                }
            }
        });
    }

    /** Bidang tempat jabatan ini berada (wajib). */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    /**
     * Data karyawan (master HR) yang memegang jabatan ini.
     *
     * Sumber level 3 dependent dropdown registrasi tamu: setelah tamu
     * memilih Bidang lalu Jabatan, daftar "Orang yang Ditemui" diambil
     * dari relasi ini (karyawans.jabatan_id).
     */
    public function karyawans(): HasMany
    {
        return $this->hasMany(Karyawan::class, 'jabatan_id');
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
