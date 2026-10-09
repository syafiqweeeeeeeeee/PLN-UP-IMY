{{--
    Opsi "Orang / Divisi yang Ditemui" untuk select di modal
    Tambah & Edit tamu. Daftar & nilai identik dengan form registrasi
    publik (/layanan/form-registrasi-tamu) agar data selalu cocok
    dengan pemblokiran slot per divisi.
--}}
@php
    $divisiGroups = [
        'Manager Operasi' => [
            'Assisten Manajer Prod A',
            'Assisten Manajer Prod B',
            'Assisten Manajer Prod C',
            'Assisten Manajer Prod D',
            'Supervisor CHCB A',
            'Supervisor CHCB B',
            'Supervisor CHCB C',
            'Supervisor CHCB D',
            'Assisten Manajer RenOps',
            'Assisten Manajer Niaga BB',
            'Assisten Manajer Kimia & Lab',
        ],
        'Manager Pemeliharaan' => [
            'Assisten Manajer Rendal Har',
            'Assisten Manajer MO',
            'Assisten Manajer Mesin 1',
            'Assisten Manajer Mesin 2',
            'Assisten Manajer Listrik',
            'Assisten Manajer Konin',
            'Assisten Manajer Inventori Kontrol & Gudang',
        ],
        'Manager Engineering' => [
            'Assisten Manajer SO',
            'Assisten Manajer CBM',
            'Assisten Manajer MMRK',
        ],
        'Manager Business Support' => [
            'Assisten Manajer Pengadaan',
            'Assisten Manajer SDM Umum CSR',
            'Assisten Manajer Keuangan',
        ],
        'Posisi Langsung di Bawah Senior Manager' => [
            'Assisten Manager K3 & KAM',
            'Assisten Manager Lingkungan',
        ],
    ];

    // Dipakai saat form Tambah gagal validasi (old input dipertahankan)
    $oldTujuan = old('tujuan_ditemui');
@endphp

<option value="">— Pilih Divisi —</option>

@foreach ($divisiGroups as $group => $items)
    <optgroup label="{{ $group }}">
        @foreach ($items as $item)
            <option value="{{ $item }}" @selected($oldTujuan === $item)>{{ $item }}</option>
        @endforeach
    </optgroup>
@endforeach
