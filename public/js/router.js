/* =============================================================
   CLIENT-SIDE ROUTER — pjax-style (Ultra Fast Navigation) v2
   -------------------------------------------------------------
   Perbaikan performa navigasi (v2):
   - In-flight dedupe: request yang sama (prefetch vs klik) berbagi
     SATU promise — tidak ada request ganda ke server.
   - Fetch timeout (AbortController): request menggantung tidak
     lagi membekukan navigasi (NAVIGATING selalu di-reset di
     finally) — fallback full-load tetap jalan.
   - Prefetch flood dihapus: bulk prefetch sidebar + prefetch di
     setiap hover membanjiri server dengan render halaman penuh
     (itulah sumber delay). Kini hanya hover pada LINK NAVIGASI
     UTAMA yang di-prefetch, sekali per URL, dengan cooldown.
   - Cache memori diberi TTL (stale → diambil ulang di background),
     dan entri cache POST/filter dibersihkan otomatis.
   - Sidebar active state di-sync setelah swap (tidak perlu reload
     layout hanya untuk mengubah menu aktif).
   - Render tetap non-blocking: swap konten + micro-animation 60ms.
   ============================================================= */
(function () {
    'use strict';

    /* ================= KONFIG ================= */
    var TRANSITION_MS = 60;      // durasi micro-interaction (50–80ms)
    var SLIDE_PX      = 4;       // slide sangat kecil (3–5px)
    var CACHE_LIMIT   = 15;      // maks halaman dalam cache memori
    var CACHE_TTL_MS  = 120000;  // 2 menit — setelah itu revalidate
    var FETCH_TIMEOUT = 8000;    // 8s → fallback full-load
    var HOVER_COOLDOWN = 400;    // ms antar prefetch hover

    var CACHE = new Map();       // url -> { title, html, styles, at, etag }
    var INFLIGHT = new Map();    // url -> Promise (dedupe)
    var NAVIGATING = false;
    var lastHoverPrefetch = 0;

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

    /* ============== CACHE MEMORI (TTL + FIFO) ============== */
    function cacheSet(url, entry) {
        CACHE.set(url, entry);
        if (CACHE.size > CACHE_LIMIT) {
            CACHE.delete(CACHE.keys().next().value); // buang tertua (FIFO)
        }
    }

    function cacheGet(url) {
        var entry = CACHE.get(url);
        if (!entry) return null;
        if (Date.now() - entry.at > CACHE_TTL_MS) {
            CACHE.delete(url); // stale → fetch ulang
            return null;
        }
        return entry;
    }

    /* ============== FETCH MODE PARSIAL (timeout + dedupe) ============== */
    function fetchPartial(url) {
        // Dedupe: request identik yang sedang berjalan berbagi satu promise.
        // (prefetch hover + klik yang berdekatan tidak lagi = 2 request)
        if (INFLIGHT.has(url)) return INFLIGHT.get(url);

        var controller = new AbortController();
        var timer = setTimeout(function () { controller.abort(); }, FETCH_TIMEOUT);

        var promise = fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-Partial': '1' },
            credentials: 'same-origin',
            redirect: 'follow',
            signal: controller.signal
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

                // Extract page-specific <style> tags from <head>
                var styles = [];
                Array.prototype.forEach.call(doc.querySelectorAll('head style, head link[rel="stylesheet"][data-page]'), function (el) {
                    styles.push(el.outerHTML);
                });

                return {
                    title: doc.title || '',
                    html: contentEl.innerHTML,
                    styles: styles,
                    at: Date.now()
                };
            })
            .finally(function () {
                clearTimeout(timer);
                INFLIGHT.delete(url);
            });

        INFLIGHT.set(url, promise);
        return promise;
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

    /* Sinkronkan active state sidebar/topbar tanpa reload layout —
       menghapus kebingungan "menu tidak ikut berpindah" dan
       re-render layout yang tidak perlu. */
    function syncActiveState(url) {
        var path = new URL(url, window.location.href).pathname;
        Array.prototype.forEach.call(document.querySelectorAll('.sidebar-nav a[href], .admin-sidebar a[href]'), function (a) {
            var linkPath;
            try { linkPath = new URL(a.href, window.location.href).pathname; }
            catch (e) { return; }
            var isActive = linkPath === path;
            a.classList.toggle('active', isActive);
        });
    }

    /* ============== SWAP KONTEN MAIN ============== */
    function swapContent(entry) {
        var container = getContainer();
        container.innerHTML = entry.html;
        reexecuteScripts(container);

        if (entry.title) document.title = entry.title;

        // Remove old page-specific styles and inject new ones
        Array.prototype.forEach.call(document.querySelectorAll('head style[data-pt-page]'), function (el) {
            el.parentNode.removeChild(el);
        });
        if (entry.styles && entry.styles.length) {
            Array.prototype.forEach.call(entry.styles, function (html) {
                var tmp = document.createElement('div');
                tmp.innerHTML = html;
                var styleEl = tmp.firstChild;
                if (styleEl) {
                    styleEl.setAttribute('data-pt-page', '1');
                    document.head.appendChild(styleEl);
                }
            });
        }

        // Re-apply perilaku interaktif pada konten baru
        if (window.PLNI18N && typeof window.PLNI18N.apply === 'function') {
            window.PLNI18N.apply();
        }
        if (window.feather) {
            try { feather.replace(); } catch (e) { /* noop */ }
        }

        syncActiveState(window.location.href);
        window.scrollTo(0, 0);
        animateIn(container);
    }

    /* ============== NAVIGASI ============== */
    function navigate(url, push) {
        if (NAVIGATING) return;
        NAVIGATING = true;

        var cached = cacheGet(url);
        if (cached) {
            // Cache hit → INSTAN, tanpa network sama sekali
            try {
                swapContent(cached);
                if (push) history.pushState({}, '', url);
            } finally {
                NAVIGATING = false;
            }
            return;
        }

        fetchPartial(url)
            .then(function (entry) {
                cacheSet(url, entry);
                swapContent(entry);
                if (push) history.pushState({}, '', url);
            })
            .catch(function (err) {
                if (err && err.layoutMismatch) {
                    window.location.href = err.url; // layout beda → full-load
                } else {
                    window.location.href = url;     // fallback full-load
                }
            })
            .finally(function () {
                NAVIGATING = false;
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

    /* ============== PREFETCH (dibatasi, anti-flood) ==============
       Hanya link navigasi utama yang di-prefetch saat hover, sekali
       per URL, dengan cooldown antar prefetch. Bulk prefetch semua
       link sidebar saat idle DIHAPUS — itulah yang membanjiri server
       dengan render halaman penuh dan membuat server lambat. */
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

    function prefetch(url) {
        if (CACHE.has(url) || INFLIGHT.has(url)) return;
        fetchPartial(url)
            .then(function (entry) { cacheSet(url, entry); })
            .catch(function () { /* prefetch gagal → biarkan navigasi normal */ });
    }

    document.addEventListener('mouseover', function (event) {
        var link = event.target && event.target.closest
            ? event.target.closest('.sidebar-nav a[href], .admin-sidebar a[href], .navbar-pln a[href]')
            : null;
        if (!sameOriginInternal(link)) return;

        var now = Date.now();
        if (now - lastHoverPrefetch < HOVER_COOLDOWN) return;
        lastHoverPrefetch = now;

        prefetch(new URL(link.href, window.location.href).href);
    });

    /* ============== INIT ============== */
    injectStyles();
})();
