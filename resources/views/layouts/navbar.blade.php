<nav class="navbar navbar-expand-lg navbar-light ci-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand ci-brand" href="{{ url('/') }}">
            <span class="text-primary">Console</span><span class="text-dark">-Ing</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Buka menu navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto mt-3 mt-lg-0 ms-lg-3 gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}"
                        href="@auth{{ route('posts.index') }}@else{{ url('/') }}@endauth">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#konselor">Lihat Konselor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#layanan">Layanan &amp; Cek Mental</a>
                </li>
                @auth
                    <!-- Menu Jadwal Saya (Khusus user yang login) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
                            href="{{ route('appointments.index') }}">Jadwal Saya</a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-2 mt-lg-0">
                <!-- Toggle Chatbot AI -->
                <li class="nav-item my-2 my-lg-0">
                    <button type="button" class="btn btn-sm btn-chat-nav" data-chatbot-toggle>
                        🤖 Chat dengan Bot
                    </button>
                </li>

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Keluar
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
