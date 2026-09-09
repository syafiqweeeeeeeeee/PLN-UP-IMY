@extends('layouts.admin')

@section('title', 'Dashboard Admin — E-PPID PLN')
@section('page-title', 'Dashboard')

@section('content')
    {{-- ============================================
         1. WELCOME / GREETING
         ============================================ --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="dash-card" style="background: linear-gradient(135deg, var(--pln-blue) 0%, var(--pln-blue-dark) 100%); border: none; color: #fff;">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h4 style="font-weight: 700; margin-bottom: 0.25rem;">
                            Selamat Datang, Admin 👋
                        </h4>
                        <p style="opacity: 0.8; font-size: 0.88rem; margin: 0;">
                            Berikut ringkasan kondisi sistem E-PPID PLN hari ini.
                        </p>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="text-center">
                            <div style="font-size: 1.5rem; font-weight: 800;">{{ number_format($stats['pending_content']) }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.7;">Menunggu Review</div>
                        </div>
                        <div style="width:1px; background:rgba(255,255,255,0.2);"></div>
                        <div class="text-center">
                            <div style="font-size: 1.5rem; font-weight: 800;">3</div>
                            <div style="font-size: 0.72rem; opacity: 0.7;">Notifikasi Baru</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         2. STATISTICS CARDS
         ============================================ --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: #dbeafe; color: #1d4ed8;">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="stat-value" style="color: #1d4ed8;">{{ number_format($stats['total_users']) }}</div>
                    <div class="stat-label">Total Pengguna</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: #dcfce7; color: #166534;">
                    <i class="fas fa-file-lines"></i>
                </div>
                <div>
                    <div class="stat-value" style="color: #166534;">{{ number_format($stats['total_pages']) }}</div>
                    <div class="stat-label">Total Halaman</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: #dbeafe; color: #005B9C;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div>
                    <div class="stat-value" style="color: #005B9C;">{{ number_format($stats['total_news']) }}</div>
                    <div class="stat-label">Total Berita</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: #fef3c7; color: #92400e;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="stat-value" style="color: #92400e;">{{ number_format($stats['pending_content']) }}</div>
                    <div class="stat-label">Draft / Menunggu Publikasi</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         3. QUICK ACTIONS
         ============================================ --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div>
                        <h5 class="dash-card-title">Aksi Cepat</h5>
                        <p class="dash-card-subtitle">Akses cepat ke fitur yang sering digunakan</p>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-xl-3 col-md-6">
                        <a href="#" class="quick-action-btn">
                            <div class="quick-action-icon" style="background: #dbeafe; color: #1d4ed8;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600;">Buat Berita</div>
                                <div style="font-size: 0.72rem; color: #9ca3af; font-weight: 400;">Publikasikan berita terbaru</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="#" class="quick-action-btn">
                            <div class="quick-action-icon" style="background: #dcfce7; color: #166534;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600;">Buat Halaman</div>
                                <div style="font-size: 0.72rem; color: #9ca3af; font-weight: 400;">Tambah halaman baru</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="#" class="quick-action-btn">
                            <div class="quick-action-icon" style="background: #fef3c7; color: #92400e;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600;">Buat Pengumuman</div>
                                <div style="font-size: 0.72rem; color: #9ca3af; font-weight: 400;">Sampaikan informasi penting</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('admin.users.create') }}" class="quick-action-btn">
                            <div class="quick-action-icon" style="background: #f3e8ff; color: #7c3aed;">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600;">Tambah Pengguna</div>
                                <div style="font-size: 0.72rem; color: #9ca3af; font-weight: 400;">Daftarkan akun baru</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         4 & 5 & 6: ACTIVITY | CONTENT | STATUS
         ============================================ --}}
    <div class="row g-3 mb-4">

        {{-- 4. Aktivitas Terbaru --}}
        <div class="col-xl-8">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h5 class="dash-card-title">Aktivitas Terbaru</h5>
                        <p class="dash-card-subtitle">Aktivitas yang baru dilakukan oleh pengguna & admin</p>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-secondary" style="border-radius:8px; font-size:0.75rem; font-weight:600;">
                        Lihat Semua
                    </a>
                </div>

                @foreach ($activities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon" style="background: {{ $activity['color'] }}15; color: {{ $activity['color'] }};">
                            <i class="{{ $activity['icon'] }}"></i>
                        </div>
                        <div style="flex: 1;">
                            <div class="activity-text">
                                <strong>{{ $activity['user'] }}</strong>
                                {{ $activity['action'] }}
                                <strong>{{ $activity['object'] }}</strong>
                            </div>
                            <div class="activity-time">
                                <i class="far fa-clock me-1"></i>{{ $activity['time'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 6. Status Sistem --}}
        <div class="col-xl-4">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h5 class="dash-card-title">Status Sistem</h5>
                        <p class="dash-card-subtitle">Kondisi infrastruktur saat ini</p>
                    </div>
                </div>

                @foreach ($system_status as $sys)
                    <div class="sys-status-item">
                        <div class="sys-status-left">
                            <span class="sys-status-dot {{ strtolower($sys['status']) }}"></span>
                            <span class="sys-status-name">{{ $sys['name'] }}</span>
                        </div>
                        <span class="sys-status-label {{ strtolower($sys['status']) }}">{{ $sys['status'] }}</span>
                    </div>
                @endforeach

                <div class="mt-3 pt-3" style="border-top: 1px solid #f3f4f6;">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size: 0.78rem; color: #6b7280;">Storage Usage</span>
                        <span style="font-size: 0.78rem; font-weight: 600; color: #92400e;">78%</span>
                    </div>
                    <div class="progress" style="height: 6px; border-radius: 3px; background: #f3f4f6;">
                        <div class="progress-bar" style="width: 78%; background: linear-gradient(90deg, #f59e0b, #ef4444); border-radius: 3px;"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span style="font-size: 0.7rem; color: #9ca3af;">15.6 GB / 20 GB</span>
                        <a href="#" style="font-size: 0.7rem; color: var(--pln-blue); font-weight: 600;">Kelola</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         5 & 7: KONTEN TERBARU | NOTIFIKASI
         ============================================ --}}
    <div class="row g-3 mb-4">

        {{-- 5. Konten Terbaru --}}
        <div class="col-xl-8">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h5 class="dash-card-title">Konten Terbaru</h5>
                        <p class="dash-card-subtitle">Berita, pengumuman, dan halaman yang baru diterbitkan</p>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-secondary" style="border-radius:8px; font-size:0.75rem; font-weight:600;">
                        Kelola Konten
                    </a>
                </div>

                @foreach ($latest_content as $content)
                    <div class="content-row">
                        <div style="flex: 1;">
                            <div class="content-title">{{ $content['title'] }}</div>
                            <div class="content-meta">
                                <i class="fas fa-tag me-1"></i>{{ $content['type'] }}
                                <span class="mx-1">•</span>
                                <i class="far fa-calendar me-1"></i>{{ $content['date'] }}
                            </div>
                        </div>
                        <span class="status-badge {{ strtolower($content['status']) }}">
                            {{ $content['status'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 7. Notifikasi --}}
        <div class="col-xl-4">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h5 class="dash-card-title">Notifikasi</h5>
                        <p class="dash-card-subtitle">Informasi penting untuk admin</p>
                    </div>
                </div>

                @foreach ($notifications as $notif)
                    <div class="notif-item">
                        <div class="notif-icon {{ $notif['type'] }}">
                            <i class="{{ $notif['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="notif-text">{{ $notif['message'] }}</div>
                            <div class="notif-time">
                                <i class="far fa-clock me-1"></i>{{ $notif['time'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
