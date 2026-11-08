@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Jadwal Konseling Saya</h4>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Buat Jadwal Baru</a>
    </div>

    <!-- Tempat Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($appointments->isEmpty())
                <p class="text-muted text-center my-4">Kamu belum memiliki jadwal konseling.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal & Jam</th>
                                <th>Tipe Sesi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $apt)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($apt->scheduled_at)->format('d M Y, H:i') }}</td>
                                    <td>{{ ucfirst($apt->type) }}</td>
                                    <td>
                                        @if($apt->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                                        @elseif($apt->status == 'approved')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($apt->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection