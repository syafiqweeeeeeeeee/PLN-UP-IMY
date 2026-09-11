@extends('layouts.app')

@section('title', 'Login Admin — E-PPID PLN')

@push('styles')
<style>
    /* Login page background — tidak override body, hanya kontainer */
    .login-page {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f4f6f9 0%, #e8edf3 100%);
        padding: 2rem 1rem;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.03);
        padding: 2.2rem 2rem 2rem;
    }

    .login-logo {
        width: 56px;
        height: 56px;
        margin: 0 auto 1.25rem;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.8rem;
        box-shadow: 0 4px 12px rgba(0, 91, 156, 0.25);
    }

    .login-header { text-align: center; margin-bottom: 1.75rem; }

    .login-header h2 {
        margin: 0;
        font-size: 1.35rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .login-header p {
        margin: 0;
        font-size: 0.85rem;
        color: #6b7280;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.82rem;
        color: #374151;
        margin-bottom: 0.4rem;
        display: block;
    }

    .form-control-pln {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.7rem 1rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: #fff;
        color: #1f2937;
    }

    .form-control-pln::placeholder { color: #9ca3af; }

    .form-control-pln:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.1);
        outline: none;
    }

    .input-group-pln { position: relative; margin-bottom: 0.25rem; }

    .input-group-pln .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.95rem;
        pointer-events: none;
        z-index: 5;
    }

    .input-group-pln .form-control-pln { padding-left: 2.6rem; }

    .password-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0.25rem;
        z-index: 5;
        transition: color 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: var(--pln-blue);
    }

    .input-group-pln .form-control-pln.has-toggle {
        padding-right: 2.6rem;
    }

    .field-error {
        font-size: 0.78rem;
        color: #dc2626;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .alert-pln-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        border-radius: 10px;
        padding: 0.7rem 1rem;
        font-size: 0.82rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-login-pln {
        width: 100%;
        background: var(--pln-yellow);
        color: var(--pln-blue);
        border: none;
        border-radius: 10px;
        padding: 0.8rem;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-login-pln:hover {
        background: #fff;
        box-shadow: 0 6px 14px rgba(255, 214, 0, 0.45);
        transform: translateY(-1px);
        color: var(--pln-blue);
    }

    .btn-login-pln:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .login-footer {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.78rem;
        color: #9ca3af;
        border-top: 1px solid #f3f4f6;
        padding-top: 1rem;
    }

    .login-footer a {
        color: var(--pln-blue);
        font-weight: 600;
        text-decoration: none;
    }

    .login-footer a:hover { text-decoration: underline; }

    /* Responsive */
    @media (max-width: 480px) {
        .login-card { padding: 1.8rem 1.5rem; }
        .login-logo { width: 48px; height: 48px; font-size: 1.5rem; }
        .login-header h2 { font-size: 1.2rem; }
    }
</style>
@endpush

@section('content')
<div class="login-page">
    <div class="login-card">
        {{-- Logo removed per request --}}

        {{-- Header --}}
        <div class="login-header">
            <h2>Selamat Datang, Admin</h2>
            <p>Silakan masuk ke panel administrasi</p>
        </div>

        {{-- Error alert --}}
        @if ($errors->any())
        <div class="alert-pln-error">
            <i class="fas fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="input-group-pln">
                <label for="email" class="form-label">Email</label>
                <div class="input-group-pln" style="margin-bottom: 0.5rem;">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input
                        id="email"
                        type="email"
                        class="form-control-pln"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="admin@contoh.com">
                </div>
                @error('email')
                <div class="field-error">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Password --}}
            <div style="margin-top: 1.2rem;">
                <label for="password" class="form-label">Password</label>
                <div class="input-group-pln" style="margin-bottom: 0.5rem;">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input
                        id="password"
                        type="password"
                        class="form-control-pln has-toggle"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password">
                    <button type="button" class="password-toggle" onclick="togglePassword()" tabindex="-1">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                <div class="field-error">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login-pln">
                <i class="fas fa-arrow-right-to-bracket"></i> Masuk
            </button>
        </form>

        {{-- Footer --}}
        <div class="login-footer">
            E-PPID PLN &middot; Admin Panel
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        var field = document.getElementById('password');
        var icon = document.getElementById('toggleIcon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
