{{--
    Opsi "Orang / Divisi yang Ditemui" (Bidang yang Ditemui) untuk
    custom dropdown divisi pada modal Tambah & Edit tamu (admin,
    portal karyawan) dan form registrasi publik
    /layanan/form-registrasi-tamu.

    SEBELUMNYA: daftar statis hardcoded — tidak ikut pembaruan master.
    SEKARANG  : dibangun dari MASTER BIDANGS (tabel bidangs yang dipakai
    juga Master Bidang & master jabatan) supaya daftar selalu sinkron
    dengan data yang dikelola admin.

    Konten-only: elemen <div> dengan data-value — dirancang untuk
    dimuat di dalam .tamu-dd-options / #divisi-options milik custom
    dropdown. Nilai yang dikirim tetap berupa NAMA bidang
    (data-value = bidangs.nama) — identik dengan kolom string
    `tamus.tujuan_ditemui`, sehingga seluruh data lama tetap cocok.

    Pengelompokan mengikuti hierarki master: tiap bidang tingkat
    teratas (parent_id NULL) menjadi judul optgroup, beserta semua
    keturunannya (Bidang::treeOrdered()). Akar "PLTU INDRAMAYU"
    dibuka lewat judul optgroup tersebut.
--}}
@php
    $bidangRows = \App\Models\Bidang::treeOrdered();
@endphp

<div class="dropdown-option" data-value="" data-selected="true">— Pilih Bidang —</div>

@php $currentGroup = null; @endphp

@foreach ($bidangRows as $row)
    @php
        $node  = $row['node'];
        $depth = $row['depth'];
    @endphp

    @if ($depth === 0)
        {{-- Bidang tingkat teratas: buka optgroup baru berdasar namanya --}}
        <div class="dropdown-optgroup">{{ $node->nama }}</div>
        @php $currentGroup = $node->nama; @endphp
    @endif

    {{-- Indentasi hierarki via class dd-depth-* (CSS) — BUKAN entitas
         &nbsp; supaya teks yang tampil / tersimpan tetap bersih. --}}
    <div class="dropdown-option dd-depth-{{ min($depth, 2) }}"
         data-value="{{ $node->nama }}"
         @if ($depth > 0) title="{{ $currentGroup }}" @endif>
        {{ $node->nama }}
    </div>
@endforeach

@if ($bidangRows->isEmpty())
    <div class="dropdown-placeholder">Belum ada bidang terdaftar</div>
@endif
