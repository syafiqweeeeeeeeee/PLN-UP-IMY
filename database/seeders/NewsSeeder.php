<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $newsData = [
            [
                'title'        => 'PLTU Indramayu Catat Produksi Tertinggi Q3 2026',
                'category'     => 'umum',
                'excerpt'      => 'Unit Pembangkitan Tenaga Uap Indramayu berhasil mencatatkan angka produksi energi tertinggi sepanjang kuartal ketiga tahun 2026 dengan capaian 2.100 GWh.',
                'content'      => "Unit Pembangkitan Tenaga Uap (PLTU) Indramayu berhasil mencatatkan angka produksi energi tertinggi sepanjang kuartal ketiga tahun 2026.\n\nCapaian ini melampaui target yang ditetapkan sebesar 2.100 GWh, meningkat 8% dibandingkan periode yang sama tahun lalu. Peningkatan ini tidak lepas dari optimalisasi operasional dan pemeliharaan preventif yang dilakukan secara konsisten.\n\nManajemen PLTU Indramayu menyampaikan apresiasi kepada seluruh personel yang telah bekerja keras menjaga keandalan pasokan listrik nasional.\n\n\"Capaian ini merupakan hasil kerja kolektif seluruh tim. Kami akan terus berupaya meningkatkan produktivitas dan efisiensi operasional,\" ujar General Manager PLTU Indramayu.",
                'author'       => 'Humas PLN NP',
                'is_published' => true,
            ],
            [
                'title'        => 'Pemeliharaan Berkala Unit 2 Berjalan Lancar',
                'category'     => 'teknis',
                'excerpt'      => 'Tim teknis berhasil menyelesaikan pemeliharaan berkala Unit 2 lebih cepat dari jadwal yang ditetapkan dengan zero accident.',
                'content'      => "Pemeliharaan berkala Unit 2 PLTU Indramayu telah berhasil diselesaikan tepat waktu dan zero accident.\n\nPekerjaan meliputi inspeksi boiler, turbine overhaul, dan penggantian komponen kritis. Seluruh tahapan berjalan sesuai rencana tanpa kendala berarti.\n\nPemeliharaan ini merupakan bagian dari program preventive maintenance untuk menjaga keandalan dan umur pakai mesin.",
                'author'       => 'Dept. Teknik',
                'is_published' => true,
            ],
            [
                'title'        => 'PLN NP Indramayu Salurkan Bantuan ke Desa Binaan',
                'category'     => 'kegiatan',
                'excerpt'      => 'Program Corporate Social Responsibility berupa bantuan infrastruktur dan pendidikan disalurkan ke tiga desa binaan di sekitar wilayah operasional.',
                'content'      => "PT PLN Nusantara Power melalui unit UP PLTU Indramayu kembali menyalurkan program CSR kepada masyarakat sekitar.\n\nKali ini bantuan difokuskan pada pembangunan fasilitas pendidikan dan perbaikan infrastruktur desa. Tiga desa binaan menerima manfaat langsung dari program ini.\n\n\"Kami berkomitmen untuk terus memberikan kontribusi positif bagi masyarakat di sekitar wilayah operasional,\" jelas Humas PLN NP.",
                'author'       => 'Bagian CSR',
                'is_published' => true,
            ],
            [
                'title'        => 'Simulasi Tanggap Darurat Berhasil Dilaksanakan',
                'category'     => 'teknis',
                'excerpt'      => 'Seluruh personel mengikuti simulasi tanggap darurat kebakaran dan evakuasi massal guna meningkatkan kesiapsiagaan operasional.',
                'content'      => "PLTU Indramayu menggelar simulasi tanggap darurat tahunan yang diikuti oleh seluruh personel.\n\nSimulasi meliputi skenario kebakaran, kebocoran gas, dan evakuasi massal. Semua tim responden darurat bergerak cepat sesuai protokol yang berlaku.\n\nEvaluasi pasca simulasi menunjukkan peningkatan waktu respons sebesar 15% dari tahun sebelumnya.",
                'author'       => 'Dept. K3',
                'is_published' => true,
            ],
            [
                'title'        => 'Penerimaan Calon Pegawai PLN NP Periode 2026 Dibuka',
                'category'     => 'kepegawaian',
                'excerpt'      => 'PT PLN Nusantara Power membuka kesempatan bagi lulusan terbaik untuk bergabung di berbagai posisi teknis dan non-teknis.',
                'content'      => "PT PLN Nusantara Power membuka penerimaan calon pegawai baru untuk periode 2026.\n\nLowongan tersedia untuk posisi Engineer, Operator Pembangkitan, dan Staff Administrasi. Proses seleksi meliputi uji kompetensi, wawancara, dan medical check-up.\n\nPendaftaran dibuka hingga 30 September 2026 melalui portal rekrutmen resmi PLN.",
                'author'       => 'Dept. SDM',
                'is_published' => true,
            ],
            [
                'title'        => 'Kontribusi PLN NP terhadap Kelistrikan Nasional Terus Meningkat',
                'category'     => 'umum',
                'excerpt'      => 'PT PLN Nusantara Power mencatat peningkatan kontribusi pasokan listrik nasional sebesar 4,2% dibandingkan periode yang sama tahun lalu.',
                'content'      => "PT PLN Nusantara Power mencatat peningkatan kontribusi pasokan listrik nasional yang signifikan.\n\nPeningkatan ini mencapai 4,2% dibandingkan periode yang sama tahun lalu, didukung oleh optimalisasi seluruh unit pembangkitan yang tersebar di Indonesia.\n\nCapaian ini sejalan dengan target pemerintah dalam menjamin keandalan pasokan energi nasional.",
                'author'       => 'Humas PLN NP',
                'is_published' => true,
            ],
            [
                'title'        => 'Pelatihan K3 untuk Karyawan Baru Angkatan 2026',
                'category'     => 'kepegawaian',
                'excerpt'      => 'Karyawan baru mengikuti program orientasi dan pelatihan Keselamatan dan Kesehatan Kerja selama dua minggu.',
                'content'      => "Sebanyak 25 karyawan baru PLTU Indramayu mengikuti program pelatihan K3 intensif.\n\nMateri pelatihan meliputi prosedur keselamatan kerja, penggunaan APD, dan prosedur evakuasi darurat. Para peserta juga mendapatkan hands-on training di area operasional.\n\nSeluruh peserta harus lulus uji kompetensi K3 sebelum ditempatkan di posisi masing-masing.",
                'author'       => 'Dept. SDM',
                'is_published' => true,
            ],
            [
                'title'        => 'Instalasi Sistem SCADA Terbaru Telah Aktif',
                'category'     => 'teknis',
                'excerpt'      => 'Pembaruan sistem SCADA mendukung monitoring real-time dan integrasi data operasional secara lebih akurat.',
                'content'      => "PLTU Indramayu telah mengaktifkan sistem SCADA terbaru untuk monitoring dan kontrol operasional.\n\nSistem baru ini menawarkan akurasi data yang lebih tinggi dan integrasi dengan platform analitik internal. Operator kini dapat memantau kondisi mesin secara real-time dari control room.\n\nProses migrasi berjalan lancar tanpa gangguan terhadap pasokan listrik.",
                'author'       => 'Dept. Teknik',
                'is_published' => true,
            ],
            [
                'title'        => 'Donor Darah massal PLN NP Indramayu',
                'category'     => 'kegiatan',
                'excerpt'      => 'Kegiatan donor darah yang diadakan di area kantor PLTU Indramayu berhasil mengumpulkan 150 kantong darah.',
                'content'      => "Kegiatan donor darah tahunan PLN NP Indramayu kembali dilaksanakan dan mendapat antusiasme tinggi dari karyawan.\n\nSebanyak 200 peserta mendaftar dan 150 di antaranya memenuhi syarat untuk mendonorkan darah. Hasilnya akan disumbangkan ke PMI setempat.\n\nKegiatan ini merupakan bagian dari komitmen PLN NP dalam mendukung program kemanusiaan.",
                'author'       => 'Bagian CSR',
                'is_published' => true,
            ],
            [
                'title'        => 'Pengumuman Jadwal Libur Nasional 2026',
                'category'     => 'umum',
                'excerpt'      => 'Daftar jadwal libur nasional dan cuti bersama tahun 2026 untuk seluruh karyawan PLN NP.',
                'content'      => "Bersama ini diumumkan jadwal libur nasional dan cuti bersama tahun 2026 bagi seluruh karyawan PT PLN Nusantara Power.\n\nAdapun jadwal libur nasional mengacu pada keputusan pemerintah pusat. Untuk cuti bersama, masing-masing unit dapat menyesuaikan dengan kondisi operasional.\n\nKoordinasi dengan atasan langsung wajib dilakukan terkait pengajuan cuti.",
                'author'       => 'Dept. SDM',
                'is_published' => false,
            ],
            [
                'title'        => 'Maintenance Overhead Crane selesai lebih cepat',
                'category'     => 'teknis',
                'excerpt'      => 'Tim mekanik berhasil mempercepat pemeliharaan overhead crane dan menghemat waktu 3 hari dari estimasi awal.',
                'content'      => "Pemeliharaan overhead crane di area coal handling selesai lebih cepat dari estimasi.\n\nTim mekanik menggantian wire rope, inspeksi motor hoist, dan kalibrasi sistem pengangkutan. Pekerjaan selesai 3 hari lebih cepat dari rencana.\n\nPemeliharaan ini penting untuk menjaga keamanan operasional material handling batubara.",
                'author'       => 'Dept. Teknik',
                'is_published' => true,
            ],
            [
                'title'        => 'Workshop Pengelolaan Limbah B3',
                'category'     => 'kegiatan',
                'excerpt'      => 'Workshop internal tentang pengelolaan limbah B3 dilaksanakan untuk meningkatkan kepatuhan regulasi.',
                'content'      => "PLTU Indramayu mengadakan workshop tentang pengelolaan limbah Bahan Berbahaya dan Beracun (B3).\n\nWorkshop dihadiri oleh perwakilan dari seluruh departemen dan menghadirkan narasumber dari DLHK setempat.\n\nMateri yang dibahas meliputi klasifikasi limbah, prosedur penyimpanan, hingga pelaporan emisi.",
                'author'       => 'Dept. K3',
                'is_published' => true,
            ],
        ];

        foreach ($newsData as $data) {
            $data['slug'] = News::generateSlug($data['title']);
            $data['author_user_id'] = null;

            // Set published_at for published news
            if ($data['is_published']) {
                $data['published_at'] = fake()->dateTimeBetween('-2 weeks', 'now');
            } else {
                $data['published_at'] = null;
            }

            News::create($data);
        }

        $this->command->info('✅ ' . count($newsData) . ' berita sample berhasil ditambahkan!');
    }
}
