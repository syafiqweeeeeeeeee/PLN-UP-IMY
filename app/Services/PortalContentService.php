<?php

namespace App\Services;

/**
 * Sumber data statis Portal Karyawan (view-only):
 *
 * - internalServices(): layanan internal perusahaan (panduan/prosedur).
 * - workLinks():        10 tautan alat kerja — 5 akses umum + 5 per bidang.
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
                'color'       => '#00599c',
                'description' => 'Email resmi korporat PLN untuk komunikasi internal dan eksternal.',
            ],
            [
                'id'          => 'portal-sdm',
                'name'        => 'Portal SDM',
                'url'         => 'https://sdm.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-users',
                'color'       => '#00897b',
                'description' => 'Data kepegawaian, slip gaji, cuti, dan layanan kehumanian lainnya.',
            ],
            [
                'id'          => 'e-office',
                'name'        => 'E-Office',
                'url'         => 'https://eoffice.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-file-lines',
                'color'       => '#6d4c41',
                'description' => 'Surat menyurat digital, disposisi, dan arsip dokumen persuratan.',
            ],
            [
                'id'          => 'presensi',
                'name'        => 'Presensi Online',
                'url'         => 'https://presensi.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-fingerprint',
                'color'       => '#5e35b1',
                'description' => 'Absensi kerja harian dan rekap kehadiran karyawan.',
            ],
            [
                'id'          => 'portal-k2',
                'name'        => 'Portal K2',
                'url'         => 'https://k2.pln.co.id',
                'category'    => 'umum',
                'icon'        => 'fa-newspaper',
                'color'       => '#0277bd',
                'description' => 'Portal berita dan informasi internal PT PLN (Persero).',
            ],

            // ===== 5 LINK PER BIDANG =====
            [
                'id'          => 'scada',
                'name'        => 'SCADA Monitoring',
                'url'         => 'https://scada.pln-np.co.id',
                'category'    => 'operasi',
                'icon'        => 'fa-gauge-high',
                'color'       => '#e65100',
                'description' => 'Pemantauan real-time parameter operasi unit dan jaringan pembangkit.',
            ],
            [
                'id'          => 'cmms',
                'name'        => 'CMMS Pemeliharaan',
                'url'         => 'https://cmms.pln-np.co.id',
                'category'    => 'pemeliharaan',
                'icon'        => 'fa-screwdriver-wrench',
                'color'       => '#37474f',
                'description' => 'Work order, jadwal overhauls, dan riwayat pemeliharaan peralatan.',
            ],
            [
                'id'          => 'sirwit',
                'name'        => 'SI-FIN Keuangan',
                'url'         => 'https://sifin.pln-np.co.id',
                'category'    => 'keuangan',
                'icon'        => 'fa-coins',
                'color'       => '#2e7d32',
                'description' => 'Pengajuan anggaran, verifikasi invoice, dan laporan keuangan unit.',
            ],
            [
                'id'          => 'e-k3',
                'name'        => 'E-K3 Safety',
                'url'         => 'https://ek3.pln-np.co.id',
                'category'    => 'k3',
                'icon'        => 'fa-helmet-safety',
                'color'       => '#c62828',
                'description' => 'Izin kerja, hazard report, dan pelaporan insiden K3 lingkungan kerja.',
            ],
            [
                'id'          => 'sim-adm',
                'name'        => 'SIM Administrasi',
                'url'         => 'https://simadm.pln-np.co.id',
                'category'    => 'keuangan',
                'icon'        => 'fa-folder-open',
                'color'       => '#455a64',
                'description' => 'Kelola aset kantor, inventaris, dan administrasi umum unit kerja.',
            ],
        ];
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
                'slug'        => 'pengajuan-cuti',
                'name'        => 'Pengajuan Cuti',
                'icon'        => 'fa-calendar-check',
                'color'       => '#00599c',
                'description' => 'Prosedur pengajuan cuti tahunan, sakit, dan cuti khusus melalui atasan langsung.',
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
                'slug'        => 'layanan-it',
                'name'        => 'Layanan IT',
                'icon'        => 'fa-headset',
                'color'       => '#0277bd',
                'description' => 'Bantuan teknis: akun, laptop, jaringan, aplikasi kerja, dan reset password.',
                'steps'       => [
                    'Buat tiket melalui Helpdesk IT atau email it-support@pln-np.co.id.',
                    'Jelaskan kendala beserta unit kerja dan nomor aset perangkat.',
                    'Tiket ditindaklanjuti petugas IT maksimal 1x8 jam kerja.',
                    'Perangkat rusak berat diambil alih tim infrastruktur.',
                ],
                'contact'     => 'it-support@pln-np.co.id',
            ],
            [
                'slug'        => 'layanan-fasilitas',
                'name'        => 'Layanan Fasilitas',
                'icon'        => 'fa-building',
                'color'       => '#00695c',
                'description' => 'Permintaan ruang rapat, perbaikan fasilitas kantor, dan inventaris.',
                'steps'       => [
                    'Ajukan permohonan via SIM Administrasi (modul Fasilitas).',
                    'Peminjaman ruang rapat minimal 1 hari sebelumnya.',
                    'Verifikasi kecukupan anggaran oleh Kaur Umum.',
                    'Notifikasi persetujuan dikirim ke email pemohon.',
                ],
                'contact'     => 'umum@pln-np.co.id',
            ],
            [
                'slug'        => 'perjalanan-dinas',
                'name'        => 'Perjalanan Dinas',
                'icon'        => 'fa-plane-departure',
                'color'       => '#6a1b9a',
                'description' => 'Pengajuan SPD, tiket, dan reimbursable biaya perjalanan dinas.',
                'steps'       => [
                    'Susun rencana perjalanan dan rincian estimasi biaya.',
                    'Ajukan SPPD paling lambat 5 hari kerja sebelum keberangkatan.',
                    'Persetujuan berjenjang: atasan langsung dan GM.',
                    'Rekap realisasi biaya diupload maksimal 7 hari setelah kembali.',
                ],
                'contact'     => 'keuangan@pln-np.co.id',
            ],
            [
                'slug'        => 'klaim-kesehatan',
                'name'        => 'Klaim Kesehatan',
                'icon'        => 'fa-notes-medical',
                'color'       => '#c62828',
                'description' => 'Pengajuan reimbursement biaya pengobatan untuk karyawan dan keluarga.',
                'steps'       => [
                    'Siapkan bukti bayar asli, resep, dan diagnosa dokter.',
                    'Isi formulir klaim di Portal SDM (modul Kesejahteraan).',
                    'Upload dokumen maksimal 30 hari sejak tanggal berobat.',
                    'Klaim disetujui dibayarkan bersama gaji periode berikutnya.',
                ],
                'contact'     => 'kesejahteraan@pln-np.co.id',
            ],
            [
                'slug'        => 'peminjaman-apd',
                'name'        => 'Peminjaman APD',
                'icon'        => 'fa-helmet-safety',
                'color'       => '#e65100',
                'description' => 'Permintaan Alat Pelindung Diri untuk pekerjaan lapangan dan area risiko.',
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
