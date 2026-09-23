<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Aturan validasi Hirarki Organisasi (level_jabatan, department,
     * sub_department) — dipakai oleh store().
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

    /**
     * Toggle status akun pengguna (Aktif ⇄ Nonaktif) — pengganti fitur
     * Edit Pengguna. Status dipetakan ke kolom email_verified_at:
     * mengaktifkan = verifikasi email; menonaktifkan = batalkan verifikasi.
     *
     * Menerima fetch AJAX (JSON) maupun submit form biasa (redirect).
     */
    public function toggleStatus(Request $request, User $user)
    {
        // Cegah admin menonaktifkan akunnya sendiri (mencegah terkunci sendiri).
        if ($user->id === $request->user()?->id) {
            $message = 'Anda tidak dapat menonaktifkan akun Anda sendiri.';

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }

            return redirect()->route('admin.users.index')->with('error', $message);
        }

        $newStatus = ! $user->email_verified_at;
        $user->update(['email_verified_at' => $newStatus ? now() : null]);

        ActivityLogger::log('update', null, [
            'module'      => 'pengguna',
            'description' => ($newStatus ? 'mengaktifkan' : 'menonaktifkan') . " akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        $message = 'Status pengguna berhasil diperbarui.';

        // AJAX (fetch): balas JSON agar UI menampilkan Toast Notification.
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'status'  => $newStatus ? 'Aktif' : 'Nonaktif',
            ]);
        }

        // Fallback form biasa: kembali ke Daftar Pengguna dengan flash message.
        return redirect()->route('admin.users.index')->with('success', $message);
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
