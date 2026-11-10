<?php

namespace App\Services;

/**
 * Sumber data Portal Karyawan (view-only):
 *
 * - workLinks():        tautan alat kerja — kini DARI TABEL work_links
 *                       (dikelola via Panel Admin → Manajemen Link Kerja);
 *                       fallback ke array statis bila tabel kosong/belum
 *                       dimigrasi agar portal tetap berfungsi.
 * - workLinksFor(user): memfilter link sesuai Hirarki Organisasi user
 *   (level jabatan / bidang / sub-bidang dari form Pengguna).
 */
class PortalContentService
{
    /**
     * Cache in-request daftar link dari DB — hindari query berulang
     * dalam satu render halaman (dashboard memanggil beberapa method).
     * Disimpan di container sehingga otomatis segar di request/proses
     * berikutnya (FPM, Octane, maupun test).
     */
    protected const WORK_LINKS_CACHE_KEY = 'portal.work_links';

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
     * - Administrator (legacy) / Senior Manager → semua link (global).
     * - Manager Bidang → link bidang miliknya + link 'umum' (Akses Umum).
     * - Asisten Manager / Staf (legacy 'staf_spv') → HANYA link
     *   sub-bidangnya (department:subDepartment) + link 'umum' (Akses Umum).
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
        if ($user->isSuperAdmin() || \App\Models\User::isGlobalLevel($user->level_jabatan)) {
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

        // Asisten Manager / Staf (legacy 'staf_spv'): terkunci pada
        // sub-bidangnya. HANYA 10 link: 5 Link Umum + 5 Link Khusus
        // sub-bidang sendiri. Link level bidang (mis. SCADA untuk seluruh
        // Bidang Operasi) tidak ditampilkan untuk level ini.
        if (\App\Models\User::subDepartmentRequired($user->level_jabatan)) {
            if ($department === null || $subDepartment === null) {
                return array_values(array_filter($links, fn ($l) => $l['category'] === 'umum'));
            }

            return array_values(array_filter($links, fn ($l) =>
                $l['category'] === 'umum'
                || (($l['department'] ?? null) === $department && ($l['sub_department'] ?? null) === $subDepartment)
            ));
        }

        // Level belum diisi / akun lama: hanya link umum.
        return array_values(array_filter($links, fn ($l) => $l['category'] === 'umum'));
    }

    /**
     * Total link alat kerja terdaftar untuk stat card dashboard —
     * sesuai hak akses user yang login:
     *
     * - Administrator / Senior Manager → total akumulasi seluruh link (15).
     * - Manager Bidang                 → link bidangnya (umum + SCADA +
     *                                    khusus semua sub-bidang bidangnya).
     * - Staf / Asmen / Spv             → 5 Link Umum + 5 Link Khusus
     *                                    sub-bidangnya = 10.
     * - Tanpa hierarki                 → 5 Link Umum saja.
     */
    public static function workLinkTotalFor(?\App\Models\User $user): int
    {
        if ($user === null) {
            return count(array_filter(self::workLinks(), fn (array $l) => ($l['category'] ?? '') === 'umum'));
        }

        // Administrator & Senior Manager: akses global — semua link terdaftar.
        if ($user->isSuperAdmin() || \App\Models\User::isGlobalLevel($user->level_jabatan)) {
            return count(self::workLinks());
        }

        return count(self::workLinksFor($user));
    }

    /**
     * Link kerja terurut seimbang untuk halaman utama (dashboard):
     * Link Umum dan Link Khusus Sub-Bidang diselang-seling (a-b-a-b)
     * sehingga keduanya tampil berdampingan sebelum user menekan
     * "Lihat Semua". Link khusus sub-bidang didahulukan di atas link
     * level bidang agar link milik bagian user langsung terlihat.
     */
    public static function workLinksBalancedFor(?\App\Models\User $user): array
    {
        $links = array_values(self::workLinksFor($user));

        $isUmum = fn (array $l) => ($l['category'] ?? '') === 'umum';

        $umum   = array_values(array_filter($links, $isUmum));
        $khusus = array_values(array_filter($links, fn (array $l) => ! $isUmum($l)));

        // Link khusus sub-bidang user didahulukan, lalu link level bidang.
        $subKhusus  = array_values(array_filter($khusus, fn (array $l) => ($l['sub_department'] ?? null) !== null));
        $deptKhusus = array_values(array_filter($khusus, fn (array $l) => ($l['sub_department'] ?? null) === null));
        $khusus     = array_merge($subKhusus, $deptKhusus);

        $mixed = [];

        for ($i = 0, $n = max(count($umum), count($khusus)); $i < $n; $i++) {
            if (isset($umum[$i])) {
                $mixed[] = $umum[$i];
            }

            if (isset($khusus[$i])) {
                $mixed[] = $khusus[$i];
            }
        }

        return $mixed;
    }

    /**
     * Label pendek sub-bidang untuk badge & tab filter:
     * "Asisten Manager Prod A" → "Prod A", "Supervisor CHCB B" → "CHCB B",
     * "Asisten Manager Kimia & Lab" → "Kimia & Lab".
     */
    public static function subDepartmentShortLabel(?string $department, ?string $subDepartment): ?string
    {
        $label = \App\Models\User::subDepartmentLabel($department, $subDepartment);

        if ($label === null) {
            return null;
        }

        return trim((string) preg_replace('/^(Asisten Manager|Supervisor|Manager|Staf)\s+/i', '', $label));
    }

    /**
     * Label badge satu link kerja:
     * - "Umum"    → link akses umum (badge kuning soft).
     * - "Prod A"  → link khusus sub-bidang (label sub-bidang tanpa
     *               prefiks jabatan, badge toska).
     * - "Operasi" → link level bidang (label bidang, badge toska).
     */
    public static function workLinkBadgeLabel(array $link): string
    {
        if (($link['category'] ?? '') === 'umum') {
            return 'Umum';
        }

        $sub = $link['sub_department'] ?? null;

        if ($sub !== null) {
            // "Asisten Manager Prod A" → "Prod A", "Supervisor CHCB B" → "CHCB B".
            return self::subDepartmentShortLabel($link['department'] ?? null, $sub) ?? $sub;
        }

        return \App\Models\User::DEPARTMENTS[$link['department'] ?? ''] ?? ($link['category'] ?? 'Link');
    }

