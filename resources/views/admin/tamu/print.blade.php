<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LAPORAN BUKU REGISTRASI TAMU — {{ now()->format('d-m-Y') }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<style>
    :root {
        --pln-blue: #0064af;
        --pln-yellow: #ffd200;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10pt;
        background: #eef2f7;
        color: #000;
        padding: 1.5rem;
    }

    /* ================== TOOLBAR (tidak tercetak) ================== */
    .print-toolbar {
        max-width: 1400px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .print-toolbar .actions { display: flex; gap: 0.5rem; }

    .print-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.2rem;
        border-radius: 10px;
        border: 0;
        font-size: 0.83rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
    }

    .print-btn.primary { background: var(--pln-blue); color: #fff; }
    .print-btn.primary:hover { background: #005290; }
    .print-btn.soft { background: #fff; color: #334155; border: 1px solid #cbd5e1; }
    .print-btn.soft:hover { background: #f1f5f9; }

    /* ================== KERTAS ================== */
    .paper {
        max-width: min(1400px, calc(100vw - 3rem));
        margin: 0 auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgb(15 23 42 / 10%);
        padding: 2rem 2.5rem;
    }

    /* ---------- Kop surat resmi ---------- */
    .kop {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .kop-logo,
    .kop-spacer {
        flex: 0 0 78px;
        width: 78px;
    }

    .kop-logo img {
        display: block;
        height: 72px;
        width: auto;
        max-width: 78px;
        object-fit: contain;
    }

    /* Logo kanan = cermin lebar logo kiri supaya teks kop tetap
       center terhadap halaman. */
    .kop-spacer { height: 1px; }

    .kop-text { flex: 1; text-align: center; }

    .kop-nama {
        font-size: 1.35rem;
        font-weight: 700;
        line-height: 1.25;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .kop-unit {
        font-size: 1.05rem;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .kop-alamat {
        font-size: 0.75rem;
        line-height: 1.35;
        margin-top: 0.15rem;
    }

    /* Garis tebal ganda pembatas kop surat. */
    .kop-garis {
        border-top: 3px solid #000;
        border-bottom: 1px solid #000;
        height: 5px;
        margin: 0.55rem 0 1.15rem;
    }

    /* ---------- Judul dokumen ---------- */
    .doc-title { text-align: center; margin-bottom: 0.9rem; }

    .doc-title h1 {
        font-size: 14pt;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .doc-title p {
        font-size: 10pt;
        margin-top: 0.3rem;
    }

    .doc-meta {
        text-align: center;
        font-size: 9pt;
        margin-top: 0.2rem;
    }

    /* ================== TABEL LAPORAN ================== */
    /* table-layout: fixed + <colgroup> -> lebar kolom tetap & proporsional,
       total 100% sehingga tabel selalu muat di kertas A4 landscape. */
    table.grid {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        table-layout: fixed;
    }

    table.grid th,
    table.grid td {
        border: 1px solid #333;
        padding: 6px 8px;
        font-size: 9pt;
        line-height: 1.35;
        vertical-align: top;
        /* Teks panjang (keperluan, instansi, nama personil) turun baris,
           tidak terpotong / tidak melebar keluar kolom. */
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: normal;
    }

    table.grid th {
        background: #f2f2f2;
        text-align: center;
        font-weight: 700;
        text-transform: uppercase;
        /* Latar abu-abu header tetap tercetak. */
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    table.grid td.ctr { text-align: center; }
    table.grid td.left { text-align: left; }

    .nama-tamu { display: block; font-weight: 700; }

    .sub-line {
        display: block;
        font-size: 0.92em;
        color: #333;
    }

    .sub-line.label { font-weight: 600; }

    .status-badge {
        display: inline-block;
        padding: 0.1rem 0.45rem;
        border: 1px solid #333;
        border-radius: 999px;
        font-size: 0.88em;
        font-weight: 700;
        white-space: nowrap;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .status-badge.menunggu  { background: #fef3c7; color: #7c4a03; }
    .status-badge.disetujui { background: #dcfce7; color: #14532d; }
    .status-badge.berkunjung { background: #dbeafe; color: #1e3a8a; }
    .status-badge.selesai   { background: #e5e7eb; color: #111827; }
    .status-badge.ditolak   { background: #fee2e2; color: #7f1d1d; }

    /* ---------- Status kosong ---------- */
    .empty {
        text-align: center;
        padding: 2.5rem 1rem;
        font-size: 0.9rem;
        color: #555;
    }

    .empty i { font-size: 1.6rem; display: block; margin-bottom: 0.5rem; color: #999; }

    /* ---------- Tanda tangan ---------- */
    .ttd {
        margin-top: 28px;
        margin-left: auto;
        width: 300px;
        text-align: center;
        font-size: 10pt;
        page-break-inside: avoid;
    }

    .ttd .tempat { margin-bottom: 0.2rem; }

    .ttd .jabatan { font-weight: 600; }

    .ttd .ruang { height: 3.2rem; }

    .ttd .nama {
        font-weight: 700;
        text-decoration: underline;
    }

    /* ---------- Footer halaman web ---------- */
    .print-footnote {
        max-width: min(1400px, calc(100vw - 3rem));
        margin: 0.8rem auto 0;
        font-size: 0.72rem;
        color: #94a3b8;
        text-align: center;
    }

    /* ================== PRINT CSS ================== */
    /* @page margin HARUS 0: Chrome/Edge/Firefox hanya membuang header & footer
       bawaan browser (judul halaman, tanggal, dan URL seperti
       http://localhost:8000/admin/tamu/1/print) bila area margin halaman tidak
       menyisakan ruang untuk menggambarnya. Jarak aman ke tepi kertas dibuat
       lewat padding .paper di bawah, bukan lewat margin @page. */
    @page { size: A4 landscape; margin: 0; }

    @media print {
        html,
        body {
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: Arial, sans-serif;
            font-size: 10pt;
            color: #000;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Navigasi, catatan kaki web & tombol cetak tidak ikut tercetak. */
        .no-print,
        .print-toolbar,
        .print-footnote,
        .btn-print,
        header,
        footer,
        nav,
        aside {
            display: none !important;
        }

        .paper {
            max-width: none;
            margin: 0;
            /* Margin cetak pengganti @page margin: 0. Padding kiri/kanan
               berlaku di semua halaman; header tabel yang berulang
               (thead table-header-group) menjaga halaman lanjutan tetap
               terbaca meski padding atas hanya di halaman pertama. */
            padding: 10mm 12mm;
            border-radius: 0;
            box-shadow: none;
        }

        table.grid {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table.grid th,
        table.grid td {
            border: 1px solid #333 !important;
            padding: 6px 8px;
            font-size: 9pt;
        }

        table.grid th {
            background-color: #f2f2f2 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            text-align: center;
        }

        /* Header tabel berulang di setiap halaman. */
        table.grid thead { display: table-header-group; }
        table.grid tr { page-break-inside: avoid; }

        /* Badge status dibuat hitam-putih agar tetap tegas saat dicetak. */
        .status-badge {
            background: transparent !important;
            color: #000 !important;
            border: 1px solid #333 !important;
        }
    }
</style>
</head>
<body class="is-report">

{{-- Toolbar pengaturan (tidak ikut tercetak) --}}
<div class="print-toolbar no-print">
    <div class="actions">
        <a href="{{ route('admin.tamu.index', request()->only(['q', 'dari', 'sampai', 'status'])) }}" class="print-btn soft">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button type="button" class="print-btn primary" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak / Simpan PDF
        </button>
    </div>
</div>

@php
    /* Label status filter — dipakai baris meta judul. */
    $labelStatus = [
        'menunggu'   => 'Menunggu Verifikasi',
        'disetujui'  => 'Disetujui / Selesai',
        'ditolak'    => 'Ditolak',
        'berkunjung' => 'Berkunjung',
        'selesai'    => 'Selesai',
    ];

    /* Nama bulan Indonesia — tidak bergantung pada locale Carbon. */
    $bulanId = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];
    $formatTanggal = static fn ($tanggal) => $tanggal->format('d')
        . ' ' . $bulanId[(int) $tanggal->format('n')]
        . ' ' . $tanggal->format('Y');

    /* Periode cetak: mengikuti filter tanggal bila ada, selain itu
       tanggal dokumen ini dicetak. */
    $periodeCetak = collect([
        $filter['dari'] ? $formatTanggal(\Illuminate\Support\Carbon::parse($filter['dari'])) : null,
        $filter['sampai'] ? $formatTanggal(\Illuminate\Support\Carbon::parse($filter['sampai'])) : null,
    ])->filter()->implode(' s/d ');

    if ($periodeCetak === '') {
        $periodeCetak = $formatTanggal(now());
    }
@endphp

<div class="paper">

    {{-- ================= KOP SURAT RESMI ================= --}}
    <div class="kop">
        <div class="kop-logo">
            <img src="{{ asset('assets/images/logo-pln1.png') }}" alt="Logo PLN Nusantara Power">
        </div>
        <div class="kop-text">
            <div class="kop-nama">PT PLN NUSANTARA POWER</div>
            <div class="kop-unit">UNIT PEMBANGKITAN INDRAMAYU</div>
            <div class="kop-alamat">Jl. Raya Preteg - Sumuradem, Kec. Sukra, Kab. Indramayu, Jawa Barat 45257</div>
        </div>
        <div class="kop-spacer" aria-hidden="true"></div>
    </div>
    <div class="kop-garis"></div>

    {{-- ================= JUDUL & INFORMASI CETAK ================= --}}
    <div class="doc-title">
        <h1>LAPORAN BUKU REGISTRASI TAMU</h1>
        <p>Periode Cetak: {{ $periodeCetak }} | Waktu Cetak: {{ now()->format('H:i') }} WIB</p>
        @if ($filter['q'] || $filter['status'])
            <p class="doc-meta">
                @if ($filter['q'])Pencarian: {{ $filter['q'] }}@endif
                @if ($filter['q'] && $filter['status']) | @endif
                @if ($filter['status'] && isset($labelStatus[$filter['status']]))Status: {{ $labelStatus[$filter['status']] }}@endif
            </p>
        @endif
    </div>

    {{-- ================= TABEL DATA ================= --}}
    <table class="grid">
        {{-- Lebar kolom tetap; total 100% agar muat di A4 landscape. --}}
        <colgroup>
            <col style="width:4%">{{-- No --}}
            <col style="width:11%">{{-- Waktu & Tanggal Kunjungan --}}
            <col style="width:16%">{{-- Nama Tamu & Instansi --}}
            <col style="width:13%">{{-- NIK & No. WhatsApp --}}
            <col style="width:15%">{{-- Bidang & Jabatan Ditemui --}}
            <col style="width:11%">{{-- Personil Ditemui --}}
            <col style="width:17%">{{-- Keperluan --}}
            <col style="width:13%">{{-- Status Verifikasi --}}
        </colgroup>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu &amp; Tanggal Kunjungan</th>
                <th>Nama Tamu &amp; Instansi</th>
                <th>NIK &amp; No. WhatsApp</th>
                <th>Bidang &amp; Jabatan Ditemui</th>
                <th>Personil Ditemui</th>
                <th>Keperluan</th>
                <th>Status Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tamus as $tamu)
                <tr>
                    <td class="ctr">{{ $loop->iteration }}</td>

                    {{-- Waktu & tanggal kunjungan --}}
                    <td class="ctr">
                        @if ($tamu->tanggal_kunjungan)
                            <span class="sub-line">{{ $tamu->tanggal_kunjungan->format('d/m/Y') }}</span>
                            <span class="sub-line">{{ $tamu->tanggal_kunjungan->format('H:i') }} WIB</span>
                        @else
                            —
                        @endif
                    </td>

                    {{-- Nama tamu & instansi --}}
                    <td class="left">
                        <span class="nama-tamu">{{ $tamu->nama }}</span>
                        <span class="sub-line">{{ $tamu->instansi ?: '—' }}</span>
                    </td>

                    {{-- NIK & No. WhatsApp --}}
                    <td class="ctr">
                        <span class="sub-line">{{ $tamu->nik ?: '—' }}</span>
                        <span class="sub-line">{{ $tamu->no_hp ?: '—' }}</span>
                    </td>

                    {{-- Bidang & jabatan yang ditemui --}}
                    <td class="left">
                        <span class="sub-line">{{ $tamu->tujuan_ditemui ?: '—' }}</span>
                        <span class="sub-line">{{ $tamu->jabatan_ditemui ?: '—' }}</span>
                    </td>

                    {{-- Personil yang ditemui --}}
                    <td class="left">{{ $tamu->orang_ditemui ?: '—' }}</td>

                    {{-- Keperluan (teks penuh, tidak dipotong) --}}
                    <td class="left">{{ $tamu->keperluan }}</td>

                    {{-- Status verifikasi (tanpa jam check-in/check-out) --}}
                    <td class="ctr">
                        @php
                            [$statusLabel, $statusClass] = match ($tamu->status_verifikasi) {
                                \App\Models\Tamu::STATUS_DITOLAK   => ['Ditolak', 'ditolak'],
                                \App\Models\Tamu::STATUS_MENUNGGU  => ['Menunggu Verifikasi', 'menunggu'],
                                default                             => ['Disetujui', 'disetujui'],
                            };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="empty">
                            <i class="fas fa-inbox"></i>
                            Tidak ada data tamu untuk kombinasi filter ini.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($tamus->isNotEmpty())
        {{-- ================= KOLOM PENGESAHAN ================= --}}
        <div class="ttd">
            <div class="tempat">Indramayu, {{ $formatTanggal(now()) }}</div>
            <div class="jabatan">Petugas Security / Admin Services</div>
            <div class="ruang"></div>
            <div class="nama">( _______________________ )</div>
        </div>
    @endif
</div>

<div class="print-footnote no-print">
    Gunakan tombol <b>Cetak / Simpan PDF</b> — pada dialog cetak pilih tujuan "Save as PDF" untuk menyimpan sebagai berkas PDF.
</div>

<script>
    // Fokus jendela lalu buka dialog cetak otomatis saat halaman siap.
    window.addEventListener('load', function () {
        try { window.focus(); } catch (e) {}
        setTimeout(function () { window.print(); }, 350);
    });
</script>
</body>
</html>
