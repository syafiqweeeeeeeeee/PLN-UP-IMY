{{-- ==========================================================================
  MODAL: DETAIL TAMU — gaya MINIMALIS (bersih, spacing rapi, warna soft)

  Satu berkas untuk semua pemakaian supaya markup modal tidak lagi
  diduplikasi antara halaman daftar admin dan portal karyawan.
  Halaman detail TERPISAH (admin/tamu/detail) SUDAH DIHAPUS — modal ini
  menjadi satu-satunya tampilan detail kunjungan.

  DUA MODE PAKAI
  --------------
  * SHELL (tanpa $tamu) — struktur + slot kosong. Halaman daftar mengisi
    tubuh modal dari payload tamuData lewat JS openDetailModal(t):
        [data-role="info"]          daftar informasi utama
        [data-role="keperluan-*"]   Maksud & Keperluan
        [data-role="dokumen-*"]     Dokumen Pendukung
        [data-role="status-card"]   badge status verifikasi + info singkat
  * LENGKAP ($tamu diisi) — tubuh modal dirender langsung oleh server.

  CARD STATUS KUNJUNGAN
  ---------------------
  Hanya menampilkan status verifikasi (Menunggu / Disetujui / Ditolak)
  beserta informasi singkat siapa & kapan verifikasi terakhir dilakukan.
  Jam Check-In / Check-Out dan tombol aksinya TIDAK lagi ditampilkan di
  modal detail.

  PARAMETER (opsional)
  --------------------
    $tamu        \App\Models\Tamu  — diisi = mode lengkap
    $accentColor string            — warna aksen ikon header (tema halaman)
    $dokumenUrl  string|null       — URL unduh dokumen privat (mode lengkap)
  ========================================================================== --}}
@php
    $tamu        = $tamu ?? null;
    $isShell     = $tamu === null;
    $accentColor = $accentColor ?? 'var(--pln-blue)';
    $dokumenUrl  = $dokumenUrl ?? null;

    /** Baris daftar informasi utama — identitas & jadwal pendaftaran. */
    $infoRows = $isShell ? [] : array_values(array_filter([
        ['Nama Lengkap', $tamu->nama],
        ['NIK / No. KTP', $tamu->nik],
        ['No. WhatsApp / HP', $tamu->no_hp],
        ['Email', $tamu->email],
        ['Instansi', $tamu->instansi],
        ['Bidang Ditemui', $tamu->tujuan_ditemui],
        ['Jabatan Ditemui', $tamu->jabatan_ditemui],
        ['Orang yang Ditemui', $tamu->orang_ditemui],
        ['Jumlah Tamu', $tamu->jumlah_tamu . ' orang'],
        ['Tanggal Kunjungan', $tamu->tanggal_kunjungan?->format('Y-m-d H:i')],
        ['Waktu Pendaftaran', $tamu->created_at?->format('Y-m-d H:i')],
    ], fn ($row) => (string) $row[1] !== ''));

    /** Badge & informasi singkat verifikasi (mode lengkap). */
    $statusBadge = $isShell ? 'menunggu' : match ($tamu->status_verifikasi) {
        \App\Models\Tamu::STATUS_DISETUJUI => 'disetujui',
        \App\Models\Tamu::STATUS_DITOLAK   => 'ditolak',
        default                            => 'menunggu',
    };
    $statusLabel = $isShell ? 'Menunggu' : $tamu->verifikasi_label;

    $verifikasiInfo = $isShell ? null : (($tamu->verified_at && $tamu->verified_by)
        ? 'Terakhir diperbarui oleh ' . $tamu->verifier_name
            . ' (' . $tamu->verifier_role_label . ') pada '
            . $tamu->verified_at->format('Y-m-d')
            . ' jam ' . $tamu->verified_at->format('H.i')
            . ' — status verifikasi saat ini ' . $tamu->verifikasi_label . '.'
        : 'Belum ada perubahan status — kunjungan menunggu verifikasi.');
@endphp

