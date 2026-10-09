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
     * 3 Role Dasar PERMANEN — struktur role DIKUNCI (spec RBAC):
     * tidak boleh dihapus / diganti namanya. Pembagian hak akses menu
     * yang berbeda-beda diatur langsung per akun (Direct Permission di
     * menu Pengguna), bukan via role baru.
     */
    public const BASE_ROLE_NAMES = [
        \App\Models\User::SUPER_ADMIN_ROLE,
        \App\Models\User::DEPARTMENT_ADMIN_ROLE,
        'Karyawan',
    ];

    public function index()
    {
        Gate::authorize('roles.view');

        $roles = Role::withCount(['users', 'permissions'])
            ->orderBy('name')
            ->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    // REVISI ARSITEKTUR — create() & store() DIHAPUS: pembuatan role
    // baru dinonaktifkan (route roles.create/roles.store tidak lagi
    // terdaftar → 404). Hak akses menu per akun diatur lewat Direct
    // Permission pada form Tambah/Edit Pengguna.

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

        $isBaseRole = in_array($role->name, self::BASE_ROLE_NAMES, true);

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

        // Role Dasar PERMANEN — tidak dapat dihapus (struktur dikunci).
        if (in_array($role->name, self::BASE_ROLE_NAMES, true)) {
            return back()->with('error',
                "Role \"{$role->name}\" adalah Role Dasar permanen dan tidak dapat dihapus.");
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
