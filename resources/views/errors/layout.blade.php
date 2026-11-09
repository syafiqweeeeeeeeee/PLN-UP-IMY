<!DOCTYPE html>
<html lang="id" class="{{ \App\Support\Theme::htmlClass(request()) }}" data-theme-pref="{{ \App\Support\Theme::preference(request()) }}" data-user-id="{{ auth()->id() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Terjadi Kesalahan') — PLN Nusantara Power</title>

    @include('layouts.partials.theme-head')

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-pln1.png') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}?v={{ @filemtime(public_path('css/theme.css')) }}">
    <style>
        :root {
            --brand: #005B9C;
            --brand-dark: #00426f;
            --text: #1e293b;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg: #f1f5f9;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: radial-gradient(circle at top, #e8f1fa 0%, var(--bg) 55%);
            color: var(--text);
            font-family: "Segoe UI", system-ui, -apple-system, "Helvetica Neue", Arial, sans-serif;
        }
        .err-card {
            width: 100%;
            max-width: 480px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
            padding: 2.25rem 2rem 2rem;
            text-align: center;
        }
        .err-logo {
            height: 42px;
            width: auto;
            margin-bottom: 1.25rem;
        }
        .err-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 91, 156, .08);
            color: var(--brand);
            font-size: 1.5rem;
            font-weight: 700;
        }
        .err-code {
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .35rem;
        }
        h1 {
            font-size: 1.25rem;
            font-weight: 800;
            margin: 0 0 .5rem;
            color: var(--brand-dark);
        }
        p {
            margin: 0 auto 1.5rem;
            font-size: .9rem;
            line-height: 1.6;
            color: var(--muted);
            max-width: 34ch;
        }
        .err-actions {
            display: flex;
            gap: .6rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .err-btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            border-radius: 10px;
            padding: .6rem 1.1rem;
            font-size: .85rem;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
        }
        .err-btn.primary {
            background: var(--brand);
            color: #fff;
        }
        .err-btn.primary:hover { background: var(--brand-dark); }
        .err-btn.soft {
            background: #fff;
            color: var(--brand);
            border-color: var(--line);
        }
        .err-btn.soft:hover { border-color: var(--brand); }
        .err-foot {
            margin-top: 1.5rem;
            font-size: .72rem;
            color: #94a3b8;
        }
        @media (max-width: 420px) {
            .err-card { padding: 1.75rem 1.25rem; }
        }
    </style>
</head>
<body class="err-page">
    <main class="err-card" role="main">
        <img src="{{ asset('assets/images/logo-pln1.png') }}" alt="PLN Nusantara Power" class="err-logo">

        <div class="err-icon" aria-hidden="true">@yield('icon', '!')</div>
        <div class="err-code">Error @yield('code', '500')</div>

        <h1>@yield('title', 'Terjadi Kesalahan')</h1>
        <p>@yield('message', 'Terjadi kendala saat memproses permintaan Anda. Silakan coba beberapa saat lagi.')</p>

        <div class="err-actions">
            @yield('actions')
            <a href="{{ url('/') }}" class="err-btn soft">Kembali ke Beranda</a>
        </div>

        <div class="err-foot">PLN Nusantara Power — Unit Induk Pembangunan</div>
    </main>
</body>
</html>
