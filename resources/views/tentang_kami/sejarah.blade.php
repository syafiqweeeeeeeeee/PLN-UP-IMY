@extends('layouts.app')

@section('title', 'Sejarah - E-PPID PLN')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
        padding: 8rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -15%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.12) 0%, transparent 70%);
        border-radius: 50%;
    }

    .page-header h1 {
        color: #fff;
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .page-header h1 span {
        color: var(--pln-yellow);
    }

    .intro-section {
        padding: 4rem 0;
        background: #fff;
    }

    .intro-section .lead {
        color: #555;
        font-size: 1.05rem;
        line-height: 1.8;
        max-width: 800px;
    }

    .timeline-section {
        padding: 3rem 0 5rem;
        background: var(--pln-gray);
    }

    .timeline {
        position: relative;
        padding: 2rem 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--pln-blue), var(--pln-cyan));
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .timeline-item {
        position: relative;
        width: 100%;
        padding: 0 0 3rem;
        display: flex;
        align-items: flex-start;
    }

    .timeline-item:nth-child(odd) {
        justify-content: flex-start;
        padding-right: calc(50% + 30px);
    }

    .timeline-item:nth-child(even) {
        justify-content: flex-end;
        padding-left: calc(50% + 30px);
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        top: 8px;
        width: 20px;
        height: 20px;
        background: var(--pln-blue);
        border: 4px solid var(--pln-cyan);
        border-radius: 50%;
        transform: translateX(-50%);
        z-index: 2;
        box-shadow: 0 0 0 4px rgba(0, 163, 224, 0.15);
    }

    .timeline-card {
        background: #fff;
        border-radius: 14px;
        padding: 1.8rem 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border-left: 4px solid var(--pln-blue);
        transition: all 0.3s ease;
        width: 100%;
    }

    .timeline-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 91, 156, 0.12);
    }

    .timeline-year {
        display: inline-block;
        background: var(--pln-cyan);
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        margin-bottom: 0.8rem;
        letter-spacing: 0.3px;
    }

    .btn-back-terkait {
        background: var(--pln-blue);
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.7rem 2rem;
        border-radius: 30px;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back-terkait:hover {
        background: var(--pln-cyan);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 163, 224, 0.3);
    }

    .timeline-card h4 {
        color: var(--pln-blue);
        font-weight: 700;
        font-size: 1.15rem;
        margin-bottom: 0.8rem;
        line-height: 1.4;
    }

    .timeline-card p {
        color: #555;
        font-size: 0.92rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }

    .timeline-card ul {
        padding-left: 1.2rem;
        margin-bottom: 0;
    }

    .timeline-card ul li {
        color: #555;
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 0.5rem;
    }

    .timeline-card ul li strong {
        color: var(--pln-blue);
    }

    @media (max-width: 767.98px) {
        .page-header h1 {
            font-size: 1.8rem;
        }

        .timeline::before {
            left: 20px;
        }

        .timeline-item:nth-child(odd),
        .timeline-item:nth-child(even) {
            padding-left: 60px;
            padding-right: 0;
            justify-content: flex-start;
        }

        .timeline-dot {
            left: 20px;
        }

        .timeline-card {
            padding: 1.4rem 1.2rem;
        }

        .timeline-card h4 {
            font-size: 1.05rem;
        }
    }
</style>

{{-- =============================================
     PAGE HEADER
     ============================================= --}}
<section class="page-header">
    <div class="container">
        <h1><span>Sejarah</span> Perusahaan</h1>

    </div>
</section>

{{-- =============================================
     INTRO SECTION
     ============================================= --}}
<section class="intro-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <p class="lead">
                    Perjalanan panjang PT Pembangkitan Jawa Bali (PJB) dimulai sejak tahun 1995.
                    Dari pendirian perusahaan dengan 5 unit pembangkitan hingga menjadi pemain utama
                    dalam industri ketenagalistrikan nasional, berikut adalah tonggak-tonggak sejarah
                    yang membentuk perusahaan hingga saat ini.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- =============================================
     TIMELINE SECTION
     ============================================= --}}
