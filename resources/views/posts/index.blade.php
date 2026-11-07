@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-4 fw-bold">Beranda Curhat</h3>

            <!-- Placeholder untuk Form Tulis Curhat (Fase Berikutnya) -->
            <div class="card mb-4 shadow-sm border-0 bg-light">
                <div class="card-body text-center text-muted p-4">
                    <i>Form untuk menulis curhatan akan diletakkan di sini.</i>
                </div>
            </div>

            <!-- Menampilkan Daftar Curhatan -->
            @forelse($posts as $post)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="card-subtitle text-muted fw-bold">
                                {{-- Cek apakah status anonim aktif --}}
                                @if($post->is_anonymous)
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