@extends('layouts.admin')

@section('title', 'Dashboard Admin — E-PPID PLN')
@section('page-title', 'Dashboard')

@section('content')
{{-- ============================================
     MAIN WRAPPER — Fluid, max-width 100%, no overflow
     ============================================ --}}
<div class="container-fluid p-0" style="max-width: 100%; overflow-x: hidden;">

    {{-- ============================================
         1. WELCOME / GREETING + SEARCH
         ============================================ --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="dash-card" style="background: linear-gradient(135deg, var(--pln-blue) 0%, var(--pln-blue-dark) 100%); border: none; color: #fff;">
                <div class="d-flex align-items-center justify-content-between flex-wrap w-100 gap-3">
                    <div style="min-width: 200px;">
                        <h4 style="font-weight: 700; margin-bottom: 0.25rem;">
                            Selamat Datang, Admin 👋
                        </h4>
                        <p style="opacity: 0.8; font-size: 0.88rem; margin: 0;">
                            Berikut ringkasan kondisi sistem E-PPID PLN hari ini.
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div style="position: relative; flex-shrink: 0;">
                            <input type="text"
                                   id="dashboardSearchInput"
                                   placeholder="Cari berita, pengumuman..."
                                   style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); border-radius: 10px; padding: 0.55rem 1rem 0.55rem 2.4rem; color: #fff; font-size: 0.85rem; width: 220px; max-width: 100%; transition: all 0.2s ease; outline: none;"
                                   onfocus="this.style.background='rgba(255,255,255,0.25)'; this.style.borderColor='rgba(255,255,255,0.5)';"
                                   onblur="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='rgba(255,255,255,0.25)';">
                            <i class="fas fa-search" style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); opacity: 0.6; font-size: 0.82rem;"></i>
                        </div>
                        <div class="d-flex gap-3 align-items-center" style="flex-shrink: 0;">
                            <div class="text-center">
                                <div style="font-size: 1.5rem; font-weight: 800;">{{ number_format($stats['pending_content']) }}</div>
                                <div style="font-size: 0.72rem; opacity: 0.7;">Draft</div>
                            </div>
                            <div style="width:1px; height:30px; background:rgba(255,255,255,0.2);"></div>
                            <div class="text-center">
                                <div style="font-size: 1.5rem; font-weight: 800;">{{ number_format($stats['total_news']) }}</div>
                                <div style="font-size: 0.72rem; opacity: 0.7;">Berita Aktif</div>
                            </div>
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
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="stat-card h-100" style="min-width: 0;">
                <div class="stat-icon" style="background: #dbeafe; color: #1d4ed8;">
                    <i class="fas fa-users"></i>
                </div>
                <div style="min-width: 0;">
                    <div class="stat-value" style="color: #1d4ed8;">{{ number_format($stats['total_users']) }}</div>
                    <div class="stat-label">Total Pengguna</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="stat-card h-100" style="min-width: 0;">
                <div class="stat-icon" style="background: #dcfce7; color: #166534;">
                    <i class="fas fa-file-lines"></i>
                </div>
                <div style="min-width: 0;">
                    <div class="stat-value" style="color: #166534;">{{ number_format($stats['total_pages']) }}</div>
                    <div class="stat-label">Total Halaman</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="stat-card h-100" style="min-width: 0;">
                <div class="stat-icon" style="background: #dbeafe; color: #005B9C;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div style="min-width: 0;">
                    <div class="stat-value" style="color: #005B9C;">{{ number_format($stats['total_news']) }}</div>
                    <div class="stat-label">Total Berita</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="stat-card h-100" style="min-width: 0;">
                <div class="stat-icon" style="background: #fef3c7; color: #92400e;">
                    <i class="fas fa-clock"></i>
                </div>
                <div style="min-width: 0;">
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
                    @can('news.create')
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <a href="{{ route('admin.news.create') }}" class="quick-action-btn h-100">
                            <div class="quick-action-icon" style="background: #dbeafe; color: #1d4ed8;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div style="min-width: 0;">
                                <div style="font-weight: 600;">Buat Berita</div>
                                <div style="font-size: 0.72rem; color: #9ca3af; font-weight: 400;">Publikasikan berita terbaru</div>
                            </div>
                        </a>
                    </div>
                    @endcan

                    @can('announcements.create')
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <a href="{{ route('admin.announcements.create') }}" class="quick-action-btn h-100">
                            <div class="quick-action-icon" style="background: #fef3c7; color: #92400e;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div style="min-width: 0;">
                                <div style="font-weight: 600;">Buat Pengumuman</div>
                                <div style="font-size: 0.72rem; color: #9ca3af; font-weight: 400;">Sampaikan informasi penting</div>
                            </div>
                        </a>
                    </div>
                    @endcan

                    @can('users.create')
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <a href="{{ route('admin.users.create') }}" class="quick-action-btn h-100">
                            <div class="quick-action-icon" style="background: #f3e8ff; color: #7c3aed;">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div style="min-width: 0;">
                                <div style="font-weight: 600;">Tambah Pengguna</div>
                                <div style="font-size: 0.72rem; color: #9ca3af; font-weight: 400;">Daftarkan akun baru</div>
                            </div>
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         4 & 6: ACTIVITY | STATUS SISTEM
         ============================================ --}}
    <div class="row g-3 mb-4">

        {{-- 4. Aktivitas Terbaru --}}
        <div class="col-xl-8 col-lg-7 col-12">
            <div class="dash-card h-100" style="min-width: 0; overflow: hidden;">
                <div class="dash-card-header">
                    <div style="min-width: 0;">
                        <h5 class="dash-card-title">Aktivitas Terbaru</h5>
                        <p class="dash-card-subtitle">Aktivitas yang baru dilakukan oleh pengguna & admin</p>
                    </div>
                    @can('activity_logs.view')
                    <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px; font-size:0.75rem; font-weight:600; white-space: nowrap; flex-shrink: 0;">
                        Lihat Semua
                    </a>
                    @endcan
                </div>

                @forelse ($activities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon" style="background: {{ $activity['color'] }}15; color: {{ $activity['color'] }};">
                            <i class="{{ $activity['icon'] }}"></i>
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div class="activity-text" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <strong>{{ $activity['user'] }}</strong>
                                {{ $activity['action'] }}
                                <strong>{{ $activity['object'] }}</strong>
                            </div>
                            <div class="activity-time">
                                <i class="far fa-clock me-1"></i>{{ $activity['time'] }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="padding: 2.5rem 1rem; text-align: center; color: #9ca3af;">
                        <i class="fas fa-clipboard-list" style="font-size: 2rem; display: block; margin-bottom: 0.75rem;"></i>
                        <div style="font-size: 0.875rem; font-weight: 600; color: #6b7280;">Belum ada aktivitas</div>
                        <div style="font-size: 0.8rem;">Aktivitas admin/karyawan akan tampil di sini.</div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- 6. Status Sistem --}}
        <div class="col-xl-4 col-lg-5 col-12">
            <div class="dash-card h-100" style="min-width: 0; overflow: hidden;">
                <div class="dash-card-header">
                    <div>
                        <h5 class="dash-card-title">Status Sistem</h5>
                        <p class="dash-card-subtitle">Kondisi infrastruktur saat ini</p>
                    </div>
                </div>

                @foreach ($system_status as $sys)
                    <div class="sys-status-item">
                        <div class="sys-status-left" style="min-width: 0;">
                            <span class="sys-status-dot {{ strtolower($sys['status']) }}"></span>
                            <span class="sys-status-name">{{ $sys['name'] }}</span>
                        </div>
                        <span class="sys-status-label {{ strtolower($sys['status']) }}" style="flex-shrink: 0;">{{ $sys['status'] }}</span>
                    </div>
                @endforeach

                @if ($storage !== null)
                    <div class="mt-3 pt-3" style="border-top: 1px solid #f3f4f6;">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="font-size: 0.78rem; color: #6b7280;">Storage Usage</span>
                            <span style="font-size: 0.78rem; font-weight: 600; color: {{ $storage['percent'] >= 80 ? '#92400e' : '#166534' }};">{{ number_format($storage['percent'], 1) }}%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 3px; background: #f3f4f6;">
                            <div class="progress-bar" style="width: {{ min(100, $storage['percent']) }}%; background: {{ $storage['percent'] >= 80 ? 'linear-gradient(90deg, #f59e0b, #ef4444)' : 'linear-gradient(90deg, #22c55e, #16a34a)' }}; border-radius: 3px;"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span style="font-size: 0.7rem; color: #9ca3af;">{{ $storage['used'] }} / {{ $storage['total'] }}</span>
                            <span style="font-size: 0.7rem; color: #9ca3af;">Bebas {{ $storage['free'] }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ============================================
         5 & 7: KONTEN TERBARU | NOTIFIKASI
         ============================================ --}}
    <div class="row g-3 mb-4">

        {{-- 5. Konten Terbaru --}}
        <div class="col-xl-8 col-lg-7 col-12">
            <div class="dash-card h-100" style="min-width: 0; overflow: hidden;">
                <div class="dash-card-header">
                    <div style="min-width: 0;">
                        <h5 class="dash-card-title">Konten Terbaru</h5>
                        <p class="dash-card-subtitle">Berita, pengumuman, dan halaman yang baru diterbitkan</p>
                    </div>
                    @can('news.view')
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px; font-size:0.75rem; font-weight:600; white-space: nowrap; flex-shrink: 0;">
                        Kelola Konten
                    </a>
                    @endcan
                </div>

                @forelse ($latest_content as $content)
                    <div class="content-row">
                        <div style="flex: 1; min-width: 0;">
                            <div class="content-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $content['title'] }}</div>
                            <div class="content-meta" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <i class="fas fa-tag me-1"></i>{{ $content['type'] }}
                                <span class="mx-1">•</span>
                                <i class="far fa-calendar me-1"></i>{{ $content['date'] }}
                            </div>
                        </div>
                        <span class="status-badge {{ strtolower($content['status']) }}" style="flex-shrink: 0; margin-left: 0.75rem;">
                            {{ $content['status'] }}
                        </span>
                    </div>
                @empty
                    <div style="padding: 2.5rem 1rem; text-align: center; color: #9ca3af;">
                        <i class="fas fa-layer-group" style="font-size: 2rem; display: block; margin-bottom: 0.75rem;"></i>
                        <div style="font-size: 0.875rem; font-weight: 600; color: #6b7280;">Belum ada konten</div>
                        <div style="font-size: 0.8rem;">Berita, pengumuman, dan halaman yang dibuat akan tampil di sini.</div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- 7. Notifikasi --}}
        <div class="col-xl-4 col-lg-5 col-12">
            <div class="dash-card h-100" style="min-width: 0; overflow: hidden;">
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
                        <div style="min-width: 0;">
                            <div class="notif-text" style="overflow: hidden; text-overflow: ellipsis;">{{ $notif['message'] }}</div>
                            <div class="notif-time">
                                <i class="far fa-clock me-1"></i>{{ $notif['time'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    #dashboardSearchInput::placeholder { color: rgba(255,255,255,0.6); }
    #dashboardSearchInput:focus::placeholder { color: rgba(255,255,255,0.8); }
    .search-hidden { display: none !important; }

    /* ===== Height Equalizer: kartu statistik & aksi cepat seragam =====
       - .row Bootstrap sudah align-items: stretch → class h-100 di markup
         membuat setiap card mengikuti tinggi row (sama tinggi, presisi).
       - min-height seragam jadi baseline agar kartu 1-baris tidak lebih
         pendek; kartu "Draft / Menunggu Publikasi" (label 2 baris) tidak
         membengkak sendiri karena semua kartu ikut setinggi itu. */
    .stat-card { min-height: 100px; }
    .quick-action-btn { min-height: 92px; }
</style>
@endpush

@push('scripts')
<script>
(function() {
    var searchInput = document.getElementById('dashboardSearchInput');
    if (!searchInput) return;
    searchInput.addEventListener('input', function() {
        var q = this.value.toLowerCase().trim();
        document.querySelectorAll('.content-row, .activity-item').forEach(function(el) {
            var t = (el.querySelector('.content-title, .activity-text') || {}).textContent || '';
            el.classList.toggle('search-hidden', q && !t.toLowerCase().includes(q));
        });
    });
})();
</script>
@endpush
