@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="ci-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="ci-hero-badge">🌿 Platform konseling sebaya mahasiswa</span>
                    <h1 class="ci-hero-title mb-3">Ruang aman untuk bercerita dan mencari teman bicara</h1>
                    <p class="lead mb-4" style="max-width: 52ch;">
                        Tulis curhat secara anonim, ngobrol dengan Bot Konselor Sebaya, atau ajukan jadwal konseling
                        online maupun offline saat kamu ingin bicara langsung.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        @auth
                            <a href="{{ route('posts.index') }}" class="btn btn-light-solid btn-lg">Buka beranda curhat</a>
                            <a href="{{ route('appointments.create') }}" class="btn btn-ghost-light btn-lg">Buat jadwal konseling</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-light-solid btn-lg">Daftar</a>
                            @endif
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-ghost-light btn-lg">Masuk</a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <h2 class="h6 mb-3">Yang bisa kamu lakukan di Console-Ing</h2>
                            <div class="d-flex gap-3 mb-3">
                                <span class="ci-icon">✍️</span>
                                <div>
                                    <div class="fw-semibold">Menulis curhat</div>
                                    <small class="text-muted">Bisa dikirim sebagai anonim.</small>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-3">
                                <span class="ci-icon ci-icon-green">🤖</span>
                                <div>
                                    <div class="fw-semibold">Ngobrol dengan bot</div>
                                    <small class="text-muted">Cerita dulu, lalu dapat arahan langkah berikutnya.</small>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <span class="ci-icon ci-icon">🗓️</span>
                                <div>
                                    <div class="fw-semibold">Jadwal konseling</div>
                                    <small class="text-muted">Pilih sesi online atau offline.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section class="ci-section" id="tentang">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5">
                    <span class="ci-eyebrow">Tentang Console-Ing</span>
                    <h2 class="ci-section-title">Apa itu konseling sebaya?</h2>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body p-4">
                            <p>Konseling sebaya berarti sesama mahasiswa saling mendengarkan dan mendukung. Banyak masalah
                                kuliah terasa lebih ringan setelah diceritakan ke orang yang paham situasinya.</p>
                            <p class="mb-0 text-muted">Console-Ing menyediakan tempat untuk beranda curhat, bot untuk
                                cerita pertama, dan jadwal konseling untuk pembicaraan langsung. Website Console-Ing tidak
                                menggantikan psikolog atau psikiater.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara memakai -->
    <section class="ci-section ci-section-alt">
        <div class="container">
            <div class="mb-4">
                <span class="ci-eyebrow">Cara memakai</span>
                <h2 class="ci-section-title">Tiga langkah dari cerita sampai sesi</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <span class="ci-step-no">1</span>
                            <h3 class="h5">Tulis atau ngobrol</h3>
                            <p class="text-muted mb-0">Tulis curhat di beranda, atau ceritakan dulu ke Bot Konselor Sebaya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <span class="ci-step-no">2</span>
                            <h3 class="h5">Baca tanggapan</h3>
                            <p class="text-muted mb-0">Pengguna lain bisa memberi dukungan lewat kolom tanggapan di setiap cerita.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <span class="ci-step-no">3</span>
                            <h3 class="h5">Buat jadwal jika perlu</h3>
                            <p class="text-muted mb-0">Kalau ceritamu perlu dibahas langsung, ajukan sesi konseling online atau offline.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan -->
    <section class="ci-section" id="layanan">
        <div class="container">
            <div class="mb-4">
                <span class="ci-eyebrow">Layanan</span>
                <h2 class="ci-section-title">Pilih cara yang paling nyaman</h2>
                <p class="ci-section-lead mb-0">Semua layanan bisa dipakai setelah kamu masuk, kecuali bot yang bisa dibuka dari halaman mana pun.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 ci-card-link">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="ci-icon mb-3">✍️</span>
                            <h3 class="h6">Curhat anonim</h3>
                            <p class="text-muted small flex-grow-1">Tulis ceritamu di beranda. Centang anonim kalau kamu tidak ingin namamu tampil.</p>
                            <a class="ci-link" href="@auth{{ route('posts.index') }}@else{{ route('login') }}@endauth">Buka beranda</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 ci-card-link">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="ci-icon ci-icon-green mb-3">🤖</span>
                            <h3 class="h6">Bot Konselor Sebaya</h3>
                            <p class="text-muted small flex-grow-1">Ceritakan dulu ke bot. Kalau perlu, bot mengarahkanmu ke jadwal konseling.</p>
                            <a class="ci-link" href="#" data-chatbot-toggle>Mulai chat</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 ci-card-link">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="ci-icon ci-icon-amber mb-3">🗓️</span>
                            <h3 class="h6">Jadwal konseling</h3>
                            <p class="text-muted small flex-grow-1">Pilih sesi online atau offline, lalu pantau statusnya di Jadwal Saya.</p>
                            <a class="ci-link" href="@auth{{ route('appointments.create') }}@else{{ route('login') }}@endauth">Buat jadwal</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="ci-icon mb-3">📋</span>
                            <h3 class="h6">Cek kondisi mental</h3>
                            <p class="text-muted small flex-grow-1">Kuesioner untuk mengenali kondisimu saat ini.</p>
                            <span class="ci-tag ci-tag-soon align-self-start">Segera hadir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Konselor -->
    <section class="ci-section ci-section-alt" id="konselor">
        <div class="container">
            <div class="mb-4">
                <span class="ci-eyebrow">Konselor</span>
                <h2 class="ci-section-title">Lihat konselor sebaya</h2>
            </div>
            <div class="card">
                <div class="card-body p-4 d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                    <span class="ci-icon">👥</span>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">Daftar konselor belum tersedia</div>
                        <small class="text-muted">Profil konselor akan tampil di bagian ini setelah fitur direktori selesai.</small>
                    </div>
                    <span class="ci-tag ci-tag-soon">Segera hadir</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="ci-section" id="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <span class="ci-eyebrow">Pertanyaan umum</span>
                        <h2 class="ci-section-title">Yang sering ditanyakan</h2>
                    </div>
                    <div class="accordion ci-accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                                    Apa yang terjadi kalau aku memilih anonim?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Ceritamu tampil sebagai &ldquo;Seseorang (Anonim)&rdquo; di beranda dan di halaman tanggapan, jadi pengguna lain tidak melihat namamu.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    Apakah bot bisa menggantikan konselor?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Tidak. Bot membantumu mulai bercerita dan menunjukkan cara membuat jadwal. Untuk pembicaraan lanjutan, ajukan jadwal konseling.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    Bagaimana cara membuat jadwal konseling?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Masuk, buka Jadwal Saya, pilih Buat Jadwal Baru, lalu tentukan jenis sesi (online atau offline) dan waktunya. Status pengajuanmu muncul di halaman yang sama.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                    Bagaimana kalau aku sedang dalam keadaan darurat?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Telepon 119 ekstensi 8 (Healing119 dari Kementerian Kesehatan) atau buka healing119.id. Jangan menunggu balasan di Console-Ing untuk keadaan darurat.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="pb-5">
        <div class="container">
            <div class="ci-cta text-center">
                <h2 class="h3 mb-2">Siap bercerita?</h2>
                <p class="mb-4 mx-auto" style="max-width: 46ch;">Mulai dari satu kalimat. Kamu yang menentukan seberapa banyak yang ingin dibagikan.</p>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    @auth
                        <a href="{{ route('posts.index') }}" class="btn btn-light-solid btn-lg">Tulis curhat</a>
                        <a href="{{ route('appointments.create') }}" class="btn btn-ghost-light btn-lg">Buat jadwal konseling</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light-solid btn-lg">Daftar</a>
                        @endif
                        <a href="#" class="btn btn-ghost-light btn-lg" data-chatbot-toggle>Chat dengan bot dulu</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
