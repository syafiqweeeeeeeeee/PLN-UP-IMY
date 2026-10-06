{{-- ============================================================
     PARTIAL: Matriks Hak Akses (ID Menu Sidebar × CRUD)
     Dipakai bersama oleh:
       - Form Tambah/Edit Role  (admin/roles/create, admin/roles/edit)
       - Form Pengguna — Direct Permission (admin/users/_form)
     Parameter:
       $menuMatrix   → MasterMenu::matrixForRoleForm()
       $checkedIds   → array<int,int> permission ID tercentang
       $checkboxGroupMode → 'role' (default) | 'direct' — hanya label
     ============================================================ --}}
@php
    $checkedIds = $checkedIds ?? [];
@endphp

@push('styles')
    <style data-page>
        .perm-matrix-block { display: block; }
        .perm-matrix-wrap { overflow-x: auto; }
        .perm-matrix { min-width: 680px; }
        .perm-check { cursor: pointer; }
        .perm-na { color: #9ca3af; }
        .text-muted { color: var(--ink-muted); }
    </style>
@endpush

<div class="perm-matrix-block">
<div class="row g-2 mb-3">
    <div class="col-auto">
        <button type="button" class="perm-select-all btn-permission-outline">
            <i class="fas fa-check-double"></i> Pilih Semua
        </button>
    </div>
    <div class="col-auto">
        <button type="button" class="perm-clear-all btn-permission-outline">
            <i class="fas fa-times"></i> Hapus Semua
        </button>
    </div>
</div>

<div class="perm-matrix-wrap">
    <table class="perm-matrix">
        <thead>
            <tr>
                <th>ID</th>
                <th>Menu Sidebar</th>
                <th>Buka Menu (View)</th>
                <th>Tambah (Create)</th>
                <th>Edit (Update)</th>
                <th>Hapus (Delete)</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($menuMatrix) && count($menuMatrix) > 0)
            @foreach ($menuMatrix as $row)
                @php
                    $menuDef = $row['definition'];
                @endphp
                <tr>
                    <td><span class="perm-menu-id">{{ $menuDef['id'] }}</span></td>
                    <td>
                        <span class="perm-menu-name">
                            <i class="fas {{ $menuDef['icon'] }}"></i> {{ $menuDef['name'] }}
                        </span>
                    </td>
                    @foreach (['view', 'create', 'edit', 'delete'] as $action)
                        @php
                            $perm = $row['permissions']->first(fn ($p) => str_ends_with($p->name, '.' . $action));
                        @endphp
                        <td>
                            @if ($perm)
                                <input type="checkbox" class="perm-check"
                                       name="permissions[]"
                                       value="{{ $perm->id }}"
                                       id="perm-{{ $perm->id }}"
                                       data-menu-id="{{ $menuDef['id'] }}"
                                       data-action="{{ $action }}"
                                       {{ in_array($perm->id, $checkedIds) ? 'checked' : '' }}>
                            @else
                                <span class="perm-na">—</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            @else
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada menu yang dikonfigurasi.</td></tr>
            @endif
        </tbody>
    </table>
</div>
<div class="form-hint flex mt-2">
    <i class="far fa-lightbulb"></i> Tanda "—" berarti menu tersebut tidak memiliki aksi tersebut (mis. Dashboard hanya punya hak View).
</div>
@error('permissions.*')
    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
@enderror

{{-- Pilih/Hapus Semua — anti double-bind via dataset flag agar aman
     dipakai di beberapa form sekaligus maupun setelah SPA navigate. --}}
<script>
    (function () {
        const wrapper = document.currentScript?.closest('.perm-matrix-block') ?? document;
        if (! wrapper || wrapper.dataset.permMatrixBound) return;
        wrapper.dataset.permMatrixBound = '1';

        const checkboxes = Array.from(wrapper.querySelectorAll('.perm-check'));

        wrapper.querySelector('.perm-select-all')?.addEventListener('click', function () {
            const allChecked = checkboxes.every(cb => cb.checked);
            checkboxes.forEach(cb => (cb.checked = !allChecked));
        });

        wrapper.querySelector('.perm-clear-all')?.addEventListener('click', function () {
            checkboxes.forEach(cb => (cb.checked = false));
        });
    })();
</script>
</div>
