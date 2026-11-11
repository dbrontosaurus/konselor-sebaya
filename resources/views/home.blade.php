@extends('layouts.app')

@section('content')
    <section class="ci-hero ci-hero-sm">
        <div class="container">
            <h1 class="ci-hero-title mb-2">Halo, {{ Auth::user()->name }}</h1>
            <p class="mb-0" style="max-width: 52ch;">Mau mulai dari mana hari ini?</p>
        </div>
    </section>

    <section class="ci-section ci-overlap pt-0">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('posts.index') }}" class="card h-100 ci-card-link text-decoration-none text-reset">
                        <div class="card-body p-4">
                            <span class="ci-icon mb-3">✍️</span>
                            <h2 class="h6">Tulis curhat</h2>
                            <p class="text-muted small mb-0">Bagikan ceritamu di beranda, bisa sebagai anonim.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('appointments.create') }}" class="card h-100 ci-card-link text-decoration-none text-reset">
                        <div class="card-body p-4">
                            <span class="ci-icon ci-icon-amber mb-3">🗓️</span>
                            <h2 class="h6">Buat jadwal konseling</h2>
                            <p class="text-muted small mb-0">Ajukan sesi online atau offline.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('appointments.index') }}" class="card h-100 ci-card-link text-decoration-none text-reset">
                        <div class="card-body p-4">
                            <span class="ci-icon mb-3">📅</span>
                            <h2 class="h6">Jadwal Saya</h2>
                            <p class="text-muted small mb-0">Lihat status semua jadwal yang kamu ajukan.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