@once
<style>
    /* Label seksi & kotak isi (Maksud/Keperluan, Dokumen).
       Warna memakai variabel --dtm-* dengan default netral, sehingga
       halaman portal karyawan bisa menimpanya sesuai temanya. */
    .dtm-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--dtm-muted, #9ca3af);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 1rem 0 0.4rem;
    }
    .dtm-box {
        background: var(--dtm-bg, #f8fafc);
        border: 1px solid var(--dtm-line, #eef2f7);
        border-radius: 10px;
        padding: 0.75rem 0.9rem;
        font-size: 0.83rem;
        color: var(--dtm-text, #374151);
        word-break: break-word;
    }
    .dtm-doc-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--dtm-link, #2563eb);
        background: var(--dtm-link-soft, #eff6ff);
        border: 1px solid var(--dtm-link-border, #dbeafe);
        border-radius: 10px;
        padding: 0.55rem 0.95rem;
        text-decoration: none;
        cursor: pointer;
    }
    .dtm-doc-btn:hover { filter: brightness(0.97); }
    .dtm-doc-btn i { color: #dc2626; }

    /* Kartu status kunjungan — badge verifikasi + info singkat. */
    .dtm-status-card {
        margin-top: 1rem;
        padding: 0.85rem 1rem;
        background: var(--dtm-bg, #f8fafc);
        border: 1px solid var(--dtm-line, #eef2f7);
        border-radius: 12px;
    }
    .dtm-status-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .dtm-status-caption {
        font-size: 0.66rem;
        font-weight: 700;
        color: var(--dtm-muted, #9ca3af);
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }
    .dtm-status-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.32rem 0.75rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .dtm-status-chip i { font-size: 0.6rem; }
    .dtm-status-chip.menunggu  { background: #fef3c7; color: #b45309; }
    .dtm-status-chip.disetujui { background: #dcfce7; color: #15803d; }
    .dtm-status-chip.ditolak   { background: #fee2e2; color: #dc2626; }
    .dtm-status-info {
        margin-top: 0.55rem;
        font-size: 0.8rem;
        line-height: 1.5;
        color: var(--dtm-text, #374151);
    }
    .dtm-status-info:empty { display: none; }

    html.theme-dark .dtm-box,
    html.theme-dark .dtm-status-card {
        background: var(--panel);
        border-color: var(--line);
        color: var(--ink);
    }
    html.theme-dark .dtm-doc-btn {
        background: rgba(37, 99, 235, .15);
        border-color: rgba(37, 99, 235, .35);
        color: #93c5fd;
    }
    html.theme-dark .dtm-status-info { color: var(--ink-body, #cbd5e1); }
    html.theme-dark .dtm-status-chip.menunggu  { background: rgba(180, 83, 9, .25); color: #fcd34d; }
    html.theme-dark .dtm-status-chip.disetujui { background: rgba(21, 128, 61, .25); color: #86efac; }
    html.theme-dark .dtm-status-chip.ditolak   { background: rgba(220, 38, 38, .25); color: #fca5a5; }
</style>
@endonce

<div class="tamu-modal-overlay" id="detailModal" onclick="if(event.target===this) closeTamuModal('detailModal')">
    <div class="tamu-modal modal-lg">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-user" style="color: {{ $accentColor }};"></i> Detail Tamu</h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('detailModal')"><i class="fas fa-xmark"></i></button>
        </div>

        <div class="tamu-modal-body" id="detailModalBody">
            @if($isShell)
                {{-- ===== SHELL — diisi JS openDetailModal(t) ===== --}}
                <div class="detail-list" data-role="info"></div>

                <div data-role="keperluan-wrap" hidden>
                    <div class="dtm-label">Maksud & Keperluan</div>
                    <div class="dtm-box" data-role="keperluan"></div>
                </div>

                <div data-role="dokumen-wrap" hidden>
                    <div class="dtm-label">Dokumen Pendukung</div>
                    <div data-role="dokumen"></div>
                </div>

                {{-- Kartu status kunjungan — diisi JS dari payload `verifikasi` & `log`. --}}
                <div class="dtm-status-card" data-role="status-card" hidden>
                    <div class="dtm-status-head">
                        <span class="dtm-status-chip menunggu" data-role="status-badge">
                            <i class="fas fa-circle"></i> <span data-role="status-label">Menunggu</span>
                        </span>
                        <span class="dtm-status-caption">Status Kunjungan</span>
                    </div>
                    <p class="dtm-status-info" data-role="status-info"></p>
                </div>

            @else
                {{-- ===== MODE LENGKAP — dirender server dari $tamu ===== --}}
                <div class="detail-list">
                    @foreach ($infoRows as [$label, $nilai])
                        <div class="detail-row">
                            <dt>{{ $label }}</dt>
                            <dd>{{ $nilai }}</dd>
                        </div>
                    @endforeach
                </div>

                @if ($tamu->keperluan)
                    <div class="dtm-label">Maksud & Keperluan</div>
                    <div class="dtm-box">{!! nl2br(e($tamu->keperluan)) !!}</div>
                @endif

                @if ($tamu->dokumen_zip && $dokumenUrl)
                    <div class="dtm-label">Dokumen Pendukung</div>
                    <a href="{{ $dokumenUrl }}" target="_blank" rel="noopener" class="dtm-doc-btn">
                        <i class="fas fa-paperclip"></i> Buka / Unduh Dokumen
                    </a>
                @endif

                {{-- Kartu status kunjungan: badge verifikasi + info singkat. --}}
                <div class="dtm-status-card">
                    <div class="dtm-status-head">
                        <span class="dtm-status-chip {{ $statusBadge }}">
                            <i class="fas fa-circle"></i> {{ $statusLabel }}
                        </span>
                        <span class="dtm-status-caption">Status Kunjungan</span>
                    </div>
                    <p class="dtm-status-info">{{ $verifikasiInfo }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
