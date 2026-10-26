@extends('layouts.karyawan')

@section('title', 'Kunjungan Tamu — Portal Karyawan')

@push('styles')
<style>
    /* ============================================
       KUNJUNGAN TAMU — PORTAL KARYAWAN
       Halaman READ-ONLY: daftar registrasi tamu dari
       form publik yang menunjuk akun ini sebagai
       "Orang yang Ditemui". Struktur selaras
       karyawan/tamu/index (header + stats, filter bar,
       tabel, pagination) tetapi TANPA aksi tulis.
       ============================================ */

    .kt-page-header {
        background: var(--kry-card);
        border: 1px solid var(--kry-line);
        border-radius: var(--kry-radius);
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.25rem;
    }
    .kt-page-header .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .kt-page-header .header-left h5 {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--kry-teal-deep);
        margin: 0 0 0.2rem;
    }
    .kt-page-header .header-left p {
        font-size: 0.8rem;
        color: var(--kry-muted);
        margin: 0;
    }
    .kt-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: var(--kry-muted);
        margin-bottom: 0.6rem;
    }
    .kt-breadcrumb a { color: var(--kry-teal); text-decoration: none; }
    .kt-breadcrumb a:hover { text-decoration: underline; }

    .kt-scope-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: rgba(0, 86, 163, 0.08);
        border: 1px solid rgba(0, 86, 163, 0.2);
        color: var(--kry-teal-deep);
        border-radius: 999px;
        padding: 0.35rem 0.85rem;
        font-size: 0.76rem;
        font-weight: 600;
    }
    .kt-scope-chip i { color: var(--kry-teal); }

    /* Stats */
    .kt-stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-top: 1.25rem;
    }
    .kt-stat-card {
        background: var(--kry-bg);
        border: 1px solid var(--kry-line);
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        transition: border-color 0.2s ease;
    }
    .kt-stat-card:hover { border-color: var(--kry-teal); }
    .kt-stat-card .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        color: #fff;
        flex-shrink: 0;
    }
    .kt-stat-card .stat-icon.blue  { background: linear-gradient(135deg, var(--kry-teal), var(--kry-teal-dark)); }
    .kt-stat-card .stat-icon.amber { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .kt-stat-card .stat-icon.green { background: linear-gradient(135deg, #22c55e, #16a34a); }
    .kt-stat-card .stat-icon.red   { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .kt-stat-card .stat-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--kry-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .kt-stat-card .stat-value {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--kry-teal-deep);
        line-height: 1.1;
    }

    /* Filter bar — pola tamu-filter-bar */
    .kt-filter-bar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.6rem;
        background: var(--kry-card);
        border: 1px solid var(--kry-line);
        border-radius: var(--kry-radius);
        padding: 0.7rem 1rem;
        margin-bottom: 1rem;
    }
    .kt-filter-bar .search-wrapper {
        position: relative;
        flex: 1;
        min-width: 220px;
    }
    .kt-filter-bar .search-wrapper i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--kry-muted);
        font-size: 0.8rem;
    }
    .kt-filter-bar input,
    .kt-filter-bar select {
        border: 1px solid var(--kry-line);
        background: var(--kry-bg);
        color: var(--kry-text, inherit);
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        font-size: 0.82rem;
        outline: none;
    }
    .kt-filter-bar input:focus,
    .kt-filter-bar select:focus { border-color: var(--kry-teal); }
    .kt-filter-bar .search-wrapper input { width: 100%; padding-left: 34px; }
    .kt-filter-divider { width: 1px; height: 24px; background: var(--kry-line); }
    .kt-filter-count { font-size: 0.76rem; color: var(--kry-muted); white-space: nowrap; }

    /* Tabel */
    .kt-table-wrap {
        background: var(--kry-card);
        border: 1px solid var(--kry-line);
        border-radius: var(--kry-radius);
        overflow-x: auto;
    }
    .kt-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.82rem;
        min-width: 880px;
    }
    .kt-table thead th {
        text-align: left;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--kry-muted);
        padding: 0.8rem 1rem;
        border-bottom: 1px solid var(--kry-line);
        background: var(--kry-bg);
        white-space: nowrap;
    }
    .kt-table tbody td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid var(--kry-line);
        vertical-align: top;
    }
    .kt-table tbody tr:last-child td { border-bottom: none; }
    .kt-table tbody tr:hover { background: rgba(0, 0, 0, 0.015); }
    html.theme-dark .kt-table tbody tr:hover { background: rgba(255, 255, 255, 0.03); }

    .kt-guest-name { font-weight: 700; color: var(--kry-teal-deep); }
    .kt-guest-meta { font-size: 0.74rem; color: var(--kry-muted); margin-top: 2px; }
    .kt-guest-meta a { color: var(--kry-teal); text-decoration: none; }
    .kt-guest-meta a:hover { text-decoration: underline; }

    .kt-jadwal-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(0, 86, 163, 0.08);
        border: 1px solid rgba(0, 86, 163, 0.18);
        color: var(--kry-teal-deep);
        border-radius: 8px;
        padding: 0.3rem 0.6rem;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .kt-tujuan-line {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.78rem;
        margin-bottom: 2px;
    }
    .kt-tujuan-line i { width: 14px; color: var(--kry-muted); text-align: center; }
    .kt-keperluan {
        display: block;
        font-size: 0.76rem;
        color: var(--kry-muted);
        margin-top: 4px;
    }

    /* Badge status — pola .tamu-badge */
    .kt-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        border-radius: 999px;
        padding: 0.28rem 0.7rem;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .kt-badge i { font-size: 0.5rem; }
    .kt-badge.menunggu  { background: #fef3c7; color: #b45309; }
    .kt-badge.disetujui { background: #dcfce7; color: #15803d; }
    .kt-badge.ditolak   { background: #fee2e2; color: #dc2626; }
    .kt-badge.selesai   { background: #f1f5f9; color: #64748b; }
    html.theme-dark .kt-badge.menunggu  { background: rgba(180, 83, 9, 0.25); color: #fcd34d; }
    html.theme-dark .kt-badge.disetujui { background: rgba(22, 163, 74, 0.25); color: #86efac; }
    html.theme-dark .kt-badge.ditolak   { background: rgba(220, 38, 38, 0.25); color: #fca5a5; }
    html.theme-dark .kt-badge.selesai   { background: rgba(100, 116, 139, 0.25); color: #cbd5e1; }

    .kt-doc-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(0, 86, 163, 0.08);
        border: 1px solid rgba(0, 86, 163, 0.2);
        color: var(--kry-teal-deep);
        border-radius: 8px;
        padding: 0.3rem 0.6rem;
        font-size: 0.74rem;
        font-weight: 600;
        text-decoration: none;
    }
    .kt-doc-chip:hover { background: rgba(0, 86, 163, 0.14); }
    .kt-doc-empty { color: var(--kry-muted); opacity: 0.5; }

    .kt-wa-link { color: #16a34a; text-decoration: none; font-size: 0.76rem; }
    .kt-wa-link:hover { text-decoration: underline; }

    .kt-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--kry-muted);
    }
    .kt-empty .empty-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 0.75rem;
        border-radius: 50%;
        background: var(--kry-bg);
        border: 1px solid var(--kry-line);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: var(--kry-teal);
    }
    .kt-empty h6 { font-weight: 700; color: var(--kry-teal-deep); margin: 0 0 0.3rem; }
    .kt-empty p { font-size: 0.8rem; margin: 0; max-width: 420px; margin-inline: auto; }
</style>
@endpush

@section('content')

    <div class="kt-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a>  /  Kunjungan Tamu
    </div>

    {{-- ============================================
         HEADER + STATS
         ============================================ --}}
    <div class="kt-page-header">
        <div class="header-row">
            <div class="header-left">
                <h5><i class="fas fa-door-open"></i> Kunjungan Tamu</h5>
                <p>Daftar pendaftaran tamu dari form registrasi publik yang menunjuk Anda sebagai orang yang ditemui. Tampilan hanya-baca.</p>
            </div>
            <span class="kt-scope-chip" title="Hanya tamu yang menyebut nama akun Anda">
                <i class="fas fa-user-shield"></i> Khusus: {{ $user->name }}
            </span>
        </div>

        <div class="kt-stats-row">
            <div class="kt-stat-card">
                <div class="stat-icon blue"><i class="fas fa-door-open"></i></div>
                <div>
                    <div class="stat-label">Total Kunjungan</div>
                    <div class="stat-value">{{ $stats['total'] }}</div>
                </div>
            </div>
            <div class="kt-stat-card">
                <div class="stat-icon amber"><i class="fas fa-hourglass-half"></i></div>
                <div>
                    <div class="stat-label">Menunggu Verifikasi</div>
                    <div class="stat-value">{{ $stats['menunggu'] }}</div>
                </div>
            </div>
            <div class="kt-stat-card">
                <div class="stat-icon green"><i class="fas fa-circle-check"></i></div>
                <div>
                    <div class="stat-label">Disetujui</div>
                    <div class="stat-value">{{ $stats['disetujui'] }}</div>
                </div>
            </div>
            <div class="kt-stat-card">
                <div class="stat-icon red"><i class="fas fa-circle-xmark"></i></div>
                <div>
                    <div class="stat-label">Ditolak</div>
                    <div class="stat-value">{{ $stats['ditolak'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         FILTER BAR (read-only — filter saja)
         ============================================ --}}
    <form class="kt-filter-bar" method="GET" action="{{ route('karyawan.kunjungan-tamu') }}">
        <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, instansi, atau NIK...">
        </div>
        <div class="kt-filter-divider"></div>
        <input type="date" name="dari" value="{{ request('dari') }}" title="Tanggal kunjungan dari">
        <span class="kt-filter-count">s/d</span>
        <input type="date" name="sampai" value="{{ request('sampai') }}" title="Tanggal kunjungan sampai">
        <select name="status" title="Status verifikasi">
            <option value="">Semua Status</option>
            <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu Verifikasi</option>
            <option value="disetujui" @selected(request('status') === 'disetujui')>Disetujui</option>
            <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
            <option value="berkunjung" @selected(request('status') === 'berkunjung')>Berkunjung</option>
            <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
        </select>
        <button type="submit" class="btn-corp btn-corp-primary" style="padding:0.5rem 1rem; font-size:0.8rem;">
            <i class="fas fa-filter me-1"></i> Terapkan
        </button>
        @if (request()->anyFilled(['q', 'dari', 'sampai', 'status']))
            <a href="{{ route('karyawan.kunjungan-tamu') }}" class="btn-corp btn-corp-soft" style="padding:0.5rem 1rem; font-size:0.8rem;">
                <i class="fas fa-rotate-left"></i>
            </a>
        @endif
        <div class="kt-filter-divider"></div>
        <span class="kt-filter-count">{{ $tamus->total() }} tamu</span>
    </form>

    {{-- ============================================
         TABEL KUNJUNGAN (read-only)
         ============================================ --}}
    <div class="kt-table-wrap">
        <table class="kt-table">
            <thead>
                <tr>
                    <th>Jadwal Kunjungan</th>
                    <th>Identitas Tamu</th>
                    <th>Instansi</th>
                    <th>Tujuan / Keperluan</th>
                    <th class="text-center">Dokumen</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tamus as $tamu)
                <tr>
                    <td>
                        <span class="kt-jadwal-chip">
                            <i class="fas fa-calendar-check"></i>
                            {{ $tamu->tanggal_kunjungan?->translatedFormat('d M Y') ?? '—' }}
                            @if ($tamu->tanggal_kunjungan)
                                · {{ $tamu->tanggal_kunjungan->format('H:i') }}
                            @endif
                        </span>
                        <div class="kt-guest-meta" title="Waktu pendaftaran">
                            <i class="fas fa-clock"></i> didaftarkan
                            {{ $tamu->created_at->translatedFormat('d M Y') }} {{ $tamu->created_at->format('H:i') }}
                        </div>
                    </td>
                    <td>
                        <div class="kt-guest-name">{{ $tamu->nama }}</div>
                        <div class="kt-guest-meta">NIK {{ $tamu->nik }} · {{ $tamu->jumlah_tamu }} orang</div>
                        <div class="kt-guest-meta">
                            <a href="{{ $tamu->wa_chat_url }}" target="_blank" rel="noopener" class="kt-wa-link"
                               title="Chat WhatsApp ke {{ $tamu->no_hp }}">
                                <i class="fab fa-whatsapp"></i> {{ $tamu->no_hp }}
                            </a>
                        </div>
                        @if ($tamu->email)
                            <div class="kt-guest-meta">
                                <a href="{{ $tamu->mailto_url }}" title="Kirim email ke {{ $tamu->email }}">
                                    <i class="fas fa-envelope"></i> {{ $tamu->email }}
                                </a>
                            </div>
                        @endif
                    </td>
                    <td>{{ $tamu->instansi ?? '—' }}</td>
                    <td>
                        <div class="kt-tujuan-line" title="Bidang yang ditemui">
                            <i class="fas fa-sitemap"></i><span>{{ $tamu->tujuan_ditemui }}</span>
                        </div>
                        @if ($tamu->jabatan_ditemui)
                            <div class="kt-tujuan-line" title="Jabatan yang ditemui">
                                <i class="fas fa-id-badge"></i><span>{{ $tamu->jabatan_ditemui }}</span>
                            </div>
                        @endif
                        @if ($tamu->orang_ditemui)
                            <div class="kt-tujuan-line" title="Orang yang ditemui">
                                <i class="fas fa-user-tie"></i><span>{{ $tamu->orang_ditemui }}</span>
                            </div>
                        @endif
                        <span class="kt-keperluan" title="{{ $tamu->keperluan }}">
                            <i class="fas fa-comment-dots"></i> {{ $tamu->keperluan }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if ($tamu->hasDokumen())
                            <a href="{{ $tamu->dokumen_zip_url_karyawan }}" target="_blank" rel="noopener"
                               class="kt-doc-chip" title="Buka / unduh dokumen pendukung {{ $tamu->nama }}">
                                <i class="fas fa-paperclip"></i> Dokumen
                            </a>
                        @else
                            <span class="kt-doc-empty" title="Tidak ada lampiran"><i class="fas fa-paperclip"></i></span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DITOLAK)
                            <span class="kt-badge ditolak" title="Kunjungan ditolak"><i class="fas fa-circle"></i> Ditolak</span>
                        @elseif ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DISETUJUI)
                            @if ($tamu->checked_out_at)
                                <span class="kt-badge selesai"><i class="fas fa-circle"></i> Selesai</span>
                            @elseif ($tamu->checked_in_at)
                                <span class="kt-badge disetujui" title="Sedang berkunjung"><i class="fas fa-circle"></i> Berkunjung</span>
                            @else
                                <span class="kt-badge disetujui" title="Disetujui — tamu dapat berkunjung"><i class="fas fa-circle"></i> Disetujui</span>
                            @endif
                        @else
                            <span class="kt-badge menunggu" title="Menunggu verifikasi"><i class="fas fa-circle"></i> Menunggu</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="kt-empty">
                            <div class="empty-icon"><i class="fas fa-door-open"></i></div>
                            <h6>Belum ada kunjungan tamu untuk Anda</h6>
                            <p>Kunjungan akan tampil di sini setelah ada pendaftar memilih nama Anda pada kolom
                               "Orang yang Ditemui" di form registrasi tamu.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ============================================
         PAGINATION (pola page-pagination karyawan.css)
         ============================================ --}}
    @if ($tamus->hasPages())
    <div class="page-pagination">
        <div class="pagination">
            @if ($tamus->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-btn" href="{{ $tamus->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($tamus->getUrlRange(max(1, $tamus->currentPage() - 2), min($tamus->lastPage(), $tamus->currentPage() + 2)) as $page => $url)
                <a class="page-btn {{ $page == $tamus->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
            @endforeach

            @if ($tamus->hasMorePages())
                <a class="page-btn" href="{{ $tamus->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="page-btn disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @endif

@endsection
