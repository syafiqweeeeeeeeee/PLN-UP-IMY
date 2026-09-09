/* =========================================================
   i18n — ALIH BAHASA OTOMATIS (ID <-> EN)
   PT PLN Nusantara Power UP PLTU Indramayu
   =========================================================
   Cara kerja:
   1. Semua elemen teks beratribut data-i18n="key".
   2. translations { id, en } memuat seluruh pasangan teks.
   3. applyLanguage(lang) me-loop querySelectorAll('[data-i18n]')
      dan memperbarui textContent, lalu menyimpan pilihan ke
      localStorage agar tidak ter-reset saat halaman di-refresh.
   4. Dropdown globe: buka/tutup saat diklik, menutup otomatis
      jika mengklik di luar menu, dan menutup saat item dipilih.
   ========================================================= */

(function () {
    'use strict';

    /* =====================================================
       1. DICTIONARY — seluruh pasangan teks ID / EN
       ===================================================== */
    const translations = {
        id: {
            /* ---------- NAVBAR ---------- */
            'nav.about': 'Tentang Kami',
            'nav.about_profile': 'Profil Perusahaan',
            'nav.about_history': 'Sejarah',
            'nav.about_vision_mission': 'Visi & Misi',
            'nav.about_structure': 'Struktur Organisasi',
            'nav.information': 'Informasi',
            'nav.info_news': 'Berita',
            'nav.info_announcements': 'Pengumuman',
            'nav.info_articles': 'Artikel',
            'nav.info_gallery': 'Galeri',
            'nav.services': 'Layanan',
            'nav.services_list': 'Daftar Layanan',
            'nav.services_info': 'Informasi Layanan',
            'nav.services_faq': 'FAQ',
            'nav.contact': 'Kontak',
            'nav.contact_us': 'Hubungi Kami',
            'nav.contact_location': 'Lokasi',
            'nav.contact_social': 'Sosial Media',
            'nav.login': 'Login',
            'lang.indonesian': 'Bahasa Indonesia',
            'lang.english': 'English',

            /* ---------- HERO BANNER ---------- */
            'hero.title_plain': 'PLN Nusantara Power <span>Indramayu</span>',
            'hero.title_1': 'PLN Nusantara Power',
            'hero.title_2': 'Indramayu',
            'hero.subtitle': 'Unit Pembangkitan Tenaga Uap (PLTU) Indramayu berkapasitas 3 x 330 MW yang beroperasi 24 jam nonstop untuk mendukung ketahanan energi nasional dan penyediaan layanan informasi publik yang transparan.',
            'hero.btn_request': '<i class="fas fa-file-alt me-2"></i> Permohonan Informasi',
            'hero.btn_learn': '<i class="fas fa-info-circle me-2"></i> Pelajari Lebih Lanjut',

            /* ---------- STATISTIK & KINERJA TEKNIS ---------- */
            'stats.title': 'Statistik & Kinerja Teknis',
            'stats.subtitle': 'Ringkasan kapasitas dan kontribusi unit pembangkitan',
            'stats.value_capacity': '3 \u00d7 330 <small>MW</small>',
            'stats.label_capacity': 'Kapasitas Terpasang',
            'stats.desc_capacity': 'Total 990 MW kapasitas pembangkitan terpasang.',
            'stats.value_coverage': 'Jamali',
            'stats.label_coverage': 'Cakupan Suplai',
            'stats.desc_coverage': 'Sistem Interkoneksi Jawa–Madura–Bali (Jamali).',
            'stats.value_total': '23.000+ <small>MW</small>',
            'stats.label_total': 'Total Kapasitas PLN NP',
            'stats.desc_total': 'Kapasitas pembangkitan PT PLN Nusantara Power.',
            'stats.value_ebt': '6,3+ <small>GW</small>',
            'stats.label_ebt': 'Proyek Energi Terbarukan (EBT)',
            'stats.desc_ebt': 'Portofolio energi terbarukan yang terus berkembang.',

            /* ---------- MEKANISME / ALUR ---------- */
            'flow.title': 'Mekanisme Pelayanan Informasi Publik',
            'flow.subtitle': 'Berikut adalah alur langkah pelayanan informasi publik di lingkungan PT PLN (Persero)',
            'flow.step1_title': 'Pengajuan Permohonan',
            'flow.step1_desc': 'Pemohon mengajukan permohonan informasi publik secara tertulis melalui formulir yang telah disediakan.',
            'flow.step2_title': 'Penerimaan & Pencatatan',
            'flow.step2_desc': 'PPID menerima permohonan, mencatat dalam register, dan memberikan tanda terima kepada pemohon.',
            'flow.step3_title': 'Proses Verifikasi',
            'flow.step3_desc': 'PPID melakukan verifikasi dan inventarisasi informasi yang dimohonkan berdasarkan kriteria keterbukaan.',
            'flow.step4_title': 'Penyampaian Informasi',
            'flow.step4_desc': 'Informasi publik disampaikan kepada pemohon paling lambat 10 hari kerja sejak permohonan diterima.',

            /* ---------- LAYANAN KAMI ---------- */
            'services.title': 'Layanan Kami',
            'services.subtitle': 'Akses berbagai layanan informasi publik yang tersedia',
            'services.menu1_title': 'Informasi Publik',
            'services.menu1_desc': 'Akses dokumen dan data informasi publik yang tersedia secara terbuka.',
            'services.menu2_title': 'Permohonan Informasi',
            'services.menu2_desc': 'Ajukan permohonan informasi publik secara online dengan mudah dan cepat.',
            'services.menu3_title': 'Keberatan Informasi',
            'services.menu3_desc': 'Sampaikan keberatan apabila informasi yang dimohonkan ditolak atau tidak sesuai.',
            'services.menu4_title': 'Informasi Serta Merta',
            'services.menu4_desc': 'Akses informasi yang harus segera diumumkan demi keselamatan masyarakat.',

            /* ---------- FOOTER ---------- */
            'footer.title': 'PT PLN Nusantara Power UP PLTU Indramayu',
            'footer.description': 'Pejabat Pengelola Informasi dan Dokumentasi (PPID) PT PLN Nusantara Power UP PLTU Indramayu bertugas memberikan layanan keterbukaan informasi publik secara transparan, cepat, dan akuntabel.',
            'footer.important_links': 'Tautan Penting',
            'footer.link_home': 'Beranda',
            'footer.link_profile': 'Profil PPID',
            'footer.link_public_info': 'Informasi Publik',
            'footer.link_info_services': 'Layanan Informasi',
            'footer.link_faq': 'FAQ',
            'footer.services': 'Layanan',
            'footer.svc_request': 'Permohonan Informasi',
            'footer.svc_objection': 'Keberatan Informasi',
            'footer.svc_immediate': 'Informasi Serta Merta',
            'footer.svc_excluded': 'Informasi Dikecualikan',
            'footer.contact': 'Hubungi Kami',
            'footer.label_address': 'Alamat',
            'footer.address': 'Desa Sumur Adem, Kecamatan Sukra, Kabupaten Indramayu, Jawa Barat 45257',
            'footer.label_phone': 'Telepon',
            'footer.phone': '(+62 234) 5613236',
            'footer.label_email': 'Email Resmi',
            'footer.email': 'upid@plnnusantarapower.co.id',
            'footer.label_hours': 'Jam Layanan',
            'footer.hours': 'Senin – Jumat (08.00 – 16.00 WIB)',
            'footer.copyright': '© 2026 PT PLN Nusantara Power UP PLTU Indramayu — Hak Cipta Dilindungi.',

            /* ---------- HALAMAN SEJARAH ---------- */
            'sejarah.breadcrumb_about': 'Tentang Kami',
            'sejarah.breadcrumb_current': 'Sejarah Perusahaan',
            'sejarah.eyebrow': 'Tentang Kami',
            'sejarah.title': 'Sejarah & <span>Jejak Langkah</span> Perusahaan',
            'sejarah.subtitle': 'Perjalanan Transformasi PT PLN Nusantara Power dalam Membangun Negeri dari Masa ke Masa.',
            'sejarah.s1_title': 'Pendirian Perusahaan & Fondasi Awal',
            'sejarah.s1_sub': 'Company Establishment',
            'sejarah.s1_desc': 'Perjalanan resmi perusahaan dimulai pada tahun 1995 ketika PT PLN (Persero) mendirikan anak perusahaan ini untuk mengelola aset-aset pembangkitan listrik di wilayah Indonesia. Pada awal berdirinya, perusahaan langsung dipercayakan mengoperasikan <strong>5 Unit Pembangkitan (UP) utama</strong> dengan total kapasitas terpasang sebesar <strong>5.068 MW</strong>. Sebagai bagian dari komitmen tata kelola pembangkit modern sejak hari pertama, perusahaan mengadopsi sistem <strong>Computerized Maintenance Management Systems (CMMS)</strong>.',
            'sejarah.s2_title': 'Dekade Pertumbuhan dan Ekspansi Bisnis',
            'sejarah.s2_sub': 'Stable Growth',
            'sejarah.s2_desc': 'Memasuki rentang tahun 2000 hingga 2010, perusahaan mengalami pertumbuhan yang stabil dan ekspansif. Kapasitas total meningkat secara signifikan dari <strong>5.068 MW menjadi 6.469 MW</strong> seiring dengan pelimpahan aset strategis berupa <strong>PLTA Cirata Unit 5–8</strong> dan <strong>PLTGU Muara Tawar</strong>.',
            'sejarah.s3_title': 'Pencapaian Standar Internasional & Keunggulan Operasional',
            'sejarah.s3_sub': 'Operational Excellence',
            'sejarah.s3_desc': 'Pada kurun waktu 2011 hingga 2015, perusahaan mencatatkan sejarah sebagai <strong>entitas pertama di Asia Pasifik</strong> yang meraih sertifikasi <strong>ISO 55001 Sistem Manajemen Aset</strong>. Keunggulan operasional ini mengantarkan perusahaan meraih predikat <strong>Emerging Industry Leader Band</strong>.',
            'sejarah.s4_title': 'Transformasi Korporasi Berkelanjutan & Era Sub-Holding',
            'sejarah.s4_sub': 'Corporate Transformation I & II',
            'sejarah.s4_desc': 'Dalam rentang tahun 2016 hingga 2024, perusahaan melewati dua gelombang transformasi besar. Pada fase <strong>Corporate Transformation I</strong>, perusahaan mengonsolidasikan PJB Group berbasis aset <strong>(Asset Based)</strong> dengan memadukan keunggulan operasional dan bisnis.',
            'sejarah.s5_title': 'Penguatan Basis, Ekspansi Pasar, dan Keberlanjutan',
            'sejarah.s5_sub': 'Strengthening The Base, Expanding The Business',
            'sejarah.s5_desc': 'Untuk periode tahun 2024 hingga 2028, perusahaan memfokuskan strategi pada penguatan basis operasional sekaligus ekspansi bisnis secara berkelanjutan. Langkah ini dijalankan melalui <strong>akselerasi transformasi digital</strong>.',

            /* ---------- HALAMAN VISI & MISI ---------- */
            'visi.breadcrumb_about': 'Tentang Kami',
            'visi.breadcrumb_current': 'Visi & Misi',
            'visi.eyebrow': 'Tentang Kami',
            'visi.title': 'Visi & Misi Perusahaan',
            'visi.desc': 'Landasan utama dan komitmen PT PLN Nusantara Power dalam menerangi Indonesia serta mendorong transisi energi global.',
            'visi.visi_label': 'Visi Perusahaan',
            'visi.visi_text': 'Menjadi Perusahaan Pembangkitan yang Terdepan dan Terpercaya untuk Energi Berkelanjutan di Indonesia dan Pasar Global.',
            'visi.misi_label': 'Misi Perusahaan',
            'visi.misi1': 'Menjaga Kinerja Pembangkit Listrik yang Unggul Sebagai Kompetensi Inti.',
            'visi.misi2': 'Membangun Bisnis Inovatif yang terdepan untuk melakukan Diversifikasi dan Pertumbuhan yang Berkelanjutan.',
            'visi.misi3': 'Mengakselerasi Portofolio Bisnis EBT Untuk Mendukung Tercapainya Nol Emisi Karbon.',
            'visi.misi4': 'Mengakuisisi dan Membangun Talenta Terbaik Untuk Menjalankan Organisasi yang Responsif dan Adaptif.',
            'visi.back_btn': 'Kembali ke Tentang Kami'
        },

        en: {
            /* ---------- NAVBAR ---------- */
            'nav.about': 'About Us',
            'nav.about_profile': 'Company Profile',
            'nav.about_history': 'History',
            'nav.about_vision_mission': 'Vision & Mission',
            'nav.about_structure': 'Organizational Structure',
            'nav.information': 'Information',
            'nav.info_news': 'News',
            'nav.info_announcements': 'Announcements',
            'nav.info_articles': 'Articles',
            'nav.info_gallery': 'Gallery',
            'nav.services': 'Services',
            'nav.services_list': 'Service List',
            'nav.services_info': 'Service Information',
            'nav.services_faq': 'FAQ',
            'nav.contact': 'Contact',
            'nav.contact_us': 'Contact Us',
            'nav.contact_location': 'Location',
            'nav.contact_social': 'Social Media',
            'nav.login': 'Login',
            'lang.indonesian': 'Bahasa Indonesia',
            'lang.english': 'English',

            /* ---------- HERO BANNER ---------- */
            'hero.title_plain': 'PLN Nusantara Power <span>Indramayu</span>',
            'hero.title_1': 'PLN Nusantara Power',
            'hero.title_2': 'Indramayu',
            'hero.subtitle': 'The Indramayu Steam Power Plant (PLTU) with an installed capacity of 3 x 330 MW, operating 24 hours nonstop to support national energy security and provide transparent public information services.',
            'hero.btn_request': '<i class="fas fa-file-alt me-2"></i> Information Request',
            'hero.btn_learn': '<i class="fas fa-info-circle me-2"></i> Learn More',

            /* ---------- STATISTIK & KINERJA TEKNIS ---------- */
            'stats.title': 'Statistics & Technical Performance',
            'stats.subtitle': 'An overview of the generating unit\u2019s capacity and contribution',
            'stats.value_capacity': '3 \u00d7 330 <small>MW</small>',
            'stats.label_capacity': 'Installed Capacity',
            'stats.desc_capacity': 'A total of 990 MW of installed generating capacity.',
            'stats.value_coverage': 'Jamali',
            'stats.label_coverage': 'Supply Coverage',
            'stats.desc_coverage': 'Java\u2013Madura\u2013Bali (Jamali) interconnected system.',
            'stats.value_total': '23,000+ <small>MW</small>',
            'stats.label_total': 'Total PLN NP Capacity',
            'stats.desc_total': 'Generating capacity of PT PLN Nusantara Power.',
            'stats.value_ebt': '6.3+ <small>GW</small>',
            'stats.label_ebt': 'Renewable Energy Projects',
            'stats.desc_ebt': 'A continuously growing renewable energy portfolio.',

            /* ---------- MEKANISME / ALUR ---------- */
            'flow.title': 'Public Information Service Mechanism',
            'flow.subtitle': 'The following is the public information service procedure at PT PLN (Persero)',
            'flow.step1_title': 'Request Submission',
            'flow.step1_desc': 'The applicant submits a written public information request through the provided form.',
            'flow.step2_title': 'Receipt & Recording',
            'flow.step2_desc': 'PPID receives the request, records it in the register, and issues a receipt to the applicant.',
            'flow.step3_title': 'Verification Process',
            'flow.step3_desc': 'PPID verifies and inventories the requested information based on openness criteria.',
            'flow.step4_title': 'Information Delivery',
            'flow.step4_desc': 'Public information is delivered to the applicant no later than 10 working days from receipt.',

            /* ---------- LAYANAN KAMI ---------- */
            'services.title': 'Our Services',
            'services.subtitle': 'Access the various public information services available',
            'services.menu1_title': 'Public Information',
            'services.menu1_desc': 'Access openly available public information documents and data.',
            'services.menu2_title': 'Information Request',
            'services.menu2_desc': 'Submit a public information request online easily and quickly.',
            'services.menu3_title': 'Information Objection',
            'services.menu3_desc': 'File an objection if the requested information is denied or does not comply.',
            'services.menu4_title': 'Immediate Information',
            'services.menu4_desc': 'Access information that must be announced immediately for public safety.',

            /* ---------- FOOTER ---------- */
            'footer.title': 'PT PLN Nusantara Power UP PLTU Indramayu',
            'footer.description': 'The Information and Documentation Management Officer (PPID) of PT PLN Nusantara Power UP PLTU Indramayu is tasked with providing public information openness services in a transparent, fast, and accountable manner.',
            'footer.important_links': 'Important Links',
            'footer.link_home': 'Home',
            'footer.link_profile': 'PPID Profile',
            'footer.link_public_info': 'Public Information',
            'footer.link_info_services': 'Information Services',
            'footer.link_faq': 'FAQ',
            'footer.services': 'Services',
            'footer.svc_request': 'Information Request',
            'footer.svc_objection': 'Information Objection',
            'footer.svc_immediate': 'Immediate Information',
            'footer.svc_excluded': 'Excluded Information',
            'footer.contact': 'Contact Us',
            'footer.label_address': 'Address',
            'footer.address': 'Sumur Adem Village, Sukra District, Indramayu Regency, West Java 45257, Indonesia',
            'footer.label_phone': 'Phone',
            'footer.phone': '(+62 234) 5613236',
            'footer.label_email': 'Official Email',
            'footer.email': 'upid@plnnusantarapower.co.id',
            'footer.label_hours': 'Service Hours',
            'footer.hours': 'Monday \u2013 Friday (08.00 \u2013 16.00 WIB)',
            'footer.copyright': '\u00a9 2026 PT PLN Nusantara Power UP PLTU Indramayu \u2014 All Rights Reserved.',

            /* ---------- SEJARAH PAGE ---------- */
            'sejarah.breadcrumb_about': 'About Us',
            'sejarah.breadcrumb_current': 'Company History',
            'sejarah.eyebrow': 'About Us',
            'sejarah.title': 'History & <span>Company Milestones</span>',
            'sejarah.subtitle': 'The Transformation Journey of PT PLN Nusantara Power in Building the Nation Through the Ages.',
            'sejarah.s1_title': 'Company Establishment & Early Foundation',
            'sejarah.s1_sub': 'Company Establishment',
            'sejarah.s1_desc': 'The company officially began its journey in 1995 when PT PLN (Persero) established this subsidiary to manage power generation assets across Indonesia. From its inception, the company was entrusted to operate <strong>5 main Generation Units (UP)</strong> with a total installed capacity of <strong>5,068 MW</strong>.',
            'sejarah.s2_title': 'Decade of Growth and Business Expansion',
            'sejarah.s2_sub': 'Stable Growth',
            'sejarah.s2_desc': 'Entering the period from 2000 to 2010, the company experienced stable and expansive growth. Total capacity increased significantly from <strong>5,068 MW to 6,469 MW</strong> along with the transfer of strategic assets including <strong>Cirata PLTA Units 5–8</strong> and <strong>Muara Tawar PLTGU</strong>.',
            'sejarah.s3_title': 'International Standards Achievement & Operational Excellence',
            'sejarah.s3_sub': 'Operational Excellence',
            'sejarah.s3_desc': 'During 2011 to 2015, the company made history as the <strong>first entity in Asia Pacific</strong> to achieve <strong>ISO 55001 Asset Management System</strong> certification. This operational excellence led the company to earn the <strong>Emerging Industry Leader Band</strong> designation.',
            'sejarah.s4_title': 'Sustainable Corporate Transformation & Sub-Holding Era',
            'sejarah.s4_sub': 'Corporate Transformation I & II',
            'sejarah.s4_desc': 'During 2016 to 2024, the company went through two major transformation waves. In the <strong>Corporate Transformation I</strong> phase, the company consolidated the asset-based PJB Group by combining operational and business excellence.',
            'sejarah.s5_title': 'Strengthening the Base, Market Expansion & Sustainability',
            'sejarah.s5_sub': 'Strengthening The Base, Expanding The Business',
            'sejarah.s5_desc': 'For the 2024–2028 period, the company focuses its strategy on strengthening operational foundations while expanding business sustainably. This is executed through <strong>accelerated digital transformation</strong>.',

            /* ---------- VISI & MISI PAGE ---------- */
            'visi.breadcrumb_about': 'About Us',
            'visi.breadcrumb_current': 'Vision & Mission',
            'visi.eyebrow': 'About Us',
            'visi.title': 'Company Vision & Mission',
            'visi.desc': 'The core foundation and commitment of PT PLN Nusantara Power in illuminating Indonesia and driving the global energy transition.',
            'visi.visi_label': 'Company Vision',
            'visi.visi_text': 'To become a leading and trusted power generation company for sustainable energy in Indonesia and the global market.',
            'visi.misi_label': 'Company Mission',
            'visi.misi1': 'Maintaining excellent power plant performance as the core competence.',
            'visi.misi2': 'Building innovative leading businesses to diversify and achieve sustainable growth.',
            'visi.misi3': 'Accelerating the RE Business Portfolio to Support Achieving Zero Carbon Emissions.',
            'visi.misi4': 'Acquiring and developing the best talent to run a responsive and adaptive organization.',
            'visi.back_btn': 'Back to About Us'
        }
    };

    /* =====================================================
       2. STATE & HELPERS
       ===================================================== */
    const STORAGE_KEY = 'pln_lang';
    const DEFAULT_LANG = 'id';

    function getSavedLanguage() {
        try {
            const saved = localStorage.getItem(STORAGE_KEY);
            return (saved === 'id' || saved === 'en') ? saved : DEFAULT_LANG;
        } catch (e) {
            return DEFAULT_LANG;
        }
    }

    function saveLanguage(lang) {
        try {
            localStorage.setItem(STORAGE_KEY, lang);
        } catch (e) {
            /* localStorage tidak tersedia (mis. private mode) — abaikan */
        }
    }

    function getTranslation(lang, key) {
        return translations[lang] && Object.prototype.hasOwnProperty.call(translations[lang], key)
            ? translations[lang][key]
            : null;
    }

    /* =====================================================
       3. TERAPKAN BAHASA — loop seluruh [data-i18n]
       ===================================================== */
    function applyLanguage(lang) {
        document.querySelectorAll('[data-i18n]').forEach(function (el) {
            const key = el.getAttribute('data-i18n');
            const text = getTranslation(lang, key);
            if (text !== null) {
                /* Gunakan innerHTML agar struktur HTML (mis. <span>, <small>)
                   dalam terjemahan tetap terjaga. Karena dictionary dikontrol
                   oleh developer (bukan user input), ini aman dari XSS. */
                el.innerHTML = text;
            }
        });

        /* Label singkat pada tombol globe */
        const badge = document.getElementById('lang-current');
        if (badge) {
            badge.textContent = lang.toUpperCase();
        }

        /* Sorot opsi aktif pada dropdown */
        document.querySelectorAll('.lang-option').forEach(function (opt) {
            opt.classList.toggle('active', opt.getAttribute('data-lang') === lang);
        });

        /* Bahasa dokumen (aksesibilitas) */
        document.documentElement.setAttribute('lang', lang === 'en' ? 'en' : 'id');

        /* Trigger Google Translate untuk konten halaman lainnya */
        triggerGoogleTranslate(lang);

        saveLanguage(lang);
    }

    /* =====================================================
       4. DROPDOWN GLOBE — toggle interaktif
       ===================================================== */
    function initLangDropdown() {
        const switcher = document.getElementById('lang-switcher');
        const toggle = document.getElementById('langToggle');
        const menu = document.getElementById('langMenu');

        if (!switcher || !toggle || !menu) {
            return;
        }

        /* Buka/tutup saat ikon globe diklik */
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpening = !switcher.classList.contains('open');
            switcher.classList.toggle('open');
            toggle.setAttribute('aria-expanded', switcher.classList.contains('open') ? 'true' : 'false');
            /* Tutup semua Bootstrap dropdown saat membuka language switcher */
            if (isOpening) {
                document.querySelectorAll('.navbar-pln .dropdown.show').forEach(function (dd) {
                    dd.classList.remove('show');
                    dd.querySelector('.dropdown-menu')?.classList.remove('show');
                });
            }
        });

        /* Tutup jika mengklik di luar menu */
        document.addEventListener('click', function (e) {
            if (!switcher.contains(e.target)) {
                switcher.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });

        /* Tutup language switcher saat Bootstrap dropdown dibuka */
        document.querySelectorAll('.navbar-pln .dropdown-toggle').forEach(function (ddToggle) {
            ddToggle.addEventListener('click', function () {
                switcher.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });

        /* Tutup saat menekan Escape */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                switcher.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });

        /* Pilih bahasa */
        menu.querySelectorAll('.lang-option').forEach(function (option) {
            option.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const lang = option.getAttribute('data-lang');
                switcher.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                applyLanguage(lang);
            });
        });
    }

    /* =====================================================
       5. FEATHER ICONS — inisialisasi ikon SVG
       ===================================================== */
    function initFeatherIcons() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    /* =====================================================
       6. GOOGLE TRANSLATE — trigger penerjemahan halaman
       ===================================================== */
    function initGoogleTranslate() {
        /* Widget Google Translate dimuat via script di app.blade.php.
           Fungsi ini bisa dipakai untuk setup tambahan jika diperlukan. */
    }

    function triggerGoogleTranslate(lang) {
        var combo = document.querySelector('.goog-te-combo');
        if (combo) {
            combo.value = lang;
            combo.dispatchEvent(new Event('change'));
        }
    }

    /* =====================================================
       7. INISIALISASI
       ===================================================== */
    function init() {
        applyLanguage(getSavedLanguage());
        initLangDropdown();
        initFeatherIcons();
        initGoogleTranslate();
    }

    /* =====================================================
       8. API PUBLIK — dipakai router (public/js/router.js)
          untuk re-apply bahasa pada konten hasil swap AJAX
       ===================================================== */
    window.PLNI18N = {
        apply: function () {
            applyLanguage(getSavedLanguage());
            initFeatherIcons();
        },
        applyLanguage: applyLanguage,
        getLanguage: getSavedLanguage
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
