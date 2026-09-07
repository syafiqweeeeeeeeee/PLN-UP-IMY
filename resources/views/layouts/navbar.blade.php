<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-pln" id="mainNav">
    <div class="container px-4 px-lg-5">
        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                src="{{ asset('assets/images/logo-pln.png') }}"
                alt="Logo PLN"
                class="logo-nav"
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
                        <i class="fas fa-building me-1"></i> Tentang Kami
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Profil Perusahaan</a></li>
                        <li><a class="dropdown-item" href="#">Sejarah</a></li>
                        <li><a class="dropdown-item" href="#">Visi &amp; Misi</a></li>
                        <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                    </ul>
                </li>

                {{-- Informasi --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-book-open me-1"></i> Informasi
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Berita</a></li>
                        <li><a class="dropdown-item" href="#">Pengumuman</a></li>
                        <li><a class="dropdown-item" href="#">Artikel</a></li>
                        <li><a class="dropdown-item" href="#">Galeri</a></li>
                    </ul>
                </li>

                {{-- Layanan --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-concierge-bell me-1"></i> Layanan
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Daftar Layanan</a></li>
                        <li><a class="dropdown-item" href="#">Informasi Layanan</a></li>
                        <li><a class="dropdown-item" href="#">FAQ</a></li>
                    </ul>
                </li>

               

                {{-- Kontak --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-envelope me-1"></i> Kontak
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Hubungi Kami</a></li>
                        <li><a class="dropdown-item" href="#">Lokasi</a></li>
                        <li><a class="dropdown-item" href="#">Sosial Media</a></li>
                    </ul>
                </li>
            </ul>

            {{-- Right Side: Login --}}
            <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0">
                <a href="#" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </a>
            </div>
        </div>
    </div>
</nav>
