<?php

namespace App\Services;

/**
 * Sumber data statis Portal Karyawan (view-only):
 *
 * - internalServices(): layanan internal perusahaan (panduan/prosedur).
 * - workLinks():        10 tautan alat kerja — 5 akses umum + 5 per bidang.
 * - workLinksFor(user): memfilter link sesuai Hirarki Organisasi user
 *   (level jabatan / bidang / sub-bidang dari form Pengguna).
 *
 * Sengaja tidak memakai tabel database agar modul ini ringan dan
 * murni read-only; menambah/mengubah item cukup edit array di sini.
 */
class PortalContentService
{
    /**
     * Daftar filter link kerja (value → label) untuk dropdown/tab filter.
     *
     * @return array<string, string>
     */
    public static function linkFilters(): array
    {
        return [
            'all'         => 'Semua Link',
            'umum'        => 'Akses Umum',
            'operasi'     => 'Bidang Operasi',
            'pemeliharaan'=> 'Bidang Pemeliharaan',
            'keuangan'    => 'Keuangan & Adm',
            'k3'          => 'Bidang K3',
        ];
    }

    /**
     * Filter link kerja SESUAI Hirarki Organisasi user yang login.
     *
     * Aturan akses:
     * - Administrator / Senior Manager → semua link (global).
     * - Manager Bidang → link bidang miliknya + link 'umum' (Akses Umum).
     * - Supervisor / Asisten Manager / Staf → HANYA link sub-bidangnya
     *   (department:subDepartment) + link 'umum' (Akses Umum).
     * - Tanpa data hierarki (akun lama) → hanya link umum.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function workLinksFor(?\App\Models\User $user): array
    {
        $links = self::workLinks();

        if ($user === null) {
            return array_values(array_filter($links, fn ($l) => $l['category'] === 'umum'));
        }

        // Administrator & Senior Manager: akses global — semua link.
        if ($user->role === 'Administrator' || \App\Models\User::isGlobalLevel($user->level_jabatan)) {
            return $links;
        }

        $department     = $user->department;
        $subDepartment  = $user->sub_department;

        // Manager Bidang: semua link bidang miliknya + link umum.
        if ($user->level_jabatan === 'manager_bidang') {
            if ($department === null) {
                return array_values(array_filter($links, fn ($l) => $l['category'] === 'umum'));
            }

            return array_values(array_filter($links, fn ($l) =>
                $l['category'] === 'umum' || ($l['department'] ?? null) === $department
            ));
}

        // Staf / Asisten Manager / Supervisor: terkunci pada sub-bidangnya +
        // link umum. Link bidang tanpa pemilik spesifik (mis. SCADA untuk
        // seluruh Bidang Operasi) tetap tampil; bidang lain disembunyikan.
        if ($user->level_jabatan === 'staf_spv') {
            if ($department === null) {
                return array_values(array_filter($links, fn ($l) => $l['category'] === 'umum'));
            }

            return array_values(array_filter($links, fn ($l) =>
                $l['category'] === 'umum'
                || (($l['department'] ?? null) === $department && ($l['sub_department'] ?? null) === null)
                || (($l['department'] ?? null) === $department && ($l['sub_department'] ?? null) === $subDepartment)
            ));
        }

        // Level belum diisi / akun lama: hanya link umum.
        return array_values(array_filter($links, fn ($l) => $l['category'] === 'umum'));
    }

    /**
     * Level akses link user untuk UI filter halaman Link Kerja.
     *
     * @return array{scope: string, mode: string, subKeys: array<int, string>, activeKey: ?string}
     *         scope     → 'all' | 'department' | 'sub'
     *         mode      → 'tabs' (bisa berpindah) | 'locked' (terkunci)
     *         subKeys   → daftar kode sub-bidang yang bisa diakses (untuk tabs)
     *         activeKey → sub-bidang aktif user ('staf_spv'); null jika tidak relevan
     */
    public static function linkAccessFor(?\App\Models\User $user): array
    {
        if ($user === null) {
            return ['scope' => 'umum', 'mode' => 'locked', 'subKeys' => [], 'activeKey' => null];
        }

        // Administrator & Senior Manager: global, tab bebas (semua bidang).
        if ($user->role === 'Administrator' || \App\Models\User::isGlobalLevel($user->level_jabatan)) {
            return ['scope' => 'all', 'mode' => 'tabs', 'subKeys' => [], 'activeKey' => null];
        }

        // Manager Bidang: tab penuh dalam bidangnya (Semua + per sub-bidang).
        if ($user->level_jabatan === 'manager_bidang') {
            return [
                'scope'     => 'department',
                'mode'      => 'tabs',
                'subKeys'   => array_keys(\App\Models\User::SUB_DEPARTMENTS[$user->department] ?? []),
                'activeKey' => null,
            ];
        }

        // Staf / Asisten Manager / Supervisor: terkunci di sub-bidang sendiri.
        if ($user->level_jabatan === 'staf_spv' && $user->department && $user->sub_department) {
            return [
                'scope'     => 'sub',
                'mode'      => 'locked',
                'subKeys'   => [$user->sub_department],
                'activeKey' => $user->sub_department,
            ];
        }

        return ['scope' => 'umum', 'mode' => 'locked', 'subKeys' => [], 'activeKey' => null];
    }

