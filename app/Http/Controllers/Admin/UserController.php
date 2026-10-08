<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\MasterMenu;
use App\Models\Role;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('users.view');

        $users = User::with('role')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Aturan validasi Hirarki Organisasi (level_jabatan, department,
     * sub_department) — dipakai oleh store() & update(). Digerakkan
     * oleh ROLE yang dipilih (conditional fields):
     *
     * - Super Admin → seluruh field hirarki disembunyikan: level_jabatan,
     *   department & sub_department dipaksa null (nilai tersembunyi
     *   dari form diabaikan).
     * - Admin Bidang → Level Jabatan disembunyikan; Bidang Utama &
     *   Sub-Bidang / Bagian tampil & wajib (dependent dropdown) — unit
     *   kerja = bidang + sub-bidang (data scoping terkunci sub).
     * - Karyawan → ketiga field selalu tampil; Level Jabatan HANYA 4
     *   tingkat (Senior Manager, Manager Bidang, Asisten Manager, Staff).
     *   Kewajiban department/sub_department mengikuti tingkat akses level:
     *   * Senior Manager → akses global view-only semua bidang: Bidang
     *     Utama & Sub-Bidang DISEMBUNYIKAN total dari form → keduanya
     *     dipaksa null (ALL) otomatis di backend tanpa dipilih manual.
     *   * Manager Bidang → department wajib; Sub-Bidang disembunyikan
     *     (membawahi seluruh sub-bidang bidangnya) → nilai dikirim pun
     *     diabaikan (dipaksa null di normalizeOrgHierarchy()).
     *   * Asisten Manager / Staff → department & sub_department wajib
     *     (akses portal terkunci di sub-bidangnya).
     *
     * @return array{0: array<string, string>, 1: array<string, string>} [rules, attributes]
     */
    private static function orgHierarchyRules(string $roleName, string $levelJabatan): array
    {
        $levels      = implode(',', array_keys(User::LEVEL_JABATAN));
        $departments = array_keys(User::DEPARTMENTS);
        $subCodes    = array_merge(...array_map('array_keys', array_values(User::SUB_DEPARTMENTS)));

        $rules = [
            'level_jabatan'  => 'nullable|in:' . $levels,
            'department'     => 'nullable|in:' . implode(',', $departments),
            'sub_department' => 'nullable|in:' . implode(',', array_merge($subCodes, [''])),
        ];

        if ($roleName === User::SUPER_ADMIN_ROLE) {
            // Super Admin: hirarki tidak relevan → field disembunyikan,
            // nilai apa pun yang dikirim (mis. via API) diabaikan.
            $rules['level_jabatan']  = 'nullable';
            $rules['department']     = 'nullable';
            $rules['sub_department'] = 'nullable';
        } elseif ($roleName === User::DEPARTMENT_ADMIN_ROLE) {
            // Admin Bidang: Level disembunyikan; Bidang Utama & Sub-Bidang
            // wajib dipilih (pemetaan per unit kerja spesifik).
            $rules['level_jabatan']  = 'nullable';
            $rules['department']     = 'required|in:' . implode(',', $departments);
            $rules['sub_department'] = 'required|in:' . implode(',', $subCodes);
        } elseif ($roleName === 'Karyawan') {
            // Karyawan: Level Jabatan (4 tingkat) wajib; kewajiban bidang
            // & sub mengikuti tingkat akses level terpilih.
            $rules['level_jabatan'] = 'required|in:' . $levels;

            if (! User::isGlobalLevel($levelJabatan)) {
                $rules['department'] = 'required|in:' . implode(',', $departments);
            }

            if (User::subDepartmentRequired($levelJabatan)) {
                $rules['sub_department'] = 'required|in:' . implode(',', $subCodes);
            }
        } else {
            // Role tidak dikenal / tidak assignable — field tidak divalidasi
            // (plain nullable) agar penolakan terjadi pada validasi role_id
            // dengan pesan "Role yang dipilih tidak valid.".
            $rules['level_jabatan']  = 'nullable';
            $rules['department']     = 'nullable';
            $rules['sub_department'] = 'nullable';
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
     * Rapikan nilai hierarki sebelum disimpan, sesuai ROLE terpilih:
     * Super Admin → seluruh hirarki dikosongkan; Admin Bidang → Level
     * Jabatan dikosongkan (field disembunyikan). Karyawan level Senior
     * Manager → bidang & sub dikosongkan (akses global); level Manager
     * Bidang → Sub-Bidang dikosongkan (membawahi seluruh sub-bidang).
     * Ketiga key dijamin selalu ada (field opsional boleh absen).
     */
    private static function normalizeOrgHierarchy(array &$data, string $roleName): void
    {
        if ($roleName === User::SUPER_ADMIN_ROLE) {
            $data['level_jabatan']  = null;
            $data['department']     = null;
            $data['sub_department'] = null;
        } elseif ($roleName === User::DEPARTMENT_ADMIN_ROLE) {
            $data['level_jabatan'] = null;
        } elseif ($roleName === 'Karyawan') {
            // Senior Manager: Bidang Utama & Sub-Bidang disembunyikan total
            // → keduanya dipaksa null (ALL / akses global view-only) walau
            // nilai dikirim via API.
            if (($data['level_jabatan'] ?? null) === 'senior_manager') {
                $data['department']     = null;
                $data['sub_department'] = null;
            }

            // Manager Bidang membawahi seluruh sub-bidang → field
            // Sub-Bidang disembunyikan; nilai terkirim (mis. via API)
            // diabaikan.
            if (($data['level_jabatan'] ?? null) === 'manager_bidang') {
                $data['sub_department'] = null;
            }
        }

        $data['level_jabatan']  = $data['level_jabatan'] ?? null;
        $data['department']     = $data['department'] ?? null;
        $data['sub_department'] = $data['sub_department'] ?? null;
    }

    /**
     * Validasi & sinkronisasi DIRECT PERMISSION (matriks ID Menu × CRUD)
     * ke tabel user_has_permissions. Checkbox di luar matriks diabaikan.
     */
    private function syncDirectPermissions(User $user, Request $request, string $roleName): void
    {
        // Cakupan direct permission:
        // - Admin Bidang → delegasi hak akses per bidang.
        // - KARYAWAN     → akses fitur per ORANG (mis. "Karyawan SDM"
        //                  diberi news.create, "Karyawan Sekuriti"
        //                  diberi tamu.view — role tetap "Karyawan").
        // Role lain (Super Admin / legacy) → bersihkan, tidak ada sisa.
        $directPermissionRoles = [User::DEPARTMENT_ADMIN_ROLE, 'Karyawan'];

        if (! in_array($roleName, $directPermissionRoles, true)) {
            $user->syncPermissions([]);

            return;
        }

        $submitted = array_map('intval', (array) $request->input('permissions', []));

        // Intersect dengan permission matriks — ID injected di luar
        // matriks (mis. roles.assign_permission) ditolak.
        $matrixIds = \App\Models\Permission::whereIn('name', MasterMenu::matrixPermissionNames())
            ->pluck('id')
            ->all();

        $user->syncPermissions(array_values(array_intersect($submitted, $matrixIds)));
    }

    /**
     * Aturan payload bersama store() & update(). Password opsional
     * pada update (kosong = tidak diganti).
     */
    private function validationRules(bool $isCreate, ?int $userId = null): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email' . ($isCreate ? '' : ',' . $userId),
            'password' => $isCreate ? 'required|min:8|confirmed' : 'nullable|min:8|confirmed',
            'role_id'  => 'required|integer|exists:roles,id',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string|max:500',
        ];
    }

    public function create()
    {
        Gate::authorize('users.create');

        // Dropdown "Role Pengguna" menampilkan SELURUH role aktif.
        // Role yang dibuat admin (di luar 3 role dasar) juga tersedia
        // untuk diberikan ke user. Urutan: role dasar di depan,
        // role buatan admin di belakang (sesuai nama).
        $baseRoles = Role::where('status', true)
            ->whereIn('name', User::ASSIGNABLE_ROLE_NAMES)
            ->get()
            ->sortBy(fn (Role $role) => array_search($role->name, User::ASSIGNABLE_ROLE_NAMES))
            ->values();

        $otherRoles = Role::where('status', true)
            ->whereNotIn('name', User::ASSIGNABLE_ROLE_NAMES)
            ->get()
            ->sortBy('name')
            ->values();

        $roles = $baseRoles->merge($otherRoles);

        return view('admin.users.create', [
            'roles'      => $roles,
            'menuMatrix' => MasterMenu::matrixForRoleForm(),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('users.create');

        $role     = Role::find($request->input('role_id'));
        $roleName = $role?->name ?? '';

        [$orgRules, $orgAttributes] = self::orgHierarchyRules($roleName, $request->input('level_jabatan', ''));

        $validated = $request->validate(array_merge(
            $this->validationRules(true),
            $orgRules
        ), $orgAttributes);

        $role = Role::findOrFail($validated['role_id']);

        // Validasi: role yang dipilih harus aktif.
        // Semua role (termasuk role buatan admin) boleh dipilih.
        if (! $role->status) {
            return back()->withErrors(['role_id' => 'Role yang dipilih sedang dinonaktifkan.'])->withInput();
        }

        // REVISI — binding kuota Super Admin: maksimal 3 akun di database.
        if ($role->name === User::SUPER_ADMIN_ROLE
            && User::superAdminAccountCount() >= User::MAX_SUPER_ADMIN_ACCOUNTS) {
            return back()->withErrors([
                'role_id' => 'Gagal: Jumlah akun Super Admin sudah mencapai batas maksimal (3 akun).',
            ])->withInput();
        }

        // REVISI — kuota Level Jabatan "Senior Manager" (role Karyawan):
        // maksimal 3 akun AKTIF di database.
        if ($role->name === 'Karyawan'
            && $validated['level_jabatan'] === 'senior_manager'
            && User::seniorManagerAccountCount() >= User::MAX_SENIOR_MANAGER_ACCOUNTS) {
            return back()->withErrors([
                'level_jabatan' => 'Gagal: Jumlah akun Senior Manager sudah mencapai batas maksimal (3 akun).',
            ])->withInput();
        }

        self::normalizeOrgHierarchy($validated, $role->name);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role_id']  = $role->id;
        $validated['role']     = $role->name;

        // RBAC — sinkronkan FK department_id dengan kode bidang terpilih
        // (pengikatan akun Admin Bidang / Karyawan ke satu bidang).
        $validated['department_id'] = $validated['department'] !== null
            ? Department::byCode($validated['department'])?->id
            : null;

        $user = User::create($validated);

        // Sinkronkan pivot role_user agar sistem permission (@can, middleware
        // permission:) mengenali role user ini, bukan hanya kolom users.role_id.
        $user->roles()->sync([$role->id]);

        // DIRECT PERMISSION — sinkronkan matriks hak akses per akun
        // (Admin Bidang & Karyawan) ke tabel user_has_permissions.
        $this->syncDirectPermissions($user, $request, $role->name);

        // Note: Jika nanti menginstal spatie/laravel-permission, aktifkan
        // pembersihan cache di sini agar perubahan Direct Permission langsung
        // berlaku real-time tanpa logout-login ulang.

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
     * Edit Pengguna — bentuk form sama dengan Tambah; Direct Permission
     * tercentang mengikuti hak akses aktif milik user (spec poin 2).
     */
    public function edit(User $user)
    {
        Gate::authorize('users.edit');

        // Dropdown "Role Pengguna" menampilkan SELURUH role aktif.
        // Role yang dibuat admin (di luar 3 role dasar) juga tersedia.
        $baseRoles = Role::where('status', true)
            ->whereIn('name', User::ASSIGNABLE_ROLE_NAMES)
            ->get()
            ->sortBy(fn (Role $role) => array_search($role->name, User::ASSIGNABLE_ROLE_NAMES))
            ->values();

        $otherRoles = Role::where('status', true)
            ->whereNotIn('name', User::ASSIGNABLE_ROLE_NAMES)
            ->get()
            ->sortBy('name')
            ->values();

        $roles = $baseRoles->merge($otherRoles);

        return view('admin.users.edit', [
            'user'              => $user,
            'roles'             => $roles,
            'menuMatrix'        => MasterMenu::matrixForRoleForm(),
            'userPermissionIds' => $user->directPermissionIds(),
        ]);
    }

    /**
     * Update Pengguna — simpan data bidang/sub-bidang ke tabel users
     * DAN sinkronisasi direct permission (user_has_permissions) ke ID
     * User tersebut (spec poin 2: "Saat Form Disimpan").
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('users.edit');

        $role     = Role::find($request->input('role_id'));
        $roleName = $role?->name ?? '';

        [$orgRules, $orgAttributes] = self::orgHierarchyRules($roleName, $request->input('level_jabatan', ''));

        $validated = $request->validate(array_merge(
            $this->validationRules(false, $user->id),
            $orgRules
        ), $orgAttributes);

        // Validasi: role yang dipilih harus aktif.
        // Semua role (termasuk role buatan admin) boleh dipilih.
        if (! $role->status) {
            return back()->withErrors(['role_id' => 'Role yang dipilih sedang dinonaktifkan.'])->withInput();
        }

        // Kuota Super Admin: akun yang DIJADIKAN Super Admin dihitung
        // (akun Super Admin existing tidak menggandakan slot-nya sendiri).
        if ($role->name === User::SUPER_ADMIN_ROLE
            && ! $user->isSuperAdmin()
            && User::superAdminAccountCount() >= User::MAX_SUPER_ADMIN_ACCOUNTS) {
            return back()->withErrors([
                'role_id' => 'Gagal: Jumlah akun Super Admin sudah mencapai batas maksimal (3 akun).',
            ])->withInput();
        }

        // Kuota Senior Manager: sama — yang sudah Senior Manager tidak
        // menggandakan slot kuotanya sendiri.
        if ($role->name === 'Karyawan'
            && $validated['level_jabatan'] === 'senior_manager'
            && $user->level_jabatan !== 'senior_manager'
            && User::seniorManagerAccountCount() >= User::MAX_SENIOR_MANAGER_ACCOUNTS) {
            return back()->withErrors([
                'level_jabatan' => 'Gagal: Jumlah akun Senior Manager sudah mencapai batas maksimal (3 akun).',
            ])->withInput();
        }

        self::normalizeOrgHierarchy($validated, $role->name);

        // Password kosong (update) → tidak diganti.
        if (($validated['password'] ?? '') !== '') {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['role_id'] = $role->id;
        $validated['role']    = $role->name;

        $validated['department_id'] = $validated['department'] !== null
            ? Department::byCode($validated['department'])?->id
            : null;

        $user->update($validated);

        // Pastikan pivot role_user mengikuti perubahan role.
        $user->roles()->sync([$role->id]);

        // DIRECT PERMISSION — sinkronkan matriks hak akses per akun.
        $this->syncDirectPermissions($user, $request, $role->name);

        // Note: Jika nanti menginstal spatie/laravel-permission, aktifkan
        // pembersihan cache di sini agar perubahan Direct Permission langsung
        // berlaku real-time tanpa logout-login ulang.

        ActivityLogger::log('update', null, [
            'module'      => 'pengguna',
            'description' => "memperbarui akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        $message = 'Data pengguna berhasil diperbarui.';

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->route('admin.users.index')->with('success', $message);
    }

    /**
     * Toggle status akun pengguna (Aktif ⇄ Nonaktif) — shortcut cepat
     * dari Daftar Pengguna. Status dipetakan ke kolom email_verified_at:
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

    /**
     * Reset password akun oleh admin → password sementara sekali pakai.
     *
     * Alur:
     * 1. Sistem membuat password sementara otomatis & acak (12 karakter
     *    alfanumerik, CSPRNG) — tidak dikirim email; admin menyampaikannya
     *    langsung ke user (WA/lisan). Password ditampilkan SEKALI di modal
     *    setelah reset, dengan tombol copy.
     * 2. Akun ditandai must_change_password = true sehingga saat login
     *    user WAJIB mengganti password dulu (middleware must.password).
     * 3. Semua sesi login lama user tersebut di-invalidate.
     *
     * Keamanan: password sementara TIDAK pernah disimpan plaintext di
     * database (cast 'hashed'), TIDAK dicatat di activity log, dan TIDAK
     * ditampilkan pada daftar user — hanya pada response reset ini.
     *
     * Guard keamanan: Super Admin saja tidak boleh me-reset akun
     * Administrator lain (mencegah eskalasi/penurunan hak); admin juga
     * tidak dapat me-reset akunnya sendiri (pakai fitur ganti password).
     * Menerima fetch AJAX (JSON) maupun submit form biasa (redirect).
     */
    public function resetPassword(Request $request, User $user)
    {
        $actor = $request->user();

        $failMessage = null;

        if ($user->id === $actor?->id) {
            $failMessage = 'Anda tidak dapat me-reset password akun Anda sendiri. Gunakan fitur ganti password di profil.';
        } elseif ($actor?->isSuperAdmin() && ! $actor->isDepartmentAdmin()
            && $user->roleNames()->contains(fn ($n) => in_array($n, [User::SUPER_ADMIN_ROLE, 'Administrator'], true))) {
            $failMessage = 'Password akun Administrator lain hanya dapat direset melalui mekanisme Lupa Password (OTP email).';
        }

        if ($failMessage !== null) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $failMessage], 422);
            }

            return redirect()->route('admin.users.index')->with('error', $failMessage);
        }

        // Password sementara dibuat SISTEM — acak & aman (Str::random
        // memakai CSPRNG, alfabet A-Z a-z 0-9), 12 karakter: cukup kuat
        // namun tetap praktis disampaikan via WhatsApp/lisan.
        $temporaryPassword = \Illuminate\Support\Str::random(12);

        // Cast 'hashed' pada model User otomatis meng-hash nilai ini.
        $user->forceFill([
            'password'             => $temporaryPassword,
            'must_change_password' => true,
            'remember_token'       => \Illuminate\Support\Str::random(60),
        ])->save();

        // Invalidate seluruh sesi login lama target: hapus baris di tabel
        // `sessions` milik user terkait. Session driver database (lihat
        // config/session.php) memvalidasi setiap request terhadap baris ini;
        // tanpa baris, middleware Authenticate akan memaksa login ulang.
        \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', $user->id)
            ->delete();

        ActivityLogger::log('reset_password', $actor, [
            'module'      => 'pengguna',
            'description' => "me-reset password akun \"{$user->name}\" ({$user->email}) — password sementara acak dibuat oleh sistem",
            'subject'     => $user,
        ]);

        $message = "Password akun \"{$user->name}\" berhasil direset. "
            . 'Sampaikan password sementara tersebut kepada pengguna; saat login ia akan diminta mengganti password.';

        if ($request->expectsJson()) {
            // temporary_password dikembalikan HANYA di sini agar admin dapat
            // menyalin & menyampaikannya; tidak pernah tersimpan / dilog.
            return response()->json([
                'success'            => true,
                'message'            => $message,
                'temporary_password' => $temporaryPassword,
            ]);
        }

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
