@extends('layouts.app')

@section('title', 'Login Admin — E-PPID PLN')

@push('styles')
<style>
    /* ============================================================
       LOGIN — Minimalis
       Prinsip: latar polos, kartu putih border-tipis, input flat,
       satu warna aksen (--pln-blue), hierarki lewat tipografi.
       ============================================================ */
    .login-page {
        /* Navbar memakai .fixed-top (di luar alur dokumen) — beri ruang
           setinggi navbar agar kartu tidak tertutup saat discroll.
           `scroll-margin` menjaga posisi tengah saat browser scroll anchoring. */
        min-height: calc(100vh - 120px);
        padding: calc(72px + 2rem) 1rem 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f6f7f9;
    }

    .login-card {
        width: 100%;
        max-width: 380px;
        background: #fff;
        border: 1px solid #eceef1;
        border-radius: 14px;
        box-shadow: 0 1px 2px rgba(16, 24, 40, 0.04), 0 8px 24px rgba(16, 24, 40, 0.04);
        padding: 2.4rem 2.2rem 2rem;
    }

    /* ---- Header: overline kecil + judul ---- */
    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-overline {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #9ca3af;
        margin-bottom: 0.55rem;
    }

    .login-header h2 {
        margin: 0 0 0.35rem;
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: -0.01em;
        color: #111827;
    }

    .login-header p {
        margin: 0;
        font-size: 0.85rem;
        color: #6b7280;
    }

    /* ---- Label & input flat ---- */
    .form-label {
        font-weight: 600;
        font-size: 0.78rem;
        color: #374151;
        margin-bottom: 0.4rem;
        display: block;
    }

    .label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.4rem;
    }

    .label-row .form-label { margin-bottom: 0; }

    .forgot-link {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--pln-blue);
        text-decoration: none;
    }

    .forgot-link:hover {
        color: #111827;
        text-decoration: underline;
    }

    .form-control-pln {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.68rem 0.9rem;
        font-size: 0.9rem;
        background: #fff;
        color: #111827;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .form-control-pln::placeholder { color: #b0b7c3; }

    .form-control-pln:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.1);
        outline: none;
    }


    .field-wrap { margin-bottom: 0.25rem; }

    .field-wrap + .field-wrap,
    .field-wrap + div { margin-top: 1.1rem; }

    .input-has-toggle { position: relative; }

    .input-has-toggle .form-control-pln { padding-right: 2.7rem; }

    .password-toggle {
        position: absolute;
        right: 0.6rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #b0b7c3;
        cursor: pointer;
        padding: 0.25rem;
        transition: color 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover { color: var(--pln-blue); }

    /* ---- Alert minimal: tinted background, tanpa border tebal ---- */
    .alert-pln-error,
    .alert-pln-success,
    .alert-pln-warning {
        border-radius: 8px;
        padding: 0.65rem 0.9rem;
        font-size: 0.8rem;
        line-height: 1.5;
        margin-bottom: 1.4rem;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .alert-pln-error {
        background: #fef2f2;
        color: #b91c1c;
    }

    .alert-pln-success {
        background: #f0fdf4;
        color: #15803d;
    }

    .alert-pln-warning {
        background: #fffbeb;
        color: #b45309;
    }

    .field-error {
        font-size: 0.76rem;
        color: #dc2626;
        margin-top: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* ---- Tombol utama: solid, tanpa gradien ---- */
    .btn-login-pln {
        width: 100%;
        background: var(--pln-blue);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.01em;
        transition: background 0.15s ease, transform 0.1s ease;
        margin-top: 1.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-login-pln:hover {
        background: #007a90;
        color: #fff;
    }

    .btn-login-pln:active { transform: translateY(1px); }

    .btn-login-pln:disabled {
        opacity: 0.65;
        cursor: not-allowed;
    }

    /* ---- Footer: sunyi, tanpa garis ---- */
    .login-footer {
        text-align: center;
        margin-top: 1.75rem;
        font-size: 0.72rem;
        color: #b0b7c3;
    }

    /* ============================================================
       FORM RESET PASSWORD (INLINE) — senada dengan kartu login
       ============================================================ */
    .fp-hint {
        font-size: 0.82rem;
        color: #6b7280;
        line-height: 1.55;
        margin: 0 0 1.2rem;
    }

    .fp-info-banner {
        background: #f0f7fa;
        color: #1e5b83;
        border-radius: 8px;
        padding: 0.7rem 0.9rem;
        font-size: 0.8rem;
        line-height: 1.55;
        display: flex;
        gap: 0.5rem;
        align-items: flex-start;
        margin-bottom: 1.2rem;
    }

    .fp-info-banner i { margin-top: 2px; }

    .fp-otp-input {
        letter-spacing: 0.55rem;
        text-align: center;
        font-size: 1.2rem;
        font-weight: 700;
    }

    /* Baris link Lupa Password — di atas tombol Masuk */
    .forgot-row {
        text-align: right;
        margin-top: 0.9rem;
    }

    /* Tombol kirim OTP: outline — sekunder dari tombol submit utama */
    .btn-fp-send {
        width: 100%;
        background: #fff;
        color: var(--pln-blue);
        border: 1px solid var(--pln-blue);
        border-radius: 8px;
        padding: 0.72rem;
        font-weight: 600;
        font-size: 0.88rem;
        transition: background 0.15s ease, color 0.15s ease, transform 0.1s ease;
        margin-top: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-fp-send:hover:not(:disabled) {
        background: var(--pln-blue);
        color: #fff;
    }

    .btn-fp-send:active { transform: translateY(1px); }

    .btn-fp-send:disabled {
        opacity: 0.65;
        cursor: not-allowed;
    }

    /* ============================================================
       POPUP EMAIL TIDAK TERDAFTAR — overlay melayang di tengah layar
       ============================================================ */
    .fp-popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        padding: 1rem;
    }

    .fp-popup {
        width: 100%;
        max-width: 340px;
        background: #fff;
        border: 1px solid #eceef1;
        border-radius: 14px;
        box-shadow: 0 24px 64px rgba(16, 24, 40, 0.18);
        padding: 1.8rem 1.6rem 1.6rem;
        text-align: center;
        animation: fpPopupIn 0.18s ease both;
    }

    @keyframes fpPopupIn {
        from { opacity: 0; transform: translateY(8px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .fp-popup-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 0.9rem;
        border-radius: 50%;
        background: #fef2f2;
        color: #dc2626;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fp-popup-title {
        margin: 0 0 0.4rem;
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .fp-popup-text {
        margin: 0;
        font-size: 0.82rem;
        color: #6b7280;
        line-height: 1.55;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .login-card { padding: 2rem 1.5rem 1.6rem; }
        .login-header h2 { font-size: 1.15rem; }
    }
</style>
@endpush

@section('content')
<div class="login-page">

    {{-- ============================================================
         KARTU 1: FORM LOGIN
         ============================================================ --}}
    <div class="login-card" id="loginCard">
        {{-- Header --}}
        <div class="login-header">
            <div class="login-overline">E-PPID · PLN Nusantara Power</div>
            <h2>Selamat Datang</h2>
            <p>Silakan masuk ke panel yang tersedia</p>
        </div>

        {{-- Error alert (server-side) --}}
        @if ($errors->any())
        <div class="alert-pln-error">
            <i class="fas fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        {{-- Notifikasi sukses reset password (diisi via AJAX, tanpa reload) --}}
        <div class="alert-pln-success" id="fpSuccessAlert" style="display:none;">
            <i class="fas fa-circle-check"></i>
            <span id="fpSuccessText"></span>
        </div>

        {{-- Peringatan: link Lupa Password diklik saat email kosong (diisi via JS) --}}
        <div class="alert-pln-warning" id="fpWarningAlert" style="display:none;">
            <i class="fas fa-triangle-exclamation"></i>
            <span>Silakan masukkan email Anda terlebih dahulu pada kolom login!</span>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="field-wrap">
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    type="email"
                    class="form-control-pln"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="nama@contoh.com">
                @error('email')
                <div class="field-error">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Password + link Lupa Password di baris label --}}
            <div class="field-wrap" style="margin-top: 1.1rem;">
                <label for="password" class="form-label">Password</label>
                <div class="input-has-toggle">
                    <input
                        id="password"
                        type="password"
                        class="form-control-pln"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password">
                    <button type="button" class="password-toggle" onclick="togglePassword()" tabindex="-1" aria-label="Tampilkan/sembunyikan password">
                        <i class="fas fa-eye-slash" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                <div class="field-error">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Link Lupa Password — berada di atas tombol Masuk --}}
            <div class="forgot-row">
                <a href="#" id="forgotPasswordLink" class="forgot-link">Lupa Password?</a>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login-pln">Masuk</button>
        </form>

        {{-- Footer --}}
        <div class="login-footer">
            PLN Nusantara Power UP Indramayu 2027
        </div>
    </div>

    {{-- ============================================================
         KARTU 2: FORM RESET PASSWORD (INLINE — tampil menggantikan
         form login pada halaman yang sama, tanpa reload / modal).
         Alur: Lupa Password? → validasi email terisi → sessionStorage
         → tampil kartu ini → OTP dikirim otomatis.
         ============================================================ --}}
    <div class="login-card" id="resetCard" hidden>
        {{-- Header --}}
        <div class="login-header">
            <div class="login-overline">E-PPID · PLN Nusantara Power</div>
            <h2>Atur Password Baru</h2>
            <p>Isi password baru, kirim kode OTP, lalu periksa email Anda</p>
        </div>

        {{-- Info: OTP terkirim / di-restorasi dari sessionStorage --}}
        <div class="fp-info-banner" id="fpInfoBanner">
            <i class="fas fa-circle-info"></i>
            <span id="fpBannerText"></span>
        </div>

        {{-- Kotak error (pengiriman OTP / penyimpanan password) --}}
        <div class="alert-pln-error" id="fpResetError" style="display:none;">
            <i class="fas fa-circle-exclamation"></i>
            <span></span>
        </div>

        <form id="fpResetForm" novalidate>
            {{-- Email — editable: user boleh mengganti email secara manual.
                 Sistem hanya mengirim OTP ke email yang TERDAFTAR; jika
                 tidak terdaftar, popup peringatan ditampilkan. --}}
            <div class="field-wrap">
                <div class="label-row">
                    <label for="fpEmail" class="form-label">Email Terdaftar</label>
                    <button type="button" id="fpBackLink" class="forgot-link">&larr; Kembali ke Login</button>
                </div>
                <input
                    id="fpEmail"
                    type="email"
                    class="form-control-pln"
                    autocomplete="email"
                    placeholder="nama@contoh.com">
            </div>

            {{-- Password baru --}}
            <div class="field-wrap" style="margin-top: 1.1rem;">
                <label for="fpPassword" class="form-label">Kata Sandi Baru</label>
                <div class="input-has-toggle">
                    <input type="password" id="fpPassword" class="form-control-pln" placeholder="Minimal 8 karakter" autocomplete="new-password">
                    <button type="button" id="fpTogglePass" class="password-toggle" tabindex="-1" aria-label="Tampilkan/sembunyikan kata sandi baru">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </div>
            </div>

            {{-- Konfirmasi password --}}
            <div class="field-wrap" style="margin-top: 1.1rem;">
                <label for="fpPasswordConfirm" class="form-label">Konfirmasi Kata Sandi Baru</label>
                <div class="input-has-toggle">
                    <input type="password" id="fpPasswordConfirm" class="form-control-pln" placeholder="Ulangi kata sandi baru" autocomplete="new-password">
                    <button type="button" id="fpTogglePass2" class="password-toggle" tabindex="-1" aria-label="Tampilkan/sembunyikan konfirmasi kata sandi">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </div>
            </div>

            {{-- Kode OTP + tombol kirim manual (OTP tidak dikirim otomatis) --}}
            <div class="field-wrap" style="margin-top: 1.1rem;">
                <label for="fpOtp" class="form-label">Kode OTP (dari Email)</label>
                <input type="text" id="fpOtp" class="form-control-pln fp-otp-input" placeholder="••••••" maxlength="6" inputmode="numeric" autocomplete="one-time-code">
                <button type="button" id="fpBtnSendOtp" class="btn-fp-send">Kirim OTP</button>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login-pln">Simpan Password Baru</button>
        </form>

        {{-- Footer --}}
        <div class="login-footer">
            PLN Nusantara Power UP Indramayu 2027
        </div>
    </div>

    {{-- ============================================================
         POPUP: EMAIL TIDAK TERDAFTAR — tampil saat Kirim OTP ditolak
         server (404). Custom overlay, senada tema kartu login.
         ============================================================ --}}
    <div class="fp-popup-overlay" id="fpPopupOverlay" hidden>
        <div class="fp-popup" role="alertdialog" aria-modal="true" aria-labelledby="fpPopupTitle">
            <div class="fp-popup-icon">
                <i class="fas fa-circle-exclamation"></i>
            </div>
            <h6 class="fp-popup-title" id="fpPopupTitle">Email Tidak Terdaftar</h6>
            <p class="fp-popup-text" id="fpPopupText"></p>
            <button type="button" id="fpPopupOk" class="btn-login-pln" style="margin-top: 1.2rem;">Mengerti</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        var field = document.getElementById('password');
        var icon = document.getElementById('toggleIcon');
        // Konvensi: password tersembunyi = eye-slash, terlihat = eye
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>
@endpush

@push('scripts')
<script>
    /* ============================================================
       LUPA PASSWORD — Inline 2 view (tanpa reload, tanpa modal).
       View A: form login. View B: form reset password.
       Alur:
       - Link "Lupa Password?" + email kosong → warning + auto-focus email.
       - Email terisi → simpan ke sessionStorage → tampilkan form reset
         (OTP BELUM dikirim di titik ini).
       - Tombol "Kirim OTP" di bagian form OTP → kirim OTP (AJAX)
         → countdown 60 detik pada tombol (label jadi "Kirim ulang OTP").
       - Refresh halaman → state dipulihkan dari sessionStorage
         (form reset tetap tampil, tombol Kirim OTP tersedia).
       CSRF diinjeksi langsung dari Blade
       (layouts.app tidak menyediakan meta csrf-token).
       ============================================================ */
    document.addEventListener('DOMContentLoaded', function () {
        var FP_URL_SEND   = "{{ route('password.otp.send') }}";
        var FP_URL_RESET  = "{{ route('password.reset') }}";
        var FP_CSRF       = "{{ csrf_token() }}";
        var FP_STORAGE_KEY = 'fp_email';

        /* ---- Elemen form login (View A) ---- */
        var loginCard   = document.getElementById('loginCard');
        var linkOpen    = document.getElementById('forgotPasswordLink');
        var loginEmail  = document.getElementById('email');
        var warnBox     = document.getElementById('fpWarningAlert');
        var successBox  = document.getElementById('fpSuccessAlert');
        var successTxt  = document.getElementById('fpSuccessText');

        /* ---- Elemen form reset (View B) ---- */
        var resetCard   = document.getElementById('resetCard');
        var inputEmail  = document.getElementById('fpEmail');
        var inputPass   = document.getElementById('fpPassword');
        var inputPass2  = document.getElementById('fpPasswordConfirm');
        var inputOtp    = document.getElementById('fpOtp');
        var errBox      = document.getElementById('fpResetError');
        var bannerText  = document.getElementById('fpBannerText');
        var btnBack     = document.getElementById('fpBackLink');
        var btnSendOtp  = document.getElementById('fpBtnSendOtp');
        var resetForm   = document.getElementById('fpResetForm');

        /* ---- Elemen popup email tidak terdaftar ---- */
        var popupOverlay = document.getElementById('fpPopupOverlay');
        var popupText    = document.getElementById('fpPopupText');
        var popupOk      = document.getElementById('fpPopupOk');

        var fpCountdown = null;
        var fpOtpSent   = false; // true setelah OTP sukses dikirim minimal sekali
        var fpOtpEmail  = null;  // email yang terakhir sukses dikirim OTP

        /* ---- Toggle lihat/sembunyikan password (field form reset). ---- */
        function fpBindToggle(btnId, inputId) {
            var btn = document.getElementById(btnId);
            var input = document.getElementById(inputId);
            if (!btn || !input) return;
            var icon = btn.querySelector('i');
            btn.addEventListener('click', function () {
                var akanTerlihat = input.type === 'password';
                input.type = akanTerlihat ? 'text' : 'password';
                // Konvensi: tersembunyi = eye-slash, terlihat = eye
                icon.classList.toggle('fa-eye', akanTerlihat);
                icon.classList.toggle('fa-eye-slash', !akanTerlihat);
            });
        }
        fpBindToggle('fpTogglePass', 'fpPassword');
        fpBindToggle('fpTogglePass2', 'fpPasswordConfirm');

        function fpShowError(msg) {
            errBox.querySelector('span').textContent = msg;
            errBox.style.display = 'flex';
        }

        function fpHideErrors() {
            errBox.style.display = 'none';
        }

        /* ---- Popup email tidak terdaftar ---- */
        function fpShowPopup(msg) {
            popupText.textContent = msg;
            popupOverlay.hidden = false;
        }

        function fpHidePopup() {
            popupOverlay.hidden = true;
        }

        function fpSetLoading(btn, loading, label) {
            btn.disabled = loading;
            btn.innerHTML = loading
                ? '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...'
                : label;
        }

        function fpPostJson(url, payload) {
            return fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': FP_CSRF,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(payload)
            }).then(function (res) {
                return res.json().catch(function () { return {}; }).then(function (data) {
                    return { ok: res.ok, status: res.status, data: data };
                });
            });
        }

        /* ---- Countdown kirim ulang OTP (detik) pada tombol Kirim OTP. ---- */
        function fpStartCountdown(seconds) {
            var left = seconds;
            btnSendOtp.disabled = true;
            clearInterval(fpCountdown);
            fpCountdown = setInterval(function () {
                left--;
                if (left <= 0) {
                    clearInterval(fpCountdown);
                    btnSendOtp.disabled = false;
                    btnSendOtp.textContent = 'Kirim ulang OTP';
                } else {
                    btnSendOtp.textContent = 'Kirim ulang OTP (' + left + 's)';
                }
            }, 1000);
            btnSendOtp.textContent = 'Kirim ulang OTP (' + left + 's)';
        }

        /* ---- Transisi antar view ---- */
        function fpShowReset(email) {
            fpHideErrors();
            fpHidePopup();
            warnBox.style.display = 'none';
            fpOtpSent = false;
            fpOtpEmail = null;
            clearInterval(fpCountdown);

            inputEmail.value = email;
            inputPass.value = '';
            inputPass2.value = '';
            inputOtp.value = '';
            // Kembalikan toggle mata ke posisi tersembunyi.
            inputPass.type = 'password';
            inputPass2.type = 'password';
            document.querySelectorAll('#resetCard .password-toggle i').forEach(function (ic) {
                ic.classList.add('fa-eye-slash');
                ic.classList.remove('fa-eye');
            });

            // OTP belum dikirim — tombol siap, banner memandu user.
            btnSendOtp.disabled = false;
            btnSendOtp.textContent = 'Kirim OTP';
            bannerText.textContent = 'Klik tombol "Kirim OTP" di bawah kolom kode OTP untuk menerima kode verifikasi melalui email.';

            loginCard.hidden = true;
            resetCard.hidden = false;
            resetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Fokus ke field pertama yang bisa diisi.
            setTimeout(function () { inputPass.focus(); }, 150);
        }

        function fpShowLogin(prefillEmail) {
            clearInterval(fpCountdown);
            fpHideErrors();
            btnSendOtp.disabled = false;
            btnSendOtp.textContent = 'Kirim OTP';

            resetCard.hidden = true;
            loginCard.hidden = false;
            loginCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

            if (prefillEmail) {
                loginEmail.value = prefillEmail;
            }
        }

        /* ---- Kirim OTP — manual, dipicu tombol di bagian form OTP ---- */
        function fpRequestOtp() {
            var email = inputEmail.value.trim();
            if (!email || email.indexOf('@') === -1) {
                fpShowError('Masukkan alamat email yang valid.');
                return;
            }

            fpHideErrors();
            btnSendOtp.disabled = true;
            btnSendOtp.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim OTP...';

            fpPostJson(FP_URL_SEND, { email: email }).then(function (r) {
                if (r.ok) {
                    fpOtpSent = true;
                    fpOtpEmail = email;
                    // Pesan server sudah memuat email ter-mask (a***b@domain.com) + masa berlaku.
                    bannerText.textContent = (r.data.message || 'Kode OTP telah dikirim ke ' + email + '. Berlaku 10 menit.') +
                        ' Masukkan kode OTP di kolom bawah.';
                    fpStartCountdown(60);
@if (app()->environment('local', 'development'))
                    if (r.data.debug_token) {
                        console.info('[DEV] Kode OTP:', r.data.debug_token);
                    }
@endif
                } else if (r.status === 404) {
                    // Email tidak terdaftar → popup (permintaan user).
                    fpShowPopup(r.data.message || 'Email tidak terdaftar pada sistem. Periksa kembali penulisan email Anda.');
                    btnSendOtp.disabled = false;
                    btnSendOtp.textContent = fpOtpSent ? 'Kirim ulang OTP' : 'Kirim OTP';
                } else {
                    fpShowError(r.data.message || 'Gagal mengirim OTP. Silakan coba lagi.');
                    // 429 "Terlalu sering ... dalam N detik" → jalankan countdown sesuai pesan.
                    var m = (r.data.message || '').match(/dalam\s+(\d+)\s+detik/i);
                    fpStartCountdown(m ? parseInt(m[1], 10) : 60);
                }
            }).catch(function () {
                fpShowError('Terjadi kesalahan jaringan. Silakan coba lagi.');
                btnSendOtp.disabled = false;
                btnSendOtp.textContent = fpOtpSent ? 'Kirim ulang OTP' : 'Kirim OTP';
            });
        }

        /* ---- Simpan password baru ---- */
        function fpSubmitReset() {
            var email = inputEmail.value.trim();
            var pass  = inputPass.value;
            var pass2 = inputPass2.value;
            var otp   = inputOtp.value.trim();

            if (!email || email.indexOf('@') === -1) {
                fpShowError('Masukkan alamat email yang valid.');
                return;
            }
            if (!fpOtpSent && !otp) {
                fpShowError('Kode OTP belum dikirim. Klik tombol "Kirim OTP" terlebih dahulu.');
                return;
            }
            if (pass.length < 8) {
                fpShowError('Password baru minimal 8 karakter.');
                return;
            }
            if (pass !== pass2) {
                fpShowError('Konfirmasi password tidak cocok.');
                return;
            }
            if (!/^\d{6}$/.test(otp)) {
                fpShowError('Kode OTP harus 6 digit angka.');
                return;
            }

            fpHideErrors();
            var submitBtn = resetForm.querySelector('button[type="submit"]');
            var submitLabel = submitBtn.textContent;
            fpSetLoading(submitBtn, true, submitLabel);

            fpPostJson(FP_URL_RESET, {
                email: email,
                password: pass,
                password_confirmation: pass2,
                otp: otp
            }).then(function (r) {
                if (r.ok) {
                    // Bersihkan state → kembali ke form login dengan notifikasi sukses.
                    sessionStorage.removeItem(FP_STORAGE_KEY);
                    fpShowLogin(inputEmail.value.trim());

                    successTxt.textContent = r.data.message || 'Password berhasil diperbarui. Silakan masuk dengan password baru Anda.';
                    successBox.style.display = 'flex';
                    successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    fpShowError(r.data.message || 'Gagal menyimpan password. Silakan coba lagi.');
                }
            }).catch(function () {
                fpShowError('Terjadi kesalahan jaringan. Silakan coba lagi.');
            }).finally(function () {
                fpSetLoading(submitBtn, false, submitLabel);
            });
        }

        /* ============================================================
           EVENT BINDING
           ============================================================ */

        // Link "Lupa Password?" — validasi email login dulu.
        linkOpen.addEventListener('click', function (e) {
            e.preventDefault();
            successBox.style.display = 'none';

            var email = loginEmail.value.trim();
            if (!email || email.indexOf('@') === -1) {
                // Email kosong / tidak valid → peringatan + auto-focus ke field email login.
                warnBox.style.display = 'flex';
                loginEmail.focus();
                return;
            }

            warnBox.style.display = 'none';
            // Simpan email agar state bertahan saat halaman di-refresh.
            sessionStorage.setItem(FP_STORAGE_KEY, email);
            // OTP belum dikirim di sini — dikirim saat tombol "Kirim OTP" ditekan.
            fpShowReset(email);
        });

        // Peringatan hilang begitu user mulai mengetik email.
        loginEmail.addEventListener('input', function () {
            warnBox.style.display = 'none';
        });

        // Kembali ke form login (ganti email) — buang state tersimpan.
        btnBack.addEventListener('click', function () {
            sessionStorage.removeItem(FP_STORAGE_KEY);
            fpShowLogin(inputEmail.value.trim());
        });

        // Kirim OTP dari tombol di bagian form OTP (manual, bukan otomatis).
        btnSendOtp.addEventListener('click', fpRequestOtp);

        // Email editable: sinkronkan sessionStorage + invalidasi OTP lama
        // bila user mengganti email secara manual.
        inputEmail.addEventListener('input', function () {
            var val = inputEmail.value.trim();
            if (val && val.indexOf('@') !== -1) {
                sessionStorage.setItem(FP_STORAGE_KEY, val);
            }

            // Email berubah → OTP yang terkirim ke email sebelumnya tidak
            // lagi relevan; reset status agar user klik "Kirim OTP" lagi.
            if (fpOtpEmail && val !== fpOtpEmail) {
                fpOtpSent = false;
                fpOtpEmail = null;
                clearInterval(fpCountdown);
                btnSendOtp.disabled = false;
                btnSendOtp.textContent = 'Kirim OTP';
                bannerText.textContent = 'Email diubah. Klik tombol "Kirim OTP" untuk menerima kode verifikasi ke email tersebut.';
            }
        });

        // Popup: tutup via tombol, klik backdrop, atau tombol Escape.
        popupOk.addEventListener('click', fpHidePopup);
        popupOverlay.addEventListener('click', function (e) {
            if (e.target === this) fpHidePopup();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !popupOverlay.hidden) fpHidePopup();
        });

        // Submit form reset (tombol maupun Enter di dalam form).
        resetForm.addEventListener('submit', function (e) {
            e.preventDefault();
            fpSubmitReset();
        });

        // Filter input OTP: hanya digit, maksimal 6.
        inputOtp.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });

        /* ============================================================
           RESTORASI STATE — refresh halaman saat berada di form reset:
           email dibaca dari sessionStorage dan form reset tetap tampil.
           OTP TIDAK dikirim ulang otomatis (hindari spam / 429 cooldown);
           user memakai link "Kirim ulang OTP" bila perlu.
           ============================================================ */
        (function fpRestore() {
            var saved = sessionStorage.getItem(FP_STORAGE_KEY);
            if (saved) {
                fpShowReset(saved);
                // Bisa jadi OTP sebelumnya masih berlaku (10 menit) — user bisa
                // langsung mengisi, atau klik "Kirim OTP" bila belum/kadaluarsa.
            }
        })();
    });
</script>
@endpush
