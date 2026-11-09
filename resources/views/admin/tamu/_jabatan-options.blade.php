{{--
    Opsi "Jabatan yang Ditemui" untuk custom dropdown jabatan pada
    modal Tambah & Edit tamu (admin, portal karyawan) dan form
    registrasi publik /layanan/form-registrasi-tamu.

    Dibangun dari MASTER JABATANS (tabel jabatans). Setiap opsi
    membawa attribute data-bidang berisi NAMA bidang induknya
    (jabatans.bidang_id → bidangs.nama) — dropdown jabatan bersifat
    BERTINGKAT: JS hanya menampilkan opsi yang data-bidang-nya cocok
    dengan bidang yang dipilih pada dropdown "Bidang yang Ditemui".

    Nilai yang dikirim tetap berupa NAMA jabatan (data-value =
    jabatans.nama) mengikuti pola kolom string yang dipakai tabel
    tamus, sehingga data lama tidak terkunci.

    DIBATASI 3 LEVEL (Jabatan::TAMU_LEVELS): Asisten Manajer, Junior,
    dan Staff lewat scope forTamu(). Jabatan Manager / Senior Manager
    dan level lain tidak lagi muncul — di form publik, modal admin,
    maupun portal karyawan (partial ini dipakai bersama).
--}}
@php
    $jabatanRows = \App\Models\Jabatan::query()
        ->forTamu()
        ->with('bidang:id,nama')
        ->orderBy('nama')
        ->get();
@endphp

<div class="dropdown-option dropdown-jabatan-placeholder" data-value="" data-selected="true">
    — Pilih Jabatan —
</div>

@foreach ($jabatanRows as $jabatan)
    {{-- data-id / data-bidang-id dipakai form registrasi tamu untuk
         cascading berbasis kunci primer; admin & portal tetap memakai
         data-bidang (nama) seperti sebelumnya. --}}
    <div class="dropdown-option dropdown-jabatan-option"
         data-value="{{ $jabatan->nama }}"
         data-id="{{ $jabatan->id }}"
         data-bidang="{{ $jabatan->bidang?->nama }}"
         data-bidang-id="{{ $jabatan->bidang_id }}"
         style="display: none;">
        {{ $jabatan->nama }}
    </div>
@endforeach
