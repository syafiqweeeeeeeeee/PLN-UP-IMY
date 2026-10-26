{{--
    DROPDOWN FILTER SCROLLABLE — dipakai baris filter Data Karyawan.
    Pengganti <select> bawaan browser untuk tiap parameter GET.

    @param string $name        nama field: name pada hidden input & data-dd wrapper
    @param string $title       nama kontrol untuk AT, mis. "Filter BIDANG"
    @param string $placeholder teks opsi "tanpa filter"
    @param mixed  $value       nilai aktif dari request()
    @param array  $options     [['value' =>, 'name' =>, 'prefix'? =>, 'data'? => [...]], ...]

    Daftar opsi dibatasi max-height 220px + overflow-y auto (scrollbar halus),
    tanpa search bar. Value filter dikirim lewat <input type="hidden"> sehingga
    filter, ekspor & pagination menerima parameter yang sama seperti dulu.
    `prefix` dipakai penanda hierarki (mis. "— — ") dan ikut bersih di teks
    yang dikirim sebagai data-label.
--}}
@php
    $ddWrap    = 'dk-'.$name.'-dd';
    $ddMenu    = 'dk-'.$name.'-menu';
    $ddTrigger = 'dk_'.$name.'_trigger';

    $labels = [];
    foreach ($options as $opt) {
        $labels[(string) $opt['value']] = ($opt['prefix'] ?? '').$opt['name'];
    }

    // Nilai request yang sudah tidak ada di daftar → dibuang, persis perilaku
    // <select> bawaan yang selalu jatuh ke opsi pertama.
    $value  = (string) $value;
    $active = array_key_exists($value, $labels);
    $text   = $active ? $labels[$value] : $placeholder;
@endphp

<input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $active ? $value : '' }}">
<div class="dk-dd" id="{{ $ddWrap }}" data-dd="{{ $name }}">
    <button type="button"
            id="{{ $ddTrigger }}"
            class="dk-dd-trigger{{ $active ? '' : ' is-placeholder' }}"
            title="{{ $text }}"
            aria-label="{{ $title }}: {{ $text }}"
            aria-haspopup="listbox"
            aria-expanded="false"
            aria-controls="{{ $ddMenu }}">
        <span class="dk-dd-label">{{ $text }}</span>
        <i class="fas fa-chevron-down dk-dd-chevron" aria-hidden="true"></i>
    </button>

    <div class="custom-dropdown-menu dk-dd-menu" id="{{ $ddMenu }}" role="listbox"
         aria-labelledby="{{ $ddTrigger }}" hidden>
        <button type="button"
                class="dropdown-option dk-dd-empty{{ $active ? '' : ' is-selected' }}"
                role="option"
                aria-selected="{{ $active ? 'false' : 'true' }}"
                data-value=""
                data-label="{{ $placeholder }}">
            <span>{{ $placeholder }}</span>
            <i class="fas fa-check dk-dd-check" aria-hidden="true"></i>
        </button>
        @foreach ($options as $opt)
            @php
                $on       = $active && $value === (string) $opt['value'];
                $optLabel = ($opt['prefix'] ?? '').$opt['name'];
            @endphp
            <button type="button"
                    class="dropdown-option{{ $on ? ' is-selected' : '' }}"
                    role="option"
                    aria-selected="{{ $on ? 'true' : 'false' }}"
                    data-value="{{ $opt['value'] }}"
                    data-label="{{ $optLabel }}"
                    @foreach (($opt['data'] ?? []) as $dk => $dv) data-{{ $dk }}="{{ $dv }}" @endforeach>
                <span>@if (($opt['prefix'] ?? '') !== '')<span class="dk-dd-dash" aria-hidden="true">{{ $opt['prefix'] }}</span>@endif{{ $opt['name'] }}</span>
                <i class="fas fa-check dk-dd-check" aria-hidden="true"></i>
            </button>
        @endforeach
    </div>
</div>
