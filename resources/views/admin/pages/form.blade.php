@extends('layouts.admin')

@section('title', ($page ? 'Edit Halaman' : 'Tambah Halaman') . ' — E-PPID PLN')
@section('page-title', $page ? 'Edit Halaman' : 'Tambah Halaman')

@push('styles')
<style>
    /* ============================================
       PAGE FORM — DESIGN SYSTEM FORM STANDAR
       Struktur & style sama dengan form Berita (referensi utama):
       form-topbar, form-section(+icon), form-group, form-input,
       form-hint, form-footer, form-btn-save/cancel
       → semua global di public/css/admin.css.
       Yang tersisa di sini HANYA komponen unik Halaman:
       accordion section editor + role checkboxes.
       ============================================ */
    textarea.form-input { min-height: 100px; resize: vertical; }

    /* Sections */
    .section-item {
        border: 1px solid #e5e7eb; border-radius: 12px;
        margin-bottom: 0.75rem; overflow: hidden; background: #fff;
    }
    .section-item-head {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.75rem 1rem; background: #f8fafc; border-bottom: 1px solid #eef2f7;
        cursor: pointer; user-select: none;
    }
    .section-item-head .left { display: flex; align-items: center; gap: 0.6rem; }
    .section-item-head .num {
        width: 26px; height: 26px; border-radius: 8px; background: #e8f1fa; color: var(--pln-blue);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.72rem; font-weight: 800;
    }
    .section-item-head .type-label { font-weight: 700; font-size: 0.82rem; color: var(--pln-text); }
    .section-item-head .chev { color: #9ca3af; font-size: 0.75rem; transition: transform 0.2s ease; }
    .section-item.open .chev { transform: rotate(180deg); }
    .section-item-body { padding: 1rem; display: none; }
    .section-item.open .section-item-body { display: block; }
    .section-move-forms { display: inline-flex; gap: 0.25rem; }
    .btn-mini {
        border: 1px solid var(--border-color); background: #fff; color: #6b7280;
        border-radius: 7px; padding: 0.3rem 0.55rem; font-size: 0.7rem; cursor: pointer;
        transition: all 0.15s ease;
    }
    .btn-mini:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .btn-mini.danger:hover { border-color: #dc2626; color: #dc2626; }

    /* Role checkboxes */
    .role-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 0.5rem; }
    .role-check {
        display: flex; align-items: center; gap: 0.5rem; padding: 0.55rem 0.75rem;
        border: 1px solid #e5e7eb; border-radius: 10px; cursor: pointer;
        font-size: 0.8rem; font-weight: 600; color: #4b5563; transition: all 0.15s ease;
    }
    .role-check:hover { border-color: var(--pln-blue); }
    .role-check:has(input:disabled) { opacity: 0.45; cursor: not-allowed; }
    .role-check:has(input:disabled):hover { border-color: #e5e7eb; }
    .role-check input { accent-color: var(--pln-blue); }

    /* Dark-mode komponen unik halaman */
    html.theme-dark .section-item { background: var(--panel); border-color: var(--line); }
    html.theme-dark .section-item-head { background: var(--panel-2); border-color: var(--line); }
    html.theme-dark .section-item-head .type-label { color: var(--ink-heading); }
    html.theme-dark .btn-mini { background: var(--panel); }
    html.theme-dark .role-check { border-color: var(--line); color: var(--ink-body); }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.pages.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $page ? 'Edit Halaman' : 'Tambah Halaman Baru' }}</h4>
            <p class="form-page-subtitle">
                @if ($page)
                    /halaman/{{ $page->slug }}
                @else
                    Isi identitas halaman, susun konten per section, lalu simpan sekali.
                @endif
            </p>
        </div>
    </div>
    <div class="form-topbar-actions">
        <button type="submit" form="pageForm" class="form-btn-save">
            <i class="fas fa-floppy-disk"></i> Simpan Halaman
        </button>
    </div>
</div>

@if (session('success'))
<div class="form-alert success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="form-alert danger">
    <i class="fas fa-circle-exclamation"></i> Perbaiki data berikut.
</div>
@endif

