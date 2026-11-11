<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1E3A8A">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Console-Ing') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet">

    <!-- Scripts & Styles (CSS biasa, tanpa Sass) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- Memanggil file navbar.blade.php -->
        @include('layouts.navbar')

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <footer class="ci-footer">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="ci-brand mb-2"><span class="text-success">Console</span><span class="text-white">-Ing</span></div>
                        <p class="mb-0" style="max-width: 42ch;">Platform konseling sebaya untuk mahasiswa. Tempat bercerita, ngobrol dengan bot, dan membuat jadwal konseling.</p>
                    </div>
                    <div class="col-6 col-lg-3">
                        <h6>Jelajahi</h6>
                        <ul class="list-unstyled mb-0 d-grid gap-1">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ url('/') }}#tentang">Tentang</a></li>
                            <li><a href="{{ url('/') }}#layanan">Layanan</a></li>
                            <li><a href="{{ url('/') }}#faq">Pertanyaan umum</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-4">
                        <h6>Butuh bantuan segera?</h6>
                        <p class="mb-1">Healing119 (Kemenkes), gratis:</p>
                        <p class="mb-0">Telepon <strong class="text-white">119 ekstensi 8</strong><br>
                            atau chat di <a href="https://healing119.id" target="_blank" rel="noopener">healing119.id</a></p>
                    </div>
                </div>
                <div class="ci-footer-bottom d-flex flex-column flex-md-row justify-content-between gap-2">
                    <span>&copy; {{ date('Y') }} Console-Ing. Dibuat untuk mahasiswa.</span>
                    <span>Console-Ing bukan pengganti psikolog atau psikiater.</span>
                </div>
            </div>
        </footer>

        <!-- Chatbot AI melayang: tampil di semua halaman -->
        @include('layouts.chatbot')
    </div>
</body>
</html>
