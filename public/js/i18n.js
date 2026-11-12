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
            'nav.home': 'Beranda',
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
            'nav.services_info': 'Informasi Layanan',
            'nav.services_faq': 'FAQ',
            'nav.services_registration': 'Form Registrasi Tamu',
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

            /* ---------- WILAYAH OPERASIONAL ---------- */
            'region.title': 'Wilayah Operasional PT PLN Nusantara Power',
            'region.subtitle': 'Cakupan area kerja dan pembangkitan di berbagai wilayah Indonesia',

            /* ---------- BANNER SLIDER ---------- */
            'banner.line_scope': 'Cakupan Area Pembangkitan',
            'banner.wilayah1': 'Wilayah Operasional 1',
            'banner.wilayah2': 'Wilayah Operasional 2',
            'banner.line_network': 'Diagram Jaringan Kelistrikan',
            'banner.interkoneksi': 'Sistem Interkoneksi',
            'banner.prev': 'Sebelumnya',
            'banner.next': 'Berikutnya',

            /* ---------- BADGE TOKO APLIKASI ---------- */
            'store.google_small': 'Dapatkan di',
            'store.apple_small': 'Unduh di',

            /* ---------- MEKANISME / ALUR ---------- */
            /* ---------- PROMO PLN MOBILE ---------- */
            'mobile.title': 'Mulai Pengalaman Baru di PLN Mobile',
            'mobile.subtitle': 'Semua keperluan listrik dan rumah dalam 1 aplikasi PLN Mobile, semua semakin mudah!',
            'mobile.hashtag': '#SemuaMakinMudah',

            /* ---------- LAYANAN KAMI ---------- */
            'services.title': 'Layanan Kami',
            'services.subtitle': 'Akses berbagai layanan informasi publik yang tersedia',
            'services.menu1_title': 'Informasi Layanan',
            'services.menu1_desc': 'Informasi mengenai layanan informasi publik yang tersedia di PPID.',
            'services.menu2_title': 'Berita',
            'services.menu2_desc': 'Baca kabar dan informasi terbaru seputar kegiatan PLTU Indramayu.',
            'services.menu4_title': 'FAQ',
            'services.menu4_desc': 'Temukan jawaban atas pertanyaan yang sering diajukan seputar layanan.',
            'services.menu5_title': 'Registrasi Tamu',
            'services.menu5_desc': 'Daftarkan kunjungan Anda ke PLTU Indramayu melalui form registrasi tamu online.',

            /* ---------- FOOTER ---------- */
            'footer.title': 'PT PLN Nusantara Power UP PLTU Indramayu',
            'footer.description': 'Pejabat Pengelola Informasi dan Dokumentasi (PPID) PT PLN Nusantara Power UP PLTU Indramayu bertugas memberikan layanan keterbukaan informasi publik secara transparan, cepat, dan akuntabel.',
            'footer.contact': 'Hubungi Kami',
            'footer.label_address': 'Alamat',
            'footer.address': 'Desa Sumur Adem, Kecamatan Sukra, Kabupaten Indramayu, Jawa Barat 45257',
            'footer.label_phone': 'Telepon',
            'footer.phone': '(+62 234) 5613236',
            'footer.label_email': 'Email Resmi',
            'footer.email': 'upid@plnnusantarapower.co.id',
            'footer.label_hours': 'Jam Layanan',
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
            'visi.back_btn': 'Kembali ke Tentang Kami',

            /* ---------- HALAMAN PROFIL PERUSAHAAN ---------- */
            'profil.badge': 'Unit Pembangkitan',
            'profil.hero_subtitle': 'Satu dari unit pembangkitan PT PLN Nusantara Power, mengoperasikan <strong>PLTU di Sumuradem, Indramayu</strong> untuk mendukung penyediaan energi listrik di Indonesia.',
            'profil.stat_capacity': 'MW Kapasitas Terpasang',
            'profil.stat_units': 'Unit Pembangkit (330 MW)',
            'profil.stat_area': 'Luas Area Pembangkit',
            'profil.card1_title': 'Unit Pembangkitan',
            'profil.card1_desc': '<strong>PLN Nusantara Power Unit Pembangkitan Indramayu (UP Indramayu)</strong> merupakan unit pembangkitan di bawah PT PLN Nusantara Power, bergerak dalam bidang penyediaan tenaga listrik melalui pengoperasian <strong>Pembangkit Listrik Tenaga Uap (PLTU)</strong>.',
            'profil.card2_title': 'PLTU Batubara',
            'profil.card2_desc': 'Pembangkit ini menggunakan <strong>batubara</strong> sebagai bahan bakar utama, dengan kapasitas terpasang sebesar <strong>990 MW</strong> yang terdiri dari <strong>tiga unit pembangkit</strong> masing-masing berkapasitas 330 MW.',
            'profil.card3_title': 'Komitmen Keberlanjutan',
            'profil.card3_desc': 'UP Indramayu terus berkomitmen menjaga keandalan dan efisiensi pembangkitan melalui pengelolaan operasional & pemeliharaan optimal, dengan tetap memperhatikan <strong>keselamatan, lingkungan, dan keberlanjutan</strong>.',
            'profil.about_title': 'Tentang UP Indramayu',
            'profil.about_desc': 'Kenali lebih dekat Unit Pembangkitan Indramayu — peran strategisnya dalam sistem kelistrikan Jawa-Bali dan komitmen terhadap operasional yang andal, aman, dan berkelanjutan.',
            'profil.role1_title': 'Peran Strategis di Sistem Jawa-Bali',
            'profil.role2_title': 'Komitmen Operasional & Lingkungan',
            'profil.capacity_title': 'Kapasitas & Lokasi',
            'profil.capacity_desc': 'Detail teknis dan lokasi PLTU Unit Pembangkitan Indramayu.',
            'profil.contribution_title': 'Peran & Kontribusi',
            'profil.contribution_desc': 'UP Indramayu tidak hanya berperan sebagai pembangkit listrik, tetapi juga berkomitmen memberikan dampak positif bagi lingkungan dan masyarakat.',
            'profil.contrib1_title': 'Pembangkitan Listrik',
            'profil.contrib2_title': 'Pengelolaan Lingkungan',
            'profil.contrib3_title': 'Keselamatan & K3',
            'profil.contrib4_title': 'CSR & Pemberdayaan Masyarakat',
            'profil.timeline_title': 'Perjalanan Unit Pembangkitan',
            'profil.timeline_desc': 'Jejak kontribusi UP Indramayu dalam penyediaan energi listrik dan komitmen terhadap operasional yang dan lingkungan yang berkelanjutan.',
            'profil.cta_title': 'Menyediakan Energi untuk Indonesia',

            /* ---------- HALAMAN STRUKTUR ORGANISASI ---------- */
            'struktur.bc_home': 'Beranda',
            'struktur.bc_about': 'Tentang Kami',
            'struktur.bc_current': 'Struktur Organisasi',
            'struktur.title': 'Bagan Struktur Organisasi',
            'struktur.subtitle': 'UP Indramayu',
            'struktur.fallback': 'Bagan Struktur Organisasi UP Indramayu',

            /* ---------- HALAMAN BERITA ---------- */
            'berita.bc_home': 'Beranda',
            'berita.bc_info': 'Informasi',
            'berita.bc_current': 'Berita',
            'berita.title': 'Berita & <span class="accent">Informasi</span> Terkini',
            'berita.subtitle': 'Ikuti perkembangan terbaru seputar operasional, program kerja, dan kegiatan PT PLN Nusantara Power UP PLTU Indramayu.',
            'berita.section_title': 'Berita & Informasi Terkini',

            /* ---------- HALAMAN GALERI ---------- */
            'galeri.bc_home': 'Beranda',
            'galeri.bc_info': 'Informasi',
            'galeri.bc_current': 'Galeri',
            'galeri.title': 'Galeri & <span class="accent">Dokumentasi</span> Operasional',
            'galeri.subtitle': 'Kumpulan foto dan dokumentasi kegiatan operasional, pemeliharaan, serta program K3 & lingkungan di PT PLN Nusantara Power UP PLTU Indramayu.',
            'galeri.filter_all': 'Semua',
            'galeri.filter_operational': 'Operasional PLTU',
            'galeri.filter_maintenance': 'Pemeliharaan',
            'galeri.filter_k3': 'K3 & Lingkungan',
            'galeri.filter_social': 'Kegiatan Sosial',
            'galeri.filter_kegiatan': 'Kegiatan',
            'galeri.filter_fasilitas': 'Fasilitas',
            'galeri.filter_dokumentasi': 'Dokumentasi',
            'galeri.filter_seremonial': 'Seremonial',
            'galeri.empty': 'Belum ada foto pada kategori ini.',
            'galeri.count': '{n} foto ditampilkan',

            /* ---------- FORM REGISTRASI TAMU ---------- */
            'form.title': 'Form Registrasi Tamu',
            'form.subtitle': 'Silakan lengkapi data diri Anda untuk pendaftaran kunjungan.',
            'form.section_identity': 'Data Diri',
            'form.section_documents': 'Dokumen',
            'form.section_visit': 'Detail Kunjungan',
            'form.label_nik': 'NIK / No. KTP',
            'form.label_nama': 'Nama Lengkap',
            'form.label_instansi': 'Perusahaan / Instansi',
            'form.label_nohp': 'No. WhatsApp / HP',
            'form.label_email': 'Email',
            'form.label_tujuan': 'Bidang yang Ditemui',
            'form.label_jabatan': 'Jabatan yang Ditemui',
            'form.label_orang': 'Orang yang Ditemui',
            'form.ph_jabatan': 'Jabatan orang yang ditemui',
            'form.ph_orang': 'Nama orang yang ditemui',
            'form.label_tanggal': 'Tanggal Kunjungan',
            'form.label_tanggal_jam': 'Tanggal & Jam Kunjungan',
            'form.ph_tanggal_jam': 'dd/mm/yyyy --:--',
            'form.label_jam': 'Jam Kunjungan',
            'form.label_jumlah': 'Jumlah Tamu',
            'form.label_keperluan': 'Maksud & Keperluan Kunjungan',
            'form.ph_nik': 'Masukkan 16 digit NIK',
            'form.ph_nama': 'Nama sesuai KTP',
            'form.ph_instansi': 'Nama instansi asal',
            'form.ph_nohp': '08xxxxxxxxxx',
            'form.ph_email': 'nama@email.com',
            'form.ph_tujuan': 'Nama orang / divisi tujuan',
            'form.ph_keperluan': 'Jelaskan singkat maksud dan keperluan kunjungan Anda...',
            'form.doc_dokumen': 'Berkas Pendukung',
            'form.doc_dokumen_hint': 'ZIP, RAR, PDF, JPG, JPEG, atau PNG — maks 10MB',
            'form.dz_title': 'Klik untuk memilih berkas',
            'form.dz_hint': 'atau seret & letakkan di sini — maksimal 10MB',
            'form.btn_hapus': 'Hapus',
            'form.btn_ganti': 'Ganti',
            'form.btn_submit': 'Daftar Sekarang',
            'form.btn_note': 'Wajib diisi. Data Anda aman & hanya untuk keperluan registrasi.',
            'form.footnote': 'Data Anda disimpan aman dan hanya digunakan untuk keperluan registrasi kunjungan.',
            'form.error_heading': 'Periksa kembali isian berikut:',
            'form.success_title': 'Data Anda Berhasil Dikirim!',
            'form.success_text': 'Menunggu konfirmasi admin.<br>Silakan cek email / WhatsApp Anda untuk informasi selanjutnya.',
            'form.btn_done': 'Selesai',

            /* ---------- INFORMASI LAYANAN (SPL) ---------- */
            'spl.bc_home': 'Beranda',
            'spl.bc_current': 'Informasi Layanan',
            'spl.title': 'Informasi <span class="accent">Standar Pelayanan</span>',
            'spl.subtitle': 'Panduan resmi, persyaratan dokumen, standar waktu, dan prosedur pelayanan publik PT PLN Nusantara Power UP PLTU Indramayu.',
            'spl.card_title': 'Standar &amp; Prosedur Pelayanan',
            'spl.card_subtitle': 'Pusat panduan, SOP, dan transparansi standar pelayanan publik',
            'spl.tab_maklumat': 'Maklumat Pelayanan',
            'spl.tab_prosedur': 'Syarat &amp; Prosedur Layanan',
            'spl.tab_estimasi': 'Estimasi Waktu &amp; Biaya',
            'spl.tab_dokumen': 'Unduh Dokumen &amp; SOP',
            'spl.maklumat_title': 'Maklumat Pelayanan Publik',
            'spl.maklumat_badge': 'Ditetapkan &amp; Ditandatangani Manajemen',
            'spl.maklumat_quote': '&ldquo;Kami berkomitmen memberikan pelayanan publik yang transparan, akuntabel, cepat, dan berorientasi pada kepuasan masyarakat, sesuai dengan peraturan perundang-undangan tentang Pelayanan Publik.&rdquo;',
            'spl.commit1': 'Pelayanan dilakukan secara tertib, tepat waktu, dan sesuai standar.',
            'spl.commit2': 'Biaya pelayanan sesuai ketentuan &mdash; tidak ada pungutan di luar ketentuan.',
            'spl.commit3': 'Informasi pelayanan disediakan secara terbuka dan mudah diakses.',
            'spl.commit4': 'Setiap pengaduan ditindaklanjuti secara cepat dan proporsional.',
            'spl.sign_org': 'Manajemen PT PLN Nusantara Power UP PLTU Indramayu',
            'spl.sign_role': 'General Manager &mdash; UP PLTU Indramayu',
            'spl.sign_note': 'Terverifikasi &mdash; Transparansi Publik',
            'spl.acc1_title': 'Standar Pelayanan Pemanfaatan FABA (Fly Ash &amp; Bottom Ash)',
            'spl.acc2_title': 'Standar Pelayanan Kunjungan Industri / Edukasi',
            'spl.acc3_title': 'Standar Pelayanan Pengajuan CSR / TJSL',
            'spl.req_label': 'Persyaratan',
            'spl.flow_label': 'Alur Prosedur',
            'spl.acc1_req1': 'Surat permohonan resmi dari instansi/perusahaan',
            'spl.acc1_req2': 'Dokumen legalitas usaha (NIB, akta, atau setara)',
            'spl.acc1_req3': 'Profil rencana penggunaan material FABA',
            'spl.acc2_req1': 'Surat resmi dari Kampus/Sekolah (minimal H-14 sebelum kunjungan)',
            'spl.acc2_req2': 'Daftar peserta kunjungan',
            'spl.acc2_req3': 'Sertifikat vaksin / dokumen K3 yang dipersyaratkan',
            'spl.acc3_req1': 'Proposal program pemberdayaan masyarakat',
            'spl.acc3_req2': 'Profil instansi/komunitas pengusul',
            'spl.acc3_req3': 'Rencana lokasi &amp; target penerima manfaat',
            'spl.step_proposal': 'Pengajuan Proposal',
            'spl.step_verifikasi': 'Verifikasi Teknis',
            'spl.step_mou': 'Penandatanganan MoU',
            'spl.step_ambil': 'Pengambilan Material',
            'spl.step_surat': 'Pengajuan Surat',
            'spl.step_jadwal': 'Konfirmasi Jadwal dari Humas',
            'spl.step_safety': 'Safety Indoktrinasi',
            'spl.step_field': 'Kunjungan Field',
            'spl.step_kajian': 'Kajian &amp; Seleksi Program',
            'spl.step_keputusan': 'Keputusan Manajemen',
            'spl.step_pelaksanaan': 'Pelaksanaan Program',
            'spl.th_service': 'Jenis Layanan',
            'spl.th_time': 'Estimasi Waktu Proses',
            'spl.th_cost': 'Biaya / Tarif',
            'spl.th_output': 'Output Layanan',
            'spl.row1_service': 'Permohonan FABA',
            'spl.row1_time': '3 &ndash; 5 Hari Kerja',
            'spl.row1_output': 'Surat Izin Pemanfaatan',
            'spl.row2_service': 'Permohonan Kunjungan',
            'spl.row2_time': '2 &ndash; 4 Hari Kerja',
            'spl.row2_output': 'Surat Konfirmasi &amp; Jadwal',
            'spl.row3_service': 'Pengajuan CSR/TJSL',
            'spl.row3_time': '7 &ndash; 14 Hari Kerja',
            'spl.row3_output': 'Lembar Disposisi &amp; Realisasi',
            'spl.free': 'Rp 0 (Gratis)',
            'spl.table_note': 'Estimasi waktu dihitung sejak berkas permohonan dinyatakan lengkap secara administratif. Seluruh layanan di atas <strong>tidak dipungut biaya</strong> sesuai standar pelayanan publik.',
            'spl.dl1_title': 'Buku Standar Pelayanan Publik UP Indramayu',
            'spl.dl1_meta': 'PDF &middot; Dokumen resmi standar pelayanan',
            'spl.dl2_title': 'Formulir Permohonan Kunjungan Industri',
            'spl.dl2_meta': 'PDF &middot; Formulir pengajuan kunjungan',
            'spl.dl3_title': 'SOP Kemitraan Pemanfaatan FABA',
            'spl.dl3_meta': 'PDF &middot; Prosedur operasional kemitraan',
            'spl.contact_title': 'Butuh bantuan lebih lanjut?',
            'spl.contact_text': 'Silakan ajukan pertanyaan melalui saluran resmi PPID PT PLN Nusantara Power.',

            /* ---------- FAQ ---------- */
            'faq.title': 'Pertanyaan yang <span class="accent">Sering Diajukan</span> (FAQ)',
            'faq.subtitle': 'Temukan informasi dan jawaban cepat terkait operasional, layanan kelistrikan, serta program keberlanjutan PT PLN Nusantara Power UP PLTU Indramayu.',
            'faq.search_ph': 'Cari pertanyaan… (mis. kunjungan industri, FABA)',
            'faq.search_aria': 'Cari pertanyaan',
            'faq.clear_aria': 'Hapus pencarian',
            'faq.card_title': 'Jelajahi Berdasarkan Kategori',
            'faq.card_subtitle': 'Pilih kategori atau ketik kata kunci untuk menemukan jawaban dengan cepat',
            'faq.filter_all': 'Semua',
            'faq.filter_operasional': 'Operasional &amp; Pembangkit',
            'faq.filter_layanan': 'Layanan &amp; Kemitraan',
            'faq.filter_k3l': 'Keselamatan &amp; Lingkungan (K3L)',
            'faq.filter_karir': 'Karir &amp; Umum',
            'faq.count': 'Menampilkan {n} dari {total} pertanyaan',
            'faq.q1': 'Apa peran utama PLTU Indramayu dalam sistem kelistrikan nasional?',
            'faq.a1': 'PLTU UP Indramayu mengoperasikan 3 unit pembangkitan dengan total kapasitas 3&nbsp;x&nbsp;330&nbsp;MW (990&nbsp;MW) yang menjadi penopang beban dasar (baseload) penting dalam sistem interkoneksi listrik Jawa-Madura-Bali (Jamali).',
            'faq.q2': 'Bagaimana komitmen PLN Nusantara Power UP PLTU Indramayu terhadap lingkungan?',
            'faq.a2': 'Kami menerapkan teknologi pengelolaan emisi modern, pemanfaatan FABA (Fly Ash &amp; Bottom Ash) secara berkelanjutan, program co-firing biomassa, serta pemantauan kualitas udara dan lingkungan sekitar secara berkala.',
            'faq.q3': 'Apakah masyarakat dapat mengajukan permohonan kunjungan atau edukasi ke PLTU Indramayu?',
            'faq.a3': 'Ya, permohonan kunjungan industri atau edukasi dapat diajukan secara resmi melalui menu Kontak atau Humas PT PLN Nusantara Power UP Indramayu dengan melampirkan surat permohonan instansi/kampus.',
            'faq.q4': 'Di mana saya bisa melihat daftar layanan publik resmi dari PLTU Indramayu?',
            'faq.a4': 'Daftar layanan publik dapat diakses langsung melalui menu &ldquo;Layanan&rdquo; pada bilah navigasi utama website ini.',
            'faq.q5': 'Mengapa pengunjung wajib mengisi form registrasi tamu sebelum masuk?',
            'faq.a5': 'Pengisian form registrasi tamu dilakukan untuk pendataan identitas, menjaga standar keamanan dan K3L (Keselamatan dan Kesehatan Kerja Lingkungan) di area objek vital nasional, serta memastikan pejabat/divisi yang dituju siap menerima kunjungan Anda.',
            'faq.q6': 'Dokumen apa saja yang wajib disiapkan saat mengisi form registrasi tamu?',
            'faq.a6': 'Anda perlu menyiapkan Nomor KTP/NIK, data diri (nama, instansi, nomor WhatsApp), serta mengunggah foto/scan KTP asli yang jelas (format JPG/PNG, ukuran maks. 2MB).',
            'faq.q7': 'Apa yang harus dilakukan setelah berhasil mengirim form pendaftaran tamu?',
            'faq.a7': 'Setibanya di lokasi, silakan tunjukkan bukti pendaftaran atau nama Anda kepada petugas keamanan (Security) atau Resepsionis di Lobi Utama untuk konfirmasi dan pengambilan Visitor Badge / Pass Tamu.',
            'faq.q8': 'Bagaimana cara mengajukan magang atau kerja praktik di PLTU Indramayu?',
            'faq.a8': 'Permohonan magang/kerja praktik diajukan melalui surat resmi dari kampus atau instansi yang ditujukan kepada PT PLN Nusantara Power UP PLTU Indramayu, dengan mencantumkan data peserta, durasi, dan bidang pembimbingan yang diinginkan.',
            'faq.q9': 'Bagaimana cara mendapatkan informasi resmi tentang kegiatan dan program UP PLTU Indramayu?',
            'faq.a9': 'Informasi resmi dapat diakses melalui menu Berita dan Pengumuman pada website ini, serta kanal sosial media resmi PT PLN Nusantara Power.',
            'faq.empty_title': 'Tidak Ada Hasil Ditemukan',
            'faq.empty_text': 'Coba gunakan kata kunci lain atau lihat semua pertanyaan.',
            'faq.empty_reset': 'Reset Pencarian',
            'faq.contact_title': 'Belum menemukan jawaban yang Anda cari?',

            /* ---------- BERITA / PENGUMUMAN (DAFTAR + DETAIL) ---------- */
            'berita.read_more': 'Selengkapnya',
            'berita.empty_title': 'Belum ada berita',
            'berita.empty_text': 'Berita akan segera tersedia. Silakan kunjungi kembali nanti.',
            'berita.pagination_aria': 'Navigasi berita',
            'berita.related_title': 'Berita Terkait',
            'png.bc_current': 'Pengumuman',
            'png.title': 'Pemberitahuan & <span class="accent">Pengumuman</span> Resmi',
            'png.subtitle': 'Informasi resmi terkait operasional, kebijakan, rekrutmen, dan layanan publik PT PLN Nusantara Power UP PLTU Indramayu.',
            'png.filter_all': 'Semua',
            'png.filter_umum': 'Umum',
            'png.filter_teknis': 'Teknis',
            'png.filter_kepegawaian': 'Kepegawaian',
            'png.filter_keuangan': 'Keuangan',
            'png.filter_layanan': 'Layanan',
            'png.view_detail': 'Lihat Detail',
            'png.empty_title': 'Belum ada pengumuman',
            'png.empty_text': 'Pengumuman resmi akan ditampilkan di halaman ini.',
            'png.pagination_aria': 'Navigasi pengumuman',
            'png.detail_badge': 'Pengumuman Resmi',
            'png.back_link': 'Kembali ke Daftar Pengumuman',
            'png.info_title': 'Informasi',
            'png.info_text_1': 'Pengumuman ini diterbitkan oleh PT PLN Nusantara Power UP PLTU Indramayu pada',
            'png.info_text_2': 'Untuk pertanyaan lebih lanjut, silakan hubungi kantor PPID.',
            'png.related_title': 'Pengumuman Terkait',

            /* ---------- NAMA BULAN SINGKAT ---------- */
            'month.1': 'Jan', 'month.2': 'Feb', 'month.3': 'Mar', 'month.4': 'Apr',
            'month.5': 'Mei', 'month.6': 'Jun', 'month.7': 'Jul', 'month.8': 'Agu',
            'month.9': 'Sep', 'month.10': 'Okt', 'month.11': 'Nov', 'month.12': 'Des',

            /* ---------- PROFIL PERUSAHAAN (LANJUTAN) ---------- */
            'profil.role1_desc_1': 'Sebagai salah satu unit pembangkitan <strong class="highlight">PLN Nusantara Power</strong>, UP Indramayu memiliki peran strategis dalam mendukung <strong>keandalan pasokan listrik</strong>, khususnya dalam sistem kelistrikan <strong>Jawa-Bali</strong>.',
            'profil.role1_desc_2': 'Dengan kapasitas pembangkitan yang besar, UP Indramayu berkontribusi dalam memenuhi <strong>kebutuhan energi listrik masyarakat</strong> sekaligus mendukung berbagai aktivitas ekonomi dan pembangunan nasional.',
            'profil.role2_desc': 'Selain menjalankan fungsi pembangkitan, UP Indramayu berupaya memberikan dampak positif bagi lingkungan dan masyarakat sekitar melalui:',
            'profil.role2_li1': '<strong class="highlight">Pengelolaan lingkungan</strong> yang bertanggung jawab',
            'profil.role2_li2': 'Peningkatan <strong>efisiensi operasional</strong> pembangkit',
            'profil.role2_li3': 'Komitmen <strong>Keselamatan &amp; Kesehatan Kerja (K3)</strong>',
            'profil.role2_li4': 'Program <strong>tanggung jawab sosial &amp; pemberdayaan masyarakat</strong>',
            'profil.contrib1_desc': 'Mengoperasikan PLTU batubara dengan kapasitas 990 MW (3 unit x 330 MW) untuk memenuhi kebutuhan energi listrik sistem Jawa-Bali.',
            'profil.contrib2_desc': 'Penerapan pengelolaan lingkungan yang bertanggung jawab sebagai bagian dari komitmen keberlanjutan operasional.',
            'profil.contrib3_desc': 'Prioritas utama dalam pengoperasian pembangkit &mdash; menjaga keselamatan, kesehatan kerja, dan efisiensi operasional secara optimal.',
            'profil.contrib4_desc': 'Berbagai program tanggung jawab sosial dan pemberdayaan masyarakat sekitar untuk memberikan dampak positif bagi komunitas setempat.',
            'profil.tl1_year': 'Pendirian Unit',
            'profil.tl1_title': 'Berdirinya PLN UP Indramayu',
            'profil.tl1_desc': 'Unit pembangkitan didirikan sebagai bagian dari PT PLN Nusantara Power, bergerak dalam bidang penyediaan tenaga listrik melalui pengoperasian PLTU.',
            'profil.tl2_year': 'Operasi Awal',
            'profil.tl2_title': 'Pengoperasian PLTU Batubara',
            'profil.tl2_desc': 'Pembangkit mulai beroperasi dengan menggunakan batubara sebagai bahan bakar utama, memiliki kapasitas terpasang 990 MW (3 unit x 330 MW) di Sumuradem, Indramayu.',
            'profil.tl3_year': 'Pengembangan',
            'profil.tl3_title': 'Dukungan keandalan sistem Jawa-Bali',
            'profil.tl3_desc': 'UP Indramayu berkontribusi dalam memenuhi kebutuhan energi listrik masyarakat sekaligus mendukung aktivitas ekonomi dan pembangunan melalui pasokan listrik yang andal.',
            'profil.tl4_year': 'Fokus Keberlanjutan',
            'profil.tl4_title': 'Pengelolaan Lingkungan &amp; CSR',
            'profil.tl4_desc': 'Unit terus berupaya memberikan dampak positif bagi lingkungan dan masyarakat melalui pengelolaan lingkungan, efisiensi operasional, K3, serta program tanggung jawab sosial.',
            'profil.cta_desc': 'PLN Nusantara Power Unit Pembangkitan Indramayu berkomitmen menjadi unit pembangkitan yang andal, profesional, dan bertanggung jawab &mdash; mendukung kebutuhan listrik sistem Jawa-Bali dengan tetap mengedepankan keselamatan, lingkungan, dan keberlanjutan.',
            'profil.cta_btn': 'Lihat Sejarah Kami',

            /* ---------- GALERI (LANJUTAN) ---------- */
            'galeri.empty_desc': 'Dokumentasi foto akan segera ditambahkan. Silakan kembali lagi nanti.',
            'galeri.filter_empty_desc': 'Coba pilih kategori lain untuk melihat dokumentasi yang tersedia.',
            'galeri.show_all': 'Tampilkan Semua Foto',

            /* ---------- FORM REGISTRASI (LANJUTAN) ---------- */
            'form.opt_pilih_pengguna': '— Pilih Pengguna —',
            'form.hint_orang': 'Daftar nama mengikuti Jabatan yang dipilih di atas — hanya karyawan aktif level Asisten Manajer, Junior, dan Staff. Ketik untuk mencari, atau klik untuk memilih dari daftar.',
            'form.hint_tanggal': 'Minimal hari ini — tanggal kemarin, akhir pekan (Sabtu/Minggu, kecuali dibuka admin), hari libur &amp; tanggal merah tidak dapat dipilih.',
            'form.holiday_warning': 'Tanggal ini adalah hari libur. Silakan pilih tanggal lain.',
            'form.msg_holiday': 'Tanggal {date} adalah hari libur dan tidak dapat dipilih untuk kunjungan.',
            'form.msg_weekend': 'Tanggal {date} jatuh pada {day} (akhir pekan) — kunjungan hanya dapat dijadwalkan pada hari kerja.',

            /* ---------- KALENDER (DATE PICKER) ---------- */
            'cal.today': 'Hari ini',
            'cal.clear': 'Bersihkan',
            'cal.pick_date': 'Pilih tanggal',
            'cal.prev_month': 'Bulan sebelumnya',
            'cal.next_month': 'Bulan berikutnya',
            'cal.pick_month': 'Pilih bulan',
            'cal.month_list': 'Daftar bulan',
            'cal.pick_year': 'Pilih tahun',
            'cal.year_list': 'Daftar tahun',
            'cal.holiday': 'Hari libur / tanggal merah',
            'cal.holiday_note': 'Hari libur',
            'cal.weekend': 'Akhir pekan — kunjungan hanya pada hari kerja.',
            'cal.past': 'Tanggal sudah lewat.',
            'cal.out_of_range': 'Di luar rentang tanggal yang diizinkan.',
            'cal.special_workday': 'Hari kerja khusus (override akhir pekan) — bisa dipilih.',
            'day.sunday': 'Minggu',
            'day.saturday': 'Sabtu',
            'day.0': 'Min', 'day.1': 'Sen', 'day.2': 'Sel', 'day.3': 'Rab',
            'day.4': 'Kam', 'day.5': 'Jum', 'day.6': 'Sab',
            'form.aria_tanggal': 'tanggal kunjungan',
            'form.title_tanggal': 'Klik untuk memilih tanggal kunjungan',
            'month.long.1': 'Januari', 'month.long.2': 'Februari', 'month.long.3': 'Maret',
            'month.long.4': 'April', 'month.long.5': 'Mei', 'month.long.6': 'Juni',
            'month.long.7': 'Juli', 'month.long.8': 'Agustus', 'month.long.9': 'September',
            'month.long.10': 'Oktober', 'month.long.11': 'November', 'month.long.12': 'Desember'
        },

        en: {
            /* ---------- NAVBAR ---------- */
            'nav.home': 'Home',
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
            'nav.services_info': 'Service Information',
            'nav.services_faq': 'FAQ',
            'nav.services_registration': 'Guest Registration Form',
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

            /* ---------- WILAYAH OPERASIONAL ---------- */
            'region.title': 'PT PLN Nusantara Power Operational Region',
            'region.subtitle': 'Work area and generation coverage across various regions of Indonesia',

            /* ---------- BANNER SLIDER ---------- */
            'banner.line_scope': 'Generation Area Coverage',
            'banner.wilayah1': 'Operational Region 1',
            'banner.wilayah2': 'Operational Region 2',
            'banner.line_network': 'Electrical Network Diagram',
            'banner.interkoneksi': 'Interconnection System',
            'banner.prev': 'Previous',
            'banner.next': 'Next',

            /* ---------- BADGE TOKO APLIKASI ---------- */
            'store.google_small': 'Get it on',
            'store.apple_small': 'Download on the',

            /* ---------- PROMO PLN MOBILE ---------- */
            'mobile.title': 'Start a New Experience with PLN Mobile',
            'mobile.subtitle': 'All your electricity and home needs in 1 PLN Mobile app — everything is easier!',
            'mobile.hashtag': '#SemuaMakinMudah',

            /* ---------- LAYANAN KAMI ---------- */
            'services.title': 'Our Services',
            'services.subtitle': 'Access the various public information services available',
            'services.menu1_title': 'Information Services',
            'services.menu1_desc': 'Information about the public information services available at PPID.',
            'services.menu2_title': 'News',
            'services.menu2_desc': 'Read the latest news and updates about PLTU Indramayu activities.',
            'services.menu4_title': 'FAQ',
            'services.menu4_desc': 'Find answers to frequently asked questions about our services.',
            'services.menu5_title': 'Guest Registration',
            'services.menu5_desc': 'Register your visit to PLTU Indramayu through the online guest registration form.',

            /* ---------- FOOTER ---------- */
            'footer.title': 'PT PLN Nusantara Power UP PLTU Indramayu',
            'footer.description': 'The Information and Documentation Management Officer (PPID) of PT PLN Nusantara Power UP PLTU Indramayu is tasked with providing public information openness services in a transparent, fast, and accountable manner.',
            'footer.contact': 'Contact Us',
            'footer.label_address': 'Address',
            'footer.address': 'Sumur Adem Village, Sukra District, Indramayu Regency, West Java 45257, Indonesia',
            'footer.label_phone': 'Phone',
            'footer.phone': '(+62 234) 5613236',
            'footer.label_email': 'Official Email',
            'footer.email': 'upid@plnnusantarapower.co.id',
            'footer.label_hours': 'Service Hours',
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
            'visi.back_btn': 'Back to About Us',

            /* ---------- PROFIL PERUSAHAAN PAGE ---------- */
            'profil.badge': 'Generation Unit',
            'profil.hero_subtitle': 'One of PT PLN Nusantara Power\u2019s generation units, operating <strong>PLTU in Sumuradem, Indramayu</strong> to support electricity supply in Indonesia.',
            'profil.stat_capacity': 'MW Installed Capacity',
            'profil.stat_units': 'Generation Units (330 MW)',
            'profil.stat_area': 'Power Plant Area',
            'profil.card1_title': 'Generation Unit',
            'profil.card1_desc': '<strong>PLN Nusantara Power Generation Unit Indramayu (UP Indramayu)</strong> is a generation unit under PT PLN Nusantara Power, engaged in electricity supply through the operation of <strong>Steam Power Plant (PLTU)</strong>.',
            'profil.card2_title': 'Coal-Fired PLTU',
            'profil.card2_desc': 'This power plant uses <strong>coal</strong> as its primary fuel, with an installed capacity of <strong>990 MW</strong> consisting of <strong>three generation units</strong> each with a capacity of 330 MW.',
            'profil.card3_title': 'Sustainability Commitment',
            'profil.card3_desc': 'UP Indramayu remains committed to maintaining reliability and efficiency of power generation through optimal operational management & maintenance, while paying attention to <strong>safety, environment, and sustainability</strong>.',
            'profil.about_title': 'About UP Indramayu',
            'profil.about_desc': 'Get to know UP Indramayu better \u2014 its strategic role in the Java-Bali power system and commitment to reliable, safe, and sustainable operations.',
            'profil.role1_title': 'Strategic Role in Java-Bali System',
            'profil.role2_title': 'Operational & Environmental Commitment',
            'profil.capacity_title': 'Capacity & Location',
            'profil.capacity_desc': 'Technical details and location of UP Indramayu PLTU.',
            'profil.contribution_title': 'Role & Contribution',
            'profil.contribution_desc': 'UP Indramayu not only serves as a power plant, but is also committed to providing positive impact for the environment and community.',
            'profil.contrib1_title': 'Power Generation',
            'profil.contrib2_title': 'Environmental Management',
            'profil.contrib3_title': 'Safety & OHS',
            'profil.contrib4_title': 'CSR & Community Empowerment',
            'profil.timeline_title': 'Generation Unit Journey',
            'profil.timeline_desc': 'The contribution trail of UP Indramayu in electricity supply and commitment to sustainable operations and environment.',
            'profil.cta_title': 'Providing Energy for Indonesia',

            /* ---------- STRUKTUR ORGANISASI PAGE ---------- */
            'struktur.bc_home': 'Home',
            'struktur.bc_about': 'About Us',
            'struktur.bc_current': 'Organizational Structure',
            'struktur.title': 'Organizational Structure Chart',
            'struktur.subtitle': 'UP Indramayu',
            'struktur.fallback': 'UP Indramayu Organizational Structure Chart',

            /* ---------- BERITA PAGE ---------- */
            'berita.bc_home': 'Home',
            'berita.bc_info': 'Information',
            'berita.bc_current': 'News',
            'berita.title': 'Latest News & <span class="accent">Information</span>',
            'berita.subtitle': 'Follow the latest updates on operations, work programs, and activities of PT PLN Nusantara Power UP PLTU Indramayu.',
            'berita.section_title': 'Latest News & Information',

            /* ---------- GALERI PAGE ---------- */
            'galeri.bc_home': 'Home',
            'galeri.bc_info': 'Information',
            'galeri.bc_current': 'Gallery',
            'galeri.title': 'Gallery & Operational <span class="accent">Documentation</span>',
            'galeri.subtitle': 'Collection of photos and documentation of operational activities, maintenance, and K3 & environmental programs at PT PLN Nusantara Power UP PLTU Indramayu.',
            'galeri.filter_all': 'All',
            'galeri.filter_operational': 'PLTU Operations',
            'galeri.filter_maintenance': 'Maintenance',
            'galeri.filter_k3': 'K3 & Environment',
            'galeri.filter_social': 'Social Activities',
            'galeri.filter_kegiatan': 'Activities',
            'galeri.filter_fasilitas': 'Facilities',
            'galeri.filter_dokumentasi': 'Documentation',
            'galeri.filter_seremonial': 'Ceremonial',
            'galeri.empty': 'No photos in this category yet.',
            'galeri.count': '{n} photos shown',

            /* ---------- GUEST REGISTRATION FORM ---------- */
            'form.title': 'Guest Registration Form',
            'form.subtitle': 'Please complete your details to register your visit.',
            'form.section_identity': 'Personal Data',
            'form.section_documents': 'Documents',
            'form.section_visit': 'Visit Details',
            'form.label_nik': 'ID Number (NIK)',
            'form.label_nama': 'Full Name',
            'form.label_instansi': 'Company / Institution',
            'form.label_nohp': 'WhatsApp / Phone Number',
            'form.label_email': 'Email',
            'form.label_tujuan': 'Bidang to Meet',
            'form.label_jabatan': 'Position to Meet',
            'form.label_orang': 'Person to Meet',
            'form.ph_jabatan': 'Position of the person to meet',
            'form.ph_orang': 'Name of the person to meet',
            'form.label_tanggal': 'Visit Date',
            'form.label_tanggal_jam': 'Visit Date & Time',
            'form.ph_tanggal_jam': 'dd/mm/yyyy --:--',
            'form.label_jam': 'Visit Time',
            'form.label_jumlah': 'Number of Guests',
            'form.label_keperluan': 'Purpose of Visit',
            'form.ph_nik': 'Enter your 16-digit NIK',
            'form.ph_nama': 'Name as on ID card',
            'form.ph_instansi': 'Your institution name',
            'form.ph_nohp': '08xxxxxxxxxx',
            'form.ph_email': 'name@email.com',
            'form.ph_tujuan': 'Person / division to meet',
            'form.ph_keperluan': 'Briefly describe the purpose of your visit...',
            'form.doc_dokumen': 'Supporting Document',
            'form.doc_dokumen_hint': 'ZIP, RAR, PDF, JPG, JPEG, or PNG — max 10MB',
            'form.dz_title': 'Click to choose a file',
            'form.dz_hint': 'or drag & drop it here — up to 10MB',
            'form.btn_hapus': 'Remove',
            'form.btn_ganti': 'Replace',
            'form.btn_submit': 'Register Now',
            'form.btn_note': 'Required fields. Your data is safe & used only for registration.',
            'form.footnote': 'Your data is stored securely and used only for visit registration purposes.',
            'form.error_heading': 'Please review the following fields:',
            'form.success_title': 'Your Data Has Been Sent!',
            'form.success_text': 'Awaiting admin confirmation.<br>Please check your email / WhatsApp for further information.',
            'form.btn_done': 'Done',

            /* ---------- SERVICE INFORMATION (SPL) ---------- */
            'spl.bc_home': 'Home',
            'spl.bc_current': 'Service Information',
            'spl.title': 'Service Standard <span class="accent">Information</span>',
            'spl.subtitle': 'Official guidelines, document requirements, time standards, and public service procedures of PT PLN Nusantara Power UP PLTU Indramayu.',
            'spl.card_title': 'Service Standards &amp; Procedures',
            'spl.card_subtitle': 'Guide center, SOPs, and public service standard transparency',
            'spl.tab_maklumat': 'Service Declaration',
            'spl.tab_prosedur': 'Requirements &amp; Service Procedures',
            'spl.tab_estimasi': 'Time &amp; Cost Estimate',
            'spl.tab_dokumen': 'Download Documents &amp; SOPs',
            'spl.maklumat_title': 'Public Service Declaration',
            'spl.maklumat_badge': 'Established &amp; Signed by Management',
            'spl.maklumat_quote': '&ldquo;We are committed to providing transparent, accountable, fast, and citizen-oriented public services in accordance with the laws and regulations on Public Services.&rdquo;',
            'spl.commit1': 'Services are delivered in an orderly manner, on time, and according to standards.',
            'spl.commit2': 'Service fees follow the applicable regulations &mdash; no charges beyond those provisions.',
            'spl.commit3': 'Service information is provided openly and is easy to access.',
            'spl.commit4': 'Every complaint is followed up quickly and proportionally.',
            'spl.sign_org': 'Management of PT PLN Nusantara Power UP PLTU Indramayu',
            'spl.sign_role': 'General Manager &mdash; UP PLTU Indramayu',
            'spl.sign_note': 'Verified &mdash; Public Transparency',
            'spl.acc1_title': 'Service Standard for FABA Utilization (Fly Ash &amp; Bottom Ash)',
            'spl.acc2_title': 'Service Standard for Industrial / Educational Visits',
            'spl.acc3_title': 'Service Standard for CSR / TJSL Proposals',
            'spl.req_label': 'Requirements',
            'spl.flow_label': 'Procedure Flow',
            'spl.acc1_req1': 'Official request letter from the institution/company',
            'spl.acc1_req2': 'Business legality documents (NIB, deed, or equivalent)',
            'spl.acc1_req3': 'Profile of the planned FABA material utilization',
            'spl.acc2_req1': 'Official letter from the campus/school (at least 14 days before the visit)',
            'spl.acc2_req2': 'List of visit participants',
            'spl.acc2_req3': 'Vaccination certificate / required OHS documents',
            'spl.acc3_req1': 'Community empowerment program proposal',
            'spl.acc3_req2': 'Profile of the proposing institution/community',
            'spl.acc3_req3': 'Planned location &amp; beneficiary targets',
            'spl.step_proposal': 'Proposal Submission',
            'spl.step_verifikasi': 'Technical Verification',
            'spl.step_mou': 'MoU Signing',
            'spl.step_ambil': 'Material Collection',
            'spl.step_surat': 'Letter Submission',
            'spl.step_jadwal': 'Schedule Confirmation by Public Relations',
            'spl.step_safety': 'Safety Induction',
            'spl.step_field': 'Field Visit',
            'spl.step_kajian': 'Program Review &amp; Selection',
            'spl.step_keputusan': 'Management Decision',
            'spl.step_pelaksanaan': 'Program Implementation',
            'spl.th_service': 'Service Type',
            'spl.th_time': 'Estimated Processing Time',
            'spl.th_cost': 'Cost / Fee',
            'spl.th_output': 'Service Output',
            'spl.row1_service': 'FABA Request',
            'spl.row1_time': '3 &ndash; 5 Working Days',
            'spl.row1_output': 'Utilization Permit Letter',
            'spl.row2_service': 'Visit Request',
            'spl.row2_time': '2 &ndash; 4 Working Days',
            'spl.row2_output': 'Confirmation Letter &amp; Schedule',
            'spl.row3_service': 'CSR/TJSL Proposal',
            'spl.row3_time': '7 &ndash; 14 Working Days',
            'spl.row3_output': 'Disposition Sheet &amp; Realization',
            'spl.free': 'Rp 0 (Free)',
            'spl.table_note': 'Processing time is counted from the moment the application file is declared administratively complete. All services above are <strong>free of charge</strong> in line with public service standards.',
            'spl.dl1_title': 'UP Indramayu Public Service Standard Book',
            'spl.dl1_meta': 'PDF &middot; Official service standard document',
            'spl.dl2_title': 'Industrial Visit Request Form',
            'spl.dl2_meta': 'PDF &middot; Visit request form',
            'spl.dl3_title': 'SOP for FABA Utilization Partnership',
            'spl.dl3_meta': 'PDF &middot; Partnership operational procedure',
            'spl.contact_title': 'Need further assistance?',
            'spl.contact_text': 'Please submit your questions through the official PPID channels of PT PLN Nusantara Power.',

            /* ---------- FAQ ---------- */
            'faq.title': 'Frequently <span class="accent">Asked Questions</span> (FAQ)',
            'faq.subtitle': 'Find quick information and answers about operations, electricity services, and sustainability programs of PT PLN Nusantara Power UP PLTU Indramayu.',
            'faq.search_ph': 'Search questions… (e.g. industrial visit, FABA)',
            'faq.search_aria': 'Search questions',
            'faq.clear_aria': 'Clear search',
            'faq.card_title': 'Browse by Category',
            'faq.card_subtitle': 'Choose a category or type a keyword to find answers quickly',
            'faq.filter_all': 'All',
            'faq.filter_operasional': 'Operations &amp; Generation',
            'faq.filter_layanan': 'Services &amp; Partnerships',
            'faq.filter_k3l': 'Safety &amp; Environment (OHS)',
            'faq.filter_karir': 'Careers &amp; General',
            'faq.count': 'Showing {n} of {total} questions',
            'faq.q1': 'What is the main role of PLTU Indramayu in the national electricity system?',
            'faq.a1': 'PLTU UP Indramayu operates 3 generation units with a total capacity of 3&nbsp;x&nbsp;330&nbsp;MW (990&nbsp;MW), which serve as an important baseload pillar in the Java-Madura-Bali (Jamali) interconnection system.',
            'faq.q2': 'How is PLN Nusantara Power UP PLTU Indramayu committed to the environment?',
            'faq.a2': 'We apply modern emission management technology, sustainable FABA (Fly Ash &amp; Bottom Ash) utilization, a biomass co-firing program, and regular monitoring of air quality and the surrounding environment.',
            'faq.q3': 'Can the public submit a visit or educational request to PLTU Indramayu?',
            'faq.a3': 'Yes, industrial or educational visit requests can be submitted officially through the Contact or Public Relations channel of PT PLN Nusantara Power UP Indramayu, attaching an official letter from your institution/campus.',
            'faq.q4': 'Where can I see the official list of public services from PLTU Indramayu?',
            'faq.a4': 'The public service list is available directly through the &ldquo;Services&rdquo; menu in the main navigation bar of this website.',
            'faq.q5': 'Why must visitors fill in the guest registration form before entering?',
            'faq.a5': 'The guest registration form is used to record identities, maintain security and OHS standards (Occupational Safety, Health and Environment) in a national vital object area, and ensure the official/division you are visiting is ready to receive you.',
            'faq.q6': 'Which documents must be prepared when filling in the guest registration form?',
            'faq.a6': 'You need to prepare your ID (KTP/NIK) number, personal details (name, institution, WhatsApp number), and upload a clear photo/scan of your original ID (JPG/PNG, max. 2MB).',
            'faq.q7': 'What should I do after successfully submitting the guest registration form?',
            'faq.a7': 'Upon arrival, please show your registration proof or state your name to the security officer or receptionist at the Main Lobby for confirmation and to collect your Visitor Badge / Guest Pass.',
            'faq.q8': 'How do I apply for an internship or practical work at PLTU Indramayu?',
            'faq.a8': 'Internship applications are submitted through an official letter from your campus or institution addressed to PT PLN Nusantara Power UP PLTU Indramayu, including participant data, duration, and the desired supervision field.',
            'faq.q9': 'How can I get official information about the activities and programs of UP PLTU Indramayu?',
            'faq.a9': 'Official information is available through the News and Announcements menu on this website, as well as the official social media channels of PT PLN Nusantara Power.',
            'faq.empty_title': 'No Results Found',
            'faq.empty_text': 'Try another keyword or view all questions.',
            'faq.empty_reset': 'Reset Search',
            'faq.contact_title': 'Still cannot find the answer you are looking for?',

            /* ---------- NEWS / ANNOUNCEMENTS (LIST + DETAIL) ---------- */
            'berita.read_more': 'Read more',
            'berita.empty_title': 'No news yet',
            'berita.empty_text': 'News will be available soon. Please check back later.',
            'berita.pagination_aria': 'News pagination',
            'berita.related_title': 'Related News',
            'png.bc_current': 'Announcements',
            'png.title': 'Official <span class="accent">Announcements</span> &amp; Notices',
            'png.subtitle': 'Official information on operations, policies, recruitment, and public services of PT PLN Nusantara Power UP PLTU Indramayu.',
            'png.filter_all': 'All',
            'png.filter_umum': 'General',
            'png.filter_teknis': 'Technical',
            'png.filter_kepegawaian': 'Personnel',
            'png.filter_keuangan': 'Finance',
            'png.filter_layanan': 'Services',
            'png.view_detail': 'View Detail',
            'png.empty_title': 'No announcements yet',
            'png.empty_text': 'Official announcements will be displayed on this page.',
            'png.pagination_aria': 'Announcement pagination',
            'png.detail_badge': 'Official Announcement',
            'png.back_link': 'Back to Announcement List',
            'png.info_title': 'Information',
            'png.info_text_1': 'This announcement was published by PT PLN Nusantara Power UP PLTU Indramayu on',
            'png.info_text_2': 'For further questions, please contact the PPID office.',
            'png.related_title': 'Related Announcements',

            /* ---------- SHORT MONTH NAMES ---------- */
            'month.1': 'Jan', 'month.2': 'Feb', 'month.3': 'Mar', 'month.4': 'Apr',
            'month.5': 'May', 'month.6': 'Jun', 'month.7': 'Jul', 'month.8': 'Aug',
            'month.9': 'Sep', 'month.10': 'Oct', 'month.11': 'Nov', 'month.12': 'Dec',

            /* ---------- COMPANY PROFILE (CONTINUED) ---------- */
            'profil.role1_desc_1': 'As one of the generation units of <strong class="highlight">PLN Nusantara Power</strong>, UP Indramayu plays a strategic role in supporting <strong>reliable electricity supply</strong>, particularly in the <strong>Java-Bali</strong> power system.',
            'profil.role1_desc_2': 'With its large generation capacity, UP Indramayu contributes to meeting the <strong>public demand for electricity</strong> while supporting economic activity and national development.',
            'profil.role2_desc': 'Beyond its generation function, UP Indramayu strives to create a positive impact on the environment and surrounding communities through:',
            'profil.role2_li1': '<strong class="highlight">Responsible environmental management</strong>',
            'profil.role2_li2': 'Improved <strong>operational efficiency</strong> of the plant',
            'profil.role2_li3': 'Commitment to <strong>Occupational Safety &amp; Health (OHS)</strong>',
            'profil.role2_li4': '<strong>Social responsibility &amp; community empowerment</strong> programs',
            'profil.contrib1_desc': 'Operating a coal-fired power plant with a capacity of 990 MW (3 units x 330 MW) to meet the electricity demand of the Java-Bali system.',
            'profil.contrib2_desc': 'Implementation of responsible environmental management as part of the commitment to sustainable operations.',
            'profil.contrib3_desc': 'A top priority in plant operations &mdash; maintaining safety, occupational health, and optimal operational efficiency.',
            'profil.contrib4_desc': 'Various social responsibility and community empowerment programs for the surrounding area to create a positive impact on the local community.',
            'profil.tl1_year': 'Unit Establishment',
            'profil.tl1_title': 'Establishment of PLN UP Indramayu',
            'profil.tl1_desc': 'The generation unit was established as part of PT PLN Nusantara Power, engaged in electricity supply through the operation of a PLTU.',
            'profil.tl2_year': 'Early Operation',
            'profil.tl2_title': 'Coal-Fired PLTU Operation',
            'profil.tl2_desc': 'The plant began operating with coal as its primary fuel, with an installed capacity of 990 MW (3 units x 330 MW) in Sumuradem, Indramayu.',
            'profil.tl3_year': 'Development',
            'profil.tl3_title': 'Supporting Java-Bali system reliability',
            'profil.tl3_desc': 'UP Indramayu contributes to meeting public electricity demand while supporting economic activity and development through a reliable power supply.',
            'profil.tl4_year': 'Sustainability Focus',
            'profil.tl4_title': 'Environmental Management &amp; CSR',
            'profil.tl4_desc': 'The unit continues to create positive impacts on the environment and community through environmental management, operational efficiency, OHS, and social responsibility programs.',
            'profil.cta_desc': 'PLN Nusantara Power Generation Unit Indramayu is committed to being a reliable, professional, and responsible generation unit &mdash; supporting the electricity needs of the Java-Bali system while prioritizing safety, environment, and sustainability.',
            'profil.cta_btn': 'View Our History',

            /* ---------- GALLERY (CONTINUED) ---------- */
            'galeri.empty_desc': 'Photo documentation will be added soon. Please check back later.',
            'galeri.filter_empty_desc': 'Try another category to see the available documentation.',
            'galeri.show_all': 'Show All Photos',

            /* ---------- REGISTRATION FORM (CONTINUED) ---------- */
            'form.opt_pilih_pengguna': '— Select User —',
            'form.hint_orang': 'The name list follows the Position selected above — only active employees at Assistant Manager, Junior, and Staff levels. Type to search, or click to select from the list.',
            'form.hint_tanggal': 'Earliest is today — past dates, weekends (Saturday/Sunday, unless opened by an admin), public holidays &amp; red-letter days cannot be selected.',
            'form.holiday_warning': 'This date is a public holiday. Please choose another date.',
            'form.msg_holiday': 'The date {date} is a public holiday and cannot be selected for a visit.',
            'form.msg_weekend': 'The date {date} falls on {day} (weekend) — visits can only be scheduled on working days.',

            /* ---------- CALENDAR (DATE PICKER) ---------- */
            'cal.today': 'Today',
            'cal.clear': 'Clear',
            'cal.pick_date': 'Select date',
            'cal.prev_month': 'Previous month',
            'cal.next_month': 'Next month',
            'cal.pick_month': 'Select month',
            'cal.month_list': 'Month list',
            'cal.pick_year': 'Select year',
            'cal.year_list': 'Year list',
            'cal.holiday': 'Public holiday / red-letter day',
            'cal.holiday_note': 'Public holiday',
            'cal.weekend': 'Weekend — visits are only available on working days.',
            'cal.past': 'The date has already passed.',
            'cal.out_of_range': 'Outside the allowed date range.',
            'cal.special_workday': 'Special working day (weekend override) — selectable.',
            'day.sunday': 'Sunday',
            'day.saturday': 'Saturday',
            'day.0': 'Sun', 'day.1': 'Mon', 'day.2': 'Tue', 'day.3': 'Wed',
            'day.4': 'Thu', 'day.5': 'Fri', 'day.6': 'Sat',
            'form.aria_tanggal': 'visit date',
            'form.title_tanggal': 'Click to choose the visit date',
            'month.long.1': 'January', 'month.long.2': 'February', 'month.long.3': 'March',
            'month.long.4': 'April', 'month.long.5': 'May', 'month.long.6': 'June',
            'month.long.7': 'July', 'month.long.8': 'August', 'month.long.9': 'September',
            'month.long.10': 'October', 'month.long.11': 'November', 'month.long.12': 'December'
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

    /* Waktu relatif sesuai bahasa — "2 hari yang lalu" / "2 days ago".
       Memakai Intl.RelativeTimeFormat agar tidak perlu tabel manual. */
    function formatRelativeTime(timestampSec, lang) {
        const diffSec = Math.round(timestampSec - Date.now() / 1000);
        const abs = Math.abs(diffSec);
        const units = [
            ['year', 31536000],
            ['month', 2592000],
            ['day', 86400],
            ['hour', 3600],
            ['minute', 60]
        ];

        try {
            const rtf = new Intl.RelativeTimeFormat(lang === 'en' ? 'en' : 'id', { numeric: 'auto' });
            for (let i = 0; i < units.length; i++) {
                const [unit, seconds] = units[i];
                if (abs >= seconds) {
                    return rtf.format(Math.round(diffSec / seconds), unit);
                }
            }
            return rtf.format(diffSec, 'second');
        } catch (e) {
            return '';
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

        /* Placeholder input/textarea (key di data-i18n-placeholder) */
        document.querySelectorAll('[data-i18n-placeholder]').forEach(function (el) {
            const key = el.getAttribute('data-i18n-placeholder');
            const text = getTranslation(lang, key);
            if (text !== null) {
                el.setAttribute('placeholder', text);
            }
        });

        /* aria-label (key di data-i18n-aria-label) — aksesibilitas */
        document.querySelectorAll('[data-i18n-aria-label]').forEach(function (el) {
            const key = el.getAttribute('data-i18n-aria-label');
            const text = getTranslation(lang, key);
            if (text !== null) {
                el.setAttribute('aria-label', text);
            }
        });

        /* Atribut title / tooltip (key di data-i18n-title) */
        document.querySelectorAll('[data-i18n-title]').forEach(function (el) {
            const key = el.getAttribute('data-i18n-title');
            const text = getTranslation(lang, key);
            if (text !== null) {
                el.setAttribute('title', text);
            }
        });

        /* Nama bulan singkat pada kartu tanggal (data-month-short="1..12") */
        document.querySelectorAll('[data-month-short]').forEach(function (el) {
            const num = parseInt(el.getAttribute('data-month-short'), 10);
            const text = getTranslation(lang, 'month.' + num);
            if (text !== null) {
                el.textContent = text;
            }
        });

        /* Waktu relatif (mis. "2 hari yang lalu") mengikuti bahasa aktif. */
        document.querySelectorAll('[data-rel-time]').forEach(function (el) {
            const ts = parseInt(el.getAttribute('data-rel-time'), 10);
            if (!isNaN(ts)) {
                el.textContent = formatRelativeTime(ts, lang);
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

        /* Beri tahu skrip halaman (mis. penghitung FAQ/galeri) agar teks yang
           dibuat lewat JavaScript ikut diperbarui. */
        try {
            document.dispatchEvent(new CustomEvent('pln:languagechange', { detail: { lang: lang } }));
        } catch (e) {
            /* browser lama tanpa CustomEvent — abaikan */
        }
    }

    /* Terjemahan untuk teks yang dibuat JavaScript (bukan atribut data-i18n).
       Tag HTML dibuang karena biasanya dipakai untuk textContent. */
    function translate(key, fallback) {
        const text = getTranslation(getSavedLanguage(), key);
        if (text === null) {
            return fallback !== undefined ? fallback : key;
        }
        return text.replace(/<[^>]*>/g, '');
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

        /* Tutup semua dropdown Bootstrap yang sedang terbuka.
           Gunakan API resmi Bootstrap (bukan menghapus class .show manual)
           agar aria-expanded, state internal & Popper ikut dibersihkan. */
        function closeBootstrapDropdowns() {
            document.querySelectorAll('.navbar-pln .dropdown-toggle[aria-expanded="true"]').forEach(function (ddToggle) {
                if (window.bootstrap && window.bootstrap.Dropdown) {
                    window.bootstrap.Dropdown.getOrCreateInstance(ddToggle).hide();
                } else {
                    ddToggle.parentElement?.classList.remove('show');
                    ddToggle.nextElementSibling?.classList.remove('show');
                    ddToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        /* Buka/tutup saat ikon globe diklik.
           PENTING: event TIDAK di-stopPropagation() agar tetap sampai ke
           listener "clearMenus" milik Bootstrap di document — sehingga
           dropdown Bootstrap lain (mis. Kontak) otomatis tertutup saat
           language switcher diklik. */
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const isOpening = !switcher.classList.contains('open');
            /* Aturan 1 dropdown aktif: saat membuka globe, tutup dropdown lain */
            if (isOpening) {
                closeBootstrapDropdowns();
            }
            switcher.classList.toggle('open');
            toggle.setAttribute('aria-expanded', switcher.classList.contains('open') ? 'true' : 'false');
        });

        /* Tutup jika mengklik di luar menu */
        document.addEventListener('click', function (e) {
            if (!switcher.contains(e.target)) {
                switcher.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });

        /* Tutup language switcher saat dropdown Bootstrap dibuka.
           Pakai event "show.bs.dropdown" (bubble dari elemen toggle)
           agar tetap berlaku untuk dropdown yang ditambahkan belakangan. */
        document.addEventListener('show.bs.dropdown', function () {
            switcher.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
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
        if (window.feather) {
            try { feather.replace(); } catch (e) { /* script defer belum siap */ }
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
        /* feather-icons dimuat dengan defer: saat i18n.js (non-defer) jalan,
           window.feather belum tentu ada. Coba lagi setelah semua defer selesai. */
        window.addEventListener('load', initFeatherIcons);
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
        getLanguage: getSavedLanguage,
        /* t('kunci', 'fallback') — untuk teks yang dirakit lewat JavaScript. */
        t: translate
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
