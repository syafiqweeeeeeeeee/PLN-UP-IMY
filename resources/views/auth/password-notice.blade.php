@extends('layouts.app')

@section('title', 'Ganti Password — E-PPID PLN')

@push('styles')
<style>
    .pwd-notice-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        background: linear-gradient(135deg, #003d6b 0%, #005B9C 55%, #008fa8 100%);
    }
    .pwd-card {
        background: #fff;
        border-radius: 18px;
        padding: 2.4rem 2rem 2rem;
        max-width: 480px;
        width: 100%;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.3);
        text-align: center;
    }
    .pwd-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1.1rem;
        border-radius: 50%;
        background: #FEF3C7;
        color: #D97706;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }
    .pwd-title { font-size: 1.2rem; font-weight: 700; color: #1f2937; margin: 0 0 0.6rem; }
    .pwd-text { font-size: 0.9rem; color: #6b7280; line-height: 1.65; margin: 0 0 1.4rem; }
    .pwd-text strong { color: #374151; }
    .pwd-steps {
        text-align: left;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem 1.1rem;
        margin: 0 0 1.5rem;
        font-size: 0.83rem;
        color: #4b5563;
        line-height: 1.7;
    }
    .pwd-steps i { color: #005B9C; margin-right: 0.45rem; }
    .pwd-btn {
        display: inline-block;
        padding: 0.7rem 2rem;
        border-radius: 10px;
        background: linear-gradient(135deg, #005B9C, #008fa8);
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .pwd-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(0, 91, 156, 0.35); color: #fff; }
    .pwd-logout {
        display: inline-block;
        margin-top: 0.9rem;
        font-size: 0.8rem;
        color: #6b7280;
        text-decoration: none;
    }
    .pwd-logout:hover { color: #DC2626; }
</style>
@endpush

@section('content')
<div class="pwd-notice-wrap">
    <div class="pwd-card">
        <div class="pwd-icon"><i class="fas fa-key"></i></div>
        <h5 class="pwd-title">Password Anda Direset Admin</h5>
        <p class="pwd-text">
            Password akun <strong>{{ auth()->user()->email }}</strong> baru saja direset oleh administrator
            menjadi <strong>password sementara</strong>. Demi keamanan, Anda wajib menggantinya
            sebelum dapat menggunakan sistem.
        </p>
        <div class="pwd-steps">
            <div><i class="fas fa-1"></i> Klik tombol <strong>Ganti Password</strong> di bawah.</div>
            <div><i class="fas fa-2"></i> Masukkan <strong>password sementara</strong> yang Anda terima dari admin.</div>
            <div><i class="fas fa-3"></i> Buat password baru Anda, lalu masuk kembali seperti biasa.</div>
        </div>
        <a href="{{ route('account.password-form') }}" class="pwd-btn">
            <i class="fas fa-lock me-1"></i> Ganti Password
        </a>
        <br>
        <a href="{{ route('logout') }}" class="pwd-logout"
           onclick="event.preventDefault(); document.getElementById('pwd-logout-form').submit();">
            <i class="fas fa-arrow-right-from-bracket me-1"></i> Keluar
        </a>
        <form id="pwd-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>
</div>
@endsection
