<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Statistics from database
        $stats = [
            'total_users'    => User::count(),
            'total_pages'    => 0, // Belum ada model Page
            'total_news'     => 0, // Belum ada model News
            'pending_content' => 0, // Belum ada model Content
        ];

        // Get recent users for activity (if any)
        $recentUsers = User::latest()->take(5)->get()->map(function ($user) {
            return [
                'user' => $user->name,
                'action' => 'Mendaftar',
                'object' => $user->email,
                'time' => $user->created_at->diffForHumans(),
                'icon' => 'fas fa-user-plus',
                'color' => '#22c55e',
            ];
        })->toArray();

        $activities = array_merge($recentUsers, [
            ['user' => 'Admin PLN',       'action' => 'Login',              'object' => 'Dashboard Admin',               'time' => '5 menit lalu',    'icon' => 'fas fa-right-to-bracket', 'color' => '#8b5cf6'],
        ]);

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
