<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Dummy data — replace with real DB queries when models exist
        $stats = [
            'total_users'    => 128,
            'total_pages'    => 42,
            'total_news'     => 85,
            'pending_content' => 7,
        ];

        $activities = [
            ['user' => 'Budi Santoso',    'action' => 'Membuat berita',        'object' => 'Pemeliharaan Trafo 22/35 kV',       'time' => '5 menit lalu',   'icon' => 'fas fa-newspaper',        'color' => '#00A3E0'],
            ['user' => 'Siti Aminah',     'action' => 'Mengedit halaman',       'object' => 'Profil Perusahaan',                 'time' => '18 menit lalu',  'icon' => 'fas fa-file-pen',          'color' => '#005B9C'],
            ['user' => 'Ahmad Hidayat',   'action' => 'Menerbitkan pengumuman', 'object' => 'Jadwal Maintenance Bulanan',        'time' => '32 menit lalu',  'icon' => 'fas fa-bullhorn',          'color' => '#FFE600'],
            ['user' => 'Dewi Lestari',    'action' => 'Menambahkan pengguna',   'object' => 'operator.baru@pln.co.id',           'time' => '1 jam lalu',     'icon' => 'fas fa-user-plus',         'color' => '#22c55e'],
            ['user' => 'Rizky Pratama',   'action' => 'Login',                  'object' => 'Dashboard Admin',                   'time' => '1 jam lalu',     'icon' => 'fas fa-right-to-bracket', 'color' => '#8b5cf6'],
            ['user' => 'Nina Sari',       'action' => 'Mengedit berita',        'object' => 'Capaian Produksi Q3 2026',          'time' => '2 jam lalu',     'icon' => 'fas fa-newspaper',        'color' => '#00A3E0'],
        ];

        $latest_content = [
            ['title' => 'Pemeliharaan Trafo 22/35 kV',           'type' => 'Berita',   'status' => 'Published', 'date' => '08 Sep 2026'],
            ['title' => 'Jadwal Maintenance Bulanan September',   'type' => 'Pengumuman','status' => 'Published', 'date' => '08 Sep 2026'],
            ['title' => 'Profil Perusahaan — Update Struktur',    'type' => 'Halaman',  'status' => 'Draft',     'date' => '07 Sep 2026'],
            ['title' => 'Laporan Keberlanjutan Lingkungan 2025',  'type' => 'Berita',   'status' => 'Pending',   'date' => '07 Sep 2026'],
            ['title' => 'Pedoman Layanan Informasi Publik',       'type' => 'Halaman',  'status' => 'Published', 'date' => '06 Sep 2026'],
        ];

        $notifications = [
            ['message' => '3 konten menunggu publikasi',  'type' => 'warning', 'time' => '10 menit lalu',  'icon' => 'fas fa-clock'],
            ['message' => 'Pengguna baru terdaftar',       'type' => 'info',    'time' => '1 jam lalu',     'icon' => 'fas fa-user-plus'],
            ['message' => 'Backup database berhasil',      'type' => 'success', 'time' => '3 jam lalu',     'icon' => 'fas fa-database'],
            ['message' => 'Update sistem ke v2.4.1',       'type' => 'info',    'time' => 'Kemarin',        'icon' => 'fas fa-code-branch'],
        ];

        $system_status = [
            ['name' => 'Database',   'status' => 'Normal', 'icon' => 'fas fa-database',  'color' => '#22c55e'],
            ['name' => 'Application','status' => 'Normal', 'icon' => 'fas fa-server',    'color' => '#22c55e'],
            ['name' => 'Storage',    'status' => 'Warning','icon' => 'fas fa-hard-drive','color' => '#f59e0b'],
        ];

        return view('admin.dashboard', compact('stats', 'activities', 'latest_content', 'notifications', 'system_status'));
    }
}
