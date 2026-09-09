/* =============================================================
   CLIENT-SIDE ROUTER — pjax-style (Ultra Fast Navigation)
   -------------------------------------------------------------
   - Link internal diklik → fetch halaman MODE PARSIAL
     (hanya isi <main>, tanpa layout/navbar/footer).
   - Layout (navbar/sidebar/footer) TIDAK direload — tetap
     mounted. Hanya main content yang di-swap.
   - Halaman yang sudah dimuat di-CACHE di memori (Map).
     Navigasi ulang = INSTAN, tanpa fetch / request berulang.
   - Setelah swap: <title>, scroll, i18n, feather icons, lalu
     micro-animation enter 60ms (opacity + translateX 4px).
   - popstate → back/forward browser tetap berfungsi.
   - Prefetch: link navbar/sidebar di-prefetch saat idle, dan
     link apapun saat di-hover → klik terasa instan.
   - Fallback: link eksternal / modifier key / JS gagal →
     navigasi full-load normal (progressive enhancement).
   ============================================================= */
(function () {
    'use strict';

    /* ================= KONFIG ================= */
    var TRANSITION_MS = 60;   // durasi micro-interaction (50–80ms)
    var SLIDE_PX      = 4;    // slide sangat kecil (3–5px)
    var CACHE_LIMIT   = 20;   // maks halaman dalam cache memori

    var CACHE = new Map();    // url -> { title, html }
    var NAVIGATING = false;

    /* ================= UTIL ================= */
    function getContainer() {
        return document.querySelector('[data-pt-container]') ||
               document.querySelector('main') ||
               document.body;
    }

    function reducedMotion() {
        return window.matchMedia &&
            window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    }

    function reflow(el) { void el.offsetWidth; }

    /* ============== MICRO-ANIMATION (60ms, GPU-friendly) ============== */
    function injectStyles() {
        if (document.getElementById('pt-router-styles')) return;
        var style = document.createElement('style');
        style.id = 'pt-router-styles';
        style.textContent =
            '@keyframes ptIn{from{opacity:0;transform:translateX(' + SLIDE_PX + 'px)}' +
            'to{opacity:1;transform:translateX(0)}}' +
            '.pt-animating{animation:ptIn ' + (TRANSITION_MS / 1000) + 's ease-out both}' +
            '@media (prefers-reduced-motion: reduce){' +
            '.pt-animating{animation:none}}';
        document.head.appendChild(style);
    }

    function animateIn(container) {
        if (reducedMotion()) return;
        var el = container.querySelector('[data-pt-animate]') || container;
        el.classList.remove('pt-animating');
        reflow(el);
        el.classList.add('pt-animating');
        el.addEventListener('animationend', function handler() {
            el.classList.remove('pt-animating');
            el.removeEventListener('animationend', handler);
        });
    }

    /* ============== CACHE MEMORI ============== */
    function cacheSet(url, entry) {
        CACHE.set(url, entry);
        if (CACHE.size > CACHE_LIMIT) {
            CACHE.delete(CACHE.keys().next().value); // buang tertua (FIFO)
        }
    }

    /* ============== FETCH MODE PARSIAL ============== */
    function fetchPartial(url) {
        return fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-Partial': '1' },
            credentials: 'same-origin',
            redirect: 'follow'
        })
            .then(function (res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.text();
            })
            .then(function (html) {
                var doc = new DOMParser().parseFromString(html, 'text/html');
                var body = doc.querySelector('body[data-partial-content]');
                var selector = body ? body.getAttribute('data-partial-content') : null;
                var contentEl = (selector && doc.querySelector(selector)) ||
                                doc.querySelector('[data-pt-container] main') ||
                                doc.querySelector('main');
                if (!contentEl) throw new Error('No content');

                // Layout berbeda (mis. admin <-> situs publik) → pindah full-load
                if (selector !== document.body.getAttribute('data-partial-content')) {
                    throw { layoutMismatch: true, url: url };
                }

                return {
                    title: doc.title || '',
                    html: contentEl.innerHTML
                };
            });
    }

    /* Re-eksekusi script inline yang ikut dalam konten halaman baru
       (innerHTML tidak menjalankan <script> secara otomatis) */
    function reexecuteScripts(container) {
        Array.prototype.forEach.call(container.querySelectorAll('script'), function (old) {
            var s = document.createElement('script');
            if (old.src) s.src = old.src;
            s.textContent = old.textContent;
            old.parentNode.replaceChild(s, old);
        });
    }

    /* ============== SWAP KONTEN MAIN ============== */
    function swapContent(entry) {
        var container = getContainer();
        container.innerHTML = entry.html;
        reexecuteScripts(container);

        if (entry.title) document.title = entry.title;

        // Re-apply perilaku interaktif pada konten baru
        if (window.PLNI18N && typeof window.PLNI18N.apply === 'function') {
            window.PLNI18N.apply();
        }
        if (window.feather) {
            try { feather.replace(); } catch (e) { /* noop */ }
        }

        window.scrollTo(0, 0);
        animateIn(container);
    }

    /* ============== NAVIGASI ============== */
    function navigate(url, push) {
        if (NAVIGATING) return;
        NAVIGATING = true;

        var finish = function (entry) {
            cacheSet(url, entry);
            swapContent(entry);
            if (push) history.pushState({}, '', url);
            NAVIGATING = false;
        };

        var cached = CACHE.get(url);
        if (cached) {
            // Cache hit → INSTAN, tanpa network sama sekali
            finish(cached);
            return;
        }

        fetchPartial(url)
            .then(function (entry) { finish(entry); })
            .catch(function (err) {
                NAVIGATING = false;
                if (err && err.layoutMismatch) {
                    window.location.href = err.url; // layout beda → full-load
                } else {
                    window.location.href = url;     // fallback full-load
                }
            });
    }

    /* ============== INTERSEPT KLIK LINK INTERNAL ============== */
    document.addEventListener('click', function (event) {
        if (event.defaultPrevented || event.button !== 0) return;
        if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;

        var link = event.target && event.target.closest
            ? event.target.closest('a[href]')
            : null;
        if (!link || !link.href) return;
        if (link.protocol !== 'http:' && link.protocol !== 'https:') return;

        var url = new URL(link.href, window.location.href);

        if (url.origin !== window.location.origin) return;              // eksternal
        if (url.href === window.location.href) return;                  // halaman sama
        if (url.pathname + url.search === window.location.pathname + window.location.search) return;
        if (link.target && link.target !== '_self') return;             // tab baru
        if (link.hasAttribute('download')) return;
        if (link.hasAttribute('data-no-router')) return;                // opt-out

        event.preventDefault();
        navigate(url.href, true);
    });

    /* ============== BACK / FORWARD BROWSER ============== */
    window.addEventListener('popstate', function () {
        navigate(window.location.href, false);
    });

    /* ============== PREFETCH ============== */
    function prefetch(url) {
        if (CACHE.has(url)) return;
        fetchPartial(url)
            .then(function (entry) { cacheSet(url, entry); })
            .catch(function () { /* prefetch gagal → biarkan navigasi normal */ });
    }

    function sameOriginInternal(a) {
        if (!a || !a.href) return false;
        if (a.protocol !== 'http:' && a.protocol !== 'https:') return false;
        if (a.target && a.target !== '_self') return false;
        if (a.hasAttribute('download') || a.hasAttribute('data-no-router')) return false;
        try {
            var url = new URL(a.href, window.location.href);
            return url.origin === window.location.origin;
        } catch (e) { return false; }
    }

    // 1) Prefetch semua link navbar/sidebar saat browser idle
    function prefetchNav() {
        var links = document.querySelectorAll(
            '.navbar-pln a[href], .sidebar-nav a[href], .admin-sidebar a[href]'
        );
        Array.prototype.forEach.call(links, function (a) {
            if (sameOriginInternal(a)) prefetch(new URL(a.href, window.location.href).href);
        });
    }

    // 2) Prefetch saat hover link apapun (50ms delay agar tidak berlebihan)
    document.addEventListener('mouseover', function (event) {
        var link = event.target && event.target.closest
            ? event.target.closest('a[href]')
            : null;
        if (!sameOriginInternal(link)) return;
        setTimeout(function () {
            prefetch(new URL(link.href, window.location.href).href);
        }, 50);
    });

    /* ============== INIT ============== */
    injectStyles();
    if ('requestIdleCallback' in window) {
        requestIdleCallback(prefetchNav, { timeout: 1500 });
    } else {
        setTimeout(prefetchNav, 300);
    }
})();
