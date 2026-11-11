@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="ci-hero ci-hero-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <span class="ci-hero-badge">🌿 Ruang aman mahasiswa</span>
                    <h1 class="ci-hero-title mb-2">Beranda Curhat</h1>
                    <p class="mb-0" style="max-width: 52ch;">Ceritakan apa yang sedang kamu rasakan. Kamu bisa mengirimnya sebagai anonim.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="ci-overlap pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Form Tulis Curhat -->
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <form action="{{ route('posts.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="body" class="form-label fs-5 fw-bold">Ada yang ingin diceritakan hari
                                        ini?</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3"
                                        placeholder="Tulis curhatanmu di sini..."></textarea>
                                    @error('body')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="is_anonymous"
                                            name="is_anonymous">
                                        <label class="form-check-label text-muted" for="is_anonymous">
                                            🔒 Kirim sebagai Anonim
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-4">Bagikan Cerita</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Menampilkan Daftar Curhatan -->
                    @forelse($posts as $post)
                        <div class="card ci-card-link mb-3">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3 gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        {{-- Cek apakah status anonim aktif --}}
                                        @if ($post->is_anonymous)
                                            <span class="ci-avatar is-anon">👤</span>
                                            <div>
                                                <div class="fw-semibold">Seseorang</div>
                                                <span class="ci-tag ci-tag-anon">Anonim</span>
                                            </div>
                                        @else
                                            <span class="ci-avatar">👤</span>
                                            <div class="fw-semibold">{{ $post->user->name }}</div>
                                        @endif
                                    </div>
                                    <small class="text-muted text-nowrap">{{ $post->created_at->diffForHumans() }}</small>
                                </div>

                                <p class="ci-post-body">{{ $post->body }}</p>

                                <div class="ci-post-footer">
                                    <a href="{{ route('posts.show', $post->id) }}" class="ci-link">
                                        💬 {{ $post->comments->count() }} Komentar &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body ci-empty">
                                <div class="ci-empty-icon">🌱</div>
                                <h2 class="h5 mb-1">Belum ada curhatan</h2>
                                <p class="text-muted mb-0">Jadilah yang pertama bercerita!</p>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
@endsection
