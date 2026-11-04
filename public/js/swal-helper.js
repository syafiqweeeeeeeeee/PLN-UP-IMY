/* ============================================================
   SWAL HELPER — LAPISAN NOTIFIKASI SERAGAM
   ------------------------------------------------------------
   Dipakai bersama oleh panel admin, portal karyawan, dan halaman
   publik (form registrasi tamu) agar semua dialog memakai
   SweetAlert, bukan alert()/confirm() bawaan browser.

   API:
   1. AdminSwal.confirm({...})  → dialog dua tombol, resolve boolean.
   2. AdminSwal.success/info/warning/error(msg, title)
   3. Elemen [data-swal-success|error|warning|info] otomatis
      diubah menjadi pop-up (saat load penuh & setelah swap router).
   4. <form data-swal-confirm="pesan"> memblokir submit langsung dan
      meminta verifikasi lewat dialog dua tombol.

   Catatan: bila SweetAlert2 gagal dimuat (CDN offline), helper tidak
   melakukan apa pun dan form tetap berjalan seperti biasa.
   ============================================================ */
(function () {
    'use strict';

    if (typeof Swal === 'undefined') return;

    /* ---- Warna tombol mengikuti palet PLN ---- */
    var COLOR_PRIMARY = '#005B9C';   // biru PLN
    var COLOR_DANGER  = '#dc2626';   // merah aksi destruktif
    var COLOR_CANCEL  = '#6b7280';   // abu-abu netral

    var BTN_CLASS = {
        popup:         'swal-admin-popup',
        confirmButton: 'swal-admin-btn',
        cancelButton:  'swal-admin-btn swal-admin-btn-cancel'
    };

    var DEFAULT_TITLES = {
        success: 'Berhasil',
        error:   'Gagal',
        warning: 'Perhatian',
        info:    'Informasi',
        question: 'Konfirmasi'
    };

    /* ==========================================================
       1) DIALOG KONFIRMASI — dua tombol pilihan
       ========================================================== */
    function confirmSwal(opts) {
        opts = opts || {};
        var danger = opts.tone === 'danger';

        return Swal.fire({
            icon: opts.icon || (danger ? 'warning' : 'question'),
            title: opts.title || DEFAULT_TITLES.question,
            text: opts.text || '',
            showCancelButton: true,
            confirmButtonText: opts.confirmText || 'Ya, Lanjutkan',
            cancelButtonText: opts.cancelText || 'Batal',
            confirmButtonColor: danger ? COLOR_DANGER : COLOR_PRIMARY,
            cancelButtonColor: COLOR_CANCEL,
            reverseButtons: true,
            focusCancel: true,
            customClass: BTN_CLASS
        }).then(function (result) {
            return !!result.isConfirmed;
        }, function () {
            return false;   // ditutup lewat ESC / klik luar → batal
        });
    }

    /* ==========================================================
       2) NOTIFIKASI — satu tombol "OK", pop-up tengah layar
       ========================================================== */
    function notifySwal(icon, message, title) {
        icon = icon || 'info';

        return Swal.fire({
            icon: icon,
            title: title || DEFAULT_TITLES[icon] || 'Informasi',
            text: message || '',
            confirmButtonText: 'OK',
            confirmButtonColor: icon === 'error' ? COLOR_DANGER : COLOR_PRIMARY,
            customClass: BTN_CLASS
        });
    }

    window.AdminSwal = {
        confirm: confirmSwal,
        notify: notifySwal,
        success: function (msg, title) { return notifySwal('success', msg, title); },
        info:    function (msg, title) { return notifySwal('info', msg, title); },
        warning: function (msg, title) { return notifySwal('warning', msg, title); },
        error:   function (msg, title) { return notifySwal('error', msg, title); }
    };

    /* ==========================================================
       3) FLASH TERSEMBUNYI → POP-UP (load penuh & swap SPA)
       ========================================================== */
    var FLASH_MAP = [
        { attr: 'data-swal-success', icon: 'success' },
        { attr: 'data-swal-error',   icon: 'error'   },
        { attr: 'data-swal-warning', icon: 'warning' },
        { attr: 'data-swal-info',    icon: 'info'    }
    ];

    function popFlash(scope) {
        var queue = [];

        FLASH_MAP.forEach(function (item) {
            var nodes = (scope || document).querySelectorAll('[' + item.attr + ']');

            Array.prototype.forEach.call(nodes, function (el) {
                if (el.getAttribute('data-swal-shown')) return;   // sudah pernah tampil
                el.setAttribute('data-swal-shown', '1');
                el.setAttribute('hidden', 'hidden');

                var message = el.getAttribute(item.attr);
                if (message) queue.push({ icon: item.icon, message: message });
            });
        });

        /* Ditampilkan BERURUTAN — pop-up berikutnya baru muncul setelah
           yang sebelumnya ditutup, supaya tidak saling menimpa. */
        var chain = Promise.resolve();
        queue.forEach(function (item) {
            chain = chain.then(function () {
                return notifySwal(item.icon, item.message);
            }).catch(function () { /* popup gagal → lanjut antrean */ });
        });
    }

    /* ==========================================================
       4) FORM data-swal-confirm → VERIFIKASI DULU, BARU SUBMIT
       ========================================================== */

    /* Form DELETE (spoofing _method) = aksi destruktif:
       default-nya tombol merah + judul "Yakin Menghapus?" bila
       view tidak menyetel judul / nada sendiri. */
    function isDeleteForm(form) {
        var method = form.querySelector('input[name="_method"]');
        return !!method && String(method.value || '').toUpperCase() === 'DELETE';
    }

    document.addEventListener('submit', function (event) {
        var form = event.target;
        if (!form || typeof form.getAttribute !== 'function') return;

        var message = form.getAttribute('data-swal-confirm');
        if (!message) return;

        var deleteForm = isDeleteForm(form);

        /* Submit kedua (setelah konfirmasi "Ya, Lanjutkan")
           dibiarkan berjalan normal. */
        if (form.getAttribute('data-swal-confirmed') === '1') {
            form.removeAttribute('data-swal-confirmed');
            return;
        }

        event.preventDefault();

        confirmSwal({
            title: form.getAttribute('data-swal-confirm-title') ||
                   (deleteForm ? 'Yakin Menghapus?' : undefined),
            text: message,
            tone: form.getAttribute('data-swal-confirm-tone') ||
                  (deleteForm ? 'danger' : undefined)
        }).then(function (confirmed) {
            if (!confirmed) return;

            form.setAttribute('data-swal-confirmed', '1');
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();      // lolos validasi HTML5 dulu
            } else {
                form.removeAttribute('data-swal-confirmed');
                HTMLFormElement.prototype.submit.call(form);
            }
        });
    });

    /* ---- Pemicu: saat halaman dimuat penuh & setelah
           router.js menukar konten (navigasi SPA) ---- */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () { popFlash(document); });
    } else {
        popFlash(document);
    }
    document.addEventListener('pt:after-swap', function () { popFlash(document); });
})();
