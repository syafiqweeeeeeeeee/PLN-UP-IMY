<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('roles.view');

        $roles = Role::withCount(['users', 'permissions'])
            ->orderBy('name')
            ->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        Gate::authorize('roles.create');

        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('roles.create');

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:100', 'unique:roles,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:active,inactive'],
        ]);

        $role = Role::create([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'status'      => $validated['status'] === 'active',
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" berhasil dibuat.");
    }

    public function edit(Role $role)
    {
        Gate::authorize('roles.edit');

        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        Gate::authorize('roles.edit');

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:100', 'unique:roles,name,' . $role->id],
            'description' => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:active,inactive'],
        ]);

        $role->update([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'status'      => $validated['status'] === 'active',
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" berhasil diperbarui.");
    }

    public function destroy(Role $role)
    {
        Gate::authorize('roles.delete');

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
