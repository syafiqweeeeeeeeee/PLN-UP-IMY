<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * REGISTRASI TAMU (halaman publik form-registrasi-tamu) — endpoint AJAX
 * untuk DEPENDENT DROPDOWN berjenjang:
 *
 *   1. Bidang yang Ditemui  (bidangs)          → bidang_id
 *   2. Jabatan yang Ditemui (jabatans)         → jabatan_id
 *   3. Orang yang Ditemui   (karyawans)        → karyawan_id
 *
 * Alur nilai mengikuti kunci primer (BUKAN nama) sehingga relasi
 * Eloquent yang dipakai benar-benar:
 *
 *   Bidang::jabatans()  (jabatans.bidang_id)
 *   Bidang::karyawans() (karyawans.bidang_id)
 *   Jabatan::karyawans() (karyawans.jabatan_id)
 *   Karyawan::jabatanMaster() / Karyawan::bidangMaster()
 *
 * Semua route bersifat PUBLIK (tanpa auth) karena form registrasi tamu
 * dapat diakses pengunjung. Response sengaja ringan — hanya data yang
 * memang ditampilkan pada dropdown (tanpa email/HP/NIK lengkap).
 *
 * Catatan kompatibilitas: getPegawai() (endpoint lama berbasis nama
 * bidang + jabatan pada tabel users/employee_profiles) DIPERTAHANKAN
 * agar tautan/klien lama tidak rusak. Form registrasi sekarang memakai
 * endpoint ID di atas.
 */
class GuestRegistrationController extends Controller
{
    /**
     * Endpoint 1 — GET /api/get-jabatan?bidang_id=...
     *
     * Jabatan milik satu bidang (jabatans.bidang_id = bidang_id), DIBATASI
     * 3 level yang boleh ditemui tamu (Jabatan::TAMU_LEVELS: Asisten
     * Manajer, Junior, Staff) lewat scope forTamu(). Dipakai dropdown
     * "Jabatan yang Ditemui" setiap kali bidang berubah.
     *
     * Response: [{id, nama, level}, ...] urut nama.
     */
    public function getJabatanByBidang(Request $request): JsonResponse
    {
        $data = $request->validate([
            'bidang_id' => ['required', 'integer', 'exists:bidangs,id'],
        ]);

        $jabatans = Jabatan::query()
            ->where('bidang_id', (int) $data['bidang_id'])
            ->forTamu()
            ->orderBy('nama')
            ->get(['id', 'nama'])
            ->map(fn (Jabatan $jabatan) => [
                'id'    => (int) $jabatan->id,
                'nama'  => (string) $jabatan->nama,
                'level' => Jabatan::tamuLevel($jabatan->nama),
            ])
            ->values();

        return response()->json($jabatans);
    }

    /**
     * Endpoint 2 — GET /api/get-karyawan?jabatan_id=...
     *
     * Orang yang menduduki satu jabatan (karyawans.jabatan_id = jabatan_id).
     * Filter ketat:
     * - hanya jabatan pada 3 level tamu (jabatan_id harus forTamu(); bila
     *   bukan, response kosong — bukan daftar seluruh karyawan),
     * - hanya karyawan AKTIF (karyawans.status = aktif; lihat scope
     *   withStatus — status kosong/NULL pada data lama dianggap aktif).
     *
     * Jalur cadangan: baris karyawan lama yang belum punya `jabatan_id`
     * (kolom teks `jabatan` masih terisi) tetap ditampilkan bila teksnya
     * SAMA PERSIS dengan nama jabatan master — sama seperti pola filter
     * master pada Data Karyawan, jadi data lama tidak hilang dari form.
     *
     * Response: [{id, nama, nid, jabatan_id, jabatan, level, user_id}, ...].
     * `user_id` = akun login yang tertaut lewat employee_profiles (nullable);
     * dipakai form untuk mengisi hidden `orang_ditemui_id` (tautan portal).
     */
    public function getKaryawanByJabatan(Request $request): JsonResponse
    {
        $data = $request->validate([
            'jabatan_id' => ['required', 'integer', 'exists:jabatans,id'],
        ]);

        // Level di luar Asisten Manajer/Junior/Staff → TIDAK ada pilihan.
        $jabatan = Jabatan::query()
            ->forTamu()
            ->find((int) $data['jabatan_id']);

        if ($jabatan === null) {
            return response()->json([]);
        }

        $karyawans = Karyawan::query()
            ->withStatus(null) // default scope: hanya karyawan aktif
            ->where(function (Builder $query) use ($jabatan) {
                $query->where('jabatan_id', $jabatan->id)
                    ->orWhere(fn (Builder $legacy) => $legacy
                        ->whereNull('jabatan_id')
                        ->where('jabatan', $jabatan->nama));
            })
            ->with(['employeeProfile:id,user_id,karyawan_id'])
            ->orderBy('nama')
            ->get(['id', 'nama', 'nid', 'jabatan_id', 'jabatan'])
            ->map(fn (Karyawan $karyawan) => [
                'id'         => (int) $karyawan->id,
                'nama'       => (string) $karyawan->nama,
                'nid'        => (string) $karyawan->nid,
                'jabatan_id' => (int) $jabatan->id,
                'jabatan'    => (string) $jabatan->nama,
                'level'      => Jabatan::tamuLevel($jabatan->nama),
                'user_id'    => $karyawan->employeeProfile?->user_id,
            ])
            ->values();

        return response()->json($karyawans);
    }

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
     * LEGACY — GET /api/get-pegawai?bidang=...&jabatan=...
     *
     * Endpoint lama (berbasis NAMA bidang & jabatan pada akun pengguna).
     * Dipertahankan untuk kompatibilitas; alur baru registrasi tamu
     * memakai getJabatanByBidang() + getKaryawanByJabatan().
     *
     * Query: model User dengan filter role bertipe karyawan/staff, lalu
     * mencocokkan RELASI DETAIL KEPEGAWAIAN (employee_profiles.bidang &
     * employee_profiles.jabatan) dengan nilai kedua dropdown. Bila akun
     * tidak punya profil kepegawaian, fallback dicocokkan ke referensi
     * master pada akunnya (users.bidang_id + users.jabatan_id) agar
     * akun yang mengikat unit kerjanya lewat form Pengguna tetap muncul.
     *
     * Response: JSON array ringan [{id, name, bidang, jabatan}, ...]
     * urut nama.
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
