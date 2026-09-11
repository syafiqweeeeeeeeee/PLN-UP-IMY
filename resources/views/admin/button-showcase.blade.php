@extends('layouts.admin')

@section('title', 'Corporate Button Set — E-PPID PLN')
@section('page-title', 'Corporate Button Set')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div>
                    <h5 class="dash-card-title">Set Tombol Korporat</h5>
                    <p class="dash-card-subtitle">Koleksi tombol UI/UX modern, responsif, material design dengan sudut melengkung</p>
                </div>
            </div>

            {{-- ==========================================
                 1. COLOR PALETTE
                 ========================================== --}}
            <div class="showcase-section">
                <div class="showcase-section-title"><i class="fas fa-palette me-1"></i> Palette Warna</div>
                <div class="showcase-section-desc">Warna konsisten untuk seluruh tombol korporat</div>

                <div class="showcase-palette">
                    <div class="palette-card">
                        <div class="palette-swatch" style="background: #035B71;">#035B71</div>
                        <div class="palette-info">
                            <div class="palette-name">Biru Korporat</div>
                            <div class="palette-hex">Login</div>
                        </div>
                    </div>
                    <div class="palette-card">
                        <div class="palette-swatch" style="background: #FF0000;">#FF0000</div>
                        <div class="palette-info">
                            <div class="palette-name">Merah Terang</div>
                            <div class="palette-hex">Logout, Hapus</div>
                        </div>
                    </div>
                    <div class="palette-card">
                        <div class="palette-swatch" style="background: #FFC107; color: #1a1a2e;">#FFC107</div>
                        <div class="palette-info">
                            <div class="palette-name">Kuning Emas Energi</div>
                            <div class="palette-hex">Edit, Tambah</div>
                        </div>
                    </div>
                    <div class="palette-card">
                        <div class="palette-swatch" style="background: #00AFF0;">#00AFF0</div>
                        <div class="palette-info">
                            <div class="palette-name">Cyan Terang</div>
                            <div class="palette-hex">Selengkapnya</div>
                        </div>
                    </div>
                    <div class="palette-card">
                        <div class="palette-swatch" style="background: #f1f5f9; color: #64748b; border-bottom: 1px solid #e2e8f0;">#F1F5F9</div>
                        <div class="palette-info">
                            <div class="palette-name">Abu Netral</div>
                            <div class="palette-hex">Batal</div>
                        </div>
                    </div>
                    <div class="palette-card">
                        <div class="palette-swatch" style="background: #3b82f6; border: 2px solid #93c5fd;">Transparan</div>
                        <div class="palette-info">
                            <div class="palette-name">Ikon Mata</div>
                            <div class="palette-hex">Preview</div>
                        </div>
                    </div>
                    <div class="palette-card">
                        <div class="palette-swatch" style="background: #1e3a5f;">#1E3A5F</div>
                        <div class="palette-info">
                            <div class="palette-name">Biru Tua</div>
                            <div class="palette-hex">Pengguna</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==========================================
                 2. FILLED BUTTONS
                 ========================================== --}}
            <div class="showcase-section">
                <div class="showcase-section-title"><i class="fas fa-square me-1"></i> Tombol Utama (Filled)</div>
                <div class="showcase-section-desc">Tombol berwarna solid dengan bayangan halus dan efek hover material design</div>

                <div class="showcase-row">
                    <span class="showcase-label" style="width:100%;">Login</span>
                    <button class="btn-corp btn-corp-login">
                        <i class="fas fa-arrow-right-to-bracket"></i> Login
                    </button>
                    <button class="btn-corp btn-corp-login btn-corp-sm">
                        <i class="fas fa-arrow-right-to-bracket"></i> Login
                    </button>
                    <button class="btn-corp btn-corp-login btn-corp-lg">
                        <i class="fas fa-arrow-right-to-bracket"></i> Login
                    </button>
                    <button class="btn-corp btn-corp-login" disabled>
                        <i class="fas fa-arrow-right-to-bracket"></i> Login
                    </button>
                </div>

                <div class="showcase-row">
                    <span class="showcase-label" style="width:100%;">Logout & Hapus</span>
                    <button class="btn-corp btn-corp-logout">
                        <i class="fas fa-right-from-bracket"></i> Logout
                    </button>
                    <button class="btn-corp btn-corp-delete">
                        <i class="fas fa-trash-can"></i> Hapus
                    </button>
                    <button class="btn-corp btn-corp-delete btn-corp-sm">
                        <i class="fas fa-trash-can"></i> Hapus
                    </button>
                    <button class="btn-corp btn-corp-logout btn-corp-sm">
                        <i class="fas fa-right-from-bracket"></i> Logout
                    </button>
                </div>

                <div class="showcase-row">
                    <span class="showcase-label" style="width:100%;">Edit & Tambah</span>
                    <button class="btn-corp btn-corp-edit">
                        <i class="fas fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn-corp btn-corp-add">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <button class="btn-corp btn-corp-edit btn-corp-sm">
                        <i class="fas fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn-corp btn-corp-add btn-corp-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>

                <div class="showcase-row">
                    <span class="showcase-label" style="width:100%;">Selengkapnya</span>
                    <button class="btn-corp btn-corp-more">
                        <i class="fas fa-circle-info"></i> Selengkapnya
                    </button>
                    <button class="btn-corp btn-corp-more btn-corp-sm">
                        <i class="fas fa-circle-info"></i> Selengkapnya
                    </button>
                    <button class="btn-corp btn-corp-more btn-corp-lg">
                        <i class="fas fa-circle-info"></i> Selengkapnya
                    </button>
                </div>

                <div class="showcase-row">
                    <span class="showcase-label" style="width:100%;">Batal</span>
                    <button class="btn-corp btn-corp-cancel">
                        <i class="fas fa-xmark"></i> Batal
                    </button>
                    <button class="btn-corp btn-corp-cancel btn-corp-sm">
                        <i class="fas fa-xmark"></i> Batal
                    </button>
                    <button class="btn-corp btn-corp-cancel btn-corp-lg">
                        <i class="fas fa-xmark"></i> Batal
                    </button>
                </div>

                <div class="showcase-row">
                    <span class="showcase-label" style="width:100%;">Preview / Mata</span>
                    <button class="btn-corp btn-corp-preview">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                    <button class="btn-corp btn-corp-preview btn-corp-sm">
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                    <button class="btn-corp btn-corp-preview btn-corp-icon">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="showcase-row">
                    <span class="showcase-label" style="width:100%;">Pengguna</span>
                    <button class="btn-corp btn-corp-user">
                        <i class="fas fa-user-shield"></i> Pengguna
                    </button>
                    <button class="btn-corp btn-corp-user btn-corp-sm">
                        <i class="fas fa-user-shield"></i> Pengguna
                    </button>
                    <button class="btn-corp btn-corp-user btn-corp-icon">
                        <i class="fas fa-user-shield"></i>
                    </button>
                </div>
            </div>

            {{-- ==========================================
                 3. OUTLINE BUTTONS
                 ========================================== --}}
            <div class="showcase-section">
                <div class="showcase-section-title"><i class="fas fa-vector-square me-1"></i> Tombol Outline</div>
                <div class="showcase-section-desc">Versi transparan dengan border berwarna untuk opsi sekunder</div>

                <div class="showcase-row">
                    <button class="btn-corp btn-corp-outline-blue">
                        <i class="fas fa-arrow-right-to-bracket"></i> Login
                    </button>
                    <button class="btn-corp btn-corp-outline-red">
                        <i class="fas fa-trash-can"></i> Hapus
                    </button>
                    <button class="btn-corp btn-corp-outline-yellow">
                        <i class="fas fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn-corp btn-corp-outline-cyan">
                        <i class="fas fa-circle-info"></i> Selengkapnya
                    </button>
                    <button class="btn-corp btn-corp-cancel">
                        <i class="fas fa-xmark"></i> Batal
                    </button>
                </div>

                <div class="showcase-row">
                    <button class="btn-corp btn-corp-outline-blue btn-corp-sm">
                        <i class="fas fa-arrow-right-to-bracket"></i> Login
                    </button>
                    <button class="btn-corp btn-corp-outline-red btn-corp-sm">
                        <i class="fas fa-trash-can"></i> Hapus
                    </button>
                    <button class="btn-corp btn-corp-outline-yellow btn-corp-sm">
                        <i class="fas fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn-corp btn-corp-outline-cyan btn-corp-sm">
                        <i class="fas fa-circle-info"></i> Selengkapnya
                    </button>
                    <button class="btn-corp btn-corp-cancel btn-corp-sm">
                        <i class="fas fa-xmark"></i> Batal
                    </button>
                </div>
            </div>

            {{-- ==========================================
                 4. ICON-ONLY BUTTONS
                 ========================================== --}}
            <div class="showcase-section">
                <div class="showcase-section-title"><i class="fas fa-icons me-1"></i> Tombol Ikon Saja</div>
                <div class="showcase-section-desc">Tombol tanpa teks, hanya ikon — ideal untuk tabel aksi</div>

                <div class="showcase-row">
                    <button class="btn-corp btn-corp-login btn-corp-icon" title="Login">
                        <i class="fas fa-arrow-right-to-bracket"></i>
                    </button>
                    <button class="btn-corp btn-corp-logout btn-corp-icon" title="Logout">
                        <i class="fas fa-right-from-bracket"></i>
                    </button>
                    <button class="btn-corp btn-corp-delete btn-corp-icon" title="Hapus">
                        <i class="fas fa-trash-can"></i>
                    </button>
                    <button class="btn-corp btn-corp-edit btn-corp-icon" title="Edit">
                        <i class="fas fa-pen-to-square"></i>
                    </button>
                    <button class="btn-corp btn-corp-add btn-corp-icon" title="Tambah">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn-corp btn-corp-more btn-corp-icon" title="Selengkapnya">
                        <i class="fas fa-circle-info"></i>
                    </button>
                    <button class="btn-corp btn-corp-cancel btn-corp-icon" title="Batal">
                        <i class="fas fa-xmark"></i>
                    </button>
                    <button class="btn-corp btn-corp-preview btn-corp-icon" title="Preview">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn-corp btn-corp-user btn-corp-icon" title="Pengguna">
                        <i class="fas fa-user-shield"></i>
                    </button>
                </div>

                <div class="showcase-row" style="margin-top: 0.5rem;">
                    <button class="btn-corp btn-corp-login btn-corp-icon btn-corp-sm" title="Login">
                        <i class="fas fa-arrow-right-to-bracket"></i>
                    </button>
                    <button class="btn-corp btn-corp-logout btn-corp-icon btn-corp-sm" title="Logout">
                        <i class="fas fa-right-from-bracket"></i>
                    </button>
                    <button class="btn-corp btn-corp-delete btn-corp-icon btn-corp-sm" title="Hapus">
                        <i class="fas fa-trash-can"></i>
                    </button>
                    <button class="btn-corp btn-corp-edit btn-corp-icon btn-corp-sm" title="Edit">
                        <i class="fas fa-pen-to-square"></i>
                    </button>
                    <button class="btn-corp btn-corp-add btn-corp-icon btn-corp-sm" title="Tambah">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn-corp btn-corp-more btn-corp-icon btn-corp-sm" title="Selengkapnya">
                        <i class="fas fa-circle-info"></i>
                    </button>
                    <button class="btn-corp btn-corp-cancel btn-corp-icon btn-corp-sm" title="Batal">
                        <i class="fas fa-xmark"></i>
                    </button>
                    <button class="btn-corp btn-corp-preview btn-corp-icon btn-corp-sm" title="Preview">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn-corp btn-corp-user btn-corp-icon btn-corp-sm" title="Pengguna">
                        <i class="fas fa-user-shield"></i>
                    </button>
                </div>
            </div>

            {{-- ==========================================
                 5. COMBINED PATTERNS (Table Actions, Form Actions)
                 ========================================== --}}
            <div class="showcase-section">
                <div class="showcase-section-title"><i class="fas fa-layer-group me-1"></i> Pola Penggunaan Umum</div>
                <div class="showcase-section-desc">Contoh kombinasi tombol untuk skenario nyata</div>

                <div class="showcase-label">Form Action Bar</div>
                <div class="showcase-row" style="background: #f8fafc; border-radius: 8px; padding: 1rem; border: 1px dashed #e2e8f0;">
                    <div style="margin-left: auto; display: flex; gap: 0.5rem;">
                        <button class="btn-corp btn-corp-cancel">
                            <i class="fas fa-xmark"></i> Batal
                        </button>
                        <button class="btn-corp btn-corp-edit">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>

                <div class="showcase-label" style="margin-top: 1.25rem;">Table Row Actions</div>
                <div class="showcase-row" style="background: #f8fafc; border-radius: 8px; padding: 1rem; border: 1px dashed #e2e8f0;">
                    <div style="display: flex; gap: 0.35rem;">
                        <button class="btn-corp btn-corp-preview btn-corp-icon btn-corp-sm" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-corp btn-corp-edit btn-corp-icon btn-corp-sm" title="Edit">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn-corp btn-corp-delete btn-corp-icon btn-corp-sm" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <span style="font-size: 0.78rem; color: #9ca3af; margin-left: 0.75rem;">→ Aksi baris tabel dengan ikon-only</span>
                </div>

                <div class="showcase-label" style="margin-top: 1.25rem;">Page Header Action</div>
                <div class="showcase-row" style="background: #f8fafc; border-radius: 8px; padding: 1rem; border: 1px dashed #e2e8f0;">
                    <button class="btn-corp btn-corp-add">
                        <i class="fas fa-plus"></i> Tambah Pengguna
                    </button>
                    <button class="btn-corp btn-corp-cancel btn-corp-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </div>

                <div class="showcase-label" style="margin-top: 1.25rem;">Card Action (Selengkapnya)</div>
                <div class="showcase-row" style="background: #f8fafc; border-radius: 8px; padding: 1rem; border: 1px dashed #e2e8f0;">
                    <a href="#" class="btn-corp btn-corp-more btn-corp-sm">
                        <i class="fas fa-arrow-right"></i> Selengkapnya
                    </a>
                </div>

                <div class="showcase-label" style="margin-top: 1.25rem;">Dark Background (Footer / Sidebar)</div>
                <div class="showcase-dark-bg">
                    <div class="showcase-row">
                        <button class="btn-corp btn-corp-login">
                            <i class="fas fa-arrow-right-to-bracket"></i> Login
                        </button>
                        <button class="btn-corp btn-corp-more">
                            <i class="fas fa-circle-info"></i> Selengkapnya
                        </button>
                        <button class="btn-corp btn-corp-user">
                            <i class="fas fa-user-shield"></i> Pengguna
                        </button>
                        <button class="btn-corp btn-corp-preview">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                    </div>
                </div>
            </div>

            {{-- ==========================================
                 6. CODE REFERENCE
                 ========================================== --}}
            <div class="showcase-section">
                <div class="showcase-section-title"><i class="fas fa-code me-1"></i> Referensi Kode</div>
                <div class="showcase-section-desc">Cara menggunakan kelas tombol di Blade template</div>

                <pre style="background: #1e293b; color: #e2e8f0; padding: 1.25rem; border-radius: 10px; font-size: 0.78rem; line-height: 1.7; overflow-x: auto; margin: 0;"><code>&lt;!-- Tombol Login (Biru Korporat) --&gt;
