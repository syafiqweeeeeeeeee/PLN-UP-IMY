@extends('layouts.admin')

@section('title', 'Hari Libur — E-PPID PLN')
@section('page-title', 'Hari Libur')

@push('styles')
<style>
    /* HARI LIBUR / TANGGAL MERAH — daftar tanggal yang ditolak pada
       form registrasi tamu publik. Class diprefiks hl- agar tidak bentrok. */
    .hl-head {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .hl-head .header-row {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .hl-head h5 {
        font-size: 1.05rem; font-weight: 700; color: var(--pln-text, #1f2937);
        margin: 0 0 0.2rem;
    }
    .hl-head p { font-size: 0.78rem; color: #9ca3af; margin: 0; max-width: 640px; }
    .hl-stats { display: flex; gap: 0.6rem; flex-wrap: wrap; margin-top: 0.9rem; }
    .hl-stat {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.4rem 0.85rem; background: #f8fafc; border: 1px solid #e5e7eb;
        border-radius: 8px; font-size: 0.75rem; font-weight: 600; color: #4b5563;
    }

    .hl-alert {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
    .hl-alert ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }

    .hl-table-wrap {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        overflow-x: auto;
    }
    .hl-table { width: 100%; border-collapse: collapse; min-width: 720px; }
    .hl-table th {
        text-align: left; padding: 0.7rem 0.9rem; font-size: 0.68rem;
        font-weight: 700; color: #6b7280; text-transform: uppercase;
        letter-spacing: 0.5px; border-bottom: 2px solid var(--border-color, #e5e7eb);
        white-space: nowrap; background: #f8fafc;
    }
    .hl-table td {
        padding: 0.65rem 0.9rem; border-bottom: 1px solid #f1f4f9;
        font-size: 0.8rem; color: #1f2937; vertical-align: middle;
    }
    .hl-table tbody tr:last-child td { border-bottom: none; }
    .hl-table tbody tr:hover { background: #e6f2fb; }

    .hl-date-chip {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.2rem 0.65rem; border-radius: 999px;
        background: #fef2f2; color: #b91c1c; font-size: 0.74rem; font-weight: 700;
        white-space: nowrap;
    }
    .hl-date-chip.masuk { background: #ecfdf5; color: #047857; }
    .hl-day { color: #6b7280; font-size: 0.74rem; }

    /* Badge status tipe: Merah = Libur (blokir), Hitam/Hijau = Masuk Kerja (override weekend) */
    .hl-badge {
        display: inline-block; padding: 0.2rem 0.6rem; border-radius: 999px;
        font-size: 0.7rem; font-weight: 700; white-space: nowrap;
    }
    .hl-badge.libur       { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
    .hl-badge.masuk_kerja { background: #111827; color: #fff; border: 1px solid #111827; }

    .hl-actions { display: flex; gap: 0.3rem; align-items: center; }
    .hl-action-btn {
        width: 30px; height: 30px; border-radius: 8px; border: none;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.75rem; cursor: pointer; transition: all 0.15s ease;
    }
    .hl-action-btn.edit   { background: #fef3c7; color: #b45309; }
    .hl-action-btn.delete { background: #fef2f2; color: #dc2626; }
    .hl-action-btn:hover { transform: translateY(-1px); }
    .hl-action-btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

    .hl-empty { text-align: center; padding: 3rem 1rem; color: #9ca3af; }
    .hl-empty i { font-size: 1.8rem; color: #cbd5e1; display: block; margin-bottom: 0.5rem; }
    .hl-empty h6 { font-size: 0.95rem; font-weight: 700; color: #6b7280; margin: 0 0 0.25rem; }
    .hl-empty p { font-size: 0.8rem; margin: 0; }

    .hl-pagination { display: flex; gap: 0.35rem; justify-content: center; margin-top: 1rem; }
    .hl-page-btn {
        min-width: 32px; padding: 0.3rem 0.55rem; border-radius: 8px;
        border: 1px solid var(--border-color, #e5e7eb); background: var(--bg-card, #fff);
        color: var(--pln-text, #1f2937); font-size: 0.76rem; font-weight: 600;
        text-decoration: none; text-align: center;
    }
    .hl-page-btn.active { background: var(--pln-blue, #0056a3); border-color: var(--pln-blue, #0056a3); color: #fff; }
    .hl-page-btn.disabled { opacity: 0.45; pointer-events: none; }

    /* Modal (pola modal admin lain: overlay + kartu putih) */
    .hl-modal-overlay {
        position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45);
        display: none; align-items: center; justify-content: center;
        z-index: 1200; padding: 1rem;
    }
    .hl-modal-overlay.show { display: flex; }
    .hl-modal {
        background: var(--bg-card, #fff); border-radius: 14px;
        width: 100%; max-width: 430px; overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
    }
    .hl-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.9rem 1.1rem; border-bottom: 1px solid var(--border-color, #e5e7eb);
    }
    .hl-modal-header h6 { margin: 0; font-size: 0.92rem; font-weight: 700; }
    .hl-modal-close {
        background: none; border: none; cursor: pointer;
        color: #9ca3af; font-size: 1rem; padding: 0.2rem 0.4rem; border-radius: 6px;
    }
    .hl-modal-close:hover { background: #f1f5f9; color: #dc2626; }
    .hl-modal-body { padding: 1.1rem; display: grid; gap: 0.8rem; }
    .hl-modal-footer {
        display: flex; justify-content: flex-end; gap: 0.5rem;
        padding: 0.85rem 1.1rem; border-top: 1px solid var(--border-color, #e5e7eb);
    }
    .hl-label { font-size: 0.76rem; font-weight: 600; color: #374151; display: block; margin-bottom: 0.25rem; }
    .hl-label .req { color: #dc2626; }
    .hl-input {
        width: 100%; border: 1px solid #d1d5db; border-radius: 8px;
        padding: 0.5rem 0.7rem; font-size: 0.82rem; background: var(--bg-card, #fff);
        color: var(--pln-text, #1f2937);
    }
    .hl-input:focus { outline: none; border-color: var(--pln-blue, #0056a3); box-shadow: 0 0 0 3px rgba(0, 86, 163, 0.12); }
    .hl-hint { font-size: 0.7rem; color: #9ca3af; margin-top: 0.2rem; }
</style>
@endpush

@section('content')
@if (session('success'))
    <div class="alert alert-success py-2 px-3" role="status">
        <i class="fas fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

{{-- ============ PAGE HEADER + AKSI ============ --}}
<div class="hl-head">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-calendar-xmark" style="color: #dc2626; margin-right: 0.5rem;"></i>Hari Libur / Tanggal Merah</h5>
            <p>Dua tipe status tanggal: <b>Libur</b> — diblokir pada form registrasi tamu publik
               (/layanan/form-registrasi-tamu); <b>Masuk Kerja</b> — mengubah Sabtu/Minggu yang defaultnya
               libur menjadi <b>bisa dipilih</b> pengunjung (override weekend).</p>
        </div>
        <div class="header-actions">
            @can('hari_libur.create')
            <button type="button" class="btn-corp btn-corp-primary" onclick="hlOpenModal('hlAddModal')">
                <i class="fas fa-plus me-1"></i> Tambah Tanggal
            </button>
            @endcan
        </div>
    </div>
    <div class="hl-stats">
        <span class="hl-stat"><i class="fas fa-calendar-xmark"></i> Total: {{ $total }}</span>
        <span class="hl-stat"><i class="fas fa-calendar-day"></i> Mendatang: {{ $mendatang }}</span>
    </div>
</div>

@if ($errors->any())
    <div class="hl-alert" role="alert">
        <i class="fas fa-circle-exclamation"></i>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- ============ TABEL TANGGAL MERAH ============ --}}
<div class="hl-table-wrap">
    @if ($tanggalLibur->isEmpty())
        <div class="hl-empty">
            <i class="fas fa-calendar-check"></i>
            <h6>Belum ada tanggal terdaftar</h6>
            <p>Semua tanggal mengikuti aturan default (akhir pekan libur, sisanya terbuka).
               Kelola lewat tombol <b>Tambah Tanggal</b>.</p>
        </div>
    @else
    <table class="hl-table">
        <thead>
            <tr>
                <th style="width: 52px;">No</th>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Tipe</th>
                <th>Keterangan</th>
                <th style="width: 110px;" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tanggalLibur as $i => $libur)
            <tr>
                <td>{{ $tanggalLibur->firstItem() + $i }}</td>
                <td>
                    <span class="hl-date-chip {{ $libur->isMasukKerja() ? 'masuk' : '' }}">
                        <i class="fas {{ $libur->isMasukKerja() ? 'fa-calendar-check' : 'fa-calendar-xmark' }}"></i>
                        {{ $libur->tanggal->translatedFormat('d M Y') }}
                    </span>
                </td>
                <td><span class="hl-day">{{ $libur->tanggal->translatedFormat('l') }}</span></td>
                <td>
                    @if ($libur->isMasukKerja())
                        <span class="hl-badge masuk_kerja"><i class="fas fa-check"></i> Masuk Kerja</span>
                    @else
                        <span class="hl-badge libur"><i class="fas fa-ban"></i> Libur</span>
                    @endif
                </td>
                <td>{{ $libur->keterangan }}</td>
                <td>
                    <div class="hl-actions">
                        @can('hari_libur.edit')
                            <button type="button" class="hl-action-btn edit" title="Edit"
                                    onclick='hlOpenEdit({!! json_encode([
                                        'id' => $libur->id,
                                        'tanggal' => $libur->tanggal->format('Y-m-d'),
                                        'tipe' => $libur->tipe,
                                        'keterangan' => $libur->keterangan,
                                    ]) !!})'>
                                <i class="fas fa-pen"></i>
                            </button>
                        @endcan
                        @can('hari_libur.delete')
                            <form method="POST" action="{{ route('admin.hari-libur.destroy', $libur) }}"
                                  onsubmit="return confirm('Hapus tanggal {{ $libur->tanggal->format('d M Y') }} ({{ addslashes($libur->keterangan) }})? Status tanggal ini kembali mengikuti aturan default.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hl-action-btn delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@if ($tanggalLibur->hasPages())
<div class="hl-pagination">
    @if ($tanggalLibur->onFirstPage())
        <span class="hl-page-btn disabled"><i class="fas fa-chevron-left"></i></span>
    @else
        <a class="hl-page-btn" href="{{ $tanggalLibur->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
    @endif

    @foreach ($tanggalLibur->getUrlRange(max(1, $tanggalLibur->currentPage() - 2), min($tanggalLibur->lastPage(), $tanggalLibur->currentPage() + 2)) as $page => $url)
        <a class="hl-page-btn {{ $page == $tanggalLibur->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
    @endforeach

    @if ($tanggalLibur->hasMorePages())
        <a class="hl-page-btn" href="{{ $tanggalLibur->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
    @else
        <span class="hl-page-btn disabled"><i class="fas fa-chevron-right"></i></span>
    @endif
</div>
@endif

{{-- ============ MODAL TAMBAH ============ --}}
@can('hari_libur.create')
<div class="hl-modal-overlay" id="hlAddModal" onclick="if (event.target === this) hlCloseModal('hlAddModal')">
    <div class="hl-modal">
        <form method="POST" action="{{ route('admin.hari-libur.store') }}">
            @csrf
            <div class="hl-modal-header">
                <h6><i class="fas fa-plus" style="color: var(--pln-blue, #0056a3); margin-right: 0.4rem;"></i>Tambah Tanggal</h6>
                <button type="button" class="hl-modal-close" onclick="hlCloseModal('hlAddModal')" aria-label="Tutup">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>
            <div class="hl-modal-body">
                <div>
                    <label class="hl-label" for="hl-tanggal">Tanggal <span class="req">*</span></label>
                    <input type="date" id="hl-tanggal" name="tanggal" required
                           min="{{ now()->format('Y-m-d') }}"
                           value="{{ old('tanggal') }}" class="hl-input">
                    <p class="hl-hint">Minimal hari ini — tanggal lampau tidak bisa didaftarkan.</p>
                </div>
                <div>
                    <label class="hl-label" for="hl-tipe">Tipe Status <span class="req">*</span></label>
                    <select id="hl-tipe" name="tipe" required class="hl-input">
                        <option value="libur" {{ old('tipe') === 'libur' ? 'selected' : '' }}>
                            Tanggal Merah / Libur — blokir kunjungan
                        </option>
                        <option value="masuk_kerja" {{ old('tipe') === 'masuk_kerja' ? 'selected' : '' }}>
                            Hari Kerja Khusus / Masuk — izinkan kunjungan di weekend
                        </option>
                    </select>
                    <p class="hl-hint">Pilih <b>Masuk Kerja</b> untuk mengubah Sabtu/Minggu menjadi hari yang bisa dipilih pengunjung.</p>
                </div>
                <div>
                    <label class="hl-label" for="hl-keterangan">Keterangan <span class="req">*</span></label>
                    <input type="text" id="hl-keterangan" name="keterangan" required maxlength="150"
                           placeholder="Contoh: Hari Raya Natal / Lembur Sabtu"
                           value="{{ old('keterangan') }}" class="hl-input">
                </div>
            </div>
            <div class="hl-modal-footer">
                <button type="button" class="btn-corp btn-corp-soft" onclick="hlCloseModal('hlAddModal')">Batal</button>
                <button type="submit" class="btn-corp btn-corp-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endcan

{{-- ============ MODAL EDIT ============ --}}
@can('hari_libur.edit')
<div class="hl-modal-overlay" id="hlEditModal" onclick="if (event.target === this) hlCloseModal('hlEditModal')">
    <div class="hl-modal">
        <form method="POST" action="" id="hlEditForm">
            @csrf
            @method('PUT')
            <div class="hl-modal-header">
                <h6><i class="fas fa-pen" style="color: #b45309; margin-right: 0.4rem;"></i>Edit Tanggal</h6>
                <button type="button" class="hl-modal-close" onclick="hlCloseModal('hlEditModal')" aria-label="Tutup">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>
            <div class="hl-modal-body">
                <div>
                    <label class="hl-label" for="hl-edit-tanggal">Tanggal <span class="req">*</span></label>
                    <input type="date" id="hl-edit-tanggal" name="tanggal" required class="hl-input">
                </div>
                <div>
                    <label class="hl-label" for="hl-edit-tipe">Tipe Status <span class="req">*</span></label>
                    <select id="hl-edit-tipe" name="tipe" required class="hl-input">
                        <option value="libur">Tanggal Merah / Libur — blokir kunjungan</option>
                        <option value="masuk_kerja">Hari Kerja Khusus / Masuk — izinkan kunjungan di weekend</option>
                    </select>
                </div>
                <div>
                    <label class="hl-label" for="hl-edit-keterangan">Keterangan <span class="req">*</span></label>
                    <input type="text" id="hl-edit-keterangan" name="keterangan" required maxlength="150"
                           placeholder="Contoh: Hari Raya Nyepi" class="hl-input">
                </div>
            </div>
            <div class="hl-modal-footer">
                <button type="button" class="btn-corp btn-corp-soft" onclick="hlCloseModal('hlEditModal')">Batal</button>
                <button type="submit" class="btn-corp btn-corp-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endcan

@push('scripts')
<script>
    function hlOpenModal(id) {
        var el = document.getElementById(id);
        if (el) el.classList.add('show');
    }

    function hlCloseModal(id) {
        var el = document.getElementById(id);
        if (el) el.classList.remove('show');
    }

    /* Isi form edit dari payload baris tabel, lalu buka modal. */
    function hlOpenEdit(data) {
        var form = document.getElementById('hlEditForm');
        var tanggal = document.getElementById('hl-edit-tanggal');
        var tipe = document.getElementById('hl-edit-tipe');
        var keterangan = document.getElementById('hl-edit-keterangan');
        if (!form || !tanggal || !tipe || !keterangan) return;

        form.action = '{{ route('admin.hari-libur.update', ['hariLibur' => ':id']) }}'.replace(':id', data.id);
        tanggal.value = data.tanggal || '';
        tipe.value = data.tipe || 'libur';
        keterangan.value = data.keterangan || '';

        hlOpenModal('hlEditModal');
    }

    /* Validasi klien sederhana: input tanggal libur tidak boleh lampau. */
    (function () {
        var tanggal = document.getElementById('hl-tanggal');
        if (!tanggal) return;
        tanggal.addEventListener('change', function () {
            var min = tanggal.min;
            if (tanggal.value && min && tanggal.value < min) {
                tanggal.setCustomValidity('Tanggal libur tidak boleh di masa lalu.');
                try { tanggal.reportValidity(); } catch (e) {}
            } else {
                tanggal.setCustomValidity('');
            }
        });
    })();

    /* Buka kembali modal tambah bila server menolak isian (old input). */
    @if ($errors->any() && old('tanggal'))
        hlOpenModal('hlAddModal');
    @endif
</script>
@endpush
@endsection
