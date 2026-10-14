<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterMenu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * 3 Role Dasar (bawaan sistem) — role ini dibuat otomatis oleh
     * PermissionSeeder dan memiliki perilaku khusus di kode:
     *   - Super Admin    → akses penuh seluruh fitur
     *   - Admin Bidang   → akses delegasi per bidang
     *   - Karyawan       → akses dasar portal karyawan
     *
     * Role Dasar TIDAK BOLEH DIHAPUS (struktur sistem), namun NAMA
     * tetap bisa diubah via edit (mis. penyesuaian penamaan). Role
     * baru BISA dibuat oleh admin jika diperlukan.
     */
    public const BASE_ROLE_NAMES = [
        \App\Models\User::SUPER_ADMIN_ROLE,
        \App\Models\User::DEPARTMENT_ADMIN_ROLE,
        'Karyawan',
    ];

    /**
     * Daftar nama role yang bersifat khusus/sistem dan tidak boleh
     * dihapus. Role lain (buatan admin) bisa dibuat & dihapus freely.
     */
    private function isBaseRole(Role $role): bool
    {
        return in_array($role->name, self::BASE_ROLE_NAMES, true);
    }

    public function index()
    {
        Gate::authorize('roles.view');

        $roles = Role::withCount(['users', 'permissions'])
            ->orderBy('name')
            ->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Tampilkan form tambah role baru.
     * Hanya role yang memiliki permission 'roles.create' yang bisa
     * mengakses halaman ini.
     */
    public function create()
    {
        Gate::authorize('roles.create');

        return view('admin.roles.create', [
            'menuMatrix' => MasterMenu::matrixForRoleForm(),
        ]);
    }

    /**
     * Simpan role baru ke database.
     * Role baru langsung bisa diisi permission via matriks hak akses.
     */
    public function store(Request $request)
    {
        Gate::authorize('roles.create');

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:100', 'unique:roles,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:active,inactive'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role = Role::create([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'status'      => $validated['status'] === 'active',
        ]);

        ActivityLogger::log('create', null, [
            'module'      => 'role',
            'description' => "membuat role baru \"{$role->name}\"",
            'subject'     => $role,
        ]);

        // Simpan matriks hak akses (checkbox per ID Menu × CRUD)
        // ke pivot role_permission.
        $this->syncMatrixPermissions($role, $request->input('permissions', []));

        return redirect()->route('admin.roles.permissions', $role)
            ->with('success', "Role \"{$role->name}\" berhasil dibuat. Atur permission untuk role ini.");
    }

    public function edit(Role $role)
    {
        Gate::authorize('roles.edit');

        // Matriks hak akses granular + daftar permission terpilih milik role.
        $menuMatrix = MasterMenu::matrixForRoleForm();
        $rolePermissionIds = $role->permissions()->pluck('permissions.id')->all();

        return view('admin.roles.edit', compact('role', 'menuMatrix', 'rolePermissionIds'));
    }

    public function update(Request $request, Role $role)
    {
        Gate::authorize('roles.edit');

        $isBaseRole = $this->isBaseRole($role);

        $validated = $request->validate([
            // Role Dasar: nama dikunci (tidak boleh diganti).
            'name'          => ['required', 'string', 'max:100', $isBaseRole ? "in:{$role->name}" : 'unique:roles,name,' . $role->id],
            'description'   => ['nullable', 'string', 'max:255'],
            'status'        => ['required', 'in:active,inactive'],
            'permissions'   => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role->update([
            'name'        => $isBaseRole ? $role->name : $validated['name'],
            'description' => $validated['description'],
            'status'      => $validated['status'] === 'active',
        ]);

        // REVISI RBAC — simpan matriks hak akses granular secara dinamis
        // ke pivot role_permission saat form Edit Role disimpan. Tabel
        // permissions kini berisi TEPAT 39 permission matriks per ID Menu,
        // sehingga sync ini justru memastikan pivot role bebas dari sisa
        // permission legacy: angka kolom "Hak Akses" di daftar role
        // selalu akurat dari relasi database ($role->permissions()->count()).
        $this->syncMatrixPermissions($role, $request->input('permissions', []), preserveExtras: true);

        // SINKRONISASI ROLE → PENGGUNA — seluruh akun pemegang role ini
        // otomatis menerima pembaruan permissions yang sama tanpa perlu
        // diedit satu per satu: (1) baseline role dibaca dinamis dari pivot
        // role_permission, (2) salinan direct permission lama milik akun
        // dibersihkan agar tidak menimpa role saat ini.
        $this->syncRoleUsersDirectPermissions($role);

        // REAL-TIME RBAC — bersihkan cache registrasi gate permission agar
        // seluruh akun pemegang role ini langsung mewarisi perubahan centang
        // (setara Spatie: forgetCachedPermissions()).
        \App\Providers\AuthServiceProvider::flushPermissionGateCache();

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" berhasil diperbarui.");
    }

    /**
     * Simpan pemetaan matriks (checkbox per ID Menu × aksi CRUD) ke pivot
     * role_permission — hanya permission yang termasuk matriks master menu.
     *
     * preserveExtras=true → permission di luar matriks yang sudah dimiliki
     * role tidak ikut terhapus (dikelola halaman "Kelola Permission").
     */
    private function syncMatrixPermissions(Role $role, array $submittedIds, bool $preserveExtras = false): void
    {
        $matrixPermissionIds = Permission::whereIn('name', MasterMenu::matrixPermissionNames())
            ->pluck('id')
            ->all();

        // Checkbox matriks: hanya ID yang benar-benar slot matriks (aman
        // dari ID injected di luar matriks).
        $submitted = array_values(array_intersect(
            array_map('intval', $submittedIds),
            $matrixPermissionIds
        ));

        if (! $preserveExtras) {
            $role->permissions()->sync($submitted);

            return;
        }

        $nonMatrixCurrentIds = $role->permissions()
            ->whereNotIn('permissions.id', $matrixPermissionIds)
            ->pluck('permissions.id')
            ->all();

        $role->permissions()->sync(array_values(array_unique(array_merge($submitted, $nonMatrixCurrentIds))));
    }

    /**
     * SINKRONISASI ROLE → PENGGUNA (spec: "mengedit centang pada suatu
     * Role langsung mengubah hak akses seluruh akun pemegang Role").
     *
     * Baseline hak akses efektif kini SELALU dibaca dinamis dari pivot
     * role_permission (semantik Spatie: direct permission hanya MENAMBAH,
     * tidak pernah memblokir role — lihat User::hasPermission). Langkah
     * ekstra di sini hanya memurnikan data: salinan direct permission
     * (user_has_permissions) yang dulu tersimpan saat akun dibuat dibuang,
     * sehingga perubahan role juga mencabut salinan basi tersebut.
     *
     * Pengecualian: role delegasi "Karyawan" & "Admin Bidang" — direct
     * permission per akun adalah fitur sah (varian tugas per orang), jadi
     * tetap dipertahankan sebagai tambahan di atas baseline role.
     */
    private function syncRoleUsersDirectPermissions(Role $role): void
    {
        $delegationRoles = [User::DEPARTMENT_ADMIN_ROLE, 'Karyawan'];

        if (in_array($role->name, $delegationRoles, true)) {
            return;
        }

        // Akun pemegang role: pivot role_user + fallback kolom users.role_id.
        $userIds = \Illuminate\Support\Facades\DB::table('role_user')
            ->where('role_id', $role->id)
            ->pluck('user_id')
            ->merge(User::where('role_id', $role->id)->pluck('id'))
            ->unique()
            ->values();

        if ($userIds->isEmpty()) {
            return;
        }

        // Abaikan akun yang juga memegang role delegasi (direct permission-
        // nya adalah hak ekstra yang sah).
        $delegationRoleIds = Role::whereIn('name', $delegationRoles)->pluck('id');

        $affectedUsers = User::whereIn('id', $userIds)
            ->whereDoesntHave('roles', fn ($q) => $q->whereIn('roles.id', $delegationRoleIds))
            ->whereNotIn('role_id', $delegationRoleIds)
            ->get();

        foreach ($affectedUsers as $user) {
            $user->syncPermissions([]);
        }

        if ($affectedUsers->isNotEmpty()) {
            \App\Providers\AuthServiceProvider::flushPermissionGateCache();
        }
    }

    public function destroy(Role $role)
    {
        Gate::authorize('roles.delete');

        // Role Dasar (Super Admin, Admin Bidang, Karyawan) tidak
        // dapat dihapus karena merupakan bagian dari struktur sistem.
        if ($this->isBaseRole($role)) {
            return back()->with('error',
                "Role \"{$role->name}\" adalah Role Dasar sistem dan tidak dapat dihapus.");
        }

        $name = $role->name;

        // SINKRONISASI ROLE → PENGGUNA — role dihapus: buang juga salinan
        // direct permission basi milik seluruh akun yang pernah memegangnya
        // agar tidak ada hak akses yang bertahan lewat salinan.
        $this->syncRoleUsersDirectPermissions($role);

        $role->delete();

        // REAL-TIME RBAC — role terhapus: cabut cache gate permission.
        \App\Providers\AuthServiceProvider::flushPermissionGateCache();

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$name}\" berhasil dihapus.");
    }

    public function permissions(Role $role)
    {
        Gate::authorize('roles.assign_permission');

        $grouped = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        return view('admin.roles.permissions', compact('role', 'grouped'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        Gate::authorize('roles.assign_permission');

        $validated = $request->validate([
            'permissions' => ['required', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $permissionIds = array_unique($validated['permissions']);

        $role->permissions()->sync($permissionIds);

        // SINKRONISASI ROLE → PENGGUNA — halaman "Kelola Permission":
        // sinkronkan juga direct permission salinan lama milik seluruh
        // akun pemegang role ini.
        $this->syncRoleUsersDirectPermissions($role);

        // REAL-TIME RBAC — halaman "Kelola Permission": flush cache gate
        // agar perubahan langsung diwarisi semua akun dengan role ini.
        \App\Providers\AuthServiceProvider::flushPermissionGateCache();

        return redirect()->route('admin.roles.permissions', $role)
            ->with('success', 'Permission berhasil diperbarui.');
    }

    public function toggleStatus(Request $request, Role $role)
    {
        Gate::authorize('roles.edit');

        $validated = $request->validate([
            'status' => ['required', 'in:active,inactive'],
        ]);

        $role->update([
            'status' => $validated['status'] === 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status role berhasil diperbarui.',
        ]);
    }
}
