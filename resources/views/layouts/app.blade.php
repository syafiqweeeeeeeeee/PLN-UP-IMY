<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title', 'Grayscale - Start Bootstrap Theme')</title>

        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('startbootstrap-grayscale-gh-pages/assets/favicon.ico') }}" />

        {{-- Font Awesome icons (free version) --}}
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        {{-- Google fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

        {{-- Core theme CSS (includes Bootstrap) --}}
        <link href="{{ asset('startbootstrap-grayscale-gh-pages/css/styles.css') }}" rel="stylesheet" />

        @stack('styles')
    </head>
    <body id="page-top">
        {{-- Navbar --}}
        @include('layouts.navbar')

        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        @include('layouts.footer')

        {{-- Bootstrap core JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        {{-- Core theme JS --}}
        <script src="{{ asset('startbootstrap-grayscale-gh-pages/js/scripts.js') }}"></script>

        {{-- SB Forms JS --}}
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        @stack('scripts')
    </body>
</html>