    /**
     * Opsi filter link yang BOLEH dilihat user (label per value) —
     * untuk dropdown & tab di halaman Link Kerja.
     *
     * @return array<string, string>
     */
    public static function linkFiltersFor(?\App\Models\User $user): array
    {
        $access = self::linkAccessFor($user);

        // Administrator / Senior Manager → filter lengkap (semua bidang).
        if ($access['scope'] === 'all') {
            return self::linkFilters();
        }

        // Staf/Asmen/Spv (terkunci) atau scope terbatas → tab miliknya saja + umum.
        $filters = ['umum' => 'Akses Umum'];

        if ($access['scope'] === 'department' && $user->department) {
            // Manager Bidang: satu tab per sub-bidang bidangnya + "Semua Sub-Bidang".
            $subs    = \App\Models\User::SUB_DEPARTMENTS[$user->department] ?? [];
            $filters = ['all' => 'Semua ' . (\App\Models\User::DEPARTMENTS[$user->department] ?? 'Bidang')]
                + ($subs !== []
                    ? array_combine(
                        array_map(fn ($k) => $user->department . ':' . $k, array_keys($subs)),
                        array_values($subs)
                    )
                    : []);
        } elseif ($access['scope'] === 'sub') {
            // Staf/Asmen/Spv: tab tunggal sub-bidang sendiri (terkunci).
            $label = \App\Models\User::subDepartmentLabel($user->department, $user->sub_department)
                ?? 'Sub-Bidang Saya';
            $filters += [$user->department . ':' . $user->sub_department => $label];
        }

        return $filters;
    }

