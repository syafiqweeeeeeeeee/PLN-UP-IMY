<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cetak Data Tamu ({{ $style === 'pdf' ? 'Laporan' : 'Spreadsheet' }})</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<style>
    :root {
        --pln-blue: #0064af;
        --pln-yellow: #ffd200;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: "Segoe UI", system-ui, -apple-system, Arial, sans-serif;
        background: #eef2f7;
        color: #1e293b;
        padding: 1.5rem;
    }

    /* ================== TOOLBAR (tidak tercetak) ================== */
    .print-toolbar {
        max-width: 1150px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .print-toolbar .switch {
        display: inline-flex;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }

    .print-toolbar .switch a {
        padding: 0.55rem 1.1rem;
        font-size: 0.83rem;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
    }

    .print-toolbar .switch a.active {
        background: var(--pln-blue);
        color: #fff;
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
        max-width: 1150px;
        margin: 0 auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgb(15 23 42 / 10%);
        padding: 2rem 2.25rem;
    }

    /* ---------- Kop laporan (gaya pdf) ---------- */
    .kop {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        border-bottom: 4px double #0f172a;
        padding-bottom: 0.9rem;
        margin-bottom: 1.1rem;
    }

    .kop-logo {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: var(--pln-blue);
        color: var(--pln-yellow);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        flex-shrink: 0;
    }

    .kop-text { flex: 1; }

    .kop-text .instansi {
        font-size: 0.78rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #475569;
    }

    .kop-text h1 { font-size: 1.12rem; text-transform: uppercase; letter-spacing: 0.03em; }

    .kop-text .sub { font-size: 0.8rem; color: #64748b; }

    /* ---------- Judul dokumen ---------- */
    .doc-title { text-align: center; margin-bottom: 1.25rem; }

    .doc-title h2 {
        font-size: 1.05rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .doc-title p { font-size: 0.8rem; color: #64748b; margin-top: 0.2rem; }

    /* ---------- Info filter / meta ---------- */
    .meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem 1.5rem;
        font-size: 0.78rem;
        color: #475569;
        margin-bottom: 0.9rem;
    }

    .meta b { color: #0f172a; }

    /* ---------- Ringkasan (gaya pdf) ---------- */
    .ringkasan {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .ringkasan .chip {
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 999px;
        padding: 0.3rem 0.85rem;
        font-size: 0.75rem;
        color: #334155;
    }

    .ringkasan .chip b { color: var(--pln-blue); }

    /* ================== TABEL GAYA EXCEL ================== */
    .sheet table.grid { border-collapse: collapse; width: 100%; }

    .sheet table.grid th,
    .sheet table.grid td {
        border: 1px solid #b6c2d2;
        padding: 0.3rem 0.45rem;
        font-size: 0.74rem;
        line-height: 1.35;
        vertical-align: top;
    }

    .sheet table.grid thead th {
        background: #dce6f1;
        color: #1f2937;
        font-weight: 700;
        text-align: center;
        position: sticky;
        top: 0;
    }

    /* header kolom seperti "row header" Excel: abjad A, B, C ... */
    .sheet table.grid thead th .col-id { display: block; font-size: 0.6rem; color: #64748b; font-weight: 600; }

    .sheet table.grid tbody tr:nth-child(even) td { background: #f6f9fd; }

    .sheet table.grid td.num { text-align: right; white-space: nowrap; }
    .sheet table.grid td.ctr { text-align: center; white-space: nowrap; }

    .sheet .rownum {
        background: #eef2f7;
        color: #64748b;
        text-align: center;
        font-size: 0.68rem;
        font-weight: 600;
    }

    /* ================== TABEL GAYA PDF (laporan) ================== */
    .report table.grid { border-collapse: collapse; width: 100%; }

    .report table.grid th {
        background: var(--pln-blue);
        color: #fff;
        font-size: 0.74rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 0.55rem 0.5rem;
        text-align: left;
    }

    .report table.grid td {
        border-bottom: 1px solid #e2e8f0;
        padding: 0.5rem;
        font-size: 0.78rem;
        vertical-align: top;
    }

    .report table.grid tbody tr:nth-child(even) td { background: #f8fafc; }

    .report table.grid td.num { text-align: right; }
    .report table.grid td.ctr { text-align: center; }

    .report .badge {
        display: inline-block;
        padding: 0.12rem 0.55rem;
        border-radius: 999px;
        font-size: 0.68rem;
        font-weight: 700;
    }

    .report .badge.berkunjung { background: #dbeafe; color: #1d4ed8; }
    .report .badge.selesai { background: #dcfce7; color: #15803d; }

    /* ---------- Tanda tangan (gaya pdf) ---------- */
    .ttd {
        margin-top: 2.2rem;
        margin-left: auto;
        width: 280px;
        text-align: center;
        font-size: 0.8rem;
        page-break-inside: avoid;
    }

    .ttd .tempat { margin-bottom: 2.6rem; }

    .ttd .nama { font-weight: 700; text-decoration: underline; }

    /* ---------- Status kosong ---------- */
    .empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: #64748b;
        font-size: 0.85rem;
    }

    .empty i { font-size: 1.6rem; display: block; margin-bottom: 0.5rem; color: #cbd5e1; }

    /* ---------- Footer halaman web ---------- */
    .print-footnote {
        max-width: 1150px;
        margin: 0.8rem auto 0;
        font-size: 0.72rem;
        color: #94a3b8;
        text-align: center;
    }

    /* ================== PRINT CSS ================== */
    @page { size: A4 landscape; margin: 12mm; }

    @media print {
        body { background: #fff; padding: 0; }

        .print-toolbar, .print-footnote { display: none !important; }

        .paper {
            max-width: none;
            border-radius: 0;
            box-shadow: none;
            padding: 0;
        }

        /* Gaya excel: header tabel berulang tiap halaman */
        table.grid thead { display: table-header-group; }
        tr { page-break-inside: avoid; }

        .sheet table.grid thead th { position: static; }

        /* Tanggal cetak kecil di bawah tabel */
        .printed-at { margin-top: 0.8rem; font-size: 0.68rem; color: #64748b; }
    }

    .printed-at { margin-top: 0.8rem; font-size: 0.7rem; color: #64748b; }
</style>
</head>
<body>

{{-- Toolbar pengaturan (tidak ikut tercetak) --}}
<div class="print-toolbar">
    <div class="switch">
        <a href="{{ route('admin.tamu.print', array_merge(['style' => 'excel'], request()->only(['q', 'dari', 'sampai', 'status']))) }}"
           class="{{ $style === 'excel' ? 'active' : '' }}">
            <i class="fas fa-table-cells-large"></i> Gaya Excel
        </a>
        <a href="{{ route('admin.tamu.print', array_merge(['style' => 'pdf'], request()->only(['q', 'dari', 'sampai', 'status']))) }}"
           class="{{ $style === 'pdf' ? 'active' : '' }}">
            <i class="fas fa-file-lines"></i> Gaya PDF / Laporan
        </a>
    </div>
    <div class="actions">
        <a href="{{ route('admin.tamu.index', request()->only(['q', 'dari', 'sampai', 'status'])) }}" class="print-btn soft">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button type="button" class="print-btn primary" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak / Simpan PDF
        </button>
    </div>
</div>

<div class="paper {{ $style === 'pdf' ? 'report' : 'sheet' }}">

    @if ($style === 'pdf')
        {{-- ================= KOP LAPORAN RESMI ================= --}}
        <div class="kop">
            <div class="kop-logo"><i class="fas fa-bolt"></i></div>
            <div class="kop-text">
                <div class="instansi">PT PLN (Persero) — Unit Induk Distribusi</div>
                <h1>PLN Nusantara Power</h1>
                <div class="sub">UP Pati — Buku Registrasi Pengunjung</div>
            </div>
            <div style="text-align:right; font-size:0.72rem; color:#64748b;">
                No. Dok: BRT/{{ now()->format('Ym') }}/{{ str_pad((string) $tamus->count(), 4, '0', STR_PAD_LEFT) }}
            </div>
        </div>
    @endif

    <div class="doc-title">
        <h2>{{ $style === 'pdf' ? 'Laporan Daftar Tamu' : 'Data Tamu — Buku Registrasi' }}</h2>
        <p>
            @if ($filter['dari'] || $filter['sampai'])
                Periode {{ $filter['dari'] ? \Illuminate\Support\Carbon::parse($filter['dari'])->translatedFormat('d M Y') : 'awal' }}
                s/d {{ $filter['sampai'] ? \Illuminate\Support\Carbon::parse($filter['sampai'])->translatedFormat('d M Y') : 'sekarang' }}
            @else
                Seluruh periode
            @endif
            — dicetak {{ now()->translatedFormat('d M Y H:i') }} WIB
        </p>
    </div>

    @if ($style === 'pdf')
        {{-- Ringkasan jumlah per status --}}
        <div class="ringkasan">
            <span class="chip"><i class="fas fa-list" style="margin-right:0.35rem;"></i>Total: <b>{{ $tamus->count() }} tamu</b></span>
            <span class="chip"><i class="fas fa-user-clock" style="margin-right:0.35rem;"></i>Berkunjung: <b>{{ $tamus->whereNull('checked_out_at')->count() }}</b></span>
            <span class="chip"><i class="fas fa-circle-check" style="margin-right:0.35rem;"></i>Selesai: <b>{{ $tamus->whereNotNull('checked_out_at')->count() }}</b></span>
            @if ($filter['status'])
                <span class="chip"><i class="fas fa-filter" style="margin-right:0.35rem;"></i>Filter status: <b>{{ $filter['status'] === 'selesai' ? 'Selesai' : 'Berkunjung' }}</b></span>
            @endif
        </div>
    @endif

    @if ($filter['q'] || $filter['dari'] || $filter['sampai'] || $filter['status'])
        <div class="meta">
            @if ($filter['q'])<span>Pencarian: <b>{{ $filter['q'] }}</b></span>@endif
            @if ($filter['status'])<span>Status: <b>{{ $filter['status'] === 'selesai' ? 'Selesai' : 'Berkunjung' }}</b></span>@endif
        </div>
    @endif

    {{-- ================= TABEL DATA ================= --}}
    <table class="grid">
        <thead>
            <tr>
                <th style="width:2.6rem;">
                    @if ($style === 'excel')<span class="col-id">A</span>@endif
                    No
                </th>
                <th style="width:7.5rem;">
                    @if ($style === 'excel')<span class="col-id">B</span>@endif
                    Waktu Daftar
                </th>
                <th style="width:7.5rem;">
                    @if ($style === 'excel')<span class="col-id">C</span>@endif
                    Tgl Kunjungan
                </th>
                <th>
                    @if ($style === 'excel')<span class="col-id">D</span>@endif
                    Nama
                </th>
                <th style="width:10rem;">
                    @if ($style === 'excel')<span class="col-id">E</span>@endif
                    NIK
                </th>
                <th style="width:7rem;">
                    @if ($style === 'excel')<span class="col-id">F</span>@endif
                    No. HP
                </th>
                <th>
                    @if ($style === 'excel')<span class="col-id">G</span>@endif
                    Email
                </th>
                <th>
                    @if ($style === 'excel')<span class="col-id">H</span>@endif
                    Instansi
                </th>
                <th>
                    @if ($style === 'excel')<span class="col-id">I</span>@endif
                    Tujuan Ditemui
                </th>
                <th style="width:3.4rem;">
                    @if ($style === 'excel')<span class="col-id">J</span>@endif
                    Jml
                </th>
                <th>
                    @if ($style === 'excel')<span class="col-id">K</span>@endif
                    Keperluan
                </th>
                <th style="width:7.5rem;">
                    @if ($style === 'excel')<span class="col-id">L</span>@endif
                    Check-In
                </th>
                <th style="width:7.5rem;">
                    @if ($style === 'excel')<span class="col-id">M</span>@endif
                    Check-Out
                </th>
                <th style="width:6rem;">
                    @if ($style === 'excel')<span class="col-id">N</span>@endif
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tamus as $tamu)
                <tr>
                    <td class="{{ $style === 'excel' ? 'rownum' : 'ctr' }}">{{ $loop->iteration }}</td>
                    <td class="ctr">{{ $tamu->created_at?->format('d/m/Y H:i') }}</td>
                    <td class="ctr">{{ $tamu->tanggal_kunjungan?->format('d/m/Y H:i') }}</td>
                    <td><strong>{{ $tamu->nama }}</strong></td>
                    <td class="ctr">{{ $tamu->nik }}</td>
                    <td class="ctr">{{ $tamu->no_hp }}</td>
                    <td>{{ $tamu->email ?? '—' }}</td>
                    <td>{{ $tamu->instansi ?? '—' }}</td>
                    <td>{{ $tamu->tujuan_ditemui }}</td>
                    <td class="num">{{ $tamu->jumlah_tamu }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($tamu->keperluan, 120) }}</td>
                    <td class="ctr">{{ $tamu->checked_in_at?->format('d/m/Y H:i') ?? '—' }}</td>
                    <td class="ctr">{{ $tamu->checked_out_at?->format('d/m/Y H:i') ?? '—' }}</td>
                    <td class="ctr">
                        @if ($style === 'pdf')
                            <span class="badge {{ $tamu->checked_out_at ? 'selesai' : 'berkunjung' }}">
                                {{ $tamu->checked_out_at ? 'Selesai' : 'Berkunjung' }}
                            </span>
                        @else
                            {{ $tamu->checked_out_at ? 'Selesai' : 'Berkunjung' }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="14">
                        <div class="empty">
                            <i class="fas fa-inbox"></i>
                            Tidak ada data tamu untuk kombinasi filter ini.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($style === 'pdf' && $tamus->isNotEmpty())
        {{-- Blok tanda tangan --}}
        <div class="ttd">
            <div class="tempat">Yogyakarta, {{ now()->translatedFormat('d F Y') }}</div>
            <div style="margin-bottom:2.6rem;">Mengetahui,</div>
            <div class="nama">( .................................... )</div>
            <div style="font-size:0.72rem; color:#64748b;">Petugas Front Office</div>
        </div>
    @endif

    <div class="printed-at">
        Dicetak dari {{ request()->getHost() }} — {{ now()->translatedFormat('d/m/Y H:i:s') }} |
        {{ $tamus->count() }} baris data
        @if ($style === 'pdf')| No. Dok: BRT/{{ now()->format('Ym') }}/{{ str_pad((string) $tamus->count(), 4, '0', STR_PAD_LEFT) }}@endif
    </div>
</div>

<div class="print-footnote">
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
