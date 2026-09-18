@extends('layouts.admin')

@section('title', 'Kelola Permohonan — E-PPID PLN')
@section('page-title', 'Kelola Permohonan')

@push('styles')
<style>
    /* ============ FILTER & SEARCH ============ */
    .search-box {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: #fff;
    }
    .search-box:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.1);
        outline: none;
    }

    /* ============ BADGE KATEGORI ============ */
    .kategori-badge {
        font-size: 0.66rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
        white-space: nowrap;
    }
    .kategori-badge.pertanyaan_umum  { background: rgba(0, 91, 156, 0.88);  color: #fff; }
    .kategori-badge.kerjasama_bisnis { background: rgba(16, 185, 129, 0.9); color: #fff; }
    .kategori-badge.layanan_om       { background: rgba(0, 163, 224, 0.88); color: #fff; }
    .kategori-badge.media_pers       { background: rgba(139, 92, 246, 0.88); color: #fff; }
    .kategori-badge.karir            { background: rgba(245, 158, 11, 0.92); color: #fff; }

    /* ============ BADGE STATUS ============ */
    .permohonan-status-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        white-space: nowrap;
    }
    .permohonan-status-badge.belum_dibaca { background: #fee2e2; color: #b91c1c; }
    .permohonan-status-badge.diproses     { background: #dbeafe; color: #1d4ed8; }
    .permohonan-status-badge.selesai      { background: #dcfce7; color: #166534; }

    /* ============ TOMBOL AKSI ============ */
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
    .action-btn:hover  { transform: translateY(-1px); }
    .action-btn.view   { background: #dbeafe; color: #1d4ed8; }
    .action-btn.delete { background: #fee2e2; color: #b91c1c; }

    .table-permohonan tbody tr { transition: background 0.15s ease; }
    .table-permohonan tbody tr:hover { background: #f8fafc; }
    .table-permohonan tbody tr.unread-row { background: #fffbeb; }
    .table-permohonan tbody tr.unread-row:hover { background: #fef3c7; }

    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 1rem; }
    .empty-state h6 { font-size: 1rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; }
    .empty-state p { font-size: 0.85rem; }

    /* ============ MODAL DETAIL ============ */
    .detail-section-label {
        font-size: 0.68rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.2rem;
    }
    .detail-section-value {
        color: #1e293b;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0;
        word-break: break-word;
    }
    .detail-pesan-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem 1.15rem;
        font-size: 0.88rem;
        color: #334155;
        line-height: 1.7;
        white-space: pre-wrap;
        word-break: break-word;
    }
    .quick-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .quick-action-btn:hover { transform: translateY(-1px); color: #fff; }
    .quick-action-btn.wa    { background: #16a34a; color: #fff; }
    .quick-action-btn.wa:hover { background: #15803d; }
    .quick-action-btn.mail  { background: #005b9c; color: #fff; }
    .quick-action-btn.mail:hover { background: #004a80; }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    {{-- ============================================ --}}
    {{-- STAT CARDS --}}
    {{-- ============================================ --}}
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="stat-card" style="min-width: 0;">
            <div class="stat-icon" style="background: #dbeafe; color: #1d4ed8;">
                <i class="fas fa-envelope"></i>
            </div>
            <div style="min-width: 0;">
                <div class="stat-value" style="color: #1d4ed8;">{{ number_format($stats['total']) }}</div>
                <div class="stat-label">Total Pesan</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="stat-card" style="min-width: 0;">
            <div class="stat-icon" style="background: #fee2e2; color: #b91c1c;">
                <i class="fas fa-inbox"></i>
            </div>
            <div style="min-width: 0;">
                <div class="stat-value" style="color: #b91c1c;">{{ number_format($stats['unread']) }}</div>
                <div class="stat-label">Belum Dibaca</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="stat-card" style="min-width: 0;">
            <div class="stat-icon" style="background: #dbeafe; color: #005B9C;">
                <i class="fas fa-clock"></i>
            </div>
            <div style="min-width: 0;">
                <div class="stat-value" style="color: #005B9C;">{{ number_format($stats['proses']) }}</div>
                <div class="stat-label">Diproses</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="stat-card" style="min-width: 0;">
            <div class="stat-icon" style="background: #dcfce7; color: #166534;">
                <i class="fas fa-circle-check"></i>
            </div>
            <div style="min-width: 0;">
                <div class="stat-value" style="color: #166534;">{{ number_format($stats['selesai']) }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div>
                    <h5 class="dash-card-title">Kelola Permohonan &amp; Pesan Masuk</h5>
                    <p class="dash-card-subtitle">Daftar permohonan dan pesan dari masyarakat/pelanggan via form kontak publik.</p>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- SEARCH & FILTER (server-side via GET) --}}
            {{-- ============================================ --}}
            <form method="GET" action="{{ route('admin.contact-messages.index') }}" id="filterForm">
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md-5">
                        <div class="input-group" style="border-radius: 8px; overflow: hidden;">
                            <span class="input-group-text" style="background: #f3f4f6; border: 1px solid #e5e7eb; border-right: none; border-radius: 8px 0 0 8px;">
                                <i class="fas fa-search" style="color: #6b7280; font-size: 0.8rem;"></i>
                            </span>
                            <input type="text" name="q" value="{{ request('q') }}" class="search-box" placeholder="Cari nama pengirim / subjek..." style="border: none; border-radius: 0 8px 8px 0;">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="d-flex gap-2 justify-content-md-end align-items-center">
                            <select name="kategori" class="search-box" style="cursor: pointer;" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Semua Kategori</option>
                                @foreach (\App\Models\ContactMessage::KATEGORI as $kat)
                                    <option value="{{ $kat }}" {{ request('kategori') === $kat ? 'selected' : '' }}>
                                        {{ match ($kat) {
                                            \App\Models\ContactMessage::KATEGORI_UMUM       => 'Umum',
                                            \App\Models\ContactMessage::KATEGORI_KERJASAMA  => 'Kemitraan FABA',
                                            \App\Models\ContactMessage::KATEGORI_LAYANAN_OM => 'Layanan O&M',
                                            \App\Models\ContactMessage::KATEGORI_MEDIA      => 'Media & Pers',
                                            \App\Models\ContactMessage::KATEGORI_KARIR      => 'Karir',
                                            default => ucfirst($kat),
                                        } }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="status" class="search-box" style="cursor: pointer;" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Semua Status</option>
                                @foreach ($statusLabels as $value => $label)
                                    <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="text-muted" style="font-size: 0.8rem; white-space: nowrap;">
                                {{ $messages->total() }} pesan
                            </span>
                        </div>
                    </div>
                </div>
            </form>

            {{-- ============================================ --}}
            {{-- TABEL DATA PERMOHONAN --}}
            {{-- ============================================ --}}
            <div class="table-responsive">
                <table class="table table-permohonan align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Tanggal</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Nama Pengirim</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Contact</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Kategori</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Subjek</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                            <th style="text-align: right; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $item)
                        <tr class="{{ $item->isUnread() ? 'unread-row' : '' }}" data-row="{{ $item->id }}">
                            <td style="padding: 1rem; white-space: nowrap;">
                                <span style="font-size: 0.85rem; color: #6b7280;">
                                    <i class="far fa-calendar me-1"></i>{{ $item->created_at->translatedFormat('d M Y') }}
                                </span>
                                <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 2px;">
                                    {{ $item->created_at->format('H:i') }} WIB
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="font-weight: 600; color: #1f2937; font-size: 0.88rem;">
                                    {{ $item->nama }}
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="font-size: 0.8rem; color: #374151;">{{ $item->email }}</div>
                                <div style="font-size: 0.78rem; color: #9ca3af; margin-top: 2px;">{{ $item->telepon }}</div>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="kategori-badge {{ $item->kategori }}">{{ $item->kategori_label }}</span>
                            </td>
                            <td style="padding: 1rem; max-width: 240px;">
                                <div style="font-size: 0.85rem; color: #374151; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $item->subjek }}">
                                    {{ $item->subjek }}
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="permohonan-status-badge {{ $item->status }}">{{ $item->status_label }}</span>
                            </td>
                            <td style="padding: 1rem; text-align: right;">
                                <div class="d-flex gap-1 justify-content-end">
                                    <button type="button" class="action-btn view" title="Lihat Detail"
                                            onclick="openDetailModal({{ $item->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <form action="{{ route('admin.contact-messages.destroy', $item) }}" method="POST" style="display: inline;"
                                          onsubmit="return confirm('Hapus permohonan ini? Tindakan tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h6>Belum ada permohonan masuk</h6>
                                    <p>Pesan dari form kontak publik akan tampil di sini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($messages->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $messages->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- MODAL DETAIL PERMOHONAN --}}
{{-- ============================================ --}}
<div id="detailModal" class="modal-pln-overlay" onclick="if(event.target===this) closeDetailModal()">
    <div class="modal-pln-dialog" style="max-width: 640px; width: 92%; max-height: 90vh; overflow-y: auto; text-align: left; padding: 1.75rem;">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="modal-pln-title" style="margin-bottom: 0.15rem;" id="detailSubjek">—</h6>
                <span class="permohonan-status-badge belum_dibaca" id="detailStatusBadge">—</span>
            </div>
            <button type="button" class="action-btn delete" onclick="closeDetailModal()" title="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>

        {{-- Info Pengirim --}}
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <div class="detail-section-label">Nama Pengirim</div>
                <p class="detail-section-value" id="detailNama">—</p>
            </div>
            <div class="col-md-6">
                <div class="detail-section-label">Kategori</div>
                <p class="detail-section-value" id="detailKategori">—</p>
            </div>
            <div class="col-md-6">
                <div class="detail-section-label">Email</div>
                <p class="detail-section-value" id="detailEmail">—</p>
            </div>
            <div class="col-md-6">
                <div class="detail-section-label">No. WA / Telepon</div>
                <p class="detail-section-value" id="detailTelepon">—</p>
            </div>
            <div class="col-12">
                <div class="detail-section-label">Tanggal Kirim</div>
                <p class="detail-section-value" id="detailTanggal">—</p>
            </div>
        </div>

        {{-- Isi Pesan --}}
        <div class="detail-section-label">Isi Pesan</div>
        <div class="detail-pesan-box mb-3" id="detailPesan">—</div>

        {{-- Ubah Status --}}
        <div class="row g-2 align-items-center mb-3">
            <div class="col-sm-6">
                <div class="detail-section-label">Ubah Status</div>
                <select id="detailStatusSelect" class="search-box" style="width: 100%; cursor: pointer;">
                    @foreach ($statusLabels as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 text-sm-end">
                <button type="button" id="btnSaveStatus" class="btn-corp btn-corp-edit" style="margin-top: 1.35rem;" onclick="saveStatus()">
                    <i class="fas fa-floppy-disk"></i> Simpan Status
                </button>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="d-flex flex-wrap gap-2 pt-2" style="border-top: 1px solid #e5e7eb;">
            <a href="#" target="_blank" rel="noopener" class="quick-action-btn wa" id="detailWaBtn">
                <i class="fab fa-whatsapp"></i> Balas via WhatsApp
            </a>
            <a href="#" class="quick-action-btn mail" id="detailMailBtn">
                <i class="fas fa-envelope"></i> Balas via Email
            </a>
        </div>
    </div>
</div>

{{-- Flash toast sukses (redirect non-AJAX) --}}
@if (session('success'))
<div id="flashToast" style="position: fixed; top: 1rem; right: 1rem; z-index: 3000; background: #16a34a; color: #fff; padding: 0.8rem 1.2rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 10px 30px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 0.6rem;">
    <i class="fas fa-circle-check"></i> {{ session('success') }}
</div>
<script>
    setTimeout(function () {
        var t = document.getElementById('flashToast');
        if (t) t.remove();
    }, 4000);
</script>
@endif
{{-- Script WAJIB di dalam @section('content') (bukan @push('scripts'))
     karena client-side router (router.js) hanya mengeksekusi ulang
     <script> di dalam <main>; kalau di push stack, modal detail,
     toast, dan sinkronisasi badge mati setelah navigasi via sidebar. --}}
<script>
    var STATUS_LABELS = @json($statusLabels);

    function openDetailModal(id) {
        var overlay = document.getElementById('detailModal');
        overlay.classList.add('show');

        // Reset tampilan sementara load
        ['detailSubjek', 'detailNama', 'detailKategori', 'detailEmail', 'detailTelepon', 'detailTanggal', 'detailPesan']
            .forEach(function (elId) { document.getElementById(elId).textContent = 'Memuat...'; });

        fetch('{{ route('admin.contact-messages.show', '__ID__') }}'.replace('__ID__', id), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            credentials: 'same-origin'
        })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                document.getElementById('detailSubjek').textContent   = data.subjek;
                document.getElementById('detailNama').textContent     = data.nama;
                document.getElementById('detailKategori').textContent = data.kategori;
                document.getElementById('detailEmail').textContent    = data.email;
                document.getElementById('detailTelepon').textContent  = data.telepon;
                document.getElementById('detailTanggal').textContent  = data.tanggal;
                document.getElementById('detailPesan').textContent    = data.pesan;

                var badge = document.getElementById('detailStatusBadge');
                badge.className = 'permohonan-status-badge ' + data.status;
                badge.textContent = data.status_label;

                document.getElementById('detailStatusSelect').value = data.status;
                document.getElementById('detailStatusSelect').setAttribute('data-id', data.id);

                var waBtn  = document.getElementById('detailWaBtn');
                var mailBtn = document.getElementById('detailMailBtn');
                waBtn.href = data.wa_link;
                mailBtn.href = data.mailto_link;

                // Baris di tabel di-refresh jadi "diproses" (tandai sudah dibaca)
                var row = document.querySelector('tr[data-row="' + data.id + '"]');
                if (row) {
                    row.classList.remove('unread-row');
                    var rowBadge = row.querySelector('.permohonan-status-badge');
                    if (rowBadge && data.status === 'diproses') {
                        rowBadge.className = 'permohonan-status-badge diproses';
                        rowBadge.textContent = data.status_label;
                    }
                }

                // Sinkronkan stat cards + badge sidebar (membuka pesan mengubah status)
                if (data.stats) syncCounters(data.stats, data.unread_count);
            })
            .catch(function () {
                closeDetailModal();
                alert('Gagal memuat detail permohonan.');
            });
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.remove('show');
    }

    /* =========================================================
       TOAST NOTIFICATION (pojok kanan atas, auto-hide 3 detik)
       ========================================================= */
    function showToast(message, type) {
        var existing = document.getElementById('permohonanToast');
        if (existing) existing.remove();

        var toast = document.createElement('div');
        toast.id = 'permohonanToast';
        toast.style.cssText =
            'position:fixed; top:1.25rem; right:1.25rem; z-index:9999;' +
            'max-width:360px; padding:0.9rem 1.2rem; border-radius:12px;' +
            'font-size:0.87rem; font-weight:600; color:#fff;' +
            'box-shadow:0 12px 32px rgba(0,0,0,0.22);' +
            'display:flex; gap:0.6rem; align-items:flex-start;' +
            'opacity:0; transform:translateY(-8px); transition:all 0.3s ease;';
        toast.style.background = type === 'success' ? '#16A34A' : '#DC2626';
        toast.innerHTML =
            '<i class="fas fa-' + (type === 'success' ? 'circle-check' : 'circle-exclamation') + '" style="margin-top:0.1rem;"></i>' +
            '<span>' + message + '</span>';
        document.body.appendChild(toast);

        requestAnimationFrame(function () {
            toast.style.opacity = '1';
            toast.style.transform = 'translateY(0)';
        });

        setTimeout(function () {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-8px)';
            setTimeout(function () { toast.remove(); }, 300);
        }, 3000);
    }

    /* =========================================================
       LOADING STATE TOMBOL SIMPAN
       ========================================================= */
    function setSaveButtonLoading(loading) {
        var btn = document.getElementById('btnSaveStatus');
        if (!btn) return;

        if (loading) {
            btn.disabled = true;
            btn.setAttribute('data-original-html', btn.innerHTML);
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Menyimpan...';
            btn.style.opacity = '0.75';
            btn.style.cursor = 'not-allowed';
        } else {
            btn.disabled = false;
            var original = btn.getAttribute('data-original-html');
            if (original) btn.innerHTML = original;
            btn.style.opacity = '';
            btn.style.cursor = '';
        }
    }

    /* =========================================================
       SINKRONISASI STAT CARDS + BADGE SIDEBAR (real-time)
       ========================================================= */
    function syncCounters(stats, unreadCount) {
        // Stat cards di halaman ini (urutan: total, unread, proses, selesai)
        var cardValues = document.querySelectorAll('.stat-card .stat-value');
        if (cardValues.length >= 4) {
            cardValues[0].textContent = Number(stats.total).toLocaleString('id-ID');
            cardValues[1].textContent = Number(stats.unread).toLocaleString('id-ID');
            cardValues[2].textContent = Number(stats.proses).toLocaleString('id-ID');
            cardValues[3].textContent = Number(stats.selesai).toLocaleString('id-ID');
        }

        // Badge merah di sidebar admin (layout — tetap ada walau pindah halaman via router)
        var sidebarLink = document.querySelector('.sidebar-link[href*="contact-messages"]');
        if (sidebarLink) {
            var badge = sidebarLink.querySelector('.badge');
            if (unreadCount > 0) {
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'badge';
                    sidebarLink.appendChild(badge);
                }
                badge.title = unreadCount + ' pesan belum dibaca';
                badge.textContent = unreadCount > 99 ? '99+' : unreadCount;
            } else if (badge) {
                badge.remove();
            }
        }
    }

    /* =========================================================
       SIMPAN STATUS (submit handler dengan loading + toast + sync)
       ========================================================= */
    function saveStatus() {
        var select = document.getElementById('detailStatusSelect');
        var id = select.getAttribute('data-id');
        if (!id) return;

        setSaveButtonLoading(true);

        fetch('{{ route('admin.contact-messages.update-status', '__ID__') }}'.replace('__ID__', id), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                                document.querySelector('input[name="_token"]')?.value || ''
            },
            credentials: 'same-origin',
            body: JSON.stringify({ status: select.value })
        })
            .then(function (res) {
                return res.json().then(function (data) {
                    return { ok: res.ok, data: data };
                });
            })
            .then(function (result) {
                if (!result.ok || !result.data.success) {
                    throw new Error(result.data.message || 'Gagal menyimpan status.');
                }

                var data = result.data;

                // 1. Update badge di modal (pill mengikuti status baru)
                var badge = document.getElementById('detailStatusBadge');
                badge.className = 'permohonan-status-badge ' + data.status;
                badge.textContent = data.status_label;

                // 2. Update baris tabel di belakang modal
                var row = document.querySelector('tr[data-row="' + id + '"]');
                if (row) {
                    row.classList.remove('unread-row');
                    var rowBadge = row.querySelector('.permohonan-status-badge');
                    if (rowBadge) {
                        rowBadge.className = 'permohonan-status-badge ' + data.status;
                        rowBadge.textContent = data.status_label;
                    }
                }

                // 3. Sinkronkan stat cards + badge sidebar
                if (data.stats) syncCounters(data.stats, data.unread_count);

                // 4. Toast sukses
                showToast('✅ Status permohonan berhasil diperbarui!', 'success');
            })
            .catch(function (e) {
                showToast('❌ Gagal mengubah status: ' + e.message, 'error');
            })
            .finally(function () {
                setSaveButtonLoading(false);
            });
    }

    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDetailModal();
    });
</script>
@endsection
