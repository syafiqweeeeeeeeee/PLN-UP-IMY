<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-pln" id="mainNav">
    <div class="container px-4 px-lg-5">
        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                src="{{ asset('assets/images/logo-pln.png') }}"
                alt="Logo PLN"
                class="logo-nav"
                draggable="false"
                ondragstart="return false;"
                style="pointer-events: none; user-select: none; -webkit-user-drag: none;"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
            />
            <span class="d-none">
                <i class="fas fa-bolt" style="color: var(--pln-yellow)"></i> E-PPID PLN
            </span>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Nav Content --}}
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                {{-- Tentang Kami --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-building me-1"></i> <span data-i18n="nav.about">Tentang Kami</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('profil-perusahaan') }}" data-i18n="nav.about_profile">Profil Perusahaan</a></li>
                        <li><a class="dropdown-item" href="{{ route('sejarah') }}" data-i18n="nav.about_history">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ route('visi-misi') }}" data-i18n="nav.about_vision_mission">Visi &amp; Misi</a></li>
                        <li><a class="dropdown-item" href="#" data-i18n="nav.about_structure">Struktur Organisasi</a></li>
                    </ul>
                </li>

                {{-- Informasi --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-book-open me-1"></i> <span data-i18n="nav.information">Informasi</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#" data-i18n="nav.info_news">Berita</a></li>
                        <li><a class="dropdown-item" href="#" data-i18n="nav.info_announcements">Pengumuman</a></li>
                        <li><a class="dropdown-item" href="#" data-i18n="nav.info_gallery">Galeri</a></li>
                    </ul>
                </li>

                {{-- Layanan --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-concierge-bell me-1"></i> <span data-i18n="nav.services">Layanan</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#" data-i18n="nav.services_list">Daftar Layanan</a></li>
                        <li><a class="dropdown-item" href="#" data-i18n="nav.services_info">Informasi Layanan</a></li>
                        <li><a class="dropdown-item" href="#" data-i18n="nav.services_faq">FAQ</a></li>
                    </ul>
                </li>

                {{-- Kontak --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-envelope me-1"></i> <span data-i18n="nav.contact">Kontak</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#" data-i18n="nav.contact_us">Hubungi Kami</a></li>
                        <li><a class="dropdown-item" href="#" data-i18n="nav.contact_location">Lokasi</a></li>
                        <li><a class="dropdown-item" href="#" data-i18n="nav.contact_social">Sosial Media</a></li>
                    </ul>
                </li>

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

            {{-- Right Side: Login --}}
            <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0">
                <a href="#" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-1"></i> <span data-i18n="nav.login">Login</span>
                </a>
            </div>
        </div>
    </div>
</nav>