    /**
     * Level akses link user untuk UI filter halaman Link Kerja.
     *
     * @return array{scope: string, mode: string, subKeys: array<int, string>, activeKey: ?string}
     *         scope     → 'all' | 'department' | 'sub'
     *         mode      → 'tabs' (bisa berpindah) | 'locked' (terkunci)
     *         subKeys   → daftar kode sub-bidang yang bisa diakses (untuk tabs)
     *         activeKey → sub-bidang aktif user (level terikat sub); null jika tidak relevan
     */
    public static function linkAccessFor(?\App\Models\User $user): array
    {
        if ($user === null) {
            return ['scope' => 'umum', 'mode' => 'locked', 'subKeys' => [], 'activeKey' => null];
        }

        // Administrator & Senior Manager: global, tab bebas (semua bidang).
        if ($user->isSuperAdmin() || \App\Models\User::isGlobalLevel($user->level_jabatan)) {
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

        // Asisten Manager / Staf (legacy 'staf_spv'): terkunci di sub-bidang sendiri.
        if (\App\Models\User::subDepartmentRequired($user->level_jabatan) && $user->department && $user->sub_department) {
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
     * - Administrator / Senior Manager → "Semua Bidang" + satu filter
     *   per Bidang Utama (global monitoring).
     * - Manager Bidang → "Semua Sub-Bidang" + satu filter per sub-
     *   bidang dalam bidangnya (label pendek, mis. "Prod A").
     * - Staf / Asmen / Spv → TANPA pilihan: terkunci di sub-bidang
     *   sendiri (filter sub-bidang lain disembunyikan).
     *
     * @return array<string, string>
     */
    public static function linkFiltersFor(?\App\Models\User $user): array
    {
        $access = self::linkAccessFor($user);

        // Administrator / Senior Manager: filter Bidang Utama (global).
        if ($access['scope'] === 'all') {
            $filters = ['all' => 'Semua Bidang'];

            foreach (\App\Models\User::DEPARTMENTS as $deptKey => $deptLabel) {
                $filters[$deptKey] = $deptLabel;
            }

            return $filters;
        }

        // Staf/Asmen/Spv (terkunci) atau scope terbatas → tab miliknya saja + umum.
        $filters = ['umum' => 'Akses Umum'];

        if ($access['scope'] === 'department' && $user->department) {
            // Manager Bidang: satu tab per sub-bidang bidangnya + "Semua Sub-Bidang".
            $subs    = \App\Models\User::SUB_DEPARTMENTS[$user->department] ?? [];
            $filters = ['all' => 'Semua Sub-Bidang']
                + ($subs !== []
                    ? array_combine(
                        array_map(fn ($k) => $user->department . ':' . $k, array_keys($subs)),
                        array_map(
                            fn ($k, $label) => self::subDepartmentShortLabel($user->department, $k) ?? $label,
                            array_keys($subs),
                            array_values($subs)
                        )
                    )
                    : []);
        } elseif ($access['scope'] === 'sub') {
            // Staf/Asmen/Spv: tab tunggal sub-bidang sendiri (terkunci).
            $label = self::subDepartmentShortLabel($user->department, $user->sub_department)
                ?? \App\Models\User::subDepartmentLabel($user->department, $user->sub_department)
                ?? 'Sub-Bidang Saya';
            $filters += [$user->department . ':' . $user->sub_department => $label];
        }

        return $filters;
    }

    /**
     * Tautan alat kerja dari tabel work_links (Panel Admin → Manajemen
     * Link Kerja). Hanya link AKTIF; hasil dikonversi ke bentuk array
     * kartu portal lewat WorkLink::toPortalArray().
     *
     * Fallback: bila tabel belum dimigrasi / kosong → array statis.
     *
     * @return array<int, array{id: string, name: string, url: string, category: string, department: ?string, sub_department: ?string, icon: string, color: string, description: string}>
     */
    public static function workLinks(): array
    {
        if (app()->bound(self::WORK_LINKS_CACHE_KEY)) {
            return app(self::WORK_LINKS_CACHE_KEY);
        }

        $links = self::workLinksFromDatabase();

        // Hanya cache bila DB memuat link; bila kosong/belum dimigrasi,
        // tetap fallback statis TANPA cache agar data baru langsung terlihat.
        if ($links !== []) {
            app()->instance(self::WORK_LINKS_CACHE_KEY, $links);

            return $links;
        }

        return self::defaultWorkLinks();
    }

    /**
     * Ambil link aktif dari tabel work_links (null bila tabel belum ada).
     *
     * @return array<int, array<string, mixed>>|null
     */
    protected static function workLinksFromDatabase(): ?array
    {
        try {
            if (! \Illuminate\Support\Facades\Schema::hasTable('work_links')) {
                return null;
            }

            return \App\Models\WorkLink::query()
                ->active()
                ->orderBy('category')
                ->orderBy('title')
                ->get()
                ->map(fn (\App\Models\WorkLink $l) => $l->toPortalArray())
                ->all();
        } catch (\Throwable $e) {
            // DB belum siap (mis. saat migrasi) → fallback statis.
            return null;
        }
    }

    /**
     * Daftar statis awal (fallback): 5 akses umum + 5 level bidang +
     * 5 khusus sub-bidang (Asisten Manager Prod A — Bidang Operasi).
     * Dipakai hanya saat tabel work_links kosong / belum tersedia.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function defaultWorkLinks(): array
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
                'id'          => 'e-learning',
                'name'        => 'E-Learning',
                'url'         => 'https://elearning.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-graduation-cap',
                'color'       => '#003d4d',
                'description' => 'Platform pembelajaran daring, sertifikasi, dan pengembangan kompetensi.',
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

            // ===== 5 LINK KHUSUS SUB-BIDANG (tahap awal: Asisten Manager Prod A) =====
            [
                'id'             => 'dkp-prod-a',
                'name'           => 'Dashboard Kontrol Pembangkit',
                'url'            => 'https://dkp.pln-np.co.id',
                'category'       => 'operasi',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_a',
                'icon'           => 'fa-chart-line',
                'color'          => '#00b0c8',
                'description'    => 'Pemantauan parameter unit, beban, dan performa pembangkit area Prod A.',
            ],
            [
                'id'             => 'logbook-prod-a',
                'name'           => 'Logbook Operator Shift',
                'url'            => 'https://logbook.pln-np.co.id',
                'category'       => 'operasi',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_a',
                'icon'           => 'fa-book-open',
                'color'          => '#007790',
                'description'    => 'Catatan operasi harian operator shift dan serah terima antar regu.',
            ],
            [
                'id'             => 'wo-operasi-prod-a',
                'name'           => 'WO Operasi Unit',
                'url'            => 'https://wo-operasi.pln-np.co.id',
                'category'       => 'operasi',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_a',
                'icon'           => 'fa-list-check',
                'color'          => '#0097b8',
                'description'    => 'Work order operasi harian dan penanganan gangguan unit area Prod A.',
            ],
            [
                'id'             => 'produksi-harian-prod-a',
                'name'           => 'Laporan Produksi Harian',
                'url'            => 'https://produksi.pln-np.co.id',
                'category'       => 'operasi',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_a',
                'icon'           => 'fa-file-export',
                'color'          => '#00566b',
                'description'    => 'Rekap produksi, availability, dan heat rate harian area Prod A.',
            ],
            [
                'id'             => 'spo-prod-a',
                'name'           => 'SPO Operasi Prod A',
                'url'            => 'https://spo.pln-np.co.id',
                'category'       => 'operasi',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_a',
                'icon'           => 'fa-book',
                'color'          => '#008fa8',
                'description'    => 'Standar Prosedur Operasi unit pembangkit dan panduan shift area Prod A.',
            ],
        ];
    }

}
