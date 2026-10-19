<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * DATA KEPEGAWAIAN AKUN PENGGUNA (tabel employee_profiles).
 *
 * Menyimpan/mutakhirkan data kepegawaian 24 kolom spesifikasi (sama
 * dengan master `karyawans`) milik satu akun pengguna — ditampilkan
 * pada Detail Pengguna dan diisi via tombol "Edit Detail / Lengkapi
 * Data". Otorisasi mengikuti kebijakan Edit Pengguna:
 * gate `users.edit:self` (Super Admin = semua akun; lainnya = milik
 * sendiri), sehingga tidak ada permission baru yang perlu diassign.
 *
 * Master data HR (karyawans) TIDAK pernah diubah dari sini. Saat data
 * disimpan, NID dicocokkan ke master: bila ada baris `karyawans` dengan
 * NID tersebut, profil ter-soft-link (karyawan_id) sehingga perubahan
 * master Excel bisa dilacak per akun.
 */
class EmployeeProfileController extends Controller
{
    /**
     * Simpan (upsert) data kepegawaian akun pengguna. Menerima submit
     * form biasa dari modal Edit Detail pada halaman Detail Pengguna.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('users.edit:self', $user);

        $validated = $this->validated($request);

        // NAMA kosong → sementara fallback ke nama akun, agar kartu
        // data kepegawaian tidak pernah tanpa nama.
        if (empty($validated['nama'])) {
            $validated['nama'] = $user->name;
        }

        // Soft-link master karyawans: NID yang cocok → karyawan_id
        // diisi (kota/kode master TIDAK diubah sama sekali).
        $validated['karyawan_id'] = ! empty($validated['nid'])
            ? Karyawan::where('nid', $validated['nid'])->value('id')
            : null;

        $wasCreated = $user->employeeProfile()->doesntExist();

        $profile = $user->employeeProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        ActivityLogger::log($wasCreated ? 'create' : 'update', null, [
            'module' => 'pengguna',
            'description' => ($wasCreated
                ? 'melengkapi data kepegawaian '
                : 'memperbarui data kepegawaian ')
                . "akun \"{$user->name}\" ({$user->email})",
            'subject' => $profile,
        ]);

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'Data kepegawaian berhasil disimpan.');
    }

    /**
     * Pencarian master karyawans berdasarkan NID (prefill form modal
     * "Muat dari NID"). Dijaga permission karyawan_data.view karena
     * mengembalikan data master HR yang mentah.
     */
    public function karyawanLookup(Request $request)
    {
        Gate::authorize('karyawan_data.view');

        $validated = $request->validate([
            'nid' => ['required', 'string', 'max:30'],
        ]);

        $karyawan = Karyawan::where('nid', $validated['nid'])->first();

        if ($karyawan === null) {
            return response()->json([
                'success' => false,
                'message' => 'NID "' . $validated['nid'] . '" tidak ditemukan pada master Data Karyawan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'nid' => $karyawan->nid,
                'nama' => $karyawan->nama,
                'unit' => $karyawan->unit,
                'bidang' => $karyawan->bidang,
                'jabatan' => $karyawan->jabatan,
                'jenjang_jabatan' => $karyawan->jenjang_jabatan,
                'grade' => $karyawan->grade,
                'organik' => $karyawan->organik,
                'institusi' => $karyawan->institusi,
                'fte' => $karyawan->fte !== null ? number_format($karyawan->fte, 2, '.', '') : null,
                'mims' => $karyawan->mims,
                'service_date' => $karyawan->service_date?->format('Y-m-d'),
                'hire_date' => $karyawan->hire_date?->format('Y-m-d'),
                'retire_date' => $karyawan->retire_date?->format('Y-m-d'),
                'grade_date' => $karyawan->grade_date?->format('Y-m-d'),
                'tgl_jab' => $karyawan->tgl_jab?->format('Y-m-d'),
                'tanggal_lahir' => $karyawan->tanggal_lahir?->format('Y-m-d'),
                'telp' => $karyawan->telp,
                'hp' => $karyawan->hp,
                'email' => $karyawan->email,
                'tempat_lahir' => $karyawan->tempat_lahir,
                'agama' => $karyawan->agama,
                'gender' => $karyawan->gender,
                'status_kawin' => $karyawan->status_kawin,
            ],
        ]);
    }

    /**
     * Rules validasi — tipe & lebar mengikuti kolom tabel karyawans;
     * semuanya nullable agar data kepegawaian boleh diisi bertahap.
     */
    private static function rules(): array
    {
        $dates = collect(Karyawan::DATE_COLUMNS)
            ->mapWithKeys(fn ($column) => [$column => ['nullable', 'date']])
            ->all();

        return array_merge([
            'nid' => ['nullable', 'string', 'max:30'],
            'nama' => ['nullable', 'string', 'max:150'],

            'unit' => ['nullable', 'string', 'max:100'],
            'bidang' => ['nullable', 'string', 'max:100'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'jenjang_jabatan' => ['nullable', 'string', 'max:50'],
            'grade' => ['nullable', 'string', 'max:30'],
            'organik' => ['nullable', 'string', 'max:100'],
            'institusi' => ['nullable', 'string', 'max:100'],
            'fte' => ['nullable', 'numeric', 'min:0', 'max:99'],
            'mims' => ['nullable', 'string', 'max:50'],

            'telp' => ['nullable', 'string', 'max:50'],
            'hp' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],

            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'agama' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', 'in:' . implode(',', array_keys(Karyawan::GENDERS))],
            'status_kawin' => ['nullable', 'in:' . implode(',', array_keys(Karyawan::STATUSES_KAWIN))],
        ], $dates);
    }

    /** Label pesan validasi — persis label spesifikasi Excel. */
    private static function attributes(): array
    {
        return Karyawan::COLUMNS_LABELS;
    }

    private function validated(Request $request): array
    {
        return $request->validate(static::rules(), [], static::attributes());
    }
}