    /**
     * 10 tautan alat kerja: 5 akses umum + 5 per bidang/divisi.
     *
     * @return array<int, array{id: string, name: string, url: string, category: string, icon: string, color: string, description: string}>
     */
    public static function workLinks(): array
    {
        return [
            // ===== 5 LINK AKSES UMUM (semua bidang) =====
            [
                'id'          => 'email-pln',
                'name'        => 'Web Email PLN',
                'url'         => 'https://mail.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-envelope',
                'color'       => '#008fa8',
                'description' => 'Email resmi korporat PLN untuk komunikasi internal dan eksternal.',
            ],
            [
                'id'          => 'portal-sdm',
                'name'        => 'Portal SDM',
                'url'         => 'https://sdm.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-users',
                'color'       => '#007790',
                'description' => 'Data kepegawaian, slip gaji, cuti, dan layanan kehumanian lainnya.',
            ],
            [
                'id'          => 'e-office',
                'name'        => 'E-Office',
                'url'         => 'https://eoffice.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-file-lines',
                'color'       => '#0097b8',
                'description' => 'Surat menyurat digital, disposisi, dan arsip dokumen persuratan.',
            ],
            [
                'id'          => 'presensi',
                'name'        => 'Presensi Online',
                'url'         => 'https://presensi.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-fingerprint',
                'color'       => '#00566b',
                'description' => 'Absensi kerja harian dan rekap kehadiran karyawan.',
            ],
            [
                'id'          => 'portal-k2',
                'name'        => 'Portal K2',
                'url'         => 'https://k2.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-newspaper',
                'color'       => '#003d4d',
                'description' => 'Portal berita dan informasi internal PT PLN (Persero).',
            ],

            // ===== 5 LINK PER BIDANG =====
            [
                'id'             => 'scada',
                'name'           => 'SCADA Monitoring',
                'url'            => 'https://scada.pln-np.co.id',
                'category'       => 'operasi',
                'department'     => 'operasi',
                'sub_department' => null,
                'icon'           => 'fa-gauge-high',
                'color'          => '#00b0c8',
                'description'    => 'Pemantauan real-time parameter operasi unit dan jaringan pembangkit.',
            ],
            [
                'id'             => 'cmms',
                'name'           => 'CMMS Pemeliharaan',
                'url'            => 'https://cmms.pln-np.co.id',
                'category'       => 'pemeliharaan',
                'department'     => 'pemeliharaan',
                'sub_department' => null,
                'icon'           => 'fa-screwdriver-wrench',
                'color'          => '#00566b',
                'description'    => 'Work order, jadwal overhauls, dan riwayat pemeliharaan peralatan.',
            ],
            [
                'id'             => 'sirwit',
                'name'           => 'SI-FIN Keuangan',
                'url'            => 'https://sifin.pln-np.co.id',
                'category'       => 'keuangan',
                'department'     => 'business_support',
                'sub_department' => null,
                'icon'           => 'fa-coins',
                'color'          => '#007790',
                'description'    => 'Pengajuan anggaran, verifikasi invoice, dan laporan keuangan unit.',
            ],
            [
                'id'             => 'e-k3',
                'name'           => 'E-K3 Safety',
                'url'            => 'https://ek3.pln-np.co.id',
                'category'       => 'k3',
                'department'     => 'k3_kam',
                'sub_department' => null,
                'icon'           => 'fa-helmet-safety',
                'color'          => '#003d4d',
                'description'    => 'Izin kerja, hazard report, dan pelaporan insiden K3 lingkungan kerja.',
            ],
            [
                'id'             => 'sim-adm',
                'name'           => 'SIM Administrasi',
                'url'            => 'https://simadm.pln-np.co.id',
                'category'       => 'keuangan',
                'department'     => 'business_support',
                'sub_department' => null,
                'icon'           => 'fa-folder-open',
                'color'          => '#0097b8',
                'description'    => 'Kelola aset kantor, inventaris, dan administrasi umum unit kerja.',
            ],
        ];
    }

