@extends('layouts.admin')

@section('title', ($page ? 'Edit Halaman' : 'Tambah Halaman') . ' — E-PPID PLN')
@section('page-title', $page ? 'Edit Halaman' : 'Tambah Halaman')

@push('styles')
<style>
    .form-topbar {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.75rem;
    }
    .form-back-btn {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 1rem; background: var(--bg-card);
        border: 1px solid var(--border-color); border-radius: 10px;
        color: #6b7280; font-weight: 600; font-size: 0.82rem; text-decoration: none;
        transition: all 0.2s ease;
    }
    .form-back-btn:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .form-page-title { font-size: 1.25rem; font-weight: 800; color: var(--pln-text); margin: 0; }
    .form-page-subtitle { font-size: 0.8rem; color: #9ca3af; margin: 0.15rem 0 0; }
    .form-btn-save {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1.5rem; background: var(--pln-blue); color: #fff;
        border: none; border-radius: 10px; font-weight: 600; font-size: 0.85rem; cursor: pointer;
        transition: all 0.25s ease;
    }
    .form-btn-save:hover { background: #003d6b; transform: translateY(-1px); }

    .form-section {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; padding: 1.5rem; margin-bottom: 1rem;
    }
    .form-section-header {
        display: flex; align-items: center; gap: 0.65rem;
        margin-bottom: 1.25rem; padding-bottom: 0.85rem; border-bottom: 1px solid #f3f4f6;
    }
    .form-section-header .icon-circle {
        width: 34px; height: 34px; border-radius: 9px;
        background: #e8f1fa; color: var(--pln-blue);
        display: flex; align-items: center; justify-content: center; font-size: 0.85rem;
    }
    .form-section-header h6 { margin: 0; font-weight: 700; color: var(--pln-text); font-size: 0.95rem; }
    .form-label-mod { font-size: 0.8rem; font-weight: 600; color: #4b5563; margin-bottom: 0.35rem; }
    .form-control-mod {
        width: 100%; padding: 0.65rem 0.9rem; border: 1px solid #e5e7eb;
        border-radius: 10px; font-size: 0.85rem; color: var(--pln-text);
        background: #fff; transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control-mod:focus { outline: none; border-color: var(--pln-blue); box-shadow: 0 0 0 3px rgba(0,91,156,0.1); }
    textarea.form-control-mod { min-height: 100px; resize: vertical; }
    .invalid-feedback-mod { color: #dc2626; font-size: 0.75rem; margin-top: 0.3rem; }
    .form-hint { font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem; }

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
    .role-check input { accent-color: var(--pln-blue); }
</style>
@endpush

@section('content')
<div class="form-topbar">
    <div>
        <a href="{{ route('admin.pages.index') }}" class="form-back-btn mb-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="form-page-title">{{ $page ? 'Edit Halaman' : 'Tambah Halaman' }}</h1>
        <p class="form-page-subtitle">
            @if ($page)
                /halaman/{{ $page->slug }}
            @else
                Isi identitas halaman dulu, lalu tambahkan konten per section.
            @endif
        </p>
    </div>
    <button type="submit" form="pageForm" class="form-btn-save">
        <i class="fas fa-floppy-disk"></i> Simpan Halaman
    </button>
</div>

<form id="pageForm" method="POST"
      action="{{ $page ? route('admin.pages.update', $page) : route('admin.pages.store') }}">
    @csrf
    @if ($page)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="icon-circle"><i class="fas fa-circle-info"></i></div>
            <h6>Identitas Halaman</h6>
        </div>
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label-mod" for="title">Judul Halaman <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $page->title ?? '') }}"
                       class="form-control-mod @error('title') is-invalid @enderror" required autofocus>
                @error('title')<div class="invalid-feedback-mod">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label-mod" for="status">Status <span class="text-danger">*</span></label>
                <select id="status" name="status" class="form-control-mod">
                    <option value="draft" @selected(old('status', $page->status ?? 'draft') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $page->status ?? '') === 'published')>Terbit</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-header">
            <div class="icon-circle"><i class="fas fa-lock"></i></div>
            <h6>Visibilitas</h6>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label-mod" for="visibility">Siapa yang boleh melihat?</label>
                <select id="visibility" name="visibility" class="form-control-mod">
                    <option value="public" @selected(old('visibility', $page->visibility ?? 'public') === 'public')>
                        Publik — semua pengunjung
                    </option>
                    <option value="role_restricted" @selected(old('visibility', $page->visibility ?? '') === 'role_restricted')>
        Role Terbatas — hanya role terpilih (wajib login)
                    </option>
                </select>
                <div class="form-hint">
                    Visibilitas di-enforce di server: halaman ber-role yang diakses tanpa hak akan tampil 404.
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-label-mod">Role yang diizinkan</div>
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
                <div class="form-hint">Hanya berlaku saat visibilitas "Role Terbatas". Tanpa role terpilih, halaman terkunci.</div>
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
</form>

@if ($page)
    {{-- ================= SECTIONS ================= --}}
    <div class="form-section">
        <div class="form-section-header" style="justify-content: space-between;">
            <div class="d-flex align-items-center" style="gap:0.65rem;">
                <div class="icon-circle"><i class="fas fa-layer-group"></i></div>
                <h6>Konten Halaman (Sections)</h6>
            </div>
            @can('pages.edit')
            <form method="POST" action="{{ route('admin.pages.sections.store', $page) }}" class="d-flex gap-2">
                @csrf
                <select name="type" class="form-control-mod" style="width:auto;" required>
                    @foreach (\App\Models\PageSection::TYPES as $typeKey => $typeLabel)
                        <option value="{{ $typeKey }}">{{ $typeLabel }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-mini" style="padding:0.5rem 1rem;">
                    <i class="fas fa-plus"></i> Tambah Section
                </button>
            </form>
            @endcan
        </div>

        @if ($page->sections->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="fas fa-layer-group fa-2x mb-3 d-block" style="color:#d1d5db;"></i>
                Belum ada section. Pilih jenis section di atas lalu klik "Tambah Section".
            </div>
        @endif

        @foreach ($page->sections as $i => $section)
            <div class="section-item {{ $errors->has('sections.' . $i) ? 'open' : '' }}" id="section-{{ $section->id }}">
                <div class="section-item-head" onclick="this.parentElement.classList.toggle('open')">
                    <div class="left">
                        <span class="num">{{ $i + 1 }}</span>
                        <span class="type-label">{{ $section->typeLabel() }}</span>
                        @if ($section->type === 'text' && $section->dataValue('heading'))
                            <span class="text-muted small">— {{ \Illuminate\Support\Str::limit($section->dataValue('heading'), 40) }}</span>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @can('pages.edit')
                        <span class="section-move-forms" onclick="event.stopPropagation();">
                            <form method="POST" action="{{ route('admin.pages.sections.move', [$page, $section]) }}">
                                @csrf
                                <input type="hidden" name="direction" value="up">
                                <button type="submit" class="btn-mini" title="Naikkan" @disabled($loop->first)>
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.pages.sections.move', [$page, $section]) }}">
                                @csrf
                                <input type="hidden" name="direction" value="down">
                                <button type="submit" class="btn-mini" title="Turunkan" @disabled($loop->last)>
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            </form>
                        </span>
                        @endcan
                        @can('pages.delete')
                        <span onclick="event.stopPropagation();">
                            <form method="POST" action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}"
                                  onsubmit="return confirm('Hapus section ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-mini danger" title="Hapus section">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </span>
                        @endcan
                        <i class="fas fa-chevron-down chev"></i>
                    </div>
                </div>
                <div class="section-item-body">
                    <form method="POST" action="{{ route('admin.pages.sections.update', [$page, $section]) }}">
                        @csrf
                        @include('admin.pages.partials.section-fields', ['section' => $section])
                        <button type="submit" class="form-btn-save" style="padding:0.5rem 1.25rem;">
                            <i class="fas fa-floppy-disk"></i> Simpan Section
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- ============================================================
     Script INLINE di dalam content section — WAJIB di sini (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     menukar isi <main> dan mengeksekusi ulang <script> di dalamnya.
     ============================================================ --}}
<script>
    (function() {
        // Saat visibility = public, matikan checkbox role (tidak dipakai)
        var visibilitySelect = document.getElementById('visibility');
        var roleGrid = document.getElementById('roleGrid');
        if (!visibilitySelect || !roleGrid) return;

        function syncRoleGrid() {
            roleGrid.querySelectorAll('input').forEach(function (cb) {
                cb.disabled = (visibilitySelect.value !== 'role_restricted');
            });
        }
        visibilitySelect.addEventListener('change', syncRoleGrid);
        syncRoleGrid();
    })();
</script>
@endsection
