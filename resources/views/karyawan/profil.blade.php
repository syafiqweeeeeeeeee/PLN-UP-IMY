@extends('layouts.karyawan')

@section('title', 'Profil Saya — Portal Karyawan')

@section('content')

    <div class="kry-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a> &nbsp;/&nbsp; Profil Saya
    </div>

    <div class="kry-page-head">
        <h1>Profil Saya</h1>
        <p>Perbarui data diri dan kata sandi akun Anda. Email tidak dapat diubah — hubungi administrator bila diperlukan.</p>
    </div>

    <div class="kry-profile-grid">

        {{-- Kartu identitas --}}
        <aside class="kry-card kry-profile-side">
            <div class="kry-profile-avatar">{{ $karyawanUser['initials'] }}</div>
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
            <span class="kry-role-badge">{{ $user->role ?? 'Karyawan' }}</span>

            <hr class="kry-divider" style="width:100%;">

            <div style="text-align:left; font-size:0.84rem; color:#64748b; display:flex; flex-direction:column; gap:10px;">
                <span><i class="fas fa-phone" style="width:18px; color:#008fa8;"></i>
                    {{ $user->no_hp ?? 'Belum ada nomor HP' }}</span>
                <span><i class="fas fa-location-dot" style="width:18px; color:#008fa8;"></i>
                    {{ $user->alamat ?? 'Belum ada alamat' }}</span>
                <span><i class="fas fa-calendar" style="width:18px; color:#008fa8;"></i>
                    Terdaftar {{ $user->created_at?->translatedFormat('d F Y') }}</span>
            </div>
        </aside>

        {{-- Form profil --}}
        <section class="kry-card kry-profile-form">
            <h3><i class="fas fa-user-pen"></i> Edit Profil Saya</h3>

            <form method="POST" action="{{ route('karyawan.profil.update') }}">
                @csrf
                @method('PUT')

                <div class="kry-field">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="kry-input"
                           value="{{ old('name', $user->name) }}" required maxlength="255">
                    @error('name')
                        <div class="kry-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="kry-field">
                    <label for="email">Email <small>(tidak dapat diubah)</small></label>
                    <input type="email" id="email" class="kry-input" value="{{ $user->email }}" disabled>
                </div>

                <div class="kry-field">
                    <label for="no_hp">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" class="kry-input"
                           value="{{ old('no_hp', $user->no_hp) }}" maxlength="20" placeholder="08xx-xxxx-xxxx">
                    @error('no_hp')
                        <div class="kry-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="kry-field">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" class="kry-input" rows="3"
                              maxlength="500" placeholder="Alamat domisili">{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat')
                        <div class="kry-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <hr class="kry-divider">

                <h3><i class="fas fa-lock"></i> Ganti Kata Sandi <small style="font-weight:500; color:#64748b;">(opsional)</small></h3>

                <div class="kry-field">
                    <label for="current_password">Kata Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="kry-input"
                           autocomplete="current-password" placeholder="Wajib diisi bila mengganti kata sandi">
                    @error('current_password')
                        <div class="kry-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="kry-field">
                    <label for="password">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" class="kry-input"
                           autocomplete="new-password" minlength="8" placeholder="Minimal 8 karakter">
                    @error('password')
                        <div class="kry-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="kry-field">
                    <label for="password_confirmation">Ulangi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="kry-input"
                           autocomplete="new-password" placeholder="Ulangi kata sandi baru">
                </div>

                <button type="submit" class="kry-btn-primary">
                    <i class="fas fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </form>
        </section>
    </div>

@endsection
