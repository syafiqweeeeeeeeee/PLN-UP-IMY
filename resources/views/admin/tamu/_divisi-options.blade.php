{{--
    Opsi "Orang / Divisi yang Ditemui" untuk custom dropdown divisi
    pada modal Tambah & Edit tamu (admin).

    Konten-only: elemen <div> dengan data-value — dirancang untuk
    dimuat di dalam .tamu-dd-options milik custom dropdown (pola yang
    sama dengan form registrasi publik /layanan/form-registrasi-tamu).
    Daftar & nilai identik agar data selalu cocok dengan pemblokiran
    slot per divisi.
--}}
@php
    $divisiGroups = [
        'Manager Operasi' => [
            'Bidang Prod A',
            'Bidang Prod B',
            'Bidang Prod C',
            'Bidang Prod D',
            'Supervisor CHCB A',
            'Supervisor CHCB B',
            'Supervisor CHCB C',
            'Supervisor CHCB D',
            'Bidang RenOps',
            'Bidang Niaga BB',
            'Bidang Kimia & Lab',
        ],
        'Manager Pemeliharaan' => [
            'Bidang Rendal Har',
            'Bidang MO',
            'Bidang Mesin 1',
            'Bidang Mesin 2',
            'Bidang Listrik',
            'Bidang Konin',
            'Bidang Inventori Kontrol & Gudang',
        ],
        'Manager Engineering' => [
            'Bidang SO',
            'Bidang CBM',
            'Bidang MMRK',
        ],
        'Manager Business Support' => [
            'Bidang Pengadaan',
            'Bidang SDM Umum CSR',
            'Bidang Keuangan',
        ],
        'Divisi / Jabatan Lainnya' => [
            'Bidang K3 & KAM',
            'Bidang Lingkungan',
        ],
    ];
@endphp

<div class="dropdown-option" data-value="">— Pilih Divisi —</div>

@foreach ($divisiGroups as $group => $items)
    <div class="dropdown-optgroup">{{ $group }}</div>
    @foreach ($items as $item)
        <div class="dropdown-option" data-value="{{ $item }}">{{ $item }}</div>
    @endforeach
@endforeach
