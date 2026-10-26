<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * REGISTRASI TAMU (halaman publik form-registrasi-tamu) — endpoint AJAX.
 *
 * Satu-satunya tanggung jawab saat ini: menyuplai daftar "Orang yang
 * Ditemui" yang sudah DIFILTER oleh pasangan "Bidang yang Ditemui" +
 * "Jabatan yang Ditemui" lewat GET /api/get-pegawai (lihat
 * routes/web.php). Tanpa auth — halaman registrasi bersifat publik,
 * sehingga response hanya memuat data ringan (id & nama) yang memang
 * ditampilkan pada form.
 */
class GuestRegistrationController extends Controller
{
    /**
     * Role yang dianggap "karyawan/staff" — aktor NON-admin yang boleh
     * muncul sebagai orang yang ditemui. Mencakup kolom legacy
     * `users.role` maupun baris pivot role_user (relasi `roles`).
     *
     * @var array<int, string>
     */
    private const PEGAWAI_ROLES = [
        'Karyawan',
        'karyawan',
        'Staff',
        'staff',
        'Staf',
        'staf',
    ];

    /**
     * Daftar pegawai sesuai bidang & jabatan — GET /api/get-pegawai.
     *
     * Query: model User dengan filter role bertipe karyawan/staff, lalu
     * mencocokkan RELASI DETAIL KEPEGAWAIAN (employee_profiles.bidang &
     * employee_profiles.jabatan) dengan nilai kedua dropdown. Bila akun
     * tidak punya profil kepegawaian, fallback dicocokkan ke referensi
     * master pada akunnya (users.bidang_id + users.jabatan_id) agar
     * akun yang mengikat unit kerjanya lewat form Pengguna tetap muncul.
     *
     * Response: JSON array ringan [{id, name, bidang, jabatan}, ...]
     * urut nama — dikonsumsi skrip dependent dropdown pada view
     * form-registrasi-tamu.blade.php.
     */
    public function getPegawai(Request $request): JsonResponse
    {
        $data = $request->validate([
            'bidang'  => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:100'],
        ]);

        $bidang = trim($data['bidang']);
        $jabatan = trim($data['jabatan']);

        $pegawai = User::query()
            // 1) Role bertipe karyawan/staff (kolom legacy & pivot role_user).
            ->where(function ($query) {
                $query->whereIn('role', self::PEGAWAI_ROLES)
                    ->orWhereHas('roles', fn ($roles) => $roles->whereIn('roles.name', self::PEGAWAI_ROLES));
            })
            // 2) Pencocokan bidang + jabatan.
            ->where(function ($query) use ($bidang, $jabatan) {
                // Jalur utama: relasi detail kepegawaian (1:1 ke users).
                $query->whereHas('employeeProfile', function ($profile) use ($bidang, $jabatan) {
                    $profile->where('bidang', $bidang)
                        ->where('jabatan', $jabatan);
                })
                    // Fallback: akun tanpa profil kepegawaian — cocokkan
                    // referensi master bidang & jabatan milik akun.
                    ->orWhere(function ($query) use ($bidang, $jabatan) {
                        $query->whereDoesntHave('employeeProfile')
                            ->whereHas('bidangRef', fn ($b) => $b->where('nama', $bidang))
                            ->whereHas('jabatanRef', fn ($j) => $j->where('nama', $jabatan));
                    });
            })
            ->orderBy('name')
            ->get()
            ->map(fn (User $user) => [
                'id'     => $user->id,
                'name'   => $user->name,
                'bidang'  => $bidang,
                'jabatan' => $jabatan,
            ])
            ->values();

        return response()->json($pegawai);
    }
}
