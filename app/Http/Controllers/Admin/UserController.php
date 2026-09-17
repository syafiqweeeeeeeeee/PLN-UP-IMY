<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpPasswordMail;
use App\Models\ActivityLog;
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

    public function create()
    {
        $roles = Role::where('status', true)->orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);

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

        ActivityLog::record('pengguna', 'create', "menambahkan akun pengguna \"{$user->name}\" ({$user->email})", $user);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
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

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'otp_code' => $otpRequired ? 'required|string|digits:6' : 'nullable',
        ]);

        $role = Role::findOrFail($validated['role_id']);

        if (! $role->status) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Role yang dipilih sedang dinonaktifkan.'], 422);
            }
            return back()->withErrors(['role_id' => 'Role yang dipilih sedang dinonaktifkan.'])->withInput();
        }

        unset($validated['role_id']);

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
        $profileFields   = ['name', 'email', 'role_id', 'no_hp', 'alamat'];
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
        ActivityLog::record('pengguna', 'delete', "menghapus akun pengguna \"{$user->name}\" ({$user->email})", $user);

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
