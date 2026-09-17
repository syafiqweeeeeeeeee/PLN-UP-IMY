@php
    /* URL halaman saat ini tanpa trailing slash — dipakai deteksi menu aktif. */
    $currentUrl = rtrim(url()->current(), '/');
    $homeUrl    = rtrim(url('/'), '/');

    /* Deteksi halaman aktif: URL sama persis, atau halaman detail di bawah
       URL menu (mis. /informasi/berita/{slug} tetap menyalakan menu "Berita").
       Halaman utama (root) hanya exact match. */
    $isActiveUrl = function (?string $url) use ($currentUrl, $homeUrl) {
        if ($url === null) return false;
        $target = rtrim($url, '/');
        if ($target === '' || $target === $homeUrl) {
            return $currentUrl === $target;
        }
        return $currentUrl === $target
            || str_starts_with($currentUrl . '/', $target . '/');
    };
@endphp

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-pln" id="mainNav">
    <div class="container px-4 px-lg-5">
        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                src="{{ asset('assets/images/logo-pln.png') }}"
                alt="Logo PLN"
                class="logo-nav"
                width="196" height="52"
                fetchpriority="high"
                decoding="async"
                draggable="false"
                ondragstart="return false;"
                style="pointer-events: none; user-select: none; -webkit-user-drag: none;"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
            />
            <span class="d-none">
                <i class="fas fa-bolt" style="color: var(--pln-yellow)"></i> PLN Nusantara Power
            </span>
        </a>

        {{-- Tombol Login (mobile) — DI LUAR collapse agar selalu terlihat
             di bar navbar tanpa harus membuka menu hamburger dulu.
             Hanya tampil di <992px (d-lg-none); di desktop tetap pakai
             tombol yang berada di dalam collapse. --}}
        <div class="d-flex align-items-center ms-auto d-lg-none me-2">
            <a href="{{ route('login') }}" class="btn btn-login">
                <span data-i18n="nav.login">Login</span>
            </a>
        </div>

        {{-- Toggler (mobile) --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Nav Content --}}
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                @foreach ($menuTree as $item)
                    @php
                        $isGroupActive = collect($item['children'])->contains(
                            fn ($c) => $isActiveUrl($c['url'] ?? null)
                        );
                    @endphp
                    @if (count($item['children']) > 0)
                        {{-- Dropdown group --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ $isGroupActive ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if ($item['icon'])
                                    <i class="fas {{ $item['icon'] }} me-1"></i>
                                @endif
                                <span @if (!empty($item['i18n'])) data-i18n="{{ $item['i18n'] }}" @endif>{{ $item['label'] }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                @foreach ($item['children'] as $child)
                                    <li>
                                        <a class="dropdown-item {{ $isActiveUrl($child['url'] ?? null) ? 'active' : '' }}" href="{{ $child['url'] }}" @if (!empty($child['target'])) target="{{ $child['target'] }}" rel="noopener" @endif @if (!empty($child['i18n'])) data-i18n="{{ $child['i18n'] }}" @endif>
                                            @if ($child['icon'])
                                                <i class="fas {{ $child['icon'] }} me-1"></i>
                                            @endif
                                            {{ $child['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif ($item['url'] !== null)
                        {{-- Leaf item langsung --}}
                        <li class="nav-item">
                            <a class="nav-link {{ $isActiveUrl($item['url']) ? 'active' : '' }}" href="{{ $item['url'] }}" @if (!empty($item['target'])) target="{{ $item['target'] }}" rel="noopener" @endif>
                                @if ($item['icon'])
                                    <i class="fas {{ $item['icon'] }} me-1"></i>
                                @endif
                                <span @if (!empty($item['i18n'])) data-i18n="{{ $item['i18n'] }}" @endif>{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach

                {{-- [ELEMEN BARU] Language Switcher (Globe) —
                     persis di antara "Kontak" dan tombol "Login" --}}
                <li class="nav-item lang-switcher" id="lang-switcher">
                    <button class="nav-link lang-toggle" type="button" id="langToggle" aria-expanded="false" aria-haspopup="true" title="Bahasa / Language">
                        <i data-feather="globe" style="width:16px;height:16px;"></i> <span id="lang-current">ID</span>
                        <span class="caret"></span>
                    </button>
                    <ul class="lang-menu" id="langMenu">
                        <li>                                <button class="lang-option {{ session('lang', 'id') === 'id' ? 'active' : '' }}" type="button" data-lang="id">
                                <img src="{{ asset('assets/images/flag-indonesia.svg') }}" alt="ID" class="flag-img me-2"> <span data-i18n="lang.indonesian">Bahasa Indonesia</span>
                            </button>
                        </li>
                        <li>
                            <button class="lang-option {{ session('lang', 'id') === 'en' ? 'active' : '' }}" type="button" data-lang="en">
                                <img src="{{ asset('assets/images/flag-usa.svg') }}" alt="EN" class="flag-img me-2"> <span data-i18n="lang.english">English</span>
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>

            {{-- Login Button (desktop saja) — di mobile disembunyikan karena
             sudah digantikan tombol login terpisah di samping hamburger --}}
            <div class="d-none d-lg-flex align-items-center ms-lg-3 mt-3 mt-lg-0">
                <a href="{{ route('login') }}" class="btn btn-login">
                    <span data-i18n="nav.login">Login</span>
                </a>
            </div>

        </div>
    </div>
</nav>
