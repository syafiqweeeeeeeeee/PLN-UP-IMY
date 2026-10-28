{{-- ==========================================================================
  KARTU CHECK-IN / CHECK-OUT (UI MINIMALIS — tanpa foto, tanpa reload)

  Dipakai di halaman Detail Kunjungan (admin) dan di dalam modal Detail
  pada halaman daftar (admin & portal karyawan). Satu tombol utama saja:

    kunjungan disetujui, belum tiba  -> [Check-In Tamu]
    sudah check-in, belum check-out   -> [Check-Out Tamu]   <- aksi utama
    sudah check-out                  -> chip "Kunjungan selesai"

  Parameter:
    $co           array|null — hasil Tamu::kunjunganState(); NULL berarti
                    mode TEMPLATE (kartu di-clone JS ke dalam modal daftar,
                    nilainya diisi dari tamuData lewat window.tamuCoSync)
    $checkinUrl   URL aksi check-in  (pakai ':id' saat mode template)
    $checkoutUrl  URL aksi check-out (pakai ':id' saat mode template)
  ========================================================================== --}}
@php
    $co = $co ?? null;
    $isTemplate = $co === null;
@endphp

{{-- Style + script hanya dirender SEKALI per halaman (shared). --}}
@once
<style>
    .co-card {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e8edf5);
        border-radius: 14px;
        padding: 1.05rem 1.2rem;
        margin-top: 1rem;
    }
    .co-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .co-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.32rem 0.75rem;
        border-radius: 999px;
        white-space: nowrap;
    }
    .co-badge i { font-size: 0.6rem; }
    .co-badge.menunggu  { background: #fef3c7; color: #b45309; }
    .co-badge.disetujui { background: #dcfce7; color: #15803d; }
    .co-badge.ditolak   { background: #fee2e2; color: #dc2626; }
    .co-badge.selesai   { background: #f1f5f9; color: #64748b; }
    .co-status { font-size: 0.78rem; font-weight: 600; color: #6b7280; }

    .co-times {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 0.6rem;
        margin-top: 0.9rem;
    }
    .co-time {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 10px;
        padding: 0.6rem 0.75rem;
    }
    .co-time-label {
        display: block;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #9ca3af;
        margin-bottom: 0.15rem;
    }
    .co-time-value {
        font-size: 0.86rem;
        font-weight: 700;
        color: var(--pln-text, #111827);
        font-variant-numeric: tabular-nums;
    }

    .co-actions { display: flex; gap: 0.55rem; flex-wrap: wrap; margin-top: 0.9rem; }
    .co-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.84rem;
        font-weight: 700;
        padding: 0.6rem 1.15rem;
        border-radius: 10px;
        border: 1.5px solid transparent;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .co-btn.primary { background: #16a34a; border-color: #16a34a; color: #fff; }
    .co-btn.primary:hover { background: #15803d; border-color: #15803d; }
    .co-btn:disabled { opacity: 0.6; cursor: progress; }

    .co-done {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.8rem;
        font-weight: 700;
        color: #15803d;
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        padding: 0.58rem 0.95rem;
        border-radius: 10px;
    }
    .co-hint { margin: 0.75rem 0 0; font-size: 0.78rem; color: #9ca3af; }
    .co-msg { margin: 0.7rem 0 0; font-size: 0.8rem; font-weight: 600; }
    .co-msg.ok  { color: #15803d; }
    .co-msg.err { color: #dc2626; }

    /* display:none eksplisit — atribut hidden kalah dari display di atas */
    .co-card [hidden] { display: none !important; }

    html.theme-dark .co-card { background: var(--panel); border-color: var(--line); }
    html.theme-dark .co-time { background: var(--panel); border-color: var(--line); }
    html.theme-dark .co-status { color: var(--ink-muted); }
    html.theme-dark .co-badge.menunggu  { background: rgba(180, 83, 9, .25); color: #fcd34d; }
    html.theme-dark .co-badge.disetujui { background: rgba(21, 128, 61, .25); color: #86efac; }
    html.theme-dark .co-badge.ditolak   { background: rgba(220, 38, 38, .25); color: #fca5a5; }
    html.theme-dark .co-badge.selesai   { background: var(--panel); color: var(--ink-muted); }
    html.theme-dark .co-done { background: rgba(21, 128, 61, .18); border-color: rgba(21, 128, 61, .35); color: #86efac; }

    @media (max-width: 767.98px) {
        .co-btn { width: 100%; justify-content: center; }
    }
</style>
<script>
/* ================================================================
   CHECK-IN / CHECK-OUT — satu gerbang fetch() + update real-time.
   Event didelegasikan ke document supaya kartu yang di-clone ke
   modal daftar ikut berfungsi tanpa wiring ulang.
   ================================================================ */
(function () {
    if (window.__tamuCoWired) { return; }
    window.__tamuCoWired = true;

    function csrf() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    function setText(root, role, value) {
        var el = root.querySelector('[data-role="' + role + '"]');
        if (el) { el.textContent = value || '—'; }
    }

    /** Terapkan state kunjungan terbaru ke kartu & elemen terkait di halaman. */
    function sync(card, s) {
        if (!card || !s) { return; }

        var badge = card.querySelector('[data-role="badge"]');
        if (badge) {
            badge.className = 'co-badge ' + (s.badge || 'menunggu');
            badge.innerHTML = '<i class="fas fa-circle"></i> ' + (s.badge_label || '-');
        }

        setText(card, 'status', s.label);
        setText(card, 'checkin', s.checkin);
        setText(card, 'checkout', s.checkout);
        setText(card, 'durasi', s.durasi_label);

        var btnIn  = card.querySelector('[data-action="checkin"]');
        var btnOut = card.querySelector('[data-action="checkout"]');
        if (btnIn)  { btnIn.hidden  = !s.can_checkin; }
        if (btnOut) { btnOut.hidden = !s.can_checkout; }

        var done = card.querySelector('[data-role="done"]');
        if (done) { done.hidden = !s.selesai; }

        var hint = card.querySelector('[data-role="hint"]');
        if (hint) { hint.hidden = !!(s.can_checkin || s.can_checkout || s.selesai); }

        var id = s.id != null ? String(s.id) : (card.dataset.id != null ? String(card.dataset.id) : null);
        if (id === null) { return; }

        // Badge di halaman Detail Kunjungan (hanya bila milik tamu yang sama)
        var head = document.getElementById('detailBadge');
        if (head && head.dataset.tamuId === id) {
            head.className = 'tamu-badge ' + (s.badge || 'menunggu');
            head.innerHTML = '<i class="fas fa-circle"></i> ' + (s.badge_label || '-');
        }

        // Badge baris tabel pada halaman daftar
        var cell = document.querySelector('tr[data-tamu-id="' + id + '"] .tamu-badge');
        if (cell) {
            cell.className = 'tamu-badge ' + (s.badge || 'menunggu');
            cell.innerHTML = '<i class="fas fa-circle"></i> ' + (s.badge_label || '-');
        }

        // Payload modal detail agar dibuka ulang menampilkan data terbaru
        if (window.tamuData && window.tamuData[id]) {
            window.tamuData[id].checkin    = s.checkin;
            window.tamuData[id].checkout   = s.checkout;
            window.tamuData[id].status     = s.label;
            window.tamuData[id].kunjungan  = s;
        }
    }

    window.tamuCoSync = sync;

    function showMsg(card, text, ok) {
        var msg = card.querySelector('[data-role="msg"]');
        if (!msg) { return; }
        msg.textContent = text;
        msg.className = 'co-msg ' + (ok ? 'ok' : 'err');
        msg.hidden = false;
    }

    async function run(card, btn) {
        var url = btn.dataset.url;
        if (!url) { return; }

        /* Placeholder ':id' (kartu TEMPLATE yang di-clone ke modal daftar)
           wajib diganti ID asli SEBELUM request dikirim. Bila ID kosong /
           tidak valid, kirim ditahan di sini — server tidak akan pernah
           menerima literal ':id' (dulu memicu error
           "No query results for model [App\Models\Tamu] :id"). */
        if (url.indexOf(':id') !== -1) {
            var cid = card.dataset.id;
            if (!cid || cid === 'null' || cid === 'undefined') {
                showMsg(card, 'Data tamu tidak ditemukan atau ID tidak valid.', false);
                return;
            }
            url = url.replace(':id', cid);
        }

        var msg = card.querySelector('[data-role="msg"]');
        btn.disabled = true;
        btn.classList.add('is-busy');
        if (msg) { msg.hidden = true; msg.className = 'co-msg'; }

        try {
            var res = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrf(),
                },
            });

            if (res.status === 419) {
                throw new Error('Sesi berakhir — muat ulang halaman lalu coba lagi.');
            }

            var body = {};
            try { body = await res.json(); } catch (ignore) { body = {}; }

            if (!res.ok || body.ok === false) {
                throw new Error(body.message || 'Gagal memproses. Silakan coba lagi.');
            }

            sync(card, body.tamu || {});
            showMsg(card, body.message || 'Berhasil diperbarui.', true);
            document.dispatchEvent(new CustomEvent('tamu:kunjungan-updated', { detail: body.tamu || {} }));
        } catch (err) {
            showMsg(card, err && err.message ? err.message : 'Gagal memproses. Silakan coba lagi.', false);
        } finally {
            btn.disabled = false;
            btn.classList.remove('is-busy');
        }
    }

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.co-btn');
        if (!btn) { return; }

        var card = btn.closest('.co-card');
        if (!card || btn.disabled) { return; }

        e.preventDefault();
        run(card, btn); // SATU klik — tanpa dialog konfirmasi (alur cepat satpam)
    });
})();
</script>
@endonce

<div class="co-card"
     data-co-card
     @unless($isTemplate) data-id="{{ $tamu->id ?? '' }}" @endunless
     data-checkin-url="{{ $checkinUrl }}"
     data-checkout-url="{{ $checkoutUrl }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="co-top">
        <span class="co-badge {{ $co['badge'] ?? 'menunggu' }}" data-role="badge">
            <i class="fas fa-circle"></i> {{ $co['badge_label'] ?? 'Menunggu' }}
        </span>
        <span class="co-status" data-role="status">{{ $co['label'] ?? '—' }}</span>
    </div>

    <div class="co-times">
        <div class="co-time">
            <span class="co-time-label">Check-In</span>
            <span class="co-time-value" data-role="checkin">{{ $co['checkin'] ?? '—' }}</span>
        </div>
        <div class="co-time">
            <span class="co-time-label">Check-Out</span>
            <span class="co-time-value" data-role="checkout">{{ $co['checkout'] ?? '—' }}</span>
        </div>
        <div class="co-time">
            <span class="co-time-label">Durasi</span>
            <span class="co-time-value" data-role="durasi">{{ $co['durasi_label'] ?? '—' }}</span>
        </div>
    </div>

    @can('tamu.checkout')
        <div class="co-actions">
            <button type="button"
                    class="co-btn primary"
                    data-action="checkin"
                    data-url="{{ $checkinUrl }}"
                    @if(! $isTemplate && ! $co['can_checkin']) hidden @endif>
                <i class="fas fa-right-to-bracket"></i> Check-In Tamu
            </button>

            {{-- Tombol UTAMA alur ini: check-out satu klik, tanpa foto. --}}
            <button type="button"
                    class="co-btn primary"
                    data-action="checkout"
                    data-url="{{ $checkoutUrl }}"
                    @if(! $isTemplate && ! $co['can_checkout']) hidden @endif>
                <i class="fas fa-right-from-bracket"></i> Check-Out Tamu
            </button>

            <span class="co-done" data-role="done" @if(! ($co['selesai'] ?? false)) hidden @endif>
                <i class="fas fa-check"></i> Kunjungan selesai
            </span>
        </div>
    @endcan

    @unless($isTemplate)
        @if(! $co['can_checkin'] && ! $co['can_checkout'] && ! $co['selesai'])
            <p class="co-hint" data-role="hint">
                Kunjungan belum disetujui — check-in & check-out baru dapat dilakukan
                setelah verifikasi admin.
            </p>
        @endif
    @endunless

    <p class="co-msg" data-role="msg" hidden></p>
</div>
