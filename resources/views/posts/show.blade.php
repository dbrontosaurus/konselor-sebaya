@extends('layouts.app')

@section('content')
    <section class="ci-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">

                    <!-- Tombol Kembali -->
                    <a href="{{ route('posts.index') }}" class="ci-back mb-4">
                        &larr; Kembali ke Beranda
                    </a>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Postingan Utama -->
                    <div class="card mb-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-start mb-4 gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if ($post->is_anonymous)
                                        <span class="ci-avatar is-anon">👤</span>
                                        <div>
                                            <h1 class="h5 card-title mb-1">Seseorang</h1>
                                            <span class="ci-tag ci-tag-anon">Anonim</span>
                                        </div>
                                    @else
                                        <span class="ci-avatar">👤</span>
                                        <h1 class="h5 card-title mb-0">{{ $post->user->name }}</h1>
                                    @endif
                                </div>
                                <small class="text-muted text-nowrap">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="ci-post-body fs-5">{{ $post->body }}</p>
                        </div>
                    </div>

                    <h2 class="h5 mb-3">Tanggapan ({{ $post->comments->count() }})</h2>

                    <!-- Daftar Komentar -->
                    @forelse($post->comments as $comment)
                        <div class="card ci-comment mb-3">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    {{-- Penanda khusus jika yang komentar adalah AI nantinya --}}
                                    @if ($comment->user->name == 'Hermes AI' || $comment->user->name == 'Teman Virtual')
                                        <span class="ci-avatar is-ai">🤖</span>
                                        <div>
                                            <div class="fw-semibold">{{ $comment->user->name }}</div>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    @else
                                        <span class="ci-avatar">👤</span>
                                        <div>
                                            <div class="fw-semibold">{{ $comment->user->name }}</div>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endif
                                </div>
                                <p class="mb-0" style="line-height: 1.75;">{{ $comment->body }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body ci-empty">
                                <div class="ci-empty-icon">🤝</div>
                                <p class="text-muted mb-0">Belum ada yang menanggapi. Berikan dukunganmu sekarang!</p>
                            </div>
                        </div>
                    @endforelse

                    <!-- Form Tambah Komentar -->
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="body" class="form-label fw-bold">Beri Dukungan atau Tanggapan</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3"
                                        placeholder="Ketik tanggapanmu di sini..."></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-4">Kirim Tanggapan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tombol Pindah ke Halaman Buat Jadwal -->
                    <div class="ci-cta text-center mt-4">
                        <h2 class="h5 mb-2">Butuh bicara lebih dalam?</h2>
                        <p class="mb-4 mx-auto" style="max-width: 46ch;">Apakah Bot Konselor menyarankanmu untuk bertemu atau kamu butuh sesi
                            khusus?</p>
                        <a href="{{ route('appointments.create') }}" class="btn btn-light-solid">
                            Buat Jadwal Konseling
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
