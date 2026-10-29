@extends('layouts.admin')

@section('title', 'Detail Kunjungan Tamu — E-PPID PLN')
@section('page-title', 'Detail Kunjungan Tamu')

@push('styles')
<style>
    /* ============================================
       DETAIL KUNJUNGAN TAMU
       Kartu badge status + log aktivitas di atas,
       tombol aksi revisi status, data tamu di bawah.
       ============================================ */
    .dt-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.4rem 1.6rem;
        margin-bottom: 1.1rem;
    }
    .dt-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .dt-head-left { display: flex; align-items: center; gap: 0.8rem; flex-wrap: wrap; }
    .dt-name { font-size: 1.05rem; font-weight: 700; color: var(--pln-text); margin: 0; }
    .dt-sub { font-size: 0.78rem; color: #9ca3af; }
    .dt-back {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.78rem; font-weight: 600; color: var(--pln-blue);
        background: #f1f5f9; border: 1px solid #e8edf5;
        padding: 0.42rem 0.85rem; border-radius: 9px; text-decoration: none;
    }
    .dt-back:hover { background: #e8eef7; }

    /* Badge status — selaras dengan tabel */
    .tamu-badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 0.72rem; font-weight: 700;
        padding: 0.32rem 0.75rem; border-radius: 999px; white-space: nowrap;
    }
    .tamu-badge i { font-size: 0.6rem; }
    .tamu-badge.menunggu  { background: #fef3c7; color: #b45309; }
    .tamu-badge.disetujui { background: #dcfce7; color: #15803d; }
    .tamu-badge.ditolak   { background: #fee2e2; color: #dc2626; }
    .tamu-badge.selesai   { background: #f1f5f9; color: #64748b; }
    html.theme-dark .tamu-badge.menunggu  { background: rgba(180,83,9,.25); color: #fcd34d; }
    html.theme-dark .tamu-badge.disetujui { background: rgba(21,128,61,.25); color: #86efac; }
    html.theme-dark .tamu-badge.ditolak   { background: rgba(220,38,38,.25); color: #fca5a5; }
    html.theme-dark .tamu-badge.selesai   { background: var(--panel); color: var(--ink-muted); }

    /* ===== CARD LOG AKTIVITAS ===== */
    .dt-log {
        display: flex; align-items: flex-start; gap: 0.85rem;
        margin-top: 1.1rem; padding: 0.85rem 1rem;
        background: #f8fafc; border: 1px solid #eef2f7; border-radius: 12px;
    }
    html.theme-dark .dt-log { background: var(--panel); border-color: var(--line); }
    .dt-log-icon {
        width: 34px; height: 34px; border-radius: 10px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        background: #e7f9ee; color: #16a34a; font-size: 0.9rem;
    }
    .dt-log-title {
        font-size: 0.68rem; font-weight: 700; color: #9ca3af;
        text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 0.15rem;
    }
    .dt-log-text { font-size: 0.83rem; color: #374151; line-height: 1.5; }
    html.theme-dark .dt-log-text { color: var(--ink-body); }
    .dt-log-text strong { font-weight: 700; color: var(--pln-text); }
    .dt-log-empty { font-size: 0.82rem; color: #9ca3af; font-style: italic; }

    /* ===== TOMBOL AKSI STATUS ===== */
    .dt-actions {
        display: flex; gap: 0.6rem; flex-wrap: wrap;
        margin-top: 1.1rem; padding-top: 1.1rem;
        border-top: 1px dashed #e8edf5;
    }
    html.theme-dark .dt-actions { border-color: var(--line); }
    .dt-btn {
        display: inline-flex; align-items: center; gap: 0.45rem;
        font-size: 0.83rem; font-weight: 700;
        padding: 0.6rem 1.1rem; border-radius: 10px;
        border: 1.5px solid transparent; cursor: pointer;
        transition: all 0.15s ease;
    }
    .dt-btn.approve { background: #16a34a; border-color: #16a34a; color: #fff; }
    .dt-btn.approve:hover { background: #15803d; border-color: #15803d; }
    .dt-btn.cancel { background: #dc2626; border-color: #dc2626; color: #fff; }
    .dt-btn.cancel:hover { background: #b91c1c; border-color: #b91c1c; }
    .dt-btn.cancel-outline { background: transparent; border-color: #dc2626; color: #dc2626; }
    .dt-btn.cancel-outline:hover { background: #dc2626; color: #fff; }
    .dt-btn .dt-btn-hint { font-weight: 500; font-size: 0.72rem; opacity: 0.85; }

    /* ===== DETAIL DATA ===== */
    .dt-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 0 1.5rem;
    }
    .dt-row {
        display: grid; grid-template-columns: 150px 1fr; gap: 0.75rem;
        padding: 0.6rem 0; border-bottom: 1px dashed #eef2f7;
        font-size: 0.83rem;
    }
    html.theme-dark .dt-row { border-color: var(--line); }
    .dt-row dt { color: #9ca3af; font-weight: 600; }
    .dt-row dd { margin: 0; color: var(--pln-text); font-weight: 500; word-break: break-word; }
    .dt-row dd a { display: inline-flex; align-items: center; gap: 0.35rem; }
    .dt-section-title {
        font-size: 0.7rem; font-weight: 700; color: #9ca3af;
        text-transform: uppercase; letter-spacing: 0.6px;
        margin: 1.2rem 0 0.4rem;
    }
    .dt-section-title:first-child { margin-top: 0; }
    .dt-keperluan {
        background: #f8fafc; border: 1px solid #eef2f7; border-radius: 10px;
        padding: 0.8rem 0.95rem; font-size: 0.83rem; color: #374151;
        white-space: pre-wrap;
    }
    html.theme-dark .dt-keperluan { background: var(--panel); border-color: var(--line); color: var(--ink-body); }
    .wa-chat-link { color: #16a34a; font-weight: 600; text-decoration: none; }
    .wa-chat-link:hover { color: #128a3e; text-decoration: underline; }
    .mailto-link { color: #2563eb; text-decoration: none; }
    .mailto-link:hover { text-decoration: underline; }
    .dt-doc-chip {
        display: inline-flex; align-items: center; gap: 0.45rem;
        padding: 0.5rem 0.95rem; border-radius: 9px;
        background: #eff6ff; border: 1px solid #dbeafe;
        color: #2563eb; font-size: 0.8rem; font-weight: 600; text-decoration: none;
    }
    .dt-doc-chip i { color: #dc2626; }
    .dt-doc-chip:hover { background: #dbeafe; }

    @media (max-width: 767.98px) {
        .dt-card { padding: 1.1rem; }
        .dt-row { grid-template-columns: 120px 1fr; }
        .dt-btn { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')
{{-- Flash hasil aksi status (approve / reject / revisi) --}}
@if (session('success'))
    {{-- Flash sukses → pop-up SweetAlert tengah layar (AdminSwal di layout). --}}
    <div hidden data-swal-success="{{ session('success') }}"></div>
@endif
@if (session('error'))
    {{-- Flash gagal → pop-up SweetAlert tengah layar (AdminSwal di layout). --}}
    <div hidden data-swal-error="{{ session('error') }}"></div>
@endif

@php
    // Label badge mengikuti status verifikasi + alur check-in/out.
    $badgeKey = 'menunggu';
    $badgeLabel = 'Menunggu';
    if ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DITOLAK) {
        $badgeKey = 'ditolak';
        $badgeLabel = 'Dibatalkan';
    } elseif ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DISETUJUI) {
        $badgeKey = $tamu->checked_out_at ? 'selesai' : 'disetujui';
        $badgeLabel = $tamu->checked_out_at ? 'Selesai' : 'Disetujui';
    }
    $menunggu = $tamu->status_verifikasi === \App\Models\Tamu::STATUS_MENUNGGU;
    $disetujui = $tamu->status_verifikasi === \App\Models\Tamu::STATUS_DISETUJUI;
    $ditolak = $tamu->status_verifikasi === \App\Models\Tamu::STATUS_DITOLAK;
@endphp

{{-- ======================================================
     KARTU UTAMA — BADGE STATUS + LOG AKTIVITAS + AKSI
     ====================================================== --}}
<div class="dt-card">
    <div class="dt-head">
        <div class="dt-head-left">
            <span class="tamu-badge {{ $badgeKey }}" id="detailBadge" data-tamu-id="{{ $tamu->id }}">
                <i class="fas fa-circle"></i> {{ $badgeLabel }}
            </span>
            <div>
                <h5 class="dt-name">{{ $tamu->nama }}</h5>
                <span class="dt-sub">NIK {{ $tamu->nik }} · {{ $tamu->instansi ?? '-' }}</span>
            </div>
        </div>
        <a href="{{ route('admin.tamu.index') }}" class="dt-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- ===== CARD LOG AKTIVITAS — siapa & kapan perubahan terakhir ===== --}}
    <div class="dt-log">
        <div class="dt-log-icon"><i class="fas fa-clock-rotate-left"></i></div>
        <div>
            <div class="dt-log-title">Log Aktivitas Status</div>
            @if ($tamu->verified_at && $tamu->verified_by)
                <div class="dt-log-text">
                    Terakhir diperbarui oleh <strong>{{ $tamu->verifier_name }}</strong>
                    ({{ $tamu->verifier_role_label }})
                    pada {{ $tamu->verified_at->translatedFormat('d M Y') }}
                    jam {{ $tamu->verified_at->format('H.i') }}
                    — status saat ini <strong>{{ $badgeLabel }}</strong>.
                </div>
            @else
                <div class="dt-log-empty">Belum ada perubahan status — kunjungan menunggu verifikasi.</div>
            @endif
        </div>
    </div>

    {{-- ===== CHECK-IN / CHECK-OUT — kartu minimalis, satu tombol, real-time =====
         Tombol Check-Out hanya tampil bila tamu SEDANG berkunjung
         (sudah check-in, belum check-out) dan langsung memperbarui
         jam Check-Out tanpa reload halaman. --}}
    @include('admin.tamu._checkinout', [
        'co'          => $tamu->kunjunganState(),
        'checkinUrl'  => route('admin.tamu.checkin', $tamu),
        'checkoutUrl' => route('admin.tamu.checkout', $tamu),
    ])

    {{-- ===== TOMBOL AKSI — mengikuti status saat ini ===== --}}
    @can('tamu.checkout')
    <div class="dt-actions">
        @if ($menunggu)
            {{-- Menunggu: dua tombol utama --}}
            <form method="POST" action="{{ route('admin.tamu.approve', $tamu) }}"
                  class="dt-status-form" data-danger="0"
                  data-title="Setujui Kunjungan?" data-text="Kunjungan tamu {{ $tamu->nama }} akan DISETUJUI dan slot jadwalnya terkunci. Lanjutkan?">
                @csrf
                <button type="submit" class="dt-btn approve">
                    <i class="fas fa-check"></i> Setujui Kunjungan
                </button>
            </form>
            <form method="POST" action="{{ route('admin.tamu.reject', $tamu) }}"
                  class="dt-status-form" data-danger="1"
                  data-title="Batalkan Kunjungan?" data-text="Kunjungan tamu {{ $tamu->nama }} akan DIBATALKAN. Lanjutkan?">
                @csrf
                <button type="submit" class="dt-btn cancel">
                    <i class="fas fa-xmark"></i> Batalkan Kunjungan
                </button>
            </form>

        @elseif ($ditolak)
            {{-- Dibatalkan -> bisa diubah menjadi Disetujui --}}
            <form method="POST" action="{{ route('admin.tamu.approve', $tamu) }}"
                  class="dt-status-form" data-danger="0"
                  data-title="Ubah Menjadi Disetujui?" data-text="Status kunjungan {{ $tamu->nama }} yang saat ini DIBATALKAN akan diubah menjadi DISETUJUI. Lanjutkan?">
                @csrf
                <button type="submit" class="dt-btn approve">
                    <i class="fas fa-rotate"></i> Ubah Menjadi Disetujui
                </button>
            </form>

        @else
            {{-- Disetujui (atau Selesai) -> bisa diubah menjadi Dibatalkan --}}
            <form method="POST" action="{{ route('admin.tamu.reject', $tamu) }}"
                  class="dt-status-form" data-danger="1"
                  data-title="Ubah Menjadi Dibatalkan?" data-text="Status kunjungan {{ $tamu->nama }} yang saat ini DISETUJUI akan diubah menjadi DIBATALKAN. Lanjutkan?">
                @csrf
                <button type="submit" class="dt-btn cancel-outline">
                    <i class="fas fa-rotate"></i> Ubah Menjadi Dibatalkan
                </button>
            </form>
        @endif
    </div>
    @endcan
</div>

{{-- ======================================================
     DATA KUNJUNGAN
     ====================================================== --}}
<div class="dt-card">
    <div class="dt-section-title">Identitas & Kontak</div>
    <dl class="dt-grid" style="margin:0;">
        <div>
            <div class="dt-row"><dt>Nama Lengkap</dt><dd>{{ $tamu->nama }}</dd></div>
            <div class="dt-row"><dt>NIK / No. KTP</dt><dd>{{ $tamu->nik }}</dd></div>
            <div class="dt-row"><dt>Instansi</dt><dd>{{ $tamu->instansi ?? '-' }}</dd></div>
            <div class="dt-row">
                <dt>No. WhatsApp</dt>
                <dd>
                    @if ($tamu->no_hp)
                        <a href="{{ $tamu->wa_chat_url }}" target="_blank" rel="noopener" class="wa-chat-link">
                            <i class="fab fa-whatsapp"></i> {{ $tamu->no_hp }}
                        </a>
                    @else
                        -
                    @endif
                </dd>
            </div>
            <div class="dt-row">
                <dt>Email</dt>
                <dd>
                    @if ($tamu->email)
                        <a href="mailto:{{ $tamu->email }}" class="mailto-link">
                            <i class="fas fa-envelope"></i> {{ $tamu->email }}
                        </a>
                    @else
                        -
                    @endif
                </dd>
            </div>
        </div>
        <div>
            <div class="dt-row"><dt>Divisi Ditemui</dt><dd>{{ $tamu->tujuan_ditemui ?? '-' }}</dd></div>
            <div class="dt-row"><dt>Jabatan Ditemui</dt><dd>{{ $tamu->jabatan_ditemui ?? '-' }}</dd></div>
            <div class="dt-row"><dt>Orang Ditemui</dt><dd>{{ $tamu->orang_ditemui ?? '-' }}</dd></div>
            <div class="dt-row"><dt>Jumlah Tamu</dt><dd>{{ $tamu->jumlah_tamu }} orang</dd></div>
            <div class="dt-row">
                <dt>Jadwal Kunjungan</dt>
                <dd>{{ $tamu->tanggal_kunjungan?->translatedFormat('d F Y') ?? '-' }}
                    {{ $tamu->tanggal_kunjungan?->format('H:i') }}</dd>
            </div>
        </div>
    </dl>

    <div class="dt-section-title">Maksud &amp; Keperluan</div>
    <div class="dt-keperluan">{{ $tamu->keperluan ?: '-' }}</div>

    @if ($dokumenUrl)
        <div class="dt-section-title">Berkas Pendukung</div>
        <a href="{{ $dokumenUrl }}" target="_blank" rel="noopener" class="dt-doc-chip">
            <i class="fas fa-paperclip"></i> Buka / Unduh Dokumen
        </a>
    @endif
</div>

{{-- ==========================================================
     KONFIRMASI AKSI STATUS — dialog SweetAlert dua tombol
     (pengganti konfirmasi bawaan browser).

     Diletakkan DI DALAM @section('content') — bukan @push('scripts')
     — karena router.js hanya mengeksekusi ulang <script> yang berada
     di dalam konten setelah navigasi SPA; script di stack layout tidak
     pernah jalan lagi sehingga konfirmasi bisa hilang.
     Listener tingkat document dipasang sekali (guard) supaya tahan
     swap konten dan tidak terpasang ganda.
     ========================================================== --}}
<script>
    if (!window.__dtStatusConfirmBound) {
        window.__dtStatusConfirmBound = true;

        document.addEventListener('submit', function (e) {
            var form = e.target;
            if (!form || !form.classList || !form.classList.contains('dt-status-form')) return;

            /* Submit kedua setelah konfirmasi "Ya" → jalankan biasa. */
            if (form.getAttribute('data-swal-confirmed') === '1') {
                form.removeAttribute('data-swal-confirmed');
                return;
            }

            e.preventDefault();

            var title   = form.dataset.title   || 'Ubah Status?';
            var text    = form.dataset.text    || 'Lanjutkan perubahan status kunjungan ini?';
            var danger  = form.dataset.danger  === '1';

            AdminSwal.confirm({
                title: title,
                text: text,
                tone: danger ? 'danger' : undefined,
                confirmText: danger ? 'Ya, Batalkan' : 'Ya, Lanjutkan',
                cancelText: 'Kembali'
            }).then(function (confirmed) {
                if (!confirmed) return;
                form.setAttribute('data-swal-confirmed', '1');
                HTMLFormElement.prototype.submit.call(form);  // native submit, tanpa event ulang
            });
        });
    }
</script>
@endsection
