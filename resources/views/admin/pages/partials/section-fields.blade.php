@php
    $d = $section->data ?? [];
@endphp

@if ($section->type === 'banner')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label-mod">Judul Utama</label>
            <input type="text" name="heading" value="{{ old('heading', $d['heading'] ?? '') }}" class="form-control-mod">
        </div>
        <div class="col-md-6">
            <label class="form-label-mod">Subjudul</label>
            <input type="text" name="subheading" value="{{ old('subheading', $d['subheading'] ?? '') }}" class="form-control-mod">
        </div>
        <div class="col-md-6">
            <label class="form-label-mod">Teks Tombol (opsional)</label>
            <input type="text" name="button_text" value="{{ old('button_text', $d['button_text'] ?? '') }}" class="form-control-mod">
        </div>
        <div class="col-md-6">
            <label class="form-label-mod">URL Tombol (opsional)</label>
            <input type="text" name="button_url" value="{{ old('button_url', $d['button_url'] ?? '') }}" class="form-control-mod"
                   placeholder="https://... atau /halaman/...">
        </div>
    </div>

@elseif ($section->type === 'text')
    <div class="mb-3">
        <label class="form-label-mod">Judul Bagian</label>
        <input type="text" name="heading" value="{{ old('heading', $d['heading'] ?? '') }}" class="form-control-mod">
    </div>
    <div>
        <label class="form-label-mod">Isi Teks</label>
        <textarea name="body" class="form-control-mod" rows="6">{{ old('body', $d['body'] ?? '') }}</textarea>
        <div class="form-hint">Teks biasa, baris kosong memisahkan paragraf. Tidak mendukung HTML (aman dari XSS).</div>
    </div>

@elseif ($section->type === 'cards' || $section->type === 'file')
    <div class="mb-3">
        <label class="form-label-mod">Judul Bagian</label>
        <input type="text" name="heading" value="{{ old('heading', $d['heading'] ?? '') }}" class="form-control-mod">
    </div>
    <div>
        <label class="form-label-mod">
            {{ $section->type === 'file' ? 'Daftar File' : 'Daftar Kartu' }}
        </label>
        <textarea name="items" class="form-control-mod" rows="5"
                  placeholder="Judul | Deskripsi | URL{{ $section->type === 'file' ? ' file' : ' tombol (opsional)' }}">{{ old('items', $section->itemsAsText()) }}</textarea>
        <div class="form-hint">Satu item per baris, pisahkan dengan " | ". Contoh: <code>Laporan Tahunan 2025 | Ringkasan kinerja | /storage/laporan.pdf</code></div>
    </div>

@elseif ($section->type === 'faq')
    <div class="mb-3">
        <label class="form-label-mod">Judul Bagian</label>
        <input type="text" name="heading" value="{{ old('heading', $d['heading'] ?? '') }}" class="form-control-mod">
    </div>
    <div>
        <label class="form-label-mod">Daftar Tanya-Jawab</label>
        <textarea name="items" class="form-control-mod" rows="6"
                  placeholder="Pertanyaan | Jawaban">{{ old('items', $section->itemsAsText()) }}</textarea>
        <div class="form-hint">Satu pasangan per baris: <code>Pertanyaan | Jawaban</code>.</div>
    </div>
@endif
