<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpPasswordMail;
use App\Services\ActivityLogger;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Aturan validasi Hirarki Organisasi (level_jabatan, department,
     * sub_department) — dipakai bersama oleh store() dan update().
     *
     * Logika interaksi (disetujui client via JS, diverifikasi ulang server):
     * - Administrator / Senior Manager → akses global: department &
     *   sub_department disembunyikan (field disabled), nilai lama dihapus.
     * - Manager Bidang → department wajib, sub_department disembunyikan.
     * - Supervisor / Asisten Manager / Staf → department & sub_department wajib.
     *
     * @return array{0: array<string, string>, 1: array<string, string>} [rules, attributes]
     */
    private static function orgHierarchyRules(string $levelJabatan): array
    {
        $levels      = implode(',', array_keys(User::LEVEL_JABATAN));
        $departments = array_keys(User::DEPARTMENTS);
        $subCodes    = array_merge(...array_map('array_keys', array_values(User::SUB_DEPARTMENTS)));
        $inSubs      = 'in:' . implode(',', array_merge($subCodes, ['']));

        $rules = [
            'level_jabatan' => 'required|in:' . $levels,
            'department'    => 'nullable|in:' . implode(',', $departments),
            'sub_department' => $inSubs,
        ];

        if (User::isGlobalLevel($levelJabatan)) {
            // Global: department & sub tidak relevan — paksa null di store/update.
            $rules['department']     = 'nullable';
            $rules['sub_department'] = 'nullable';
        } elseif ($levelJabatan === 'manager_bidang') {
            $rules['department'] = 'required|in:' . implode(',', $departments);
        } elseif ($levelJabatan === 'staf_spv') {
            $rules['department']     = 'required|in:' . implode(',', $departments);
            $rules['sub_department'] = 'required|in:' . implode(',', $subCodes);
        }

        return [
            $rules,
            [
                'level_jabatan' => 'Level Jabatan',
                'department' => 'Bidang Utama',
                'sub_department' => 'Sub-Bidang / Bagian',
            ],
        ];
    }

    /**
     * Rapikan nilai hierarki sebelum disimpan: level global →
     * department & sub_department dikosongkan; selain Staf/Asmen/Spv
     * → sub_department dikosongkan.
     */
    private static function normalizeOrgHierarchy(array &$data, string $levelJabatan): void
    {
        if (User::isGlobalLevel($levelJabatan)) {
            $data['department']     = null;
            $data['sub_department'] = null;
        } elseif (! User::subDepartmentRequired($levelJabatan)) {
            $data['sub_department'] = null;
        }
    }

    public function create()
    {
        $roles = Role::where('status', true)->orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        [$orgRules, $orgAttributes] = self::orgHierarchyRules($request->input('level_jabatan', ''));

        $validated = $request->validate(array_merge([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ], $orgRules), $orgAttributes);

        self::normalizeOrgHierarchy($validated, $validated['level_jabatan']);

        $role = Role::findOrFail($validated['role_id']);

        if (! $role->status) {
            return back()->withErrors(['role_id' => 'Role yang dipilih sedang dinonaktifkan.'])->withInput();
        }

        $validated['password'] = bcrypt($validated['password']);
        unset($validated['role_id']);

        $user = User::create(array_merge($validated, [
            'role_id' => $role->id,
            'role' => $role->name,
        ]));

        // Sinkronkan pivot role_user agar sistem permission (@can, middleware
        // permission:) mengenali role user ini, bukan hanya kolom users.role_id.
        $user->roles()->sync([$role->id]);

        ActivityLogger::log('create', null, [
            'module'      => 'pengguna',
            'description' => "menambahkan akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        // Selalu kembali ke Daftar Pengguna dengan notifikasi sukses.
        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        $user->load('role');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('role');
        $roles = Role::where('status', true)->orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Kirim kode OTP ke email user yang sedang diedit untuk verifikasi perubahan password.
     */
    public function sendOtp(Request $request, User $user): JsonResponse
    {
        $otpCode = (string) rand(100000, 999999);

        // Simpan OTP ke cache 5 menit (300 detik) dengan key unik per user.
        Cache::put("otp_password_change_{$user->id}", $otpCode, now()->addMinutes(5));

        Mail::to($user->email)->send(new SendOtpPasswordMail($otpCode, $user->name));

        return response()->json([
            'success' => true,
            'message' => "Kode OTP telah dikirim ke {$user->email}.",
            'email'   => $user->email,
        ]);
    }

    /**
     * Verifikasi OTP instan (auto-validate) saat 6 digit selesai diketik.
     * Tidak menghapus OTP dari cache — verifikasi final tetap dilakukan saat update.
     */
    public function verifyOtp(Request $request, User $user): JsonResponse
    {
        $request->validate(['otp_code' => 'required|string|digits:6']);

        $cachedOtp = Cache::get("otp_password_change_{$user->id}");

        $isValid = $cachedOtp && hash_equals($cachedOtp, (string) $request->input('otp_code'));

        return response()->json([
            'success' => $isValid,
            'message' => $isValid ? 'Kode OTP Valid' : 'Kode OTP salah atau telah kadaluwarsa',
        ]);
    }

    public function update(Request $request, User $user)
    {
        // Jika password baru diisi, OTP wajib ada di request (ditandai input hidden
        // oleh frontend setelah OTP terkirim) dan harus cocok dengan yang di cache.
        $otpRequired = $request->filled('password');

        [$orgRules, $orgAttributes] = self::orgHierarchyRules($request->input('level_jabatan', ''));

        $validated = $request->validate(array_merge([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'otp_code' => $otpRequired ? 'required|string|digits:6' : 'nullable',
        ], $orgRules), $orgAttributes);

        $role = Role::findOrFail($validated['role_id']);

        if (! $role->status) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Role yang dipilih sedang dinonaktifkan.'], 422);
            }
            return back()->withErrors(['role_id' => 'Role yang dipilih sedang dinonaktifkan.'])->withInput();
        }

        unset($validated['role_id']);

        self::normalizeOrgHierarchy($validated, $validated['level_jabatan']);

        if (!empty($validated['password'])) {
            $cacheKey = "otp_password_change_{$user->id}";
            $cachedOtp = Cache::get($cacheKey);

            // OTP wajib cocok — jika salah/kedaluwarsa, gagalkan penyimpanan.
            if (! $cachedOtp || ! hash_equals($cachedOtp, (string) $request->input('otp_code'))) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Kode OTP tidak valid atau sudah kadaluwarsa.'], 422);
                }
                return back()
                    ->withErrors(['otp_code' => 'Kode OTP tidak valid atau sudah kadaluwarsa.'])
                    ->withInput();
            }

            $validated['password'] = Hash::make($validated['password']);

            // OTP hanya berlaku sekali — hapus setelah berhasil diverifikasi.
            Cache::forget($cacheKey);
        } else {
            // Password kosong: abaikan OTP, perbarui data profil saja.
            unset($validated['password']);
        }

        $user->update(array_merge($validated, [
            'role_id' => $role->id,
            'role' => $role->name,
        ]));

        // Sinkronkan pivot role_user saat role diganti.
        $user->roles()->sync([$role->id]);

        // Pesan dinamis sesuai field yang benar-benar berubah.
        $passwordChanged = array_key_exists('password', $validated);   // hanya true jika password baru disimpan
        $profileFields   = ['name', 'email', 'role_id', 'level_jabatan', 'department', 'sub_department', 'no_hp', 'alamat'];
        $profileChanged  = collect($profileFields)
            ->contains(fn ($f) => $user->wasChanged($f));

        $message = match ([$passwordChanged, $profileChanged]) {
            [true, true]   => 'Data profil dan kata sandi pengguna berhasil diperbarui!',
            [true, false]  => 'Kata sandi pengguna berhasil diperbarui!',
            [false, true]  => 'Informasi profil pengguna berhasil diperbarui!',
            default        => 'Tidak ada perubahan data pengguna.',
        };

        // Request AJAX (fetch + SweetAlert2): balas JSON berisi pesan dinamis + URL redirect.
        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => $message,
                'redirect' => route('admin.users.show', $user),
            ]);
        }

        // Fallback non-AJAX: redirect biasa ke Detail Pengguna.
        return redirect()->route('admin.users.show', $user)
            ->with('success', $message);
    }

    public function destroy(User $user)
    {
        ActivityLogger::log('delete', null, [
            'module'      => 'pengguna',
            'description' => "menghapus akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
