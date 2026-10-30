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
        [data-role="info"]        daftar informasi utama
        [data-role="log"]         kartu log aktivitas status
        [data-role="keperluan-*"]  Maksud & Keperluan
        [data-role="dokumen-*"]   Dokumen Pendukung
        [data-role="co-slot"]     kartu dinamis check-in/out (di-clone)
  * LENGKAP ($tamu diisi) — tubuh modal dirender langsung oleh server.

  ATURAN BAGIAN ATAS (revisi desain)
  ----------------------------------
  Daftar informasi utama HANYA memuat identitas & jadwal pendaftaran:
  Nama, NIK, kontak, instansi, tujuan, Jumlah Tamu, Tanggal Kunjungan,
  Waktu Pendaftaran. Baris Check-In / Check-Out / Status DIHAPUS —
  ketiganya pindah ke kartu dinamis di bawah, yang menangani 3 kondisi:

    Kondisi 1  Belum Check-In   badge  + tombol [Check-In Tamu (Tiba)]
    Kondisi 2  Sedang Berkunjung badge + jam Check-In aktual +
                                tombol [Check-Out Tamu (Pulang)]
    Kondisi 3  Selesai          jam Check-In + jam Check-Out + Durasi +
                                alert "Kunjungan selesai"

  Aksi tetap memakai fetch PATCH (JSON) sehingga jam & badge berubah
  REAL-TIME tanpa reload halaman.

  LOG AKTIVITAS (revisi — pengganti halaman detail yang DIHAPUS)
  --------------------------------------------------------------
  Kartu "Log Aktivitas Status" (siapa & kapan perubahan terakhir)
  kini ikut di dalam modal:
    * SHELL     — diisi JS dari payload tamuData[*].log (teks siap pakai)
    * LENGKAP   — dirender server dari verified_at / verified_by

  PARAMETER (opsional)
  --------------------
    $tamu        \App\Models\Tamu  — diisi = mode lengkap
    $accentColor string            — warna aksen ikon header (tema halaman)
    $checkinUrl  string            — URL aksi check-in  (':id' saat shell)
    $checkoutUrl string            — URL aksi check-out (':id' saat shell)
    $dokumenUrl  string|null       — URL unduh dokumen privat (mode lengkap)
  ========================================================================== --}}
@php
    $tamu        = $tamu ?? null;
    $isShell     = $tamu === null;
    $accentColor = $accentColor ?? 'var(--pln-blue)';
    $checkinUrl  = $checkinUrl ?? route('admin.tamu.checkin', $tamu ?? ':id');
    $checkoutUrl = $checkoutUrl ?? route('admin.tamu.checkout', $tamu ?? ':id');
    $dokumenUrl  = $dokumenUrl ?? null;
    $co          = $isShell ? null : $tamu->kunjunganState();

    /** Baris daftar informasi utama — TANPA Check-In / Check-Out / Status. */
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
        ['Tanggal Kunjungan', $tamu->tanggal_kunjungan?->format('d M Y, H:i')],
        ['Waktu Pendaftaran', $tamu->created_at?->format('d M Y, H:i')],
    ], fn ($row) => (string) $row[1] !== ''));

    /** Teks kartu LOG AKTIVITAS — sama dengan payload `log` di modal shell. */
    $logAktivitas = $isShell ? null : (($tamu->verified_at && $tamu->verified_by)
        ? 'Terakhir diperbarui oleh ' . $tamu->verifier_name
            . ' (' . $tamu->verifier_role_label . ') pada '
            . $tamu->verified_at->translatedFormat('d M Y')
            . ' jam ' . $tamu->verified_at->format('H.i')
            . ' — status saat ini ' . $tamu->kunjunganState()['badge_label'] . '.'
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

    /* Kartu log aktivitas — pengganti kartu log di halaman detail lama. */
    .dtm-log {
        display: flex; align-items: flex-start; gap: 0.75rem;
        margin-top: 1rem; padding: 0.8rem 0.95rem;
        background: var(--dtm-bg, #f8fafc);
        border: 1px solid var(--dtm-line, #eef2f7);
        border-radius: 10px;
    }
    .dtm-log-icon {
        width: 30px; height: 30px; border-radius: 9px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        background: #e7f9ee; color: #16a34a; font-size: 0.82rem;
    }
    .dtm-log-title {
        font-size: 0.66rem; font-weight: 700; color: #9ca3af;
        text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 0.15rem;
    }
    .dtm-log-text { font-size: 0.8rem; color: var(--dtm-text, #374151); line-height: 1.5; }
    html.theme-dark .dtm-log-icon { background: rgba(22,163,74,.18); color: #4ade80; }

    html.theme-dark .dtm-box {
        background: var(--panel);
        border-color: var(--line);
        color: var(--ink);
    }
    html.theme-dark .dtm-doc-btn {
        background: rgba(37, 99, 235, .15);
        border-color: rgba(37, 99, 235, .35);
        color: #93c5fd;
    }
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
                {{-- Daftar informasi utama: identitas + jadwal pendaftaran.
                     Check-In / Check-Out / Status sengaja TIDAK ada di sini. --}}
                <div class="detail-list" data-role="info"></div>

                {{-- Kartu LOG AKTIVITAS — diisi JS dari payload `log`. --}}
                <div class="dtm-log" data-role="log" hidden>
                    <div class="dtm-log-icon"><i class="fas fa-clock-rotate-left"></i></div>
                    <div>
                        <div class="dtm-log-title">Log Aktivitas Status</div>
                        <div class="dtm-log-text" data-role="log-text"></div>
                    </div>
                </div>

                <div data-role="keperluan-wrap" hidden>
                    <div class="dtm-label">Maksud & Keperluan</div>
                    <div class="dtm-box" data-role="keperluan"></div>
                </div>

                <div data-role="dokumen-wrap" hidden>
                    <div class="dtm-label">Dokumen Pendukung</div>
                    <div data-role="dokumen"></div>
                </div>

                {{-- Card dinamis (3 kondisi status + aksi) di-clone ke sini --}}
                <div data-role="co-slot"></div>

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

                {{-- Kartu LOG AKTIVITAS — siapa & kapan perubahan terakhir. --}}
                <div class="dtm-log">
                    <div class="dtm-log-icon"><i class="fas fa-clock-rotate-left"></i></div>
                    <div>
                        <div class="dtm-log-title">Log Aktivitas Status</div>
                        <div class="dtm-log-text">{{ $logAktivitas }}</div>
                    </div>
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

                {{-- Card dinamis: badge + jam + durasi + aksi (AJAX real-time) --}}
                @include('admin.tamu._checkinout', [
                    'co'          => $co,
                    'tamu'        => $tamu,
                    'checkinUrl'  => $checkinUrl,
                    'checkoutUrl' => $checkoutUrl,
                ])
            @endif
        </div>
    </div>
</div>