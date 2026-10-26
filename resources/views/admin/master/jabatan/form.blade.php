@extends('layouts.admin')

@section('title', ($jabatan ? 'Edit Jabatan' : 'Tambah Jabatan') . ' — E-PPID PLN')
@section('page-title', $jabatan ? 'Edit Jabatan' : 'Tambah Jabatan')

@push('styles')
<style>
    /* MASTER JABATAN — form tambah/edit: pilihan bidang + parent
       jabatan berlabel hierarki. Mengikuti Design System Form panel
       admin (global di admin.css). */
    .mj-parent-hint {
        font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;
    }
    .mj-error {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
    .mj-error ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }
    .mj-bidang-empty-warn {
        background: #fffbeb; border: 1px solid #fde68a; color: #92400e;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }

    /* ==== CUSTOM DROPDOWN "BIDANG" (scrollable) =====================
       Select native diganti tombol pemicu + panel daftar opsi:
       - daftar maksimal max-height 200px (≈5–6 baris) + overflow-y auto,
       - sudut panel membulat 8px dengan bayangan lembut,
       - item padding 8px 12px + hover highlight yang halus,
       - TANPA kotak pencarian (fokus hanya pada daftar scrollable).
       Value tersimpan di <input type="hidden" name="bidang_id">. */
    .mj-dd { position: relative; }

    .mj-dd-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.6rem;
        width: 100%;
        text-align: left;
        line-height: 1.4;
        cursor: pointer;
    }
    .mj-dd-trigger:disabled { cursor: not-allowed; opacity: 0.65; }
    .mj-dd-label {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    /* Belum ada pilihan → teks placeholder netral abu muda. */
    .mj-dd-trigger.is-placeholder .mj-dd-label { color: #9ca3af; font-style: italic; }
    .mj-dd-chevron {
        flex-shrink: 0;
        font-size: 0.7rem;
        color: #9ca3af;
        transition: transform 0.18s ease, color 0.18s ease;
    }
    .mj-dd.is-open .mj-dd-chevron { transform: rotate(180deg); color: var(--pln-blue); }
    .mj-dd.is-open .mj-dd-trigger {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.12);
    }

    /* Panel daftar opsi — scrollable, bersih, sudut membulat. */
    .mj-dd-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 1200;
        box-sizing: border-box;
        padding: 6px;
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Batas tinggi ≈ 5–6 opsi + scrollbar vertikal. */
        max-height: 200px;
        overflow-y: auto;
        overscroll-behavior: contain;
        scrollbar-width: thin;
        scrollbar-color: rgba(148, 163, 184, 0.45) transparent;
        animation: mj-dd-in 0.14s ease-out;
    }
    .mj-dd-menu[hidden] { display: none; }
    @keyframes mj-dd-in {
        from { opacity: 0; transform: translateY(-4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    /* Scrollbar tipis & halus (bukan scrollbar bawaan yang tebal). */
    .mj-dd-menu::-webkit-scrollbar { width: 6px; }
    .mj-dd-menu::-webkit-scrollbar-track { background: transparent; }
    .mj-dd-menu::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.45);
        border-radius: 8px;
    }
    .mj-dd-menu::-webkit-scrollbar-thumb:hover { background: rgba(100, 116, 139, 0.6); }

    .mj-dd .dropdown-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        width: 100%;
        padding: 8px 12px;
        border: 0;
        background: transparent;
        border-radius: 6px;
        font-family: inherit;
        font-size: 0.85rem;
        line-height: 1.35;
        color: #1f2937;
        text-align: left;
        cursor: pointer;
        transition: background 0.15s ease, color 0.15s ease;
    }
    .mj-dd .dropdown-option + .dropdown-option { margin-top: 2px; }
    .mj-dd .dropdown-option:hover,
    .mj-dd .dropdown-option:focus-visible {
        background: rgba(0, 91, 156, 0.08);
        color: var(--pln-blue);
        outline: none;
    }
    .mj-dd .dropdown-option.is-selected {
        background: rgba(0, 91, 156, 0.12);
        color: var(--pln-blue);
        font-weight: 600;
    }
    .mj-dd .dropdown-option > span { flex: 1 1 auto; min-width: 0; }
    .mj-dd-check { display: none; font-size: 0.7rem; flex-shrink: 0; }
    .mj-dd .dropdown-option.is-selected .mj-dd-check { display: inline-block; }

    /* Pesan error validasi (server maupun client-side). */
    .mj-dd-error { display: none; }
    .mj-dd-error.is-shown { display: flex; }

    /* Mode gelap admin. */
    html.theme-dark .mj-dd-menu { background: var(--panel); border-color: var(--line); }
    html.theme-dark .mj-dd .dropdown-option { color: var(--ink-heading); }
    html.theme-dark .mj-dd .dropdown-option:hover,
    html.theme-dark .mj-dd .dropdown-option:focus-visible {
        background: rgba(0, 163, 224, 0.12);
        color: var(--pln-cyan);
    }
    html.theme-dark .mj-dd .dropdown-option.is-selected {
        background: rgba(0, 163, 224, 0.14);
        color: var(--pln-cyan);
    }
    html.theme-dark .mj-dd.is-open .mj-dd-trigger {
        border-color: var(--pln-cyan);
        box-shadow: 0 0 0 3px var(--focus-ring);
    }
