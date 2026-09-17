@extends('layouts.admin')

@section('title', 'Log Aktivitas — E-PPID PLN')
@section('page-title', 'Log Aktivitas')

@push('styles')
<style>
    .log-action-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        white-space: nowrap;
    }
    .log-module-badge {
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
        background: #e0f2fe;
        color: #075985;
        white-space: nowrap;
    }
    .log-desc { font-size: 0.875rem; color: #374151; }
    .log-user {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        min-width: 170px;
    }
    .log-avatar {
        width: 32px;
        height: 32px;
        flex: 0 0 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.72rem;
    }
    .log-user-name { font-size: 0.82rem; font-weight: 600; color: #111827; line-height: 1.2; }
    .log-user-role { font-size: 0.7rem; color: #6b7280; }
    .log-time { font-size: 0.78rem; color: #6b7280; white-space: nowrap; }
    .log-ip { font-size: 0.7rem; color: #9ca3af; }

    .filter-select {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        font-size: 0.85rem;
        background: #fff;
        color: #374151;
    }
    .filter-select:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.1);
        outline: none;
    }
    .search-box {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    .search-box:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.1);
        outline: none;
    }
    .btn-clear-all {
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 0.5rem 0.9rem;
        transition: all 0.2s ease;
    }
    .btn-clear-all:hover { background: #fecaca; transform: translateY(-1px); }

    .table-logs tbody tr { transition: background 0.15s ease; }
    .table-logs tbody tr:hover { background: #f8fafc; }
    .table-logs td { vertical-align: middle; }

    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: none;
        transition: all 0.2s ease;
        padding: 0;
    }
    .action-btn.delete { background: #fee2e2; color: #b91c1c; }
    .action-btn.delete:hover { transform: translateY(-1px); background: #fecaca; }

    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 1rem; }
    .empty-state h6 { font-size: 1rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; }
    .empty-state p { font-size: 0.85rem; }

    /* Modal konfirmasi (pola modal-pln yang sudah ada di layout) */
    .modal-pln-overlay { display: none; }
    .modal-pln-overlay.show { display: flex; }

    /* ============================================
       DELETE CONFIRMATION MODAL (pola news modal)
       ============================================ */
    .log-delete-overlay {
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
    .log-delete-overlay.show { display: flex; }
    .log-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: logDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes logDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .log-delete-icon {
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
    .log-delete-title { font-size: 1.05rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .log-delete-text { font-size: 0.88rem; color: #6b7280; line-height: 1.6; margin: 0 0 0.35rem; }
    .log-delete-name {
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
    .log-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }

    /* Tombol modal — selaras persis dengan .news-delete-btn di /admin/news */
    .log-delete-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .log-delete-btn.cancel {
        background: #f3f4f6;
        color: #6b7280;
    }
    .log-delete-btn.cancel:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .log-delete-btn.confirm {
        background: #DC2626;
        color: #fff;
    }
    .log-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
</style>
@endpush

@section('content')
@php
    $bulanId = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $tgl = function ($d) use ($bulanId) {
        return $d->day . ' ' . $bulanId[$d->month] . ' ' . $d->year . ', ' . $d->format('H:i');
    };
@endphp

{{-- ============================================
     PAGE HEADER (pola /admin/news)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-clipboard-list header-icon"></i>Riwayat Aktivitas</h5>
            <p>Semua aksi admin/karyawan terhadap berita, pengumuman, akun, dan sistem tercatat di sini</p>
        </div>
        <button type="button" class="btn-corp btn-corp-danger-soft" onclick="document.getElementById('clearAllModal').classList.add('show')" @if($logs->total() === 0) disabled @endif>
            <i class="fas fa-broom"></i> Bersihkan Semua
        </button>
    </div>

    {{-- Stats Chips --}}
    <div class="stat-chips-row">
        <div class="stat-chip">
            <span class="stat-dot blue"></span>
            Total Log
            <span class="stat-number">{{ $logs->total() }}</span>
        </div>
        @if($filters['module'] || $filters['action'] || $filters['q'])
        <a href="{{ route('admin.activity-logs.index') }}" class="stat-chip" style="text-decoration:none;">
            <i class="fas fa-xmark" style="color:#ef4444; font-size:0.7rem;"></i>
            Filter aktif — klik untuk reset
        </a>
        @endif
    </div>
</div>

{{-- ============================================
     FILTER BAR (server-side)
     ============================================ --}}
<form method="GET" action="{{ route('admin.activity-logs.index') }}">
    <div class="page-filter-bar">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="q" value="{{ $filters['q'] }}" class="filter-input" placeholder="Cari aktivitas / nama pengguna...">
        </div>
        <div class="filter-divider"></div>
        <select name="module" class="filter-input" style="width:auto;">
            <option value="">Semua Modul</option>
            @foreach ($modules as $key => $label)
                <option value="{{ $key }}" @selected($filters['module'] === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <select name="action" class="filter-input" style="width:auto;">
            <option value="">Semua Aksi</option>
            @foreach ($actions as $key => $label)
                <option value="{{ $key }}" @selected($filters['action'] === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-corp btn-corp-primary btn-corp-sm">
            <i class="fas fa-filter"></i> Filter
        </button>
    </div>
</form>

{{-- ============================================
     LOG TABLE
     ============================================ --}}
<div class="dash-card">
            <div class="table-responsive">
                <table class="table table-logs align-middle">
                    <thead>
                        <tr style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280;">
                            <th style="width: 140px;">Pengguna</th>
                            <th style="width: 130px;">Aksi</th>
                            <th>Aktivitas</th>
                            <th style="width: 150px;">Waktu</th>
                            <th style="width: 60px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>
                                    <div class="log-user">
                                        <div class="log-avatar">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($log->user_name ?? '?', 0, 2)) }}</div>
                                        <div>
                                            <div class="log-user-name">{{ $log->user_name ?? 'Sistem' }}</div>
                                            <div class="log-user-role">{{ $log->user_role ?: '—' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="log-action-badge" style="background: {{ $log->action_color }}1a; color: {{ $log->action_color }};">
                                        <i class="fas {{ $log->action_icon }}"></i> {{ $log->action_label }}
                                    </span>
                                </td>
                                <td>
                                    <span class="log-module-badge">{{ $log->module_label }}</span>
                                    <div class="log-desc mt-1">{{ $log->description }}</div>
                                    @if($log->ip_address)
                                        <div class="log-ip"><i class="fas fa-globe me-1"></i>{{ $log->ip_address }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="log-time">{{ $tgl($log->created_at) }}</div>
                                    <div class="log-ip">{{ $log->created_at->locale('id')->diffForHumans() }}</div>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="action-btn delete" title="Hapus log ini"
                                            onclick="openLogDeleteModal('{{ route('admin.activity-logs.destroy', $log) }}', '{{ addslashes($log->description) }}')">
                                        <i class="fas fa-trash" style="font-size: 0.75rem;"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h6>Belum ada log aktivitas</h6>
                                        <p>Aktivitas admin/karyawan akan tercatat otomatis di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="page-pagination">
                {{ $logs->links() }}
            </div>
</div>

{{-- Modal konfirmasi bersihkan semua --}}
<div id="clearAllModal" class="modal-pln-overlay" onclick="if(event.target===this) this.classList.remove('show')">
    <div class="modal-pln-dialog">
        <h6 class="modal-pln-title">Bersihkan Semua Log?</h6>
        <p style="font-size: 0.85rem; color: #6b7280;">
            Seluruh <strong>{{ $logs->total() }}</strong> entri log akan dihapus permanen.
            Aksi ini sendiri akan tetap tercatat sebagai satu entri log baru.
        </p>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <button type="button" class="btn-corp btn-corp-cancel" onclick="document.getElementById('clearAllModal').classList.remove('show')">
                Batal
            </button>
            <form method="POST" action="{{ route('admin.activity-logs.clear') }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-corp btn-corp-logout">
                    <i class="fas fa-broom me-1"></i> Ya, Bersihkan
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================
     DELETE CONFIRMATION MODAL (pola news modal)
     ============================================ --}}
<div class="log-delete-overlay" id="deleteLogModal">
    <div class="log-delete-dialog">
        <div class="log-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="log-delete-title">Hapus Log?</h6>
        <p class="log-delete-text">Apakah Anda yakin ingin menghapus log ini?</p>
        <div class="log-delete-name" id="deleteLogDesc"></div>
        <div class="log-delete-actions">
            <button class="log-delete-btn cancel" onclick="closeLogDeleteModal()">Batal</button>
            <form id="deleteLogForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="log-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================
     Script INLINE modal hapus — WAJIB di dalam content (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     mengeksekusi ulang tag script di dalam main; kalau di push
     stack, popup hapus tidak muncul setelah navigasi via sidebar.
     ============================================================ --}}
<script>
    // Guard re-eksekusi: hindari listener ganda saat router.js
    // menjalankan ulang script ini setelah swap konten.
    if (!window.__logDeleteModalBound) {
        window.__logDeleteModalBound = true;

        window.openLogDeleteModal = function(url, desc) {
            const modal = document.getElementById('deleteLogModal');
            document.getElementById('deleteLogDesc').textContent = desc;
            document.getElementById('deleteLogForm').action = url;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        };

        window.closeLogDeleteModal = function() {
            document.getElementById('deleteLogModal').classList.remove('show');
            document.body.style.overflow = '';
        };

        document.getElementById('deleteLogModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeLogDeleteModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('deleteLogModal')?.classList.contains('show')) {
                closeLogDeleteModal();
            }
        });
    }
</script>
@endsection
