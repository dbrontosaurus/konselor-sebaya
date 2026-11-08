@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Tombol Kembali -->
            <a href="{{ route('posts.index') }}" class="text-decoration-none text-secondary mb-3 d-block">
                &larr; Kembali ke Beranda
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Postingan Utama -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 fw-bold">
                            @if($post->is_anonymous)
                                👤 Seseorang (Anonim)
                            @else
                                👤 {{ $post->user->name }}
                            @endif
                        </h5>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="card-text fs-5">{{ $post->body }}</p>
                </div>
            </div>

            <h5 class="mb-3 fw-bold">Tanggapan ({{ $post->comments->count() }})</h5>

            <!-- Daftar Komentar -->
            @forelse($post->comments as $comment)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-1">
                            {{-- Penanda khusus jika yang komentar adalah AI nantinya --}}
                            @if($comment->user->name == 'Hermes AI' || $comment->user->name == 'Teman Virtual')
                                🤖 {{ $comment->user->name }}
                            @else
                                👤 {{ $comment->user->name }}
                            @endif
                        </h6>
                        <small class="text-muted d-block mb-2">{{ $comment->created_at->diffForHumans() }}</small>
                        <p class="mb-0">{{ $comment->body }}</p>
                    </div>
                </div>
            @empty
                <div class="alert alert-light text-center border">
                    Belum ada yang menanggapi. Berikan dukunganmu sekarang!
                </div>
            @endforelse

            <!-- Form Tambah Komentar -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <form action="{{ route('comments.store', $post->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="body" class="form-label fw-bold">Beri Dukungan atau Tanggapan</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="2" placeholder="Ketik tanggapanmu di sini..."></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection