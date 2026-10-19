<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * EMPLOYEE PROFILE — data kepegawaian milik AKUN PENGGUNA (1:1 ke
 * `users`). Menampilkan 24 kolom spesifikasi Excel (sama dengan
 * `karyawans`) pada halaman Detail Pengguna; diisi/mutakhirkan lewat
 * tombol "Edit Detail / Lengkapi Data".
 *
 * Relasi penanda `karyawan()` (soft-link) diisi otomatis ketika NID
 * yang disimpan cocok dengan baris master `karyawans` hasil impor
 * Excel — master datanya tetap dikelola modul Data Karyawan.
 */
class EmployeeProfile extends Model
{
    protected $table = 'employee_profiles';

    protected $fillable = [
        'user_id',
        'karyawan_id',

        // Identitas
        'nid', 'nama',

        // Organisasi & Jabatan
        'unit', 'bidang', 'jabatan', 'jenjang_jabatan', 'grade',
        'organik', 'institusi', 'fte', 'mims',

        // Tanggal Penting
        'service_date', 'hire_date', 'retire_date', 'grade_date',
        'tgl_jab', 'tanggal_lahir',

        // Kontak & Komunikasi
        'telp', 'hp', 'email',

        // Data Pribadi
        'tempat_lahir', 'agama', 'gender', 'status_kawin',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'karyawan_id' => 'integer',
        'service_date' => 'date',
        'hire_date' => 'date',
        'retire_date' => 'date',
        'grade_date' => 'date',
        'tgl_jab' => 'date',
        'tanggal_lahir' => 'date',
        'fte' => 'float',
    ];

    /** Kolom tampilan mengikuti spesifikasi master (Karyawan). */
    public const COLUMNS_LABELS = Karyawan::COLUMNS_LABELS;

    /**
     * Master referensi AGAMA — dipakai dropdown pada modal Edit Detail
     * Kepegawaian. Nilai tersimpan yang di luar daftar tetap ditampilkan
     * sebagai option tambahan (injeksi) agar tidak tertukar data.
     */
    public const AGAMAS = [
        'Islam',
        'Kristen Protestan',
        'Kristen Katolik',
        'Hindu',
        'Buddha',
        'Khonghucu',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Soft-link ke master data HR (karyawans) — bisa null. */
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }

    /* =========================================================
       HELPER TAMPILAN — pola sama dengan model Karyawan
       ========================================================= */

    public function genderLabel(): ?string
    {
        return Karyawan::GENDERS[$this->gender] ?? $this->gender;
    }

    public function statusKawinLabel(): ?string
    {
        return Karyawan::STATUSES_KAWIN[$this->status_kawin] ?? $this->status_kawin;
    }

    /** Format tanggal yang mudah dibaca (14 Mar 1985); null-safe. */
    public function formatTanggal(?string $column): ?string
    {
        return $this->getAttribute($column)?->translatedFormat('d M Y');
    }
}