<section class="timeline-section">
    <div class="container">
        <div class="timeline">

            {{-- 1995 --}}
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">1995</span>
                    <h4>Pendirian Perusahaan & Fondasi Awal</h4>
                    <p>
                        Perjalanan resmi perusahaan dimulai pada tahun 1995 ketika PT PLN (Persero)
                        mendirikan anak perusahaan ini untuk mengelola aset-aset pembangkitan listrik
                        di wilayah Indonesia. Pada awal berdirinya, perusahaan langsung dipercayakan
                        mengoperasikan <strong>5 Unit Pembangkitan (UP) utama</strong> dengan total
                        kapasitas terpasang sebesar <strong>5.068 MW</strong>.
                    </p>
                    <p>
                        Sebagai bagian dari komitmen tata kelola pembangkit modern sejak hari pertama,
                        perusahaan mengadopsi sistem <strong>Computerized Maintenance Management
                        Systems (CMMS)</strong>. Penerapan teknologi CMMS ini menjadi fondasi digital
                        pertama perusahaan dalam memantau, merencanakan, dan mengeksekusi pemeliharaan
                        aset secara terstruktur demi menjaga tingkat keandalan suplai listrik nasional.
                    </p>
                </div>
            </div>

            {{-- 2000 – 2010 --}}
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2000 – 2010</span>
                    <h4>Dekade Pertumbuhan dan Ekspansi Bisnis</h4>
                    <p>
                        Memasuki rentang tahun 2000 hingga 2010, perusahaan memasuki fase pertumbuhan
                        yang stabil dan ekspansif dengan sejumlah pencapaian strategis:
                    </p>
                    <ul>
                        <li>
                            <strong>Penambahan Aset Strategis</strong> — Perusahaan menerima pelimpahan
                            aset vital baru, yakni PLTA Cirata Unit 5–8 dan PLTGU Muara Tawar.
                            Pelimpahan ini secara signifikan meningkatkan total kapasitas terpasang PJB
                            dari 5.068 MW menjadi <strong>6.469 MW</strong>.
                        </li>
                        <li>
                            <strong>Pengembangan Struktur Korporasi</strong> — Perusahaan mulai membentuk
                            anak perusahaan serta perusahaan afiliasi untuk memperkuat rantai pasok dan
                            layanan pendukung bisnis inti pembangkitan.
                        </li>
                        <li>
                            <strong>Investasi Strategis (IPP)</strong> — Perusahaan memperluas investasi
                            dengan melakukan penyertaan saham pada Independent Power Producer (IPP), seperti
                            PT Sumber Segara Primadaya (S2P - pengelola PLTU Cilacap) dan PT Bhumi Jati
                            Power (BDSN - pengelola PLTU Tanjung Jati B Unit 5 & 6).
                        </li>
                        <li>
                            <strong>Kepemimpinan Operasional</strong> — Pada periode ini, perusahaan
                            berhasil memformulasikan serta menerapkan standar best practice dalam lini
                            bisnis Jasa Operasi dan Pemeliharaan (Operation & Maintenance / O&M), yang
                            kemudian ditawarkan kepada pihak ketiga di industri ketenagalistrikan.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 2011 – 2015 --}}
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2011 – 2015</span>
                    <h4>Operational Excellence</h4>
                    <ul>
                        <li>
                            Menjadi entitas pertama di Asia Pasifik yang meraih sertifikasi
                            <strong>ISO 55001 Sistem Manajemen Aset</strong>.
                        </li>
                        <li>
                            Raihan predikat <strong>Emerging Industry Leader Band</strong> berdasarkan
                            kriteria Malcolm Baldrige.
                        </li>
                        <li>
                            UP Gresik, UP Paiton, UP Muara Karang, dan UP Cirata berhasil masuk dalam
                            jajaran <strong>Top 10% keandalan NERC</strong> (North American Electric
                            Reliability Corporation).
                        </li>
                        <li>
                            Berhasil mengoperasikan <strong>fasilitas CNG (Compressed Natural Gas)
                            Pembangkit terbesar di dunia</strong>.
                        </li>
                        <li>
                            Dianugerahi <strong>Platinum Award</strong> atas komitmen Tanggung Jawab
                            Sosial dan Lingkungan (CSR) di Indonesia.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 2016 – 2024 --}}
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2016 – 2024</span>
                    <h4>Corporate Transformation I & II (Era Holding Sub-Holding)</h4>
                    <ul>
                        <li>
                            <strong>Corporate Transformation I</strong> — Menerapkan integrasi PJB Group
                            berbasis aset (Asset Based) dengan menggabungkan keunggulan operasional & bisnis,
                            serta meraih predikat <strong>Malcolm Baldrige Industry Leader Band</strong>.
                        </li>
                        <li>
                            <strong>Corporate Transformation II & Sub-Holding</strong> — Bertransformasi
                            menjadi <strong>PT PLN Nusantara Power</strong> sebagai bagian dari restrukturisasi
                            Holding Sub-Holding PLN Group.
                        </li>
                        <li>
                            Mengadopsi pendekatan berbasis investasi (Investment Based) untuk kesiapan
                            masa depan (<strong>Future Proof</strong>) dan ekspansi kapasitas pembangkitan
                            secara masif.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 2024 – 2028 --}}
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2024 – 2028</span>
                    <h4>Strengthening The Base, Expanding The Business</h4>
                    <ul>
                        <li>
                            <strong>Digital Transformation & Operational Excellence</strong> — Akselerasi
                            transformasi digital yang terintegrasi penuh dengan keunggulan operasional.
                        </li>
                        <li>
                            <strong>Growth & Expansion</strong> — Mengakselerasi pertumbuhan bisnis dan
                            ekspansi portofolio EBT.
                        </li>
                        <li>
                            <strong>Net Zero Emission & Sustainability</strong> — Berkomitmen penuh mendukung
                            target transisi energi menuju Net Zero Emission serta menjaga keberlanjutan
                            bisnis jangka panjang.
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- Back Button --}}
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-back-terkait">
                <i class="fas fa-arrow-left"></i> Kembali ke Tentang Kami
            </a>
        </div>
    </div>
</section>
@endsection
