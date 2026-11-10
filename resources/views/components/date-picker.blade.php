@props([
    'name' => null,
    'id' => null,
    'value' => null,
    'min' => null,
    'max' => null,
    'placeholder' => 'Pilih tanggal',
    'size' => null,
    'blockWeekends' => false,
    'blocked' => [],
    'workDates' => [],
    'clearable' => false,
    'required' => false,
    'disabled' => false,
    'icon' => 'fa-calendar-days',
    'wrapperClass' => '',
    'placement' => 'auto',
    'yearStart' => null,
    'yearEnd' => null,
])

@php
    /* ------------------------------------------------------------
       DATE PICKER — komponen global (lihat public/css/date-picker.css
       & public/js/date-picker.js).

       Nilai selalu dikirim sebagai YYYY-MM-DD. Hanya atribut di bawah
       ini yang dibaca oleh mesin kalender:

         min="today" | "YYYY-MM-DD"   → batas bawah (opsional)
         max="today" | "YYYY-MM-DD"   → batas atas (opsional)
         :block-weekends="true"       → Sabtu/Minggu disabled (merah)
         :blocked="['2026-12-25' => 'Natal']" → tanggal merah disabled
         :work-dates="['2026-11-07' => 'Lembur']" → override weekend
         :clearable="true"            → tombol "Bersihkan" (untuk filter)

         placement="auto"|"bottom"    → auto (bawaan) boleh membalik ke atas
                                        bila tidak ada ruang; "bottom" SELALU
                                        membuka ke bawah.
         year-start="1950"            → tahun awal pilihan dropdown Tahun
         year-end="2026"              → tahun akhir pilihan dropdown Tahun
                                        (bawaan: dari min/max, atau 50 tahun
                                        ke belakang s.d. 10 tahun ke depan).

       Kalender punya dropdown BULAN & TAHUN di header sehingga tanggal
       lahir lama bisa dicapai tanpa klik panah berkali-kali. Kedua daftar
       dibuka di DALAM popup (max-height 200px + scroll, gaya seragam)
       agar tidak menjulang menutupi form di bawahnya, dan hanya memakai
       satu ikon panah (lihat public/css/date-picker.css).

       Contoh:
         <x-date-picker name="tanggal_kunjungan" min="today" required />
         <x-date-picker name="tanggal_lahir" placement="bottom"
                        year-start="1950" :year-end="now()->year" />
       ------------------------------------------------------------ */

    $normalizeMap = static function ($items) {
        $map = [];

        if ($items instanceof \Illuminate\Support\Collection) {
            $items = $items->all();
        }

        if (! is_array($items)) {
            return $map;
        }

        foreach ($items as $key => $item) {
            if (is_object($item)) {
                // Model (mis. HariLibur) → pakai atribut tanggal/keterangan.
                $tanggal = $item->tanggal ?? null;
                $keterangan = $item->keterangan ?? '';

                if ($tanggal instanceof \DateTimeInterface) {
                    $tanggal = $tanggal->format('Y-m-d');
                }

                if ($tanggal) {
                    $map[substr((string) $tanggal, 0, 10)] = (string) $keterangan;
                }

                continue;
            }

            if (is_int($key)) {
                // ['2026-12-25', ...] → tanpa keterangan
                if ($item) {
                    $map[substr((string) $item, 0, 10)] = '';
                }

                continue;
            }

            // ['2026-12-25' => 'Natal', ...]
            $map[substr((string) $key, 0, 10)] = is_scalar($item) ? (string) $item : '';
        }

        return $map;
    };

    $blockedMap = $normalizeMap($blocked);
    $workMap = $normalizeMap($workDates);

    $fieldId = $id ?: 'dp-'.\Illuminate\Support\Str::slug($name ?: 'tanggal').'-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(5));
    // $errors dibagikan middleware web; guard agar komponen tetap bisa
    // dirender di luar request (mis. Blade::render pada test).
    $hasError = $name && isset($errors) ? $errors->has($name) : false;
@endphp

<div class="pln-dp {{ $size === 'sm' ? 'is-sm' : '' }} {{ $wrapperClass }}"
     data-pln-datepicker
     data-min="{{ $min }}"
     data-max="{{ $max }}"
     data-block-weekends="{{ $blockWeekends ? '1' : '0' }}"
     data-blocked="{{ json_encode((object) $blockedMap) }}"
     data-work-dates="{{ json_encode((object) $workMap) }}"
     data-clearable="{{ $clearable ? '1' : '0' }}"
     data-placement="{{ strtolower((string) $placement) === 'bottom' ? 'bottom' : 'auto' }}"
     data-year-start="{{ $yearStart }}"
     data-year-end="{{ $yearEnd }}">
    <input type="text"
           id="{{ $fieldId }}"
           @if ($name) name="{{ $name }}" @endif
           value="{{ $value }}"
           placeholder="{{ $placeholder }}"
           data-dp-input
           readonly
           autocomplete="off"
           inputmode="none"
           aria-haspopup="dialog"
           aria-expanded="false"
           @required($required)
           @disabled($disabled)
           {{ $attributes->class([
               'pln-dp-input',
               'has-error' => $hasError,
           ]) }}>
    <i class="fas {{ $icon }} pln-dp-icon" aria-hidden="true"></i>
    <i class="fas fa-chevron-down pln-dp-chevron" aria-hidden="true"></i>
    <div class="pln-cal" data-dp-panel hidden></div>
</div>
