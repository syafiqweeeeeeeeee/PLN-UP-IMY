@extends('layouts.admin')

@section('title', ($bidang ? 'Edit Bidang' : 'Tambah Bidang') . ' — E-PPID PLN')
@section('page-title', $bidang ? 'Edit Bidang' : 'Tambah Bidang')

@push('styles')
<style>
    /* MASTER BIDANG — form tambah/edit. Mengikuti Design System Form
       panel admin (form-topbar, form-section, form-input — global di
       admin.css); aturan di sini hanya khusus halaman ini. */
    .mb-parent-hint {
        font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;
    }
    .mb-error {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
    .mb-error ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }

    /* ==== CUSTOM DROPDOWN "PARENT (INDUK BIDANG)" (scrollable) ======
       Select native diganti tombol pemicu + panel daftar opsi berhierarki:
       - daftar maksimal max-height 220px + overflow-y auto (scrollbar halus),
       - sudut panel membulat (setara rounded-3 / 8px) + bayangan lembut,
       - item padding 8px 12px, font proporsional, hover highlight halus,
       - indentasi tingkat & simbol `└` dirapikan via padding per level,
       - TANPA kotak pencarian.
       Value tersimpan di <input type="hidden" name="parent_id">. */
    .mb-dd { position: relative; }

    .mb-dd-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.6rem;
        width: 100%;
        text-align: left;
        line-height: 1.4;
        cursor: pointer;
    }
    .mb-dd-trigger:disabled { cursor: not-allowed; opacity: 0.65; }
    .mb-dd-label {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    /* Belum ada induk dipilih → teks placeholder netral abu muda. */
    .mb-dd-trigger.is-placeholder .mb-dd-label { color: #9ca3af; font-style: italic; }
    .mb-dd-chevron {
        flex-shrink: 0;
        font-size: 0.7rem;
        color: #9ca3af;
        transition: transform 0.18s ease, color 0.18s ease;
    }
    .mb-dd.is-open .mb-dd-chevron { transform: rotate(180deg); color: var(--pln-blue); }
    .mb-dd.is-open .mb-dd-trigger {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.12);
    }

    /* Panel daftar opsi — scrollable, bersih, sudut membulat. */
    .mb-dd-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 1200;
        box-sizing: border-box;
        padding: 6px;
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 8px;              /* setara kelas rounded-3 */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Batas tinggi — daftar panjang tidak meluber. */
        max-height: 220px;
        overflow-y: auto;
        overscroll-behavior: contain;
        scrollbar-width: thin;
        scrollbar-color: rgba(148, 163, 184, 0.45) transparent;
        animation: mb-dd-in 0.14s ease-out;
    }
    .mb-dd-menu[hidden] { display: none; }
    @keyframes mb-dd-in {
        from { opacity: 0; transform: translateY(-4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    /* Scrollbar tipis & halus (bukan scrollbar bawaan yang tebal). */
    .mb-dd-menu::-webkit-scrollbar { width: 6px; }
    .mb-dd-menu::-webkit-scrollbar-track { background: transparent; }
    .mb-dd-menu::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.45);
        border-radius: 8px;
    }
    .mb-dd-menu::-webkit-scrollbar-thumb:hover { background: rgba(100, 116, 139, 0.6); }

    .mb-dd .dropdown-option {
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
        line-height: 1.4;
        color: #1f2937;
        text-align: left;
        cursor: pointer;
        transition: background 0.15s ease, color 0.15s ease;
    }
    .mb-dd .dropdown-option + .dropdown-option { margin-top: 2px; }
    /* Efek hover lembut + sorotan keyboard. */
    .mb-dd .dropdown-option:hover,
    .mb-dd .dropdown-option:focus-visible {
        background: rgba(0, 91, 156, 0.08);
        color: var(--pln-blue);
        outline: none;
    }
    .mb-dd .dropdown-option.is-selected {
        background: rgba(0, 91, 156, 0.12);
        color: var(--pln-blue);
        font-weight: 600;
    }
    .mb-dd .dropdown-option > span { flex: 1 1 auto; min-width: 0; }
    /* Simbol cabang hierarki — abu muda, monospace agar rata per tingkat. */
    .mb-dd-branch {
        display: inline-block;
        margin-right: 0.15rem;
        color: #9ca3af;
        font-family: ui-monospace, 'Cascadia Mono', Consolas, monospace;
        font-weight: 600;
    }
    /* Opsi "tanpa induk" — selalu netral, tidak pernah tebal. */
    .mb-dd .mb-dd-empty { color: #9ca3af; font-style: italic; }
    .mb-dd .mb-dd-empty.is-selected { background: rgba(148, 163, 184, 0.14); color: #64748b; font-weight: 600; }
    .mb-dd-check { display: none; font-size: 0.7rem; flex-shrink: 0; }
    .mb-dd .dropdown-option.is-selected .mb-dd-check { display: inline-block; }

    /* Mode gelap admin. */
    html.theme-dark .mb-dd-menu { background: var(--panel); border-color: var(--line); }
    html.theme-dark .mb-dd .dropdown-option { color: var(--ink-heading); }
    html.theme-dark .mb-dd .dropdown-option:hover,
    html.theme-dark .mb-dd .dropdown-option:focus-visible {
        background: rgba(0, 163, 224, 0.12);
        color: var(--pln-cyan);
    }
    html.theme-dark .mb-dd .dropdown-option.is-selected {
        background: rgba(0, 163, 224, 0.14);
        color: var(--pln-cyan);
    }
    html.theme-dark .mb-dd .mb-dd-empty { color: var(--ink-faint); }
    html.theme-dark .mb-dd .mb-dd-empty.is-selected { background: rgba(148, 163, 184, 0.18); color: var(--ink-body); }
    html.theme-dark .mb-dd .mb-dd-branch { color: var(--ink-faint); }
    html.theme-dark .mb-dd.is-open .mb-dd-trigger {
        border-color: var(--pln-cyan);
        box-shadow: 0 0 0 3px var(--focus-ring);
    }
</style>
@endpush

@section('content')
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.master_bidang.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $bidang ? 'Edit Bidang' : 'Tambah Bidang Baru' }}</h4>
            <p class="form-page-subtitle">
                {{ $bidang ? 'Perbarui nama atau posisi bidang dalam hierarki' : 'Buat bidang baru — boleh tingkat atas atau sub-bidang' }}
            </p>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="mb-error" role="alert">
    <i class="fas fa-circle-exclamation"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ $bidang ? route('admin.master_bidang.update', $bidang) : route('admin.master_bidang.store') }}" method="POST">
    @csrf
    @if ($bidang)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-sitemap"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Bidang</h6>
                <p class="form-section-desc">Nama bidang dan induknya dalam hierarki</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="nama">
                Nama Bidang <span class="required" style="color:#dc2626;">*</span>
            </label>
            <input type="text"
                   id="nama"
                   name="nama"
                   value="{{ old('nama', $bidang?->nama) }}"
                   class="form-input @error('nama') is-invalid @enderror"
                   placeholder="Contoh: Teknik Pembangkitan"
                   maxlength="100" required>
            @error('nama')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-group-label" for="parent_id_trigger">
                Parent (Induk Bidang) <span style="color:#9ca3af; font-weight:500;">(opsional)</span>
            </label>

            @php
                /* Nilai terpilih (old input saat error validasi, atau data edit).
                   $parents = koleksi baris ['node' => Bidang, 'depth' => int]. */
                $selectedId   = (string) old('parent_id', $bidang?->parent_id ?? '');
                $selectedRow  = collect($parents)->first(
                    fn ($row) => (string) $row['node']->id === $selectedId
                );
                $selectedValue = $selectedRow ? (string) $selectedRow['node']->id : '';
                $selectedText  = $selectedRow
                    ? ($selectedRow['depth'] > 0 ? '└ ' : '') . $selectedRow['node']->nama
                    : '— Tingkat atas (tanpa induk) —';
                $hasParentError = $errors->has('parent_id');
            @endphp

            {{-- Nilai yang dikirim saat form disimpan — di-update custom dropdown di bawahnya. --}}
            <input type="hidden" name="parent_id" id="parent_id" value="{{ $selectedValue }}">

            <div class="mb-dd{{ $hasParentError ? ' is-invalid' : '' }}" id="mb-parent-dd">
                <button type="button"
                        id="parent_id_trigger"
                        class="form-input mb-dd-trigger{{ $selectedRow ? '' : ' is-placeholder' }}{{ $hasParentError ? ' is-invalid' : '' }}"
                        aria-haspopup="listbox"
                        aria-expanded="false"
                        aria-controls="mb-parent-menu">
                    <span class="mb-dd-label" id="mb-parent-label">{{ $selectedText }}</span>
                    <i class="fas fa-chevron-down mb-dd-chevron" aria-hidden="true"></i>
                </button>

                {{-- Daftar opsi hierarkis: maksimal 220px + scrollbar vertikal. --}}
                <div class="custom-dropdown-menu mb-dd-menu" id="mb-parent-menu" role="listbox"
                     aria-labelledby="parent_id_trigger" hidden>
                    {{-- Parent opsional → opsi "tanpa induk" tetap tersedia untuk mengosongkan pilihan. --}}
                    <button type="button"
                            class="dropdown-option mb-dd-empty{{ $selectedRow ? '' : ' is-selected' }}"
                            role="option"
                            aria-selected="{{ $selectedRow ? 'false' : 'true' }}"
                            data-value=""
                            data-label="— Tingkat atas (tanpa induk) —">
                        <span>— Tingkat atas (tanpa induk) —</span>
                        <i class="fas fa-check mb-dd-check" aria-hidden="true"></i>
                    </button>
                    @foreach ($parents as $row)
                        @php
                            $depth    = (int) $row['depth'];
                            $optLabel = ($depth > 0 ? '└ ' : '') . $row['node']->nama;
                            $isActive = $selectedValue !== ''
                                && $selectedValue === (string) $row['node']->id;
                        @endphp
                        {{-- Indentasi per tingkat: 12px dasar + 16px tiap level. --}}
                        <button type="button"
                                class="dropdown-option{{ $isActive ? ' is-selected' : '' }}{{ $depth > 0 ? ' is-branch' : '' }}"
                                role="option"
                                aria-selected="{{ $isActive ? 'true' : 'false' }}"
                                style="padding-left: {{ 12 + $depth * 16 }}px"
                                data-value="{{ $row['node']->id }}"
                                data-label="{{ $optLabel }}">
                            <span>@if ($depth > 0)<span class="mb-dd-branch" aria-hidden="true">└ </span>@endif{{ $row['node']->nama }}</span>
                            <i class="fas fa-check mb-dd-check" aria-hidden="true"></i>
                        </button>
                    @endforeach
                </div>
            </div>

            @error('parent_id')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="mb-parent-hint">
                Kosongkan untuk bidang tingkat atas. Pilihan yang berupa keturunan bidang ini
                (termasuk bidang itu sendiri) tidak ditampilkan agar hierarki tidak bersiklus.
            </div>
        </div>
    </div>

    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i>
            Field bertanda <b>*</b> wajib diisi.
        </div>
        <div class="form-footer-actions">
            <a href="{{ route('admin.master_bidang.index') }}" class="btn-corp btn-corp-soft">Batal</a>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-check me-1"></i> {{ $bidang ? 'Simpan Perubahan' : 'Simpan Bidang' }}
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    /* CUSTOM DROPDOWN "PARENT (INDUK BIDANG)" — daftar opsi hierarkis
       scrollable (max-height 220px) pengganti <select> native.
       - Struktur hierarki dipertahankan: indentasi per tingkat + simbol `└`.
       - Klik opsi → value ditulis ke <input type="hidden" name="parent_id">
         lalu event 'input' + 'change' di-dispatch, jadi simpan form tetap
         mengirim parent_id yang benar (opsional: opsi "tanpa induk" = '').
       - Panel ditutup saat klik di luar / Escape / pindah fokus (Tab).
       - Keyboard: panah atas/bawah berpindah opsi, Enter/Space memilih.
       - TANPA kotak pencarian. */
    const wrap = document.getElementById('mb-parent-dd');
    if (!wrap) return;

    const trigger = document.getElementById('parent_id_trigger');
    const menu    = document.getElementById('mb-parent-menu');
    const hidden  = document.getElementById('parent_id');
    const label   = document.getElementById('mb-parent-label');
    const form    = wrap.closest('form');
    const options = Array.prototype.slice.call(menu.querySelectorAll('.dropdown-option'));

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

    function choose(opt) {
        // Sinkronisasi value form → hidden input parent_id.
        hidden.value = opt.dataset.value;
        label.textContent = opt.dataset.label || opt.textContent.trim();
        trigger.classList.toggle('is-placeholder', opt.dataset.value === '');
        trigger.classList.remove('is-invalid');
        wrap.classList.remove('is-invalid');

        options.forEach(function (o) {
            const on = o === opt;
            o.classList.toggle('is-selected', on);
            o.setAttribute('aria-selected', on ? 'true' : 'false');
        });

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
})();
</script>
@endpush
