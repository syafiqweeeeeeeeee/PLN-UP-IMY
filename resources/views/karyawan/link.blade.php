@extends('layouts.karyawan')

@section('title', 'Link Kerja — Portal Karyawan')

@section('content')

    <div class="kry-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a> &nbsp;/&nbsp; Link Kerja
    </div>

    <div class="kry-page-head">
        <h1>Direktori Link Kerja</h1>
        <p>Kumpulan tautan aplikasi dan web internal yang sering digunakan — tampil sesuai jabatan dan bidang Anda.</p>
        @if ($linkAccess['mode'] === 'locked')
            <p style="font-size:0.8rem; color:#64748b; margin-top:0.35rem;">
                <i class="fas fa-lock" style="color:#008fa8;"></i>
                Link terkunci pada sub-bidang Anda
                @if ($authUser->department && $authUser->sub_department)
                    — <strong>{{ \App\Models\User::subDepartmentLabel($authUser->department, $authUser->sub_department) }}</strong>
                    ({{ \App\Models\User::DEPARTMENTS[$authUser->department] ?? '' }}).
                @else
                    .
                @endif
            </p>
        @elseif ($linkAccess['mode'] === 'tabs' && $linkAccess['scope'] === 'department')
            <p style="font-size:0.8rem; color:#64748b; margin-top:0.35rem;">
                <i class="fas fa-layer-group" style="color:#008fa8;"></i>
                Manager Bidang {{ \App\Models\User::DEPARTMENTS[$authUser->department] ?? '' }} — pilih tab sub-bidang di bawah naungan Anda.
            </p>
        @endif
    </div>

    {{-- ===== FILTER: dropdown + tab (keduanya sinkron) =====
         Opsi filter disediakan server per level jabatan:
         - Administrator / Senior Manager → semua kategori.
         - Manager Bidang → Semua bidangnya + per sub-bidang.
         - Staf/Asmen/Spv → terkunci di sub-bidang sendiri. --}}
    <div class="kry-filter-bar">
        @if (count($filters) > 1)
            <label for="kryFilterSelect"><i class="fas fa-filter"></i> Filter:</label>

            <select id="kryFilterSelect" class="kry-filter-select" aria-label="Filter kategori link">
                @foreach ($filters as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        @else
            <label class="kry-filter-select" style="display:inline-flex; align-items:center; gap:0.4rem;">
                <i class="fas fa-lock"></i> {{ reset($filters) }}
            </label>
        @endif

        <div class="kry-filter-tabs" role="tablist" aria-label="Filter kategori link">
            @foreach ($filters as $value => $label)
                <button type="button" class="kry-filter-tab {{ $loop->first ? 'active' : '' }}"
                        data-filter="{{ $value }}">{{ $label }}</button>
            @endforeach
        </div>
    </div>

    {{-- ===== GRID LINK ===== --}}
    <div class="kry-link-grid" id="kryLinkGrid">
        @foreach ($links as $link)
            <article class="kry-card kry-link-card" data-category="{{ $link['category'] }}"
                     data-department="{{ $link['department'] ?? '' }}"
                     data-sub-department="{{ $link['sub_department'] ?? '' }}">
                <span class="kry-link-icon" style="background: {{ $link['color'] }};">
                    <i class="fas {{ $link['icon'] }}"></i>
                </span>
                <div class="kry-link-body">
                    <h3>
                        {{ $link['name'] }}
                        <span class="kry-badge {{ $link['category'] === 'umum' ? 'kry-badge-umum' : '' }}">
                            {{ $filters[$link['category']] ?? $link['category'] }}
                        </span>
                    </h3>
                    <p class="kry-link-desc">{{ $link['description'] }}</p>
                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener" class="kry-btn-open">
                        Buka Website <i class="fas fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
            </article>
        @endforeach

        <div class="kry-card kry-empty" id="kryEmptyState" hidden>
            <i class="fas fa-link-slash" style="font-size:1.4rem; display:block; margin-bottom:8px;"></i>
            Tidak ada link pada kategori ini.
        </div>
    </div>

@endsection

@php
    // Kunci filter default per scope:
    // - 'sub' (Staf/Asmen/Spv) → langsung aktif di tab sub-bidang sendiri.
    // - lainnya → tab pertama (Semua / Akses Umum).
    $defaultFilter = $linkAccess['scope'] === 'sub'
        ? $authUser->department . ':' . $authUser->sub_department
        : array_key_first($filters);
@endphp

@push('scripts')
<script>
    (function () {
        var select  = document.getElementById('kryFilterSelect');
        var tabs    = Array.prototype.slice.call(document.querySelectorAll('.kry-filter-tab'));
        var cards   = Array.prototype.slice.call(document.querySelectorAll('#kryLinkGrid .kry-link-card'));
        var empty   = document.getElementById('kryEmptyState');
        var DEFAULT = @json($defaultFilter);

        function cardMatches(card, value) {
            var category = card.getAttribute('data-category');
            var dept     = card.getAttribute('data-department');
            var sub      = card.getAttribute('data-sub-department');

            // "Semua <Bidang>" (Manager Bidang): semua link bidangnya + umum.
            if (value === 'all') {
                return category === 'umum' || dept === @json($authUser->department);
            }

            // Tab sub-bidang (mis. "operasi:spv_chcb_a").
            var subIdx = value.indexOf(':');
            if (subIdx !== -1) {
                var vDept = value.slice(0, subIdx);
                var vSub  = value.slice(subIdx + 1);
                return category === 'umum' || (dept === vDept && sub === vSub);
            }

            // Filter global (Administrator/Senior Manager): kategori penuh.
            return value === 'umum' ? category === 'umum' : (category === value || dept === value);
            
        }

        function applyFilter(value) {
            var visible = 0;

            cards.forEach(function (card) {
                var match = cardMatches(card, value);
                card.classList.toggle('is-hidden', !match);
                if (match) visible++;
            });

            if (empty) empty.hidden = visible > 0;

            // Sinkronkan dropdown & tab
            if (select) select.value = value;
            tabs.forEach(function (t) {
                t.classList.toggle('active', t.getAttribute('data-filter') === value);
            });
        }

        if (select) select.addEventListener('change', function () {
            applyFilter(this.value);
        });

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                applyFilter(tab.getAttribute('data-filter'));
            });
        });

        // Kondisi awal: terkunci di sub-bidang untuk Staf/Asmen/Spv.
        applyFilter(DEFAULT);
    })();
</script>
@endpush
