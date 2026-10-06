@extends('layouts.app')

@section('title', 'Ganti Password — E-PPID PLN')

@push('styles')
<style>
    .pwd-change-wrap {
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
    }
    .pwd-head { text-align: center; margin-bottom: 1.5rem; }
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
    .pwd-title { font-size: 1.2rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .pwd-sub { font-size: 0.85rem; color: #6b7280; margin: 0; line-height: 1.6; }
    .pwd-field { margin-bottom: 1rem; }
    .pwd-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.35rem;
    }
    .pwd-inputwrap { position: relative; }
    .pwd-inputwrap input {
        width: 100%;
        padding: 0.65rem 2.5rem 0.65rem 0.85rem;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 0.9rem;
    }
    .pwd-inputwrap input:focus {
        outline: none;
        border-color: #005B9C;
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.12);
    }
    .pwd-eye {
        position: absolute;
        right: 0.6rem;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        color: #6b7280;
        cursor: pointer;
        padding: 0.3rem;
    }
    .pwd-error {
        color: #DC2626;
        font-size: 0.76rem;
        margin-top: 0.3rem;
    }
    .pwd-hint { font-size: 0.72rem; color: #9ca3af; margin-top: 0.35rem; }
    .pwd-alert {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B91C1C;
        font-size: 0.8rem;
        border-radius: 10px;
        padding: 0.6rem 0.85rem;
        margin-bottom: 1rem;
    }
    .pwd-submit {
        width: 100%;
        padding: 0.7rem;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #005B9C, #008fa8);
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .pwd-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(0, 91, 156, 0.35); }
</style>
@endpush

@section('content')
<div class="pwd-change-wrap">
    <div class="pwd-card">
        <div class="pwd-head">
            <div class="pwd-icon"><i class="fas fa-lock"></i></div>
            <h5 class="pwd-title">Buat Password Baru</h5>
            <p class="pwd-sub">Ganti password sementara dengan password baru milik Anda sendiri.</p>
        </div>

        @if ($errors->any())
            <div class="pwd-alert">
                <i class="fas fa-circle-exclamation me-1"></i> Periksa kembali isian formulir.
            </div>
        @endif

        <form method="POST" action="{{ route('account.password-update') }}">
            @csrf

            <div class="pwd-field">
                <label for="current_password">Password Sementara</label>
                <div class="pwd-inputwrap">
                    <input type="password" id="current_password" name="current_password"
                           value="{{ old('current_password') }}" required autofocus autocomplete="off">
                    <button type="button" class="pwd-eye" onclick="togglePwd('current_password', this)" title="Tampilkan/Sembunyikan">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('current_password')<div class="pwd-error">{{ $message }}</div>@enderror
                <div class="pwd-hint">Password sementara yang Anda terima dari admin.</div>
            </div>

            <div class="pwd-field">
                <label for="password">Password Baru</label>
                <div class="pwd-inputwrap">
                    <input type="password" id="password" name="password" required autocomplete="new-password">
                    <button type="button" class="pwd-eye" onclick="togglePwd('password', this)" title="Tampilkan/Sembunyikan">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')<div class="pwd-error">{{ $message }}</div>@enderror
                <div class="pwd-hint">Minimal 8 karakter. Gunakan kombinasi huruf besar, huruf kecil, dan angka.</div>
            </div>

            <div class="pwd-field">
                <label for="password_confirmation">Ulangi Password Baru</label>
                <div class="pwd-inputwrap">
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                    <button type="button" class="pwd-eye" onclick="togglePwd('password_confirmation', this)" title="Tampilkan/Sembunyikan">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password_confirmation')<div class="pwd-error">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="pwd-submit">
                <i class="fas fa-check me-1"></i> Simpan Password Baru
            </button>
        </form>
    </div>
</div>

<script>
    function togglePwd(inputId, btn) {
        const input = document.getElementById(inputId);
        const eye = btn.querySelector('i');
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        eye.className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
    }
</script>
@endsection
