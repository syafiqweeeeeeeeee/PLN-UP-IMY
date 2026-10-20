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
--}}
@php
    $jabatanRows = \App\Models\Jabatan::query()
        ->with('bidang:id,nama')
        ->orderBy('nama')
        ->get();
@endphp

<div class="dropdown-option dropdown-jabatan-placeholder" data-value="" data-selected="true">
    — Pilih Jabatan —
</div>

@foreach ($jabatanRows as $jabatan)
    <div class="dropdown-option dropdown-jabatan-option"
         data-value="{{ $jabatan->nama }}"
         data-bidang="{{ $jabatan->bidang?->nama }}"
         style="display: none;">
        {{ $jabatan->nama }}
    </div>
@endforeach
