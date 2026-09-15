{{--
    Komponen section editor SERAGAM — dipakai di form Tambah & Edit Halaman,
    dan di-clone oleh JS untuk tombol "+ Tambah Section" (via <template>).
    Input: $s = ['id' => ?int, 'type' => string, 'data' => array], $idx = string unik.
    Nama field: sections[{idx}][id|type|heading|body|items|...]
    Grup field jenis lain di-DISABLE (tidak ikut submit) sesuai jenis terpilih.
--}}
@php
    $sid  = $s['id'] ?? null;
    $type = $s['type'] ?? 'text';
    $d    = $s['data'] ?? [];

    // items array (cards/file/faq) → teks textarea "A | B | C" per baris
    $itemsAsText = collect($d['items'] ?? [])
        ->map(function ($item) {
            if (! is_array($item)) {
                return (string) $item;
            }

            return collect([
                $item['title'] ?? ($item['question'] ?? ''),
                $item['description'] ?? ($item['answer'] ?? ''),
                $item['url'] ?? '',
            ])->filter(fn ($v) => (string) $v !== '')->implode(' | ');
        })
        ->implode("\n");
@endphp

<div class="section-item" data-section-block>
    <div class="section-item-head" data-section-toggle>
        <div class="left">
            <span class="num" data-section-num>•</span>
            <span class="type-label" data-section-type-label>{{ \App\Models\PageSection::TYPES[$type] ?? $type }}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            {{-- Tombol TANPA inline onclick — semua klik ditangani delegated listener
                 di form.blade.php (yang memanggil preventDefault + stopPropagation).
                 Inline stopPropagation justru mencegah event sampai ke listener. --}}
            <span class="section-move-forms">
                <button type="button" class="btn-mini" data-section-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
                <button type="button" class="btn-mini" data-section-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
            </span>
            <button type="button" class="btn-mini danger" data-section-remove title="Hapus section"><i class="fas fa-trash"></i></button>
            <i class="fas fa-chevron-down chev"></i>
        </div>
    </div>

    <div class="section-item-body">
        @if ($sid)
            <input type="hidden" name="sections[{{ $idx }}][id]" value="{{ $sid }}">
        @endif

        <div class="mb-3">
            <label class="form-label-mod">Jenis section</label>
            <select name="sections[{{ $idx }}][type]" class="form-control-mod" data-section-type>
                @foreach (\App\Models\PageSection::TYPES as $typeKey => $typeLabel)
                    <option value="{{ $typeKey }}" @selected($type === $typeKey)>{{ $typeLabel }}</option>
                @endforeach
            </select>
        </div>

        {{-- ================= BANNER / HERO ================= --}}
        <div class="row g-3 mb-1" data-fields="banner" @if ($type !== 'banner') style="display:none;" @endif>
            <div class="col-md-6">
                <label class="form-label-mod">Judul Utama</label>
                <input type="text" name="sections[{{ $idx }}][heading]" value="{{ $d['heading'] ?? '' }}"
                       class="form-control-mod" @disable($type !== 'banner')>
            </div>
            <div class="col-md-6">
                <label class="form-label-mod">Subjudul</label>
                <input type="text" name="sections[{{ $idx }}][subheading]" value="{{ $d['subheading'] ?? '' }}"
                       class="form-control-mod" @disable($type !== 'banner')>
            </div>
            <div class="col-md-6">
                <label class="form-label-mod">Teks Tombol (opsional)</label>
                <input type="text" name="sections[{{ $idx }}][button_text]" value="{{ $d['button_text'] ?? '' }}"
                       class="form-control-mod" @disable($type !== 'banner')>
            </div>
            <div class="col-md-6">
                <label class="form-label-mod">URL Tombol (opsional)</label>
                <input type="text" name="sections[{{ $idx }}][button_url]" value="{{ $d['button_url'] ?? '' }}"
                       class="form-control-mod" placeholder="https://... atau /halaman/..." @disable($type !== 'banner')>
            </div>
        </div>

        {{-- ================= TEKS ================= --}}
        <div data-fields="text" @if ($type !== 'text') style="display:none;" @endif>
            <div class="mb-3">
                <label class="form-label-mod">Judul Bagian</label>
                <input type="text" name="sections[{{ $idx }}][heading]" value="{{ $d['heading'] ?? '' }}"
                       class="form-control-mod" @disable($type !== 'text')>
            </div>
            <div>
                <label class="form-label-mod">Isi Teks</label>
                <textarea name="sections[{{ $idx }}][body]" class="form-control-mod" rows="6" @disable($type !== 'text')>{{ $d['body'] ?? '' }}</textarea>
                <div class="form-hint">Teks biasa, baris kosong memisahkan paragraf. Tidak mendukung HTML (aman dari XSS).</div>
            </div>
        </div>

        {{-- ================= KARTU / DAFTAR FILE ================= --}}
        <div data-fields="cards" @if ($type !== 'cards') style="display:none;" @endif>
            <div class="mb-3">
                <label class="form-label-mod">Judul Bagian</label>
                <input type="text" name="sections[{{ $idx }}][heading]" value="{{ $d['heading'] ?? '' }}"
                       class="form-control-mod" @disable($type !== 'cards')>
            </div>
            <div>
                <label class="form-label-mod">Daftar Kartu</label>
                <textarea name="sections[{{ $idx }}][items]" class="form-control-mod" rows="5"
                          placeholder="Judul | Deskripsi | URL tombol (opsional)" @disable($type !== 'cards')>{{ $type === 'cards' ? $itemsAsText : '' }}</textarea>
                <div class="form-hint">Satu item per baris, pisahkan dengan " | ".</div>
            </div>
        </div>

        <div data-fields="file" @if ($type !== 'file') style="display:none;" @endif>
            <div class="mb-3">
                <label class="form-label-mod">Judul Bagian</label>
                <input type="text" name="sections[{{ $idx }}][heading]" value="{{ $d['heading'] ?? '' }}"
                       class="form-control-mod" @disable($type !== 'file')>
            </div>
            <div>
                <label class="form-label-mod">Daftar File</label>
                <textarea name="sections[{{ $idx }}][items]" class="form-control-mod" rows="5"
                          placeholder="Nama File | Keterangan | URL file" @disable($type !== 'file')>{{ $type === 'file' ? $itemsAsText : '' }}</textarea>
                <div class="form-hint">Contoh: <code>Laporan Tahunan 2025 | Ringkasan kinerja | /storage/laporan.pdf</code></div>
            </div>
        </div>

        {{-- ================= FAQ ================= --}}
        <div data-fields="faq" @if ($type !== 'faq') style="display:none;" @endif>
            <div class="mb-3">
                <label class="form-label-mod">Judul Bagian</label>
                <input type="text" name="sections[{{ $idx }}][heading]" value="{{ $d['heading'] ?? '' }}"
                       class="form-control-mod" @disable($type !== 'faq')>
            </div>
            <div>
                <label class="form-label-mod">Daftar Tanya-Jawab</label>
                <textarea name="sections[{{ $idx }}][items]" class="form-control-mod" rows="6"
                          placeholder="Pertanyaan | Jawaban" @disable($type !== 'faq')>{{ $type === 'faq' ? $itemsAsText : '' }}</textarea>
                <div class="form-hint">Satu pasangan per baris: <code>Pertanyaan | Jawaban</code>.</div>
            </div>
        </div>
    </div>
</div>