&lt;button class="btn-corp btn-corp-login"&gt;
    &lt;i class="fas fa-arrow-right-to-bracket"&gt;&lt;/i&gt; Login
&lt;/button&gt;

&lt;!-- Tombol Logout (Merah Terang) --&gt;
&lt;button class="btn-corp btn-corp-logout"&gt;
    &lt;i class="fas fa-right-from-bracket"&gt;&lt;/i&gt; Logout
&lt;/button&gt;

&lt;!-- Tombol Hapus (Merah Terang) --&gt;
&lt;button class="btn-corp btn-corp-delete"&gt;
    &lt;i class="fas fa-trash-can"&gt;&lt;/i&gt; Hapus
&lt;/button&gt;

&lt;!-- Tombol Edit (Kuning Emas Energi) --&gt;
&lt;button class="btn-corp btn-corp-edit"&gt;
    &lt;i class="fas fa-pen-to-square"&gt;&lt;/i&gt; Edit
&lt;/button&gt;

&lt;!-- Tombol Tambah (Kuning Emas Energi) --&gt;
&lt;button class="btn-corp btn-corp-add"&gt;
    &lt;i class="fas fa-plus"&gt;&lt;/i&gt; Tambah
&lt;/button&gt;

&lt;!-- Tombol Selengkapnya (Cyan Terang) --&gt;
&lt;button class="btn-corp btn-corp-more"&gt;
    &lt;i class="fas fa-circle-info"&gt;&lt;/i&gt; Selengkapnya
&lt;/button&gt;

&lt;!-- Tombol Batal (Abu-abu Netral) --&gt;
&lt;button class="btn-corp btn-corp-cancel"&gt;
    &lt;i class="fas fa-xmark"&gt;&lt;/i&gt; Batal
&lt;/button&gt;

&lt;!-- Tombol Preview / Mata (Transparan) --&gt;
&lt;button class="btn-corp btn-corp-preview"&gt;
    &lt;i class="fas fa-eye"&gt;&lt;/i&gt; Preview
&lt;/button&gt;

&lt;!-- Tombol Pengguna (Biru Tua) --&gt;
&lt;button class="btn-corp btn-corp-user"&gt;
    &lt;i class="fas fa-user-shield"&gt;&lt;/i&gt; Pengguna
&lt;/button&gt;

&lt;!-- Ukuran: .btn-corp-sm | .btn-corp-lg --&gt;
&lt;!-- Ikon-only: .btn-corp-icon --&gt;
&lt;!-- Outline: .btn-corp-outline-blue, .btn-corp-outline-red, ... --&gt;</code></pre>
            </div>

        </div>
    </div>
</div>
@endsection