    /**
     * Layanan internal ter-scope Hirarki Organisasi user (pola workLinksFor).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function internalServicesFor(?\App\Models\User $user): array
    {
        $services = self::internalServices();

        $keep = fn (array $s) => match (true) {
            $user === null => ($s['department'] ?? null) === null,
            // Administrator & Senior Manager: semua layanan.
            $user->role === 'Administrator' || \App\Models\User::isGlobalLevel($user->level_jabatan) => true,
            // Manager Bidang: layanan bidangnya + layanan lintas-bidang (tanpa department).
            $user->level_jabatan === 'manager_bidang' =>
                ($s['department'] ?? null) === null || ($s['department'] ?? null) === $user->department,
            // Staf / Asisten Manager / Supervisor: layanan sub-bidangnya + lintas-bidang.
            $user->level_jabatan === 'staf_spv' && $user->department && $user->sub_department =>
                ($s['department'] ?? null) === null
                || (($s['department'] ?? null) === $user->department && ($s['sub_department'] ?? null) === $user->sub_department),
            // Tanpa data hierarki: hanya layanan lintas-bidang.
            default => ($s['department'] ?? null) === null,
        };

        return array_values(array_filter($services, $keep));
    }

    /**
     * Daftar layanan internal (view-only, panduan/prosedur).
     *
     * @return array<int, array{slug: string, name: string, icon: string, color: string, description: string, steps: array<int, string>, contact: string}>
     */
    public static function internalServices(): array
    {
        return [
            [
                'slug'          => 'pengajuan-cuti',
                'name'          => 'Pengajuan Cuti',
                'icon'          => 'fa-calendar-check',
                'color'         => '#008fa8',
                'department'    => null,
                'sub_department' => null,
                'description'   => 'Prosedur pengajuan cuti tahunan, sakit, dan cuti khusus melalui atasan langsung.',
                'steps'       => [
                    'Isi formulir cuti di Portal SDM atau formulir fisik dari HRD.',
                    'Lampirkan surat dokter (untuk cuti sakit lebih dari 1 hari).',
                    'Ajukan minimal 3 hari kerja sebelum tanggal rencana cuti.',
                    'Menunggu persetujuan atasan langsung di Portal SDM.',
                    'Salinan persetujuan otomatis terkirim ke kepegawaian.',
                ],
                'contact'     => 'kepegawaian@pln-np.co.id',
            ],
            [
                'slug'          => 'layanan-it',
                'name'          => 'Layanan IT',
                'icon'          => 'fa-headset',
                'color'         => '#00b0c8',
                'department'    => null,
                'sub_department' => null,
                'description'   => 'Bantuan teknis: akun, laptop, jaringan, aplikasi kerja, dan reset password.',
                'steps'       => [
                    'Buat tiket melalui Helpdesk IT atau email it-support@pln-np.co.id.',
                    'Jelaskan kendala beserta unit kerja dan nomor aset perangkat.',
                    'Tiket ditindaklanjuti petugas IT maksimal 1x8 jam kerja.',
                    'Perangkat rusak berat diambil alih tim infrastruktur.',
                ],
                'contact'     => 'it-support@pln-np.co.id',
            ],
            [
                'slug'          => 'layanan-fasilitas',
                'name'          => 'Layanan Fasilitas',
                'icon'          => 'fa-building',
                'color'         => '#007790',
                'department'    => null,
                'sub_department' => null,
                'description'   => 'Permintaan ruang rapat, perbaikan fasilitas kantor, dan inventaris.',
                'steps'       => [
                    'Ajukan permohonan via SIM Administrasi (modul Fasilitas).',
                    'Peminjaman ruang rapat minimal 1 hari sebelumnya.',
                    'Verifikasi kecukupan anggaran oleh Kaur Umum.',
                    'Notifikasi persetujuan dikirim ke email pemohon.',
                ],
                'contact'     => 'umum@pln-np.co.id',
            ],
            [
                'slug'          => 'perjalanan-dinas',
                'name'          => 'Perjalanan Dinas',
                'icon'          => 'fa-plane-departure',
                'color'         => '#0097b8',
                'department'    => 'business_support',
                'sub_department' => null,
                'description'   => 'Pengajuan SPD, tiket, dan reimbursable biaya perjalanan dinas.',
                'steps'       => [
                    'Susun rencana perjalanan dan rincian estimasi biaya.',
                    'Ajukan SPPD paling lambat 5 hari kerja sebelum keberangkatan.',
                    'Persetujuan berjenjang: atasan langsung dan GM.',
                    'Rekap realisasi biaya diupload maksimal 7 hari setelah kembali.',
                ],
                'contact'     => 'keuangan@pln-np.co.id',
            ],
            [
                'slug'          => 'klaim-kesehatan',
                'name'          => 'Klaim Kesehatan',
                'icon'          => 'fa-notes-medical',
                'color'         => '#00566b',
                'department'    => null,
                'sub_department' => null,
                'description'   => 'Pengajuan reimbursement biaya pengobatan untuk karyawan dan keluarga.',
                'steps'       => [
                    'Siapkan bukti bayar asli, resep, dan diagnosa dokter.',
                    'Isi formulir klaim di Portal SDM (modul Kesejahteraan).',
                    'Upload dokumen maksimal 30 hari sejak tanggal berobat.',
                    'Klaim disetujui dibayarkan bersama gaji periode berikutnya.',
                ],
                'contact'     => 'kesejahteraan@pln-np.co.id',
            ],
            [
                'slug'          => 'peminjaman-apd',
                'name'          => 'Peminjaman APD',
                'icon'          => 'fa-helmet-safety',
                'color'         => '#003d4d',
                'department'    => 'k3_kam',
                'sub_department' => null,
                'description'   => 'Permintaan Alat Pelindung Diri untuk pekerjaan lapangan dan area risiko.',
                'steps'       => [
                    'Cek ketersediaan stok APD di E-K3 Safety (modul Gudang APD).',
                    'Ajukan permintaan sesuai jenis pekerjaan dan standar K3.',
                    'Verifikasi oleh petugas K3 area masing-masing.',
                    'Serah terima dicatat pada form pengeluaran gudang.',
                ],
                'contact'     => 'k3@pln-np.co.id',
            ],
        ];
    }

    /**
     * Satu layanan internal berdasar slug (null bila tidak ada).
     */
    public static function internalService(string $slug): ?array
    {
        return collect(self::internalServices())->firstWhere('slug', $slug);
    }
}