<form id="pageForm" method="POST"
      action="{{ $page ? route('admin.pages.update', $page) : route('admin.pages.store') }}">
    @csrf
    @if ($page)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue"><i class="fas fa-circle-info"></i></div>
            <div>
                <h6 class="form-section-title">Identitas Halaman</h6>
                <p class="form-section-desc">Judul dan status publikasi halaman</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="form-group-label" for="title">Judul Halaman <span class="required">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $page->title ?? '') }}"
                           class="form-input @error('title') is-invalid @enderror" placeholder="Masukkan judul halaman..." required autofocus>
                    @error('title')<div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-group-label" for="status">Status <span class="required">*</span></label>
                    <select id="status" name="status" class="form-input">
                        <option value="draft" @selected(old('status', $page->status ?? 'draft') === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $page->status ?? '') === 'published')>Terbit</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon purple"><i class="fas fa-lock"></i></div>
            <div>
                <h6 class="form-section-title">Visibilitas</h6>
                <p class="form-section-desc">Siapa yang boleh melihat halaman ini</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="visibility">Siapa yang boleh melihat?</label>
                    <select id="visibility" name="visibility" class="form-input">
                        <option value="public" @selected(old('visibility', $page->visibility ?? 'public') === 'public')>
                            Publik — semua pengunjung
                        </option>
                        <option value="role_restricted" @selected(old('visibility', $page->visibility ?? '') === 'role_restricted')>
            Role Terbatas — hanya role terpilih (wajib login)
                        </option>
                    </select>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Visibilitas di-enforce di server: halaman ber-role yang diakses tanpa hak akan tampil 404.
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label">Role yang diizinkan</label>
                    <div class="role-grid" id="roleGrid">
                        @forelse ($roles as $role)
                            <label class="role-check">
                                <input type="checkbox" name="role_ids[]" value="{{ $role->id }}"
                                       {{ in_array($role->id, old('role_ids', $page?->roles->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                                {{ $role->name }}
                            </label>
                        @empty
                            <span class="text-muted small">Belum ada role terdaftar.</span>
                        @endforelse
                    </div>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Hanya berlaku saat visibilitas "Role Terbatas". Tanpa role terpilih, halaman terkunci.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="show_in_list" name="show_in_list" value="1"
                   {{ old('show_in_list', $page->show_in_list ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="show_in_list">
                Tampilkan di daftar halaman (/halaman)
            </label>
        </div>
    </div>

    {{-- ================= KONTEN HALAMAN (SECTIONS) — selalu tampil, ikut submit utama ================= --}}
    <div class="form-section">
        <div class="form-section-header" style="justify-content: space-between;">
            <div class="d-flex align-items-center" style="gap:0.65rem;">
                <div class="form-section-icon cyan"><i class="fas fa-layer-group"></i></div>
                <div>
                    <h6 class="form-section-title">Konten Halaman (Sections)</h6>
                    <p class="form-section-desc">Susun isi halaman per section</p>
                </div>
            </div>
            <button type="button" class="btn-mini" style="padding:0.5rem 1rem;" id="btnAddSection">
                <i class="fas fa-plus"></i> Tambah Section
            </button>
        </div>

        <div class="form-hint flex mb-2">
            <i class="fas fa-circle-info"></i>
            Semua section tersimpan bersama tombol <strong>"Simpan Halaman"</strong> di atas — tidak perlu simpan satu per satu.
        </div>

        @php
            // Prioritas repopulasi: old() (gagal validasi) → sections tersimpan (edit) → default 1 section Teks kosong
            $formSections = old('sections');
            if (is_array($formSections) && $formSections !== []) {
                $formSections = collect($formSections)
                    ->filter(fn ($r) => is_array($r))
                    ->map(fn ($r) => ['id' => $r['id'] ?? null, 'type' => $r['type'] ?? 'text', 'data' => $r])
                    ->values()->all();
            } else {
                $formSections = $page?->sections
                    ?->sortBy([['sort_order', 'asc'], ['id', 'asc']])
                    ->map(fn ($sec) => ['id' => $sec->id, 'type' => $sec->type, 'data' => $sec->data ?? []])
                    ->values()->all() ?? [];
            }
            if (count($formSections) === 0) {
                $formSections = [['id' => null, 'type' => 'text', 'data' => []]];
            }
        @endphp

        <div id="sectionsList">
            @foreach ($formSections as $i => $s)
                @include('admin.pages.partials.section-block', ['s' => $s, 'idx' => $i])
            @endforeach
        </div>

        <div class="text-center text-muted py-3 d-none" id="sectionsEmpty">
            <i class="fas fa-layer-group fa-2x mb-3 d-block" style="color:#d1d5db;"></i>
            Belum ada section. Klik "+ Tambah Section" untuk mulai mengisi konten.
        </div>

        {{-- Template di-clone JS untuk "+ Tambah Section" — placeholder __NEW__ dinomori ulang otomatis --}}
        <template id="sectionTemplate">
            @include('admin.pages.partials.section-block', ['s' => ['id' => null, 'type' => 'text', 'data' => []], 'idx' => '__NEW__'])
        </template>
    </div>
</form>

{{-- ============================================
     FOOTER — standar Design System Form (di luar form,
     tombol simpan utama ada di form-topbar via attribute form="pageForm")
     ============================================ --}}
<div class="form-footer">
    <div class="form-footer-info">
        <i class="fas fa-circle-info"></i> Field dengan <span style="color:#dc2626;">*</span> wajib diisi
    </div>
    <div class="form-footer-actions">
        <a href="{{ route('admin.pages.index') }}" class="form-btn-cancel">
            Batal
        </a>
        <button type="submit" form="pageForm" class="form-btn-save">
            <i class="fas fa-floppy-disk"></i> Simpan Halaman
        </button>
    </div>
</div>

{{-- ============================================================
     Script INLINE di dalam content section — WAJIB di sini (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     menukar isi <main> dan mengeksekusi ulang <script> di dalamnya.
     ============================================================ --}}
<script>
    (function() {
        /* ============ Role grid: aktif hanya saat visibility = role_restricted ============ */
        var visibilitySelect = document.getElementById('visibility');
        var roleGrid = document.getElementById('roleGrid');
        if (visibilitySelect && roleGrid) {
            function syncRoleGrid() {
                roleGrid.querySelectorAll('input').forEach(function (cb) {
                    cb.disabled = (visibilitySelect.value !== 'role_restricted');
                });
            }
            visibilitySelect.addEventListener('change', syncRoleGrid);
            syncRoleGrid();
        }

        /* ============ Sections editor ============ */
        var list = document.getElementById('sectionsList');
        if (!list) return;

        var template = document.getElementById('sectionTemplate');
        var emptyBox = document.getElementById('sectionsEmpty');
        var addBtn = document.getElementById('btnAddSection');
        var cloneCounter = 0;

        function blocks() {
            return Array.prototype.slice.call(list.querySelectorAll('[data-section-block]'));
        }

        function syncBlockType(block) {
            var typeSelect = block.querySelector('[data-section-type]');
            var type = typeSelect ? typeSelect.value : 'text';
            var label = typeSelect && typeSelect.selectedIndex >= 0
                ? typeSelect.options[typeSelect.selectedIndex].text
                : type;

            block.querySelectorAll('[data-fields]').forEach(function (group) {
                var show = (group.dataset.fields === type);
                group.style.display = show ? '' : 'none';
                group.querySelectorAll('[name]').forEach(function (el) {
                    el.disabled = !show; // field jenis lain tidak ikut submit
                });
            });

            var labelEl = block.querySelector('[data-section-type-label]');
            if (labelEl) labelEl.textContent = label;
        }

        function renumber() {
            blocks().forEach(function (block, i) {
                block.querySelectorAll('[name]').forEach(function (el) {
                    el.name = el.name.replace(/^sections\[[^\]]*\]/, 'sections[' + i + ']');
                });
                var num = block.querySelector('[data-section-num]');
                if (num) num.textContent = (i + 1);
            });
            blocks().forEach(syncBlockType);
            if (emptyBox) emptyBox.classList.toggle('d-none', blocks().length > 0);
        }

        function openSection(block, open) {
            block.classList.toggle('open', open);
        }

        list.addEventListener('click', function (e) {
            var block = e.target.closest('[data-section-block]');
            if (!block) return;

            var moveBtn = e.target.closest('[data-section-move]');
            var removeBtn = e.target.closest('[data-section-remove]');
            var toggleHit = e.target.closest('[data-section-toggle]');

            // Semua interaksi di header: cegah perilaku default (submit form utama /
            // navigasi) dan hentikan bubbling agar tidak memicu handler lain
            // (termasuk efek buka-tutup accordion saat tombol dikuasai diklik).
            if (moveBtn || removeBtn || toggleHit) {
                e.preventDefault();
                e.stopPropagation();
            }

            if (moveBtn) {
                var dir = moveBtn.dataset.sectionMove;
                if (dir === 'up' && block.previousElementSibling) {
                    block.parentNode.insertBefore(block, block.previousElementSibling);
                } else if (dir === 'down' && block.nextElementSibling) {
                    block.parentNode.insertBefore(block.nextElementSibling, block);
                }
                renumber(); // penomoran & indeks name[] di-reorder otomatis
                return;
            }

            if (removeBtn) {
                // Konfirmasi dulu — hindari terhapus saat admin sedang mengisi konten
                if (confirm('Yakin ingin menghapus section ini? Perubahan berlaku setelah Simpan Halaman.')) {
                    block.remove();       // blok langsung hilang dari layar, tanpa reload
                    renumber();           // section 1, 2, 3 kembali berurutan rapi
                }
                return;
            }

            if (toggleHit) {
                openSection(block, !block.classList.contains('open'));
            }
        });

        list.addEventListener('change', function (e) {
            var block = e.target.closest('[data-section-block]');
            if (block && e.target.matches('[data-section-type]')) {
                syncBlockType(block);
            }
        });

        if (addBtn && template) {
            addBtn.addEventListener('click', function () {
                var fresh = template.content.querySelector('[data-section-block]').cloneNode(true);
                fresh.querySelectorAll('[name]').forEach(function (el) {
                    el.name = el.name.replace('__NEW__', 'c' + (cloneCounter++));
                });
                list.appendChild(fresh);
                renumber();
                openSection(fresh, true);
                var firstInput = fresh.querySelector('[data-fields="text"] input[name]');
                if (firstInput) firstInput.focus();
                fresh.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        }

        // State awal: sinkronkan nomor/visibility, buka blok pertama bila hanya satu
        renumber();
        var initial = blocks();
        if (initial.length === 1) openSection(initial[0], true);
    })();
</script>
@endsection
