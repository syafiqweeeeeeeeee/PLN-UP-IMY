<?php

namespace Database\Seeders;

use App\Models\WorkLink;
use Illuminate\Database\Seeder;

/**
 * Seeder Manajemen Link Kerja — data awal Portal Karyawan:
 *
 * - 9 Link Kerja Kategori 'Umum'  : tampil untuk semua akun Karyawan
 *   (Presensi Online, Webmail PLN, E-Office, Portal SDM, E-Learning +
 *   4 layanan SDM: E-Cuti & SPPD, Slip Gaji & Insentif, E-Learning &
 *   LMS PLN, Klaim Restitusi Kesehatan).
 * - 5 Link Kerja Kategori 'Khusus': Sub-Bidang Operasi
 *   (Asisten Manager Prod A, Supervisor CHCB A, Asisten Manager
 *   Kimia & Lab).
 *
 * firstOrCreate berdasar title → aman dijalankan berulang.
 */
class WorkLinkSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // 5 LINK KERJA KATEGORI 'UMUM' — tampil di semua akun Karyawan
        // ============================================================
        $umumLinks = [
            [
                'title'       => 'Presensi Online',
                'url'         => 'https://presensi.pln.co.id',
                'description' => 'Absensi kerja harian dan rekap kehadiran karyawan.',
                'icon'        => 'fa-fingerprint',
            ],
            [
                'title'       => 'Webmail PLN',
                'url'         => 'https://mail.pln.co.id',
                'description' => 'Email resmi korporat PLN untuk komunikasi internal dan eksternal.',
                'icon'        => 'fa-envelope',
            ],
            [
                'title'       => 'E-Office',
                'url'         => 'https://eoffice.pln.co.id',
                'description' => 'Surat menyurat digital, disposisi, dan arsip dokumen persuratan.',
                'icon'        => 'fa-file-lines',
            ],
            [
                'title'       => 'Portal SDM',
                'url'         => 'https://sdm.pln.co.id',
                'description' => 'Data kepegawaian, slip gaji, cuti, dan layanan kehumanian lainnya.',
                'icon'        => 'fa-users',
            ],
            [
                'title'       => 'E-Learning',
                'url'         => 'https://elearning.pln.co.id',
                'description' => 'Platform pembelajaran daring, sertifikasi, dan pengembangan kompetensi.',
                'icon'        => 'fa-graduation-cap',
            ],

            // ---- 4 LINK LAYANAN SDM (Admin Bidang Business Support / SDM) ----
            [
                'title'       => 'E-Cuti & SPPD Online',
                'url'         => 'https://ecuti.pln.co.id',
                'description' => 'Pengajuan cuti, izin, dan perjalanan dinas online.',
                'icon'        => 'fa-solid fa-id-card',
            ],
            [
                'title'       => 'Portal Slip Gaji & Insentif',
                'url'         => 'https://slipgaji.pln.co.id',
                'description' => 'Layanan mandiri unduh rincian penghasilan bulanan.',
                'icon'        => 'fa-solid fa-wallet',
            ],
            [
                'title'       => 'E-Learning & LMS PLN',
                'url'         => 'https://lms.pln.co.id',
                'description' => 'Portal pembelajaran, diklat, dan sertifikasi pegawai.',
                'icon'        => 'fa-solid fa-graduation-cap',
            ],
            [
                'title'       => 'Klaim Restitusi Kesehatan',
                'url'         => 'https://klaim.pln.co.id',
                'description' => 'Pengajuan reimbursement biaya pengobatan dan kesehatan.',
                'icon'        => 'fa-solid fa-notes-medical',
            ],
        ];

        foreach ($umumLinks as $link) {
            WorkLink::firstOrCreate([
                'title'    => $link['title'],
                'category' => 'umum',
            ], $link + [
                'category'      => 'umum',
                'department'    => null,
                'sub_department' => null,
                'is_active'     => true,
            ]);
        }

        // ============================================================
        // 5 LINK KERJA KHUSUS — Sub-Bidang Operasi:
        // Asisten Manager Prod A (2), Supervisor CHCB A (2),
        // Asisten Manager Kimia & Lab (1)
        // ============================================================
        $khususLinks = [
            [
                'title'          => 'Dashboard Kontrol Pembangkit',
                'url'            => 'https://dkp.pln-np.co.id',
                'description'    => 'Pemantauan parameter unit, beban, dan performa pembangkit area Prod A.',
                'icon'           => 'fa-chart-line',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_a',
            ],
            [
                'title'          => 'Logbook Operator Shift',
                'url'            => 'https://logbook.pln-np.co.id',
                'description'    => 'Catatan operasi harian operator shift dan serah terima antar regu.',
                'icon'           => 'fa-book-open',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_a',
            ],
            [
                'title'          => 'CHCB Monitoring System',
                'url'            => 'https://chcb.pln-np.co.id',
                'description'    => 'Pemantauan Coal Handling & Crusher Building area CHCB A.',
                'icon'           => 'fa-gauge-high',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ],
            [
                'title'          => 'Jadwal Shift CHCB A',
                'url'            => 'https://shift-chcb.pln-np.co.id',
                'description'    => 'Jadwal piket shift dan pembagian regu operator CHCB A.',
                'icon'           => 'fa-calendar-check',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ],
            [
                'title'          => 'Lab Chemistry Portal',
                'url'            => 'https://lab-kimia.pln-np.co.id',
                'description'    => 'Hasil uji kimia air & bahan bakar serta log pengujian laboratorium.',
                'icon'           => 'fa-flask-vial',
                'department'     => 'operasi',
                'sub_department' => 'asmen_kimia_lab',
            ],
        ];

        foreach ($khususLinks as $link) {
            WorkLink::firstOrCreate([
                'title'    => $link['title'],
                'category' => 'khusus',
            ], $link + [
                'category'  => 'khusus',
                'is_active' => true,
            ]);
        }
    }
}
