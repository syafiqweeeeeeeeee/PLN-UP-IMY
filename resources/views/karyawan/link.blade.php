@extends('layouts.karyawan')

@section('title', 'Link Kerja — Portal Karyawan')

@section('content')

    <div class="kry-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a> &nbsp;/&nbsp; Link Kerja
    </div>

    <div class="kry-page-head">
        <h1>Direktori Link Kerja</h1>
        <p>Kumpulan tautan aplikasi dan web internal yang sering digunakan — 5 akses umum dan 5 link khusus per bidang.</p>
    </div>

    {{-- ===== FILTER: dropdown + tab (keduanya sinkron) ===== --}}
    <div class="kry-filter-bar">
        <label for="kryFilterSelect"><i class="fas fa-filter"></i> Filter:</label>

        <select id="kryFilterSelect" class="kry-filter-select" aria-label="Filter kategori link">
            @foreach ($filters as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>

        <div class="kry-filter-tabs" role="tablist" aria-label="Filter cepat kategori link">
            @foreach ($filters as $value => $label)
                <button type="button" class="kry-filter-tab {{ $loop->first ? 'active' : '' }}"
                        data-filter="{{ $value }}">{{ $label }}</button>
            @endforeach
        </div>
    </div>

    {{-- ===== GRID LINK ===== --}}
    <div class="kry-link-grid" id="kryLinkGrid">
        @foreach ($links as $link)
            <article class="kry-card kry-link-card" data-category="{{ $link['category'] }}">
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

@push('scripts')
<script>
    (function () {
        var select  = document.getElementById('kryFilterSelect');
        var tabs    = Array.prototype.slice.call(document.querySelectorAll('.kry-filter-tab'));
        var cards   = Array.prototype.slice.call(document.querySelectorAll('#kryLinkGrid .kry-link-card'));
        var empty   = document.getElementById('kryEmptyState');

        function applyFilter(value) {
            var visible = 0;

            cards.forEach(function (card) {
                var match = value === 'all' || card.getAttribute('data-category') === value;
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
    })();
</script>
@endpush
