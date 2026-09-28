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
    .alert-pln-success {
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
       MODAL LUPA PASSWORD — senada dengan tema minimalis
       ============================================================ */
    .modal-fp .modal-content {
        border: 1px solid #eceef1;
        border-radius: 14px;
        box-shadow: 0 24px 64px rgba(16, 24, 40, 0.18);
    }

    .modal-fp .modal-header {
        border-bottom: none;
        padding: 1.4rem 1.6rem 0;
    }

    .modal-fp .modal-title {
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: -0.01em;
        color: #111827;
    }

    .modal-fp .btn-close {
        --bs-btn-close-focus-shadow: 0 0 0 3px rgba(0, 143, 168, 0.15);
    }

    .modal-fp .modal-body { padding: 1.1rem 1.6rem 0.4rem; }

    .modal-fp .modal-footer {
        border-top: none;
        padding: 0.6rem 1.6rem 1.6rem;
    }

    .fp-hint {
        font-size: 0.82rem;
        color: #6b7280;
        line-height: 1.55;
        margin: 0 0 1.2rem;
    }

    .fp-field { margin-bottom: 0.25rem; }

    .fp-field + .fp-field { margin-top: 1rem; }

    .btn-fp-primary {
        width: 100%;
        background: var(--pln-blue);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.72rem;
        font-weight: 600;
        font-size: 0.88rem;
        transition: background 0.15s ease, transform 0.1s ease;
    }

    .btn-fp-primary:hover {
        background: #007a90;
        color: #fff;
    }

    .btn-fp-primary:active { transform: translateY(1px); }

    .btn-fp-primary:disabled {
        opacity: 0.65;
        cursor: not-allowed;
    }

    .fp-otp-input {
        letter-spacing: 0.55rem;
        text-align: center;
        font-size: 1.2rem;
        font-weight: 700;
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

    .fp-resend {
        text-align: center;
        margin-top: 1.2rem;
        font-size: 0.78rem;
        color: #6b7280;
    }

    .fp-link {
        background: none;
        border: none;
        padding: 0;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--pln-blue);
        text-decoration: none;
        cursor: pointer;
    }

    .fp-link:hover:not(:disabled) {
        color: #111827;
        text-decoration: underline;
    }

    .fp-link:disabled {
        color: #b0b7c3;
        cursor: not-allowed;
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
    <div class="login-card">
        {{-- Header --}}
        <div class="login-header">
            <div class="login-overline">E-PPID · PLN Nusantara Power</div>
            <h2>Selamat Datang</h2>
            <p>Silakan masuk ke panel yang tersedia</p>
        </div>

        {{-- Error alert --}}
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
                <div class="label-row">
                    <label for="password" class="form-label">Password</label>
                    <a href="#" id="forgotPasswordLink" class="forgot-link">Lupa Password?</a>
                </div>
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

            {{-- Submit --}}
            <button type="submit" class="btn-login-pln">Masuk</button>
        </form>

        {{-- Footer --}}
        <div class="login-footer">
            PLN Nusantara Power UP Indramayu 2027
        </div>
    </div>
</div>

{{-- ============================================================
     MODAL LUPA PASSWORD — 2 langkah AJAX tanpa reload:
     Langkah 1: input email → Kirim OTP
     Langkah 2: password baru + konfirmasi → kode OTP (di bawah)
     ============================================================ --}}
<div class="modal fade modal-fp" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">
                    <span id="fpModalTitle">Lupa Password</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                {{-- LANGKAH 1: input email terdaftar --}}
                <div id="fpStepEmail">
                    <p class="fp-hint">
                        Masukkan email terdaftar Anda. Kode OTP akan dikirim ke email tersebut.
                    </p>
                    <div class="fp-field">
                        <label for="fpEmail" class="form-label">Email Terdaftar</label>
                        <input type="email" id="fpEmail" class="form-control-pln" placeholder="nama@contoh.com" autocomplete="email">
                    </div>
                    <div class="field-error" id="fpEmailError" style="display:none;">
                        <i class="fas fa-exclamation-circle"></i> <span></span>
                    </div>
                </div>

                {{-- LANGKAH 2: password baru + kode OTP --}}
                <div id="fpStepReset" style="display:none;">
                    <div class="fp-info-banner">
                        <i class="fas fa-circle-info"></i>
                        <span>Kode OTP telah dikirim ke <strong id="fpSentEmail"></strong>. Isi password baru Anda, lalu masukkan kode OTP dari email di bagian bawah.</span>
                    </div>

                    <div class="fp-field">
                        <label for="fpPassword" class="form-label">Kata Sandi Baru</label>
                        <div class="input-has-toggle">
                            <input type="password" id="fpPassword" class="form-control-pln" placeholder="Minimal 8 karakter" autocomplete="new-password">
                            <button type="button" id="fpTogglePass" class="password-toggle" tabindex="-1" aria-label="Tampilkan/sembunyikan kata sandi baru">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="fp-field">
                        <label for="fpPasswordConfirm" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <div class="input-has-toggle">
                            <input type="password" id="fpPasswordConfirm" class="form-control-pln" placeholder="Ulangi kata sandi baru" autocomplete="new-password">
                            <button type="button" id="fpTogglePass2" class="password-toggle" tabindex="-1" aria-label="Tampilkan/sembunyikan konfirmasi kata sandi">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="fp-field">
                        <label for="fpOtp" class="form-label">Kode OTP (dari Email)</label>
                        <input type="text" id="fpOtp" class="form-control-pln fp-otp-input" placeholder="••••••" maxlength="6" inputmode="numeric" autocomplete="one-time-code">
                    </div>

                    <div class="field-error" id="fpResetError" style="display:none;">
                        <i class="fas fa-exclamation-circle"></i> <span></span>
                    </div>

                    <div class="fp-resend">
                        Tidak menerima kode?
                        <button type="button" id="fpBtnResend" class="fp-link">Kirim ulang OTP</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="fpBtnSendOtp" class="btn-fp-primary">Kirim OTP</button>
                <button type="button" id="fpBtnReset" class="btn-fp-primary" style="display:none;">Simpan Password Baru</button>
            </div>
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
       LUPA PASSWORD — AJAX 2 langkah (Email → OTP + Password Baru)
       Tanpa reload halaman. CSRF diinjeksi langsung dari Blade
       (layouts.app tidak menyediakan meta csrf-token).
       ============================================================ */
    document.addEventListener('DOMContentLoaded', function () {
        var FP_URL_SEND  = "{{ route('password.otp.send') }}";
        var FP_URL_RESET = "{{ route('password.reset') }}";
        var FP_CSRF      = "{{ csrf_token() }}";

        var modalEl  = document.getElementById('forgotPasswordModal');
        if (!modalEl) return;

        var linkOpen   = document.getElementById('forgotPasswordLink');
        var stepEmail  = document.getElementById('fpStepEmail');
        var stepReset  = document.getElementById('fpStepReset');
        var inputEmail = document.getElementById('fpEmail');
        var inputPass  = document.getElementById('fpPassword');
        var inputPass2 = document.getElementById('fpPasswordConfirm');
        var inputOtp   = document.getElementById('fpOtp');
        var errEmail   = document.getElementById('fpEmailError');
        var errReset   = document.getElementById('fpResetError');
        var btnSend    = document.getElementById('fpBtnSendOtp');
        var btnReset   = document.getElementById('fpBtnReset');
        var btnResend  = document.getElementById('fpBtnResend');
        var sentEmail  = document.getElementById('fpSentEmail');
        var modalTitle = document.getElementById('fpModalTitle');
        var successBox = document.getElementById('fpSuccessAlert');
        var successTxt = document.getElementById('fpSuccessText');

        var fpCountdown = null;

        /* Toggle lihat/sembunyikan password (dipakai field di modal). */
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

        function fpShowError(box, msg) {
            box.querySelector('span').textContent = msg;
            box.style.display = 'flex';
        }

        function fpHideErrors() {
            errEmail.style.display = 'none';
            errReset.style.display = 'none';
        }

        /* Kotak error aktif mengikuti langkah yang sedang tampil. */
        function fpActiveErrorBox() {
            return stepReset.style.display !== 'none' ? errReset : errEmail;
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

        function fpShowStep(step) {
            fpHideErrors();
            if (step === 1) {
                stepEmail.style.display = '';
                stepReset.style.display = 'none';
                btnSend.style.display = '';
                btnReset.style.display = 'none';
                modalTitle.textContent = 'Lupa Password';
            } else {
                stepEmail.style.display = 'none';
                stepReset.style.display = '';
                btnSend.style.display = 'none';
                btnReset.style.display = '';
                modalTitle.textContent = 'Atur Password Baru';
            }
        }

        function fpStartCountdown(seconds) {
            var left = seconds;
            btnResend.disabled = true;
            clearInterval(fpCountdown);
            fpCountdown = setInterval(function () {
                left--;
                if (left <= 0) {
                    clearInterval(fpCountdown);
                    btnResend.disabled = false;
                    btnResend.textContent = 'Kirim ulang OTP';
                } else {
                    btnResend.textContent = 'Kirim ulang OTP (' + left + 's)';
                }
            }, 1000);
            btnResend.textContent = 'Kirim ulang OTP (' + left + 's)';
        }

        function fpRequestOtp() {
            var email = inputEmail.value.trim();
            if (!email || email.indexOf('@') === -1) {
                fpShowError(errEmail, 'Masukkan alamat email yang valid.');
                return;
            }

            fpHideErrors();
            fpSetLoading(btnSend, true, 'Kirim OTP');
            if (!btnResend.disabled) {
                btnResend.disabled = true;
                btnResend.textContent = 'Kirim ulang OTP';
            }

            fpPostJson(FP_URL_SEND, { email: email }).then(function (r) {
                if (r.ok) {
                    sentEmail.textContent = email;
                    fpShowStep(2);
                    fpStartCountdown(60);
@if (app()->environment('local', 'development'))
                    if (r.data.debug_token) {
                        console.info('[DEV] Kode OTP:', r.data.debug_token);
                    }
@endif
                } else {
                    fpShowError(fpActiveErrorBox(), r.data.message || 'Gagal mengirim OTP. Silakan coba lagi.');
                    if (stepReset.style.display !== 'none') {
                        btnResend.disabled = false;
                        btnResend.textContent = 'Kirim ulang OTP';
                    }
                }
            }).catch(function () {
                fpShowError(fpActiveErrorBox(), 'Terjadi kesalahan jaringan. Silakan coba lagi.');
                if (stepReset.style.display !== 'none') {
                    btnResend.disabled = false;
                    btnResend.textContent = 'Kirim ulang OTP';
                }
            }).finally(function () {
                fpSetLoading(btnSend, false, 'Kirim OTP');
            });
        }

        function fpSubmitReset() {
            var pass  = inputPass.value;
            var pass2 = inputPass2.value;
            var otp   = inputOtp.value.trim();

            if (pass.length < 8) {
                fpShowError(errReset, 'Password baru minimal 8 karakter.');
                return;
            }
            if (pass !== pass2) {
                fpShowError(errReset, 'Konfirmasi password tidak cocok.');
                return;
            }
            if (!/^\d{6}$/.test(otp)) {
                fpShowError(errReset, 'Kode OTP harus 6 digit angka.');
                return;
            }

            fpHideErrors();
            fpSetLoading(btnReset, true, 'Simpan Password Baru');

            fpPostJson(FP_URL_RESET, {
                email: inputEmail.value.trim(),
                password: pass,
                password_confirmation: pass2,
                otp: otp
            }).then(function (r) {
                if (r.ok) {
                    // Tutup modal, tampilkan notifikasi sukses di halaman login.
                    var inst = bootstrap.Modal.getInstance(modalEl);
                    if (inst) inst.hide();

                    successTxt.textContent = r.data.message || 'Password berhasil diperbarui. Silakan masuk dengan password baru Anda.';
                    successBox.style.display = 'flex';
                    successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else if (r.status === 422 && r.data.errors && r.data.errors.otp) {
                    fpShowError(errReset, r.data.errors.otp[0]);
                } else {
                    fpShowError(errReset, r.data.message || 'Gagal menyimpan password. Silakan coba lagi.');
                }
            }).catch(function () {
                fpShowError(errReset, 'Terjadi kesalahan jaringan. Silakan coba lagi.');
            }).finally(function () {
                fpSetLoading(btnReset, false, 'Simpan Password Baru');
            });
        }

        function fpResetModal() {
            clearInterval(fpCountdown);
            inputEmail.value = '';
            inputPass.value = '';
            inputPass2.value = '';
            inputOtp.value = '';
            // Kembalikan toggle mata ke posisi tersembunyi.
            inputPass.type = 'password';
            inputPass2.type = 'password';
            document.querySelectorAll('#fpStepReset .password-toggle i').forEach(function (ic) {
                ic.classList.add('fa-eye-slash');
                ic.classList.remove('fa-eye');
            });
            fpHideErrors();
            fpShowStep(1);
            fpSetLoading(btnSend, false, 'Kirim OTP');
            fpSetLoading(btnReset, false, 'Simpan Password Baru');
            btnResend.disabled = false;
            btnResend.textContent = 'Kirim ulang OTP';
        }

        linkOpen.addEventListener('click', function (e) {
            e.preventDefault();
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        });

        btnSend.addEventListener('click', fpRequestOtp);
        btnReset.addEventListener('click', fpSubmitReset);
        btnResend.addEventListener('click', fpRequestOtp);

        inputOtp.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });

        inputEmail.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') { e.preventDefault(); fpRequestOtp(); }
        });

        modalEl.addEventListener('shown.bs.modal', function () {
            (stepEmail.style.display !== 'none' ? inputEmail : inputOtp).focus();
        });

        modalEl.addEventListener('hidden.bs.modal', function () {
            // Buang instance internal agar modal selalu bisa dibuka ulang
            // dengan state bersih (form kembali ke langkah 1).
            try {
                var inst = bootstrap.Modal.getInstance(modalEl);
                if (inst) inst.dispose();
            } catch (err) { /* abaikan */ }
            fpResetModal();
        });
    });
</script>
@endpush
