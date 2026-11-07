@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mb-4 fw-bold">Beranda Curhat</h3>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Form Tulis Curhat -->
                <div class="card mb-4 shadow-sm border-0 bg-white">
                    <div class="card-body p-4">
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="body" class="form-label fw-bold">Ada yang ingin diceritakan hari
                                    ini?</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3"
                                    placeholder="Tulis curhatanmu di sini..."></textarea>
                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_anonymous"
                                        name="is_anonymous">
                                    <label class="form-check-label text-muted" for="is_anonymous">
                                        Kirim sebagai Anonim
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary px-4">Bagikan Cerita</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Menampilkan Daftar Curhatan -->
                @forelse($posts as $post)
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="card-subtitle text-muted fw-bold">
                                    {{-- Cek apakah status anonim aktif --}}
                                    @if ($post->is_anonymous)
                                        👤 Seseorang (Anonim)
                                    @else
                                        👤 {{ $post->user->name }}
                                    @endif
                                </h6>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>

                            <p class="card-text fs-5">{{ $post->body }}</p>

                            <hr class="text-muted">

                            <a href="#" class="text-decoration-none text-secondary">
                                💬 {{ $post->comments->count() }} Komentar
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center">
                        Belum ada curhatan. Jadilah yang pertama bercerita!
                    </div>
                @endforelse

            </div>
        </div>
    </div>
@endsection
