@extends('layouts.admin')

@section('title', 'Manajemen Link Kerja — E-PPID PLN')
@section('page-title', 'Link Kerja')

@push('styles')
<style>
    /* ============================================
       WORK LINKS — pola halaman Pengumuman (tabel)
       ============================================ */
    .worklink-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        white-space: nowrap;
    }
    .worklink-badge.umum {
        background: #dcfce7;
        color: #166534;
    }
    .worklink-badge.khusus {
        background: rgba(0, 143, 168, 0.14);
        color: #007790;
    }
    .worklink-status-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        white-space: nowrap;
    }
    .worklink-status-badge.aktif {
        background: #dcfce7;
        color: #166534;
    }
    .worklink-status-badge.nonaktif {
        background: #fee2e2;
        color: #b91c1c;
    }
    .worklink-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #008fa8, #00566b);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .worklink-url {
        color: var(--ink-faint);
        font-size: 0.78rem;
        font-family: monospace;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 280px;
    }
    .target-cell {
        font-size: 0.8rem;
        color: var(--ink-muted);
        white-space: nowrap;
    }

    /* ============================================
       DELETE CONFIRMATION MODAL (pola news modal)
       ============================================ */
    .worklink-delete-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(4px);
    }
    .worklink-delete-overlay.show { display: flex; }
    .worklink-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: worklinkDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes worklinkDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .worklink-delete-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 1rem;
        background: #FEE2E2;
        color: #DC2626;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }
    .worklink-delete-title { font-size: 1.05rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .worklink-delete-text { font-size: 0.88rem; color: #6b7280; line-height: 1.6; margin: 0 0 0.35rem; }
    .worklink-delete-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1f2937;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin: 0.75rem 0 1.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .worklink-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
    .worklink-delete-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .worklink-delete-btn.cancel { background: #f3f4f6; color: #6b7280; }
    .worklink-delete-btn.cancel:hover { background: #e5e7eb; color: #374151; }
    .worklink-delete-btn.confirm { background: #DC2626; color: #fff; }
    .worklink-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    /* ============================================
       EDIT MODAL (pop-up update tanpa pindah halaman)
       ============================================ */
    .worklink-edit-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(4px);
    }
    .worklink-edit-overlay.show { display: flex; }
    .worklink-edit-dialog {
        background: #fff;
        border-radius: 16px;
        width: 100%;
        max-width: 640px;
        max-height: 92vh;
        max-height: 92dvh;   /* viewport dinamis (mobile browser) */
        display: flex;
        flex-direction: column;
        min-height: 0;
        overflow: hidden;    /* rounded corner memotong body scroll */
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: worklinkEditIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes worklinkEditIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    /* Rantai flex dialog → form → body: tanpa ini body tumbuh melebihi
       dialog (min-height:auto) dan FOOTER TERDORONG keluar layar —
       penyebab tombol Batal/Simpan terpotong. */
    .worklink-edit-dialog > form {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
    }
    .worklink-edit-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.15rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        flex: 0 0 auto;
    }
    .worklink-edit-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }
    .worklink-edit-title i { color: var(--pln-blue, #005b9c); }
    .worklink-edit-close {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 8px;
        background: #f3f4f6;
        color: #6b7280;
        cursor: pointer;   /* affordance: tombol interaktif */
        pointer-events: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }
    .worklink-edit-close:hover { background: #e5e7eb; color: #374151; }
    .worklink-edit-body {
        padding: 1.25rem 1.5rem;
        flex: 1 1 auto;
        min-height: 0;        /* kunci scroll di dalam flex column */
        overflow-y: auto;
        overscroll-behavior: contain;
    }
    .worklink-edit-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid #e5e7eb;
        flex: 0 0 auto;       /* footer selalu terlihat utuh */
        flex-wrap: wrap;
    }
    .worklink-edit-info {
        font-size: 0.72rem;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }
    .worklink-edit-actions { display: flex; gap: 0.6rem; }
    .worklink-edit-btn {
        padding: 0.6rem 1.4rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;   /* affordance: tombol interaktif */
        pointer-events: auto;
        transition: all 0.2s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .worklink-edit-btn.cancel { background: #f3f4f6; color: #6b7280; }
    .worklink-edit-btn.cancel:hover { background: #e5e7eb; color: #374151; }
    .worklink-edit-btn.save { background: var(--pln-blue, #005b9c); color: #fff; }
    .worklink-edit-btn.save:hover { background: #004a7c; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0, 91, 156, 0.3); }
    .worklink-edit-btn.save:disabled { opacity: 0.65; cursor: not-allowed; transform: none; box-shadow: none; }

    /* Layar kecil: footer actions pindah baris, tombol full-width —
       tidak ada tombol terpotong. */
    @media (max-width: 576px) {
        .worklink-edit-overlay { padding: 0.5rem; }
        .worklink-edit-dialog { max-height: 96dvh; border-radius: 14px; }
        .worklink-edit-head { padding: 0.9rem 1rem; }
        .worklink-edit-body { padding: 1rem; }
        .worklink-edit-footer { padding: 0.75rem 1rem; }
        .worklink-edit-info { display: none; }
        .worklink-edit-actions { width: 100%; }
        .worklink-edit-actions .worklink-edit-btn { flex: 1; justify-content: center; }
    }

    /* Preview ikon (pola icon-preview form) */
    .wl-icon-wrap { display: flex; align-items: center; gap: 0.5rem; }
    .wl-icon-preview {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #008fa8, #00566b);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    html.theme-dark .worklink-edit-dialog { background: var(--panel, #1f2937); }
    html.theme-dark .worklink-edit-head,
    html.theme-dark .worklink-edit-footer { border-color: var(--line, #374151); }
    html.theme-dark .worklink-edit-title { color: var(--ink-heading, #f9fafb); }
    html.theme-dark .worklink-edit-close { background: var(--panel-2, #111827); color: var(--ink-muted, #9ca3af); }
    html.theme-dark .worklink-edit-info { color: var(--ink-faint, #6b7280); }

    /* Target khusus dalam modal (pola #targetKhususPanel form) */
    .worklink-target-panel {
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        background: #f9fafb;
    }
    html.theme-dark .worklink-target-panel { border-color: var(--line, #374151); background: var(--panel, #111827); }
    .worklink-target-panel.hidden-panel { display: none; }

    /* Kategori pill di dalam modal (pola category-pill form) */
    .wl-modal-pills { display: flex; gap: 0.5rem; flex-wrap: wrap; }
    .wl-modal-pill { position: relative; }
    .wl-modal-pill input { display: none; }
    .wl-modal-pill-label {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 0.95rem;
        border-radius: 10px;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #6b7280;
    }
    html.theme-dark .wl-modal-pill-label { background: var(--panel, #1f2937); border-color: var(--line, #374151); color: var(--ink-muted, #9ca3af); }
    .wl-modal-pill-label:hover {
        border-color: #94a3b8;
        background: #f9fafb;
        transform: translateY(-1px);
    }
    html.theme-dark .wl-modal-pill-label:hover { border-color: var(--ink-faint, #6b7280); background: var(--panel-hover, #111827); }
    .wl-modal-pill input:checked + .wl-modal-pill-label {
        color: #fff;
        border-color: transparent;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    .wl-modal-pill input:checked + .wl-modal-pill-label.cat-umum   { background: #16a34a; }
    .wl-modal-pill input:checked + .wl-modal-pill-label.cat-khusus { background: var(--pln-blue, #005b9c); }

    /* Status radio di dalam modal (pola status-radio form) */
    .wl-modal-status span {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.5rem 0.95rem;
        border-radius: 10px;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    html.theme-dark .wl-modal-status span { background: var(--panel, #1f2937); border-color: var(--line, #374151); color: var(--ink-muted, #9ca3af); }
    /* Radio disembunyikan visual (tetap ada di DOM → terkirim saat
       disubmit); klik label tetap men-toggle nilai radio. */
    .wl-modal-status { position: relative; }
    .wl-modal-status input {
        position: absolute;
        opacity: 0;
        width: 1px;
        height: 1px;
        margin: 0;
        pointer-events: none;
    }
    .wl-modal-status:hover span { border-color: #94a3b8; transform: translateY(-1px); }
    .wl-modal-status:has(input:checked) span {
        border-color: var(--pln-blue, #005b9c);
        background: #f0f7ff;
        color: var(--pln-blue, #005b9c);
    }
    .wl-modal-status:has(input:focus-visible) span {
        outline: 2px solid var(--pln-blue, #005b9c);
        outline-offset: 2px;
    }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER (pola /admin/announcements)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-link header-icon"></i>Manajemen Link Kerja</h5>
            <p>Kelola tautan alat kerja yang tampil di Portal Karyawan</p>
        </div>
        @can('work_links.create')
        <a href="{{ route('admin.work-links.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Link Kerja
        </a>
        @endcan
    </div>

    <div class="stat-chips-row">
        <div class="stat-chip">
            <span class="stat-dot blue"></span>
            Total
            <span class="stat-number">{{ $links->total() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot green"></span>
            Aktif
            <span class="stat-number">{{ \App\Models\WorkLink::where('is_active', true)->count() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot amber"></span>
            Nonaktif
            <span class="stat-number">{{ \App\Models\WorkLink::where('is_active', false)->count() }}</span>
        </div>
    </div>
</div>

{{-- ============================================
     FILTER BAR
     ============================================ --}}
<div class="page-filter-bar">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" class="filter-input" placeholder="Cari nama link atau URL..." value="{{ request('q') }}">
    </div>
    <div class="filter-divider"></div>
    <select id="filterCategory" class="filter-input" style="width:auto;">
        <option value="">Semua Kategori</option>
        <option value="umum" {{ request('kategori') === 'umum' ? 'selected' : '' }}>Umum</option>
        <option value="khusus" {{ request('kategori') === 'khusus' ? 'selected' : '' }}>Khusus</option>
    </select>
    <select id="filterStatus" class="filter-input" style="width:auto;">
        <option value="">Semua Status</option>
        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>
    <div class="filter-divider"></div>
    <span class="filter-count">{{ $links->total() }} link kerja</span>
</div>

{{-- ============================================
     WORK LINK TABLE
     ============================================ --}}
<div class="dash-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Link</th>
                    <th class="col-hide-mobile">URL</th>
                    <th>Kategori</th>
                    <th>Target Bidang</th>
                    <th>Target Sub-Bidang</th>
                    <th>Status</th>
                    <th class="th-actions">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($links as $item)
                @php
                    $wlOwnerLabel = $item->category === \App\Models\WorkLink::CATEGORY_UMUM
                        ? 'UMUM'
                        : (\App\Models\User::DEPARTMENTS[$item->department] ?? $item->department);
                    $wlCanEdit = auth()->check() && (
                        auth()->user()->isSuperAdmin()
                        || ($item->category === \App\Models\WorkLink::CATEGORY_KHUSUS
                            && $item->department === auth()->user()->boundDepartment())
                    );
                @endphp
                <tr data-id="{{ $item->id }}"
                    data-title="{{ strtolower($item->title) }}"
                    data-url="{{ strtolower($item->url) }}"
                    data-category="{{ $item->category }}"
                    data-status="{{ $item->is_active ? 'aktif' : 'nonaktif' }}"
                    data-can-edit="{{ $wlCanEdit ? 'true' : 'false' }}"
                    data-owner-label="{{ $wlOwnerLabel }}"
                    data-user-department-label="{{ auth()->check() ? (\App\Models\User::DEPARTMENTS[auth()->user()->boundDepartment()] ?? '') : '' }}"
                    data-link="{{ e(json_encode($item->only(['id', 'title', 'url', 'description', 'icon', 'category', 'department', 'sub_department', 'is_active']))) }}">
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="worklink-icon"><i class="fas {{ $item->icon ?: 'fa-link' }}"></i></span>
                            <div style="min-width: 0;">
                                <div class="worklink-name" style="font-weight: 600; color: var(--ink-heading); font-size: 0.88rem;">
                                    {{ $item->title }}
                                </div>
                                @if ($item->description)
                                    <div class="worklink-desc" style="color: var(--ink-faint); font-size: 0.76rem; max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $item->description }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="col-hide-mobile">
                        <a href="{{ $item->url }}" target="_blank" rel="noopener" class="worklink-url" title="{{ $item->url }}">
                            {{ $item->url }}
                        </a>
                    </td>
                    <td>
                        <span class="worklink-badge {{ $item->category }}">{{ ucfirst($item->category) }}</span>
                    </td>
                    <td>
                        <span class="target-cell">
                            {{ $item->category === 'umum' ? '—' : (\App\Models\User::DEPARTMENTS[$item->department] ?? '-') }}
                        </span>
                    </td>
                    <td>
                        <span class="target-cell">
                            @if ($item->category === 'umum' || ! $item->sub_department)
                                —
                            @else
                                {{ \App\Models\User::subDepartmentLabel($item->department, $item->sub_department) ?? $item->sub_department }}
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="worklink-status-badge {{ $item->is_active ? 'aktif' : 'nonaktif' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="td-actions">
                        <div class="d-flex gap-1 justify-content-end">
                            @can('work_links.edit')
                            {{-- Edit via pop-up modal (tanpa pindah halaman).
                                 Klik diblokir via JS bila link bukan milik
                                 bidang admin yang login (SweetAlert). --}}
                            <button type="button" class="news-action-btn edit" title="Edit"
                                    onclick="openWorkLinkEditModal(this)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form action="{{ route('admin.work-links.toggle-status', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="news-action-btn {{ $item->is_active ? 'unpublish' : 'publish' }}"
                                        title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fas {{ $item->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                </button>
                            </form>
                            @endcan
                            @can('work_links.delete')
                            <button type="button" class="news-action-btn delete" title="Hapus"
                                    onclick="openWorkLinkDeleteModal('{{ route('admin.work-links.destroy', $item) }}', '{{ addslashes($item->title) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="news-empty-state" style="grid-column: auto; border: none;">
                            <div class="empty-icon"><i class="fas fa-link"></i></div>
                            <h6>Belum ada link kerja</h6>
                            <p>Klik tombol "Tambah Link Kerja" untuk membuat tautan baru untuk Portal Karyawan.</p>
                            @can('work_links.create')
                            <a href="{{ route('admin.work-links.create') }}" class="btn-corp btn-corp-add">
                                <i class="fas fa-plus"></i> Tambah Link Pertama
                            </a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($links->hasPages())
    <div class="page-pagination">
        <div class="pagination">
            @if ($links->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-btn" href="{{ $links->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($links->getUrlRange(max(1, $links->currentPage() - 2), min($links->lastPage(), $links->currentPage() + 2)) as $page => $url)
                <a class="page-btn {{ $page == $links->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
            @endforeach

            @if ($links->hasMorePages())
                <a class="page-btn" href="{{ $links->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="page-btn disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @endif
</div>

{{-- ============================================
     DELETE CONFIRMATION MODAL
     ============================================ --}}
<div class="worklink-delete-overlay" id="deleteWorkLinkModal">
    <div class="worklink-delete-dialog">
        <div class="worklink-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="worklink-delete-title">Hapus Link Kerja?</h6>
        <p class="worklink-delete-text">Apakah Anda yakin ingin menghapus link kerja ini?</p>
        <div class="worklink-delete-name" id="deleteWorkLinkTitle"></div>
        <div class="worklink-delete-actions">
            <button class="worklink-delete-btn cancel" onclick="closeWorkLinkDeleteModal()">Batal</button>
            <form id="deleteWorkLinkForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="worklink-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================
     EDIT MODAL — pop-up update tanpa pindah halaman.
     Diisi via JS dari data-link pada baris tabel;
     submit AJAX → update baris tanpa reload.
     ============================================ --}}
@php
    /* Konteks modal edit — pola formContext() di WorkLinkController:
       Admin Bidang → daftar bidang & sub-bidang dikunci ke bidangnya. */
    $wlBoundDept = auth()->check() && ! auth()->user()->isSuperAdmin()
        ? auth()->user()->boundDepartment()
        : null;

    $wlDepartments = $wlBoundDept !== null
        ? array_intersect_key(\App\Models\User::DEPARTMENTS, [$wlBoundDept => true])
        : \App\Models\User::DEPARTMENTS;

    $wlSubDepartments = $wlBoundDept !== null
        ? array_intersect_key(\App\Models\User::SUB_DEPARTMENTS, [$wlBoundDept => true])
        : \App\Models\User::SUB_DEPARTMENTS;

    /* Daftar ikon FontAwesome (library ikon yang dipakai layout admin).
       Nilai 'value' = nama class yang disimpan ke DB; label = nama ikon
       pada library (bukan istilah fungsional seperti "Link (umum)"). */
    $wlIconOptions = [
        'fa-link'             => 'Link',
        'fa-globe'            => 'Globe / Website',
        'fa-file-lines'       => 'File / Dokumen',
        'fa-database'         => 'Database',
        'fa-shield-halved'    => 'Shield / Keamanan',
        'fa-server'           => 'Server',
        'fa-gauge-high'       => 'Gauge / Dashboard',
        'fa-chart-line'       => 'Chart / Grafik',
        'fa-envelope'         => 'Envelope / Email',
        'fa-users'            => 'Users / Grup',
        'fa-fingerprint'      => 'Fingerprint / Presensi',
        'fa-graduation-cap'   => 'Graduation Cap / E-Learning',
        'fa-screwdriver-wrench' => 'Screwdriver / Pemeliharaan',
        'fa-coins'            => 'Coins / Keuangan',
        'fa-helmet-safety'    => 'Helmet / K3',
        'fa-folder-open'      => 'Folder / Arsip',
        'fa-book-open'        => 'Book / Logbook',
        'fa-list-check'       => 'List Check / Work Order',
        'fa-calendar-check'   => 'Calendar / Jadwal',
        'fa-headset'          => 'Headset / Helpdesk',
        'fa-cloud-arrow-up'   => 'Cloud Upload / Storage',
        'fa-building'         => 'Building / Fasilitas',
    ];
@endphp

<div class="worklink-edit-overlay" id="workLinkEditModal" aria-hidden="true">
    <div class="worklink-edit-dialog" role="dialog" aria-modal="true" aria-labelledby="workLinkEditTitleBar">
        <div class="worklink-edit-head">
            <h6 class="worklink-edit-title" id="workLinkEditTitleBar">
                <i class="fas fa-pen-to-square"></i> Edit Link Kerja
            </h6>
            <button type="button" class="worklink-edit-close" onclick="closeWorkLinkEditModal()" aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>

        <form id="workLinkEditForm" method="POST" action="" novalidate>
            @csrf
            @method('PUT')

            <div class="worklink-edit-body">
                <div class="form-group">
                    <label class="form-group-label" for="wlEditTitle">
                        Title / Nama Link <span class="required">*</span>
                    </label>
                    <input type="text" id="wlEditTitle" name="title" class="form-input"
                           placeholder="Contoh: Dashboard Kontrol Pembangkit" maxlength="255">
                </div>

                <div class="row g-2">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label class="form-group-label" for="wlEditUrl">
                                URL Tujuan <span class="required">*</span>
                            </label>
                            <input type="text" id="wlEditUrl" name="url" class="form-input"
                                   placeholder="https://contoh.pln-np.co.id" maxlength="500">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="form-group-label" for="wlEditIcon">Select Icon</label>
                            <div class="wl-icon-wrap">
                                <span class="wl-icon-preview" id="wlEditIconPreview">
                                    <i class="fas fa-link" id="wlEditIconPreviewEl"></i>
                                </span>
                                <select id="wlEditIcon" name="icon" class="form-input" style="flex:1;">
                                    @foreach ($wlIconOptions as $wlIconValue => $wlIconLabel)
                                        <option value="{{ $wlIconValue }}">{{ $wlIconLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-hint flex">
                                <i class="far fa-lightbulb"></i> Ikon FontAwesome yang tampil di kartu link Portal Karyawan
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-group-label" for="wlEditDescription">
                        Deskripsi Singkat <span class="optional">(opsional)</span>
                    </label>
                    <textarea id="wlEditDescription" name="description" class="form-input"
                              rows="2" maxlength="1000"
                              placeholder="Jelaskan fungsi singkat link ini..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-group-label">Kategori <span class="required">*</span></label>
                    <div class="wl-modal-pills">
                        <div class="wl-modal-pill">
                            <input type="radio" name="category" value="umum" id="wlEditCatUmum" checked>
                            <label for="wlEditCatUmum" class="wl-modal-pill-label cat-umum">
                                <i class="fas fa-users"></i> Umum
                            </label>
                        </div>
                        <div class="wl-modal-pill">
                            <input type="radio" name="category" value="khusus" id="wlEditCatKhusus">
                            <label for="wlEditCatKhusus" class="wl-modal-pill-label cat-khusus">
                                <i class="fas fa-user-lock"></i> Khusus
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Panel target khusus — tampil hanya saat kategori Khusus.
                     Admin Bidang: Bidang Utama terkunci sesuai bidang admin. --}}
                <div class="worklink-target-panel hidden-panel" id="wlEditTargetPanel">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-group-label" for="wlEditDepartment">
                                    Bidang Utama <span class="required">*</span>
                                    @if ($wlBoundDept)
                                        <span class="optional"><i class="fas fa-lock" style="font-size:0.7rem;"></i> terkunci</span>
                                    @endif
                                </label>
                                <select id="wlEditDepartment" name="department" class="form-input"
                                        @if ($wlBoundDept) disabled @endif>
                                    <option value="">— Pilih Bidang Utama —</option>
                                    @foreach ($wlDepartments as $wlDeptKey => $wlDeptLabel)
                                        <option value="{{ $wlDeptKey }}" {{ $wlBoundDept === $wlDeptKey ? 'selected' : '' }}>{{ $wlDeptLabel }}</option>
                                    @endforeach
                                </select>
                                @if ($wlBoundDept)
                                    {{-- select disabled tidak dikirim browser →
                                         kirim nilai via hidden input. --}}
                                    <input type="hidden" name="department" value="{{ $wlBoundDept }}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-group-label" for="wlEditSubDepartment">
                                    Sub-Bidang <span class="optional">(opsional)</span>
                                </label>
                                <select id="wlEditSubDepartment" name="sub_department" class="form-input">
                                    <option value="">— Semua Sub-Bidang (level Bidang) —</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-group-label">Status Link</label>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <label class="wl-modal-status">
                            <input type="radio" name="is_active" value="1" id="wlEditActive" checked>
                            <span><i class="fas fa-eye me-1" style="color: var(--pln-cyan);"></i> Aktif</span>
                        </label>
                        <label class="wl-modal-status">
                            <input type="radio" name="is_active" value="0" id="wlEditInactive">
                            <span><i class="fas fa-eye-slash me-1" style="color: #9ca3af;"></i> Nonaktif</span>
                        </label>
                        {{-- Nilai is_active yang benar-benar dikirim: divalidasi
                             JS terhadap radio, lalu ditimpa sebelum fetch. --}}
                        <input type="hidden" name="is_active_confirmed" id="wlEditActiveConfirmed" value="1">
                    </div>
                </div>
            </div>

            <div class="worklink-edit-footer">
                <div class="worklink-edit-info">
                    <i class="fas fa-circle-info"></i> Perubahan tersimpan tanpa memuat ulang halaman
                </div>
                <div class="worklink-edit-actions">
                    <button type="button" class="worklink-edit-btn cancel" onclick="closeWorkLinkEditModal()">Batal</button>
                    <button type="submit" class="worklink-edit-btn save" id="workLinkEditSubmit">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Data referensi untuk modal edit & pembaruan baris tabel (JS) --}}
<script id="workLinkDepartmentsData" type="application/json">@json($wlDepartments)</script>
<script id="workLinkSubDepartmentsData" type="application/json">@json($wlSubDepartments)</script>

{{-- Script inline — WAJIB di dalam content agar router.js
     mengeksekusi ulang setelah navigasi SPA. --}}
<script>
    (function() {
        const searchInput = document.getElementById('searchInput');
        const filterCategory = document.getElementById('filterCategory');
        const filterStatus = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('tbody tr[data-title]');

        function applyFilters() {
            const search = (searchInput?.value ?? '').toLowerCase();
            const category = filterCategory?.value ?? '';
            const status = filterStatus?.value ?? '';

            rows.forEach(function(row) {
                const title = row.dataset.title || '';
                const url = row.dataset.url || '';
                const rowCategory = row.dataset.category || '';
                const rowStatus = row.dataset.status || '';

                const matchSearch = !search || title.includes(search) || url.includes(search);
                const matchCategory = !category || rowCategory === category;
                const matchStatus = !status || rowStatus === status;

                row.style.display = (matchSearch && matchCategory && matchStatus) ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);
        filterCategory?.addEventListener('change', applyFilters);
        filterStatus?.addEventListener('change', applyFilters);
    })();

    if (!window.__workLinkDeleteModalBound) {
        window.__workLinkDeleteModalBound = true;

        window.openWorkLinkDeleteModal = function(url, title) {
            const modal = document.getElementById('deleteWorkLinkModal');
            document.getElementById('deleteWorkLinkTitle').textContent = title;
            document.getElementById('deleteWorkLinkForm').action = url;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        };

        window.closeWorkLinkDeleteModal = function() {
            document.getElementById('deleteWorkLinkModal').classList.remove('show');
            document.body.style.overflow = '';
        };

        document.getElementById('deleteWorkLinkModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeWorkLinkDeleteModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('deleteWorkLinkModal')?.classList.contains('show')) {
                closeWorkLinkDeleteModal();
            }
        });
    }

    /* ============================================================
       EDIT MODAL — pop-up update tanpa pindah halaman
       ------------------------------------------------------------
       - Tombol Edit ada di semua baris untuk semua role.
       - Link milik bidang sendiri (atau Super Admin) → modal
         terisi data link otomatis dari data-link baris tabel.
       - Link 'umum' / milik bidang lain → TIDAK pindah halaman
         (tidak ada redirect ke /edit), cukup SweetAlert
         "Akses Dibatasi".
       - Submit → AJAX PUT → baris tabel diperbarui di tempat
         tanpa reload browser.
       ============================================================ */
    if (!window.__workLinkEditModalBound) {
        window.__workLinkEditModalBound = true;

        const WlEdit = (function() {
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';

            let currentRow = null;
            let currentId  = null;

            /* Referensi DOM di-lookup DINAMIS (pola delete modal):
               router.js mengganti konten halaman saat navigasi SPA —
               elemen yang di-cache di closure menjadi basi. */
            const overlayEl   = () => document.getElementById('workLinkEditModal');
            const formEl      = () => document.getElementById('workLinkEditForm');
            const panelEl     = () => document.getElementById('wlEditTargetPanel');
            const deptSelEl   = () => document.getElementById('wlEditDepartment');
            const subSelEl    = () => document.getElementById('wlEditSubDepartment');
            const submitBtnEl = () => document.getElementById('workLinkEditSubmit');

            function refData() {
                let depts = {}, subs = {};
                try {
                    depts = JSON.parse(document.getElementById('workLinkDepartmentsData')?.textContent || '{}');
                    subs  = JSON.parse(document.getElementById('workLinkSubDepartmentsData')?.textContent || '{}');
                } catch (e) { /* data referensi belum ter-render */ }
                return { depts: depts, subs: subs };
            }

            /* ---- Baris tabel: pemetaan kolom <- payload link ---- */
            function ownerLabel(link, depts) {
                if (link.category === 'umum') return '—';
                return depts[link.department] || link.department || '-';
            }

            function subLabel(link, subs) {
                if (link.category !== 'khusus' || !link.sub_department) return '—';
                return (subs[link.department] || {})[link.sub_department] || link.sub_department;
            }

            function updateRow(link) {
                const row = currentRow;
                if (!row) return;
                const refs = refData();

                row.dataset.title    = (link.title || '').toLowerCase();
                row.dataset.url      = (link.url || '').toLowerCase();
                row.dataset.category = link.category;
                row.dataset.status   = link.is_active ? 'aktif' : 'nonaktif';

                // Kolom Nama + deskripsi
                const nameEl = row.querySelector('.worklink-name');
                if (nameEl) nameEl.textContent = link.title || '';
                const descEl = row.querySelector('.worklink-desc');
                if (descEl) {
                    if (link.description) {
                        descEl.textContent = link.description;
                        descEl.style.display = '';
                    } else {
                        descEl.style.display = 'none';
                    }
                }

                // Icon
                const iconEl = row.querySelector('.worklink-icon i');
                if (iconEl) iconEl.className = 'fas ' + (link.icon || 'fa-link');

                // URL
                const urlEl = row.querySelector('a.worklink-url');
                if (urlEl) {
                    urlEl.href = link.url || '#';
                    urlEl.textContent = link.url || '';
                    urlEl.title = link.url || '';
                }

                // Badge kategori
                const catEl = row.querySelector('.worklink-badge');
                if (catEl) {
                    catEl.className = 'worklink-badge ' + (link.category === 'umum' ? 'umum' : 'khusus');
                    catEl.textContent = link.category === 'umum' ? 'Umum' : 'Khusus';
                }

                // Target bidang / sub-bidang
                const cells = row.querySelectorAll('td');
                if (cells[3]) cells[3].querySelector('.target-cell').textContent = ownerLabel(link, refs.depts);
                if (cells[4]) cells[4].querySelector('.target-cell').textContent = subLabel(link, refs.subs);

                // Badge status
                const stEl = row.querySelector('.worklink-status-badge');
                if (stEl) {
                    stEl.className = 'worklink-status-badge ' + (link.is_active ? 'aktif' : 'nonaktif');
                    stEl.textContent = link.is_active ? 'Aktif' : 'Nonaktif';
                }
            }

            /* ---- Stat chips (Total/Aktif/Nonaktif) ikut bergeser bila
               status aktif berubah lewat modal — tanpa reload ---- */
            function updateStats(wasActive, nowActive) {
                if (wasActive === nowActive) return;
                const numbers = document.querySelectorAll('.stat-chip .stat-number');
                if (numbers.length < 3) return;
                const aktif    = parseInt(numbers[1].textContent, 10) || 0;
                const nonaktif = parseInt(numbers[2].textContent, 10) || 0;
                if (nowActive) {
                    numbers[1].textContent = aktif + 1;
                    numbers[2].textContent = Math.max(0, nonaktif - 1);
                } else {
                    numbers[1].textContent = Math.max(0, aktif - 1);
                    numbers[2].textContent = nonaktif + 1;
                }
            }

            /* ---- Dropdown sub-bidang dinamis (pola form) ---- */
            function fillSubOptions(department, selected) {
                const subSel = subSelEl();
                if (!subSel) return;
                const subs = refData().subs[department] || {};
                subSel.innerHTML = '<option value="">— Semua Sub-Bidang (level Bidang) —</option>';
                Object.keys(subs).forEach(function(key) {
                    const opt = document.createElement('option');
                    opt.value = key;
                    opt.textContent = subs[key];
                    if (key === selected) opt.selected = true;
                    subSel.appendChild(opt);
                });
            }

            /* ---- Toggle panel target sesuai kategori ---- */
            function togglePanel() {
                const panel = panelEl(), form = formEl();
                if (!panel || !form) return;
                panel.classList.toggle('hidden-panel',
                    !(form.querySelector('input[name="category"]:checked')?.value === 'khusus'));
            }

            /* ---- Preview ikon live (select ↔ kotak preview) ---- */
            function syncIconPreview() {
                const form = formEl();
                const sel = form?.querySelector('[name="icon"]');
                const el = document.getElementById('wlEditIconPreviewEl');
                if (sel && el) el.className = 'fas ' + (sel.value || 'fa-link');
            }

            /* ---- Live validation: bersihkan border merah begitu
               field diisi ulang (bukan hanya saat submit) ---- */
            function clearInvalidIfFilled(input) {
                if (input && input.classList.contains('is-invalid') && input.value.trim()) {
                    input.classList.remove('is-invalid');
                }
            }

            function open(row) {
                const form = formEl(), overlay = overlayEl();
                const deptSel = deptSelEl();
                if (!form || !overlay) return;

                currentRow = row;
                currentId = row.dataset.id || null;

                let link = {};
                try { link = JSON.parse(row.dataset.link); } catch (e) { link = {}; }

                // ---- POPULATE DATA EXISTING (edit mode) ----
                // Reset state error: jangan ada border merah sebelum
                // user benar-benar berinteraksi/men-submit.
                form.querySelectorAll('.is-invalid').forEach(function(el) {
                    el.classList.remove('is-invalid');
                });

                form.querySelector('[name="title"]').value       = link.title || '';
                form.querySelector('[name="url"]').value         = link.url || '';
                form.querySelector('[name="description"]').value = link.description || '';
                form.querySelector('[name="icon"]').value        = link.icon || 'fa-link';

                const cat = link.category === 'khusus' ? 'khusus' : 'umum';
                const catRadio = form.querySelector('input[name="category"][value="' + cat + '"]');
                if (catRadio) catRadio.checked = true;

                const dept = cat === 'khusus' ? (link.department || '') : '';
                if (deptSel && !deptSel.disabled) deptSel.value = dept;
                fillSubOptions(dept, link.sub_department || '');

                // Status Link: radio di-populate + hidden input disinkronkan
                // (nilai ini yang dipakai payload — lihat handleSubmit).
                const activeVal = link.is_active ? '1' : '0';
                const activeRadio = form.querySelector('input[name="is_active"][value="' + activeVal + '"]');
                if (activeRadio) activeRadio.checked = true;
                const confirmed = form.querySelector('#wlEditActiveConfirmed');
                if (confirmed) confirmed.value = activeVal;

                syncIconPreview();
                togglePanel();
                form.action = '{{ url('admin/work-links') }}/' + currentId;

                overlay.classList.add('show');
                overlay.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                form.querySelector('[name="title"]').focus();
            }

            function close() {
                const overlay = overlayEl();
                if (overlay) {
                    overlay.classList.remove('show');
                    overlay.setAttribute('aria-hidden', 'true');
                }

                /* ---- CLEANUP: reset form + state error ----
                   open() mengisi ulang semua field dari data-link baris,
                   jadi reset di sini aman & mencegah state basi. */
                const form = formEl();
                if (form) {
                    form.querySelectorAll('.is-invalid').forEach(function(el) {
                        el.classList.remove('is-invalid');
                    });
                    form.reset();
                    const confirmed = form.querySelector('#wlEditActiveConfirmed');
                    if (confirmed) confirmed.value = '1';
                }

                document.body.style.overflow = '';   // lepaskan lock scroll halaman
                currentRow = null;
                currentId = null;
            }

            function showToast(icon, title) {
                if (typeof Swal === 'undefined') return;
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: icon,
                    title: title,
                    showConfirmButton: false,
                    timer: 2600,
                    timerProgressBar: true
                });
            }

            /* ---- Submit AJAX → PUT JSON → update baris di tempat ---- */
            function handleSubmit(e) {
                const form = formEl();
                if (!form) return;
                e.preventDefault();

                // Validasi ringan (pola validasi form utama)
                const titleInput = form.querySelector('[name="title"]');
                const urlInput   = form.querySelector('[name="url"]');
                const deptSel    = deptSelEl();
                const subSel     = subSelEl();
                const submitBtn  = submitBtnEl();
                let firstInvalid = null;

                [titleInput, urlInput].forEach(function(inp) {
                    const empty = !(inp?.value ?? '').trim();
                    inp?.classList.toggle('is-invalid', empty);
                    if (empty && !firstInvalid) firstInvalid = inp;
                });

                if (form.querySelector('input[name="category"]:checked')?.value === 'khusus'
                    && !(deptSel?.value ?? '')) {
                    deptSel?.classList.add('is-invalid');
                    firstInvalid = firstInvalid || deptSel;
                } else {
                    deptSel?.classList.remove('is-invalid');
                }

                if (firstInvalid) {
                    firstInvalid.focus();
                    return;
                }

                // ---- STATUS LINK: sumber kebenaran = posisi radio saat
                // submit (bukan hidden input statis) — nilainya ditimpa
                // di sini sebelum fetch. Radio visual tetap yang menentukan.
                const activeConfirmed = form.querySelector('#wlEditActiveConfirmed');
                const isActive = form.querySelector('input[name="is_active"]:checked')?.value === '1';
                if (activeConfirmed) activeConfirmed.value = isActive ? '1' : '0';

                const payload = {
                    title:         titleInput.value.trim(),
                    url:           urlInput.value.trim(),
                    description:   form.querySelector('[name="description"]').value.trim(),
                    icon:          form.querySelector('[name="icon"]').value,
                    category:      form.querySelector('input[name="category"]:checked')?.value || 'umum',
                    department:    (deptSel && !deptSel.disabled) ? (deptSel.value || null) : (form.querySelector('input[name="department"][type="hidden"]')?.value ?? null),
                    sub_department: subSel?.value || null,
                    is_active:     isActive            // ← sebelumnya TIDAK PERNAH terkirim (bug)
                };
                if (payload.category === 'umum') {
                    payload.department = null;
                    payload.sub_department = null;
                }

                if (submitBtn) submitBtn.disabled = true;

                fetch(form.action, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(payload)
                })
                .then(function(res) {
                    if (res.status === 403) {
                        throw { accessDenied: true };
                    }
                    return res.json().catch(function() {
                        throw new Error('Terjadi kesalahan server (HTTP ' + res.status + ').');
                    });
                })
                .then(function(data) {
                    if (!data.success) {
                        throw new Error(data.message || 'Gagal memperbarui Link Kerja.');
                    }
                    updateStats(currentRow?.dataset.status === 'aktif', !!data.link.is_active);
                    updateRow(data.link);
                    close();
                    showToast('success', data.message || 'Link Kerja berhasil diperbarui.');
                })
                .catch(function(err) {
                    if (err && err.accessDenied) {
                        showToast('warning', 'Akses Dibatasi: data ini bukan milik bidang Anda.');
                        close();
                        return;
                    }
                    showToast('error', (err && err.message) ? err.message : 'Terjadi kesalahan jaringan.');
                })
                .finally(function() {
                    if (submitBtn) submitBtn.disabled = false;
                });
            };

            /* ---- Listener global (document-level, tahan SPA swap): ----
               submit form modal, interaksi kategori/bidang, overlay & Escape. */
            document.addEventListener('submit', function(e) {
                if (e.target && e.target.id === 'workLinkEditForm') handleSubmit(e);
            });

            document.addEventListener('change', function(e) {
                const form = formEl();
                if (!form || !form.contains(e.target)) return;

                // Kategori: Umum → sembunyikan target; Khusus → tampilkan
                if (e.target.name === 'category') togglePanel();

                // Bidang Utama berubah → isi ulang dropdown Sub-Bidang
                if (e.target === deptSelEl()) fillSubOptions(e.target.value, '');

                // Select Icon: update preview realtime
                if (e.target.name === 'icon') syncIconPreview();
            });

            document.addEventListener('input', function(e) {
                const form = formEl();
                if (!form || !form.contains(e.target)) return;
                if (e.target.name === 'title' || e.target.name === 'url') {
                    clearInvalidIfFilled(e.target);
                }
            });

            document.addEventListener('click', function(e) {
                const overlay = overlayEl();
                if (!overlay || !overlay.classList.contains('show')) return;

                // Klik pada area gelap (di luar dialog) → tutup
                if (e.target === overlay) { close(); return; }

                // Fallback: tombol Close (X) header & tombol Batal footer.
                // (Inline onclick memanggil window.closeWorkLinkEditModal;
                //  delegasi ini cadangan bila inline handler gagal dipanggil.)
                if (e.target.closest('.worklink-edit-close, .worklink-edit-btn.cancel')) {
                    e.preventDefault();
                    close();
                }
            });

            document.addEventListener('keydown', function(e) {
                const overlay = overlayEl();
                if (e.key === 'Escape' && overlay?.classList.contains('show')) close();
            });

            return { open: open, close: close, togglePanel: togglePanel };
        })();

        /* ============================================================
           API GLOBAL — dipanggil inline onclick di markup.
           closeWorkLinkEditModal WAJIB ada: tombol Close (X) & Batal
           memanggilnya; sebelumnya fungsi ini tidak pernah didefinisikan
           → ReferenceError → modal tak bisa ditutup.
           ============================================================ */
        window.closeWorkLinkEditModal = function() {
            WlEdit.close();
        };

        window.openWorkLinkEditModal = function(btn) {
            const row = btn.closest('tr');
            if (!row) return;

            // HAK AKSES: link milik bidang sendiri (atau Super Admin)?
            // Admin Bidang + link 'umum'/bidang lain → blokir via SweetAlert,
            // TANPA redirect ke /admin/work-links/{id}/edit.
            if (row.dataset.canEdit !== 'true') {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Akses Dibatasi',
                        html: 'Data ini milik <strong>' + (row.dataset.ownerLabel || 'bidang lain') + '</strong>. ' +
                            'Anda hanya dapat mengedit konten khusus Bidang <strong>' +
                            (row.dataset.userDepartmentLabel || 'Anda') + '</strong>.',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#d97706'
                    });
                }
                return;   // ← tidak ada navigasi apa pun
            }

            WlEdit.open(row);
        };
    }
</script>
@endsection
