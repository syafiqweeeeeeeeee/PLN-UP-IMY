<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterMenu;
use App\Models\Permission;
use App\Models\Role;
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
        // ke pivot role_permission saat form Edit Role disimpan. Permission
        // DI LUAR matriks (mis. news.publish, tamu.checkout,
        // roles.assign_permission, legacy) TETAP dipertahankan — slot
        // ekstra tersebut dikelola di halaman "Kelola Permission".
        $this->syncMatrixPermissions($role, $request->input('permissions', []), preserveExtras: true);

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
        $role->delete();

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
