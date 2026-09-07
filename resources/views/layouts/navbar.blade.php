<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-pln" id="mainNav">
    <div class="container px-4 px-lg-5">
        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                src="{{ asset('assets/images/logo-pln.png') }}"
                alt="Logo PLN Nusantara Power"
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
            {{-- Main Nav Links --}}
            <ul class="navbar-nav ms-auto me-2">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ppid">
                        <i class="fas fa-building me-1"></i> PPID
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#informasi-publik">
                        <i class="fas fa-book-open me-1"></i> Informasi Publik
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#layanan">
                        <i class="fas fa-concierge-bell me-1"></i> Layanan Informasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pengadaan">
                        <i class="fas fa-shopping-cart me-1"></i> Pengadaan Barang/Jasa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">
                        <i class="fas fa-question-circle me-1"></i> FAQ
                    </a>
                </li>
            </ul>

            {{-- Right Side: Search + Login --}}
            <div class="d-flex align-items-center gap-2">
                {{-- Search Form --}}
                <form class="search-form d-none d-lg-flex" action="#" method="GET">
                    <input type="text" name="q" placeholder="Cari informasi..." aria-label="Search" />
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                {{-- Login Button --}}
                <a href="#" class="btn btn-login d-none d-lg-inline-block">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </a>
            </div>
        </div>
    </div>
</nav>