</style>
@endpush

@section('content')
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.master_jabatan.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $jabatan ? 'Edit Jabatan' : 'Tambah Jabatan Baru' }}</h4>
            <p class="form-page-subtitle">
                {{ $jabatan ? 'Perbarui nama, bidang, atau posisi jabatan dalam hierarki' : 'Buat jabatan baru — pilih bidangnya dan opsional induk jabatan' }}
            </p>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="mj-error" role="alert">
    <i class="fas fa-circle-exclamation"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if ($bidangs->isEmpty())
<div class="mj-bidang-empty-warn" role="alert">
    <i class="fas fa-triangle-exclamation"></i>
    Belum ada data bidang. Tambahkan <b>Master Bidang</b> terlebih dahulu — setiap jabatan wajib berada di bawah satu bidang.
    <a href="{{ route('admin.master_bidang.index') }}" style="font-weight:700; color:#92400e;">Buka Master Bidang →</a>
</div>
@endif

<form action="{{ $jabatan ? route('admin.master_jabatan.update', $jabatan) : route('admin.master_jabatan.store') }}" method="POST">
    @csrf
    @if ($jabatan)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-user-tie"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Jabatan</h6>
                <p class="form-section-desc">Nama jabatan, bidangnya, dan induk jabatannya</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="nama">
                Nama Jabatan <span style="color:#dc2626;">*</span>
            </label>
            <input type="text"
                   id="nama"
                   name="nama"
                   value="{{ old('nama', $jabatan?->nama) }}"
                   class="form-input @error('nama') is-invalid @enderror"
                   placeholder="Contoh: Manajer UP Indramayu"
                   maxlength="100" required>
            @error('nama')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        @php
            /* Nilai terpilih (old input saat error validasi, atau data edit). */
            $selectedId   = (string) old('bidang_id', $jabatan?->bidang_id ?? '');
            $selectedRow  = $bidangs->first(fn ($b) => (string) $b->id === $selectedId);
            $selectedText = $selectedRow
                ? $selectedRow->nama . ($selectedRow->parent_id ? ' (sub-bidang)' : '')
                : '— Pilih bidang tempat jabatan ini berada —';
            $hasBidangError = $errors->has('bidang_id');
        @endphp

        <div class="form-group">
            <label class="form-group-label" for="bidang_id_trigger">
                Bidang <span style="color:#dc2626;">*</span>
            </label>

            {{-- Nilai yang dikirim saat form di-submit — di-update custom dropdown di bawahnya. --}}
            <input type="hidden" name="bidang_id" id="bidang_id" value="{{ $selectedRow?->id ?? '' }}">

            <div class="mj-dd{{ $hasBidangError ? ' is-invalid' : '' }}" id="mj-bidang-dd">
                <button type="button"
                        id="bidang_id_trigger"
                        class="form-input mj-dd-trigger{{ $selectedRow ? '' : ' is-placeholder' }}{{ $hasBidangError ? ' is-invalid' : '' }}"
                        aria-haspopup="listbox"
                        aria-expanded="false"
                        aria-controls="mj-bidang-menu"
                        aria-required="true"
                        {{ $bidangs->isEmpty() ? 'disabled' : '' }}>
                    <span class="mj-dd-label" id="mj-bidang-label">{{ $selectedText }}</span>
                    <i class="fas fa-chevron-down mj-dd-chevron" aria-hidden="true"></i>
                </button>

                {{-- Daftar opsi scrollable: maksimal 200px (±5–6 baris) + scrollbar. --}}
                <div class="custom-dropdown-menu mj-dd-menu" id="mj-bidang-menu" role="listbox"
                     aria-labelledby="bidang_id_trigger" hidden>
                    @foreach ($bidangs as $bidang)
                        @php
                            $optLabel = $bidang->nama . ($bidang->parent_id ? ' (sub-bidang)' : '');
                            $optActive = (string) $bidang->id === (string) $selectedRow?->id;
                        @endphp
                        <button type="button"
                                class="dropdown-option{{ $optActive ? ' is-selected' : '' }}"
                                role="option"
                                aria-selected="{{ $optActive ? 'true' : 'false' }}"
                                data-value="{{ $bidang->id }}"
                                data-label="{{ $optLabel }}">
                            <span>{{ $optLabel }}</span>
                            <i class="fas fa-check mj-dd-check" aria-hidden="true"></i>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="form-error mj-dd-error{{ $hasBidangError ? ' is-shown' : '' }}"
                 id="bidang_id-error" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first('bidang_id', 'Bidang tempat jabatan berada wajib dipilih.') }}</span>
            </div>
            <div class="mj-parent-hint">Daftar bidang dari Master Bidang — pilih salah satu.</div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="parent_id">
                Parent (Induk Jabatan) <span style="color:#9ca3af; font-weight:500;">(opsional)</span>
            </label>
            <select id="parent_id" name="parent_id" class="form-input @error('parent_id') is-invalid @enderror">
                <option value="">— Tingkat atas (tanpa induk jabatan) —</option>
                @foreach ($parents as $row)
                    @php $parentJabatan = $row['node']; @endphp
                    <option value="{{ $parentJabatan->id }}"
                        @selected((string) old('parent_id', $jabatan?->parent_id) === (string) $parentJabatan->id)>
                        {{ str_repeat("\u{00A0}\u{00A0}\u{00A0}", $row['depth']) }}{{ $row['depth'] > 0 ? '└ ' : '' }}{{ $parentJabatan->nama }}{{ $parentJabatan->bidang ? ' — bidang: ' . $parentJabatan->bidang->nama : '' }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="mj-parent-hint">
                Induk jabatan hanya boleh jabatan lain (bukan bidang). Pilihan yang berupa keturunan
                jabatan ini (termasuk jabatan itu sendiri) tidak ditampilkan agar hierarki tidak bersiklus.
            </div>
        </div>
    </div>

    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i>
            Field bertanda <b>*</b> wajib diisi.
        </div>
        <div class="form-footer-actions">
            <a href="{{ route('admin.master_jabatan.index') }}" class="btn-corp btn-corp-soft">Batal</a>
            <button type="submit" class="form-btn-save" @if ($bidangs->isEmpty()) disabled @endif>
                <i class="fas fa-check me-1"></i> {{ $jabatan ? 'Simpan Perubahan' : 'Simpan Jabatan' }}
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    /* CUSTOM DROPDOWN "BIDANG" — daftar opsi scrollable (max-height 200px)
       pengganti <select> native.
       - Klik opsi → value ditulis ke <input type="hidden" name="bidang_id">
         lalu event 'input' + 'change' di-dispatch, jadi submit form tetap
         mengirim bidang_id yang benar (dan listener lain ikut terpanggil).
       - Panel ditutup saat klik di luar / Escape / pindah fokus (Tab).
       - Keyboard: panah atas/bawah berpindah opsi, Enter/Space memilih.
       - Hidden input tidak bisa memakai atribut `required`, jadi validasi
         wajib-pilih dijalankan saat submit (pesan sama dengan server). */
    const wrap = document.getElementById('mj-bidang-dd');
    if (!wrap) return;

    const trigger   = document.getElementById('bidang_id_trigger');
    const menu      = document.getElementById('mj-bidang-menu');
    const hidden    = document.getElementById('bidang_id');
    const label     = document.getElementById('mj-bidang-label');
    const errorBox  = document.getElementById('bidang_id-error');
    const form      = wrap.closest('form');
    const options   = Array.prototype.slice.call(menu.querySelectorAll('.dropdown-option'));

    if (!trigger || !hidden || !options.length) return;

    function setOpen(open) {
        menu.hidden = !open;
        wrap.classList.toggle('is-open', open);
        trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open) {
            const idx = options.findIndex(function (o) { return o.classList.contains('is-selected'); });
            const target = options[idx >= 0 ? idx : 0];
            target.focus();
            target.scrollIntoView({ block: 'nearest' });
        }
    }

    function showError(show) {
        errorBox.classList.toggle('is-shown', show);
        wrap.classList.toggle('is-invalid', show);
        trigger.classList.toggle('is-invalid', show);
    }

    function choose(opt) {
        // Sinkronisasi value form → hidden input bidang_id.
        hidden.value = opt.dataset.value;
        label.textContent = opt.dataset.label || opt.textContent.trim();
        trigger.classList.remove('is-placeholder');

        options.forEach(function (o) {
            const on = o === opt;
            o.classList.toggle('is-selected', on);
            o.setAttribute('aria-selected', on ? 'true' : 'false');
        });

        showError(false);
        hidden.dispatchEvent(new Event('input', { bubbles: true }));
        hidden.dispatchEvent(new Event('change', { bubbles: true }));

        setOpen(false);
        trigger.focus();
    }

    trigger.addEventListener('click', function () { setOpen(menu.hidden); });

    options.forEach(function (opt) {
        opt.addEventListener('click', function () { choose(opt); });
    });

    trigger.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { setOpen(false); return; }
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp' || e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();           // cegah aktivasi native button
            setOpen(true);
            if (e.key === 'ArrowUp') options[options.length - 1].focus();
        }
    });

    menu.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            e.preventDefault();
            setOpen(false);
            trigger.focus();
            return;
        }
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();
            const i = options.indexOf(document.activeElement);
            const next = e.key === 'ArrowDown'
                ? Math.min(i + 1, options.length - 1)
                : Math.max(i - 1, 0);
            options[next].focus();
            options[next].scrollIntoView({ block: 'nearest' });
        }
    });

    // Klik di luar dropdown → tutup panel.
    document.addEventListener('mousedown', function (e) {
        if (!menu.hidden && !wrap.contains(e.target)) setOpen(false);
    });

    // Fokus berpindah keluar dari dropdown (Tab) → tutup panel.
    wrap.addEventListener('focusout', function () {
        requestAnimationFrame(function () {
            if (!wrap.contains(document.activeElement)) setOpen(false);
        });
    });

    // Guard setara atribut required pada select yang sudah dihapus.
    if (form) {
        form.addEventListener('submit', function (e) {
            if (hidden.value !== '') return;
            e.preventDefault();
            e.stopImmediatePropagation();
            showError(true);
            setOpen(true);
        });
    }
})();
</script>
@endpush
