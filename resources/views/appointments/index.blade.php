@extends('layouts.app')

@section('content')
    <section class="ci-hero ci-hero-sm">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
                <div>
                    <span class="ci-hero-badge">🗓️ Sesi konseling</span>
                    <h1 class="ci-hero-title mb-2">Jadwal Konseling Saya</h1>
                    <p class="mb-0" style="max-width: 52ch;">Pantau semua sesi yang sudah kamu ajukan di satu tempat.</p>
                </div>
                <a href="{{ route('appointments.create') }}" class="btn btn-light-solid">+ Buat Jadwal Baru</a>
            </div>
        </div>
    </section>

    <section class="ci-overlap pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    <!-- Tempat Notifikasi Sukses -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body p-2 p-md-3">
                            @if($appointments->isEmpty())
                                <div class="ci-empty">
                                    <div class="ci-empty-icon">📅</div>
                                    <h2 class="h5 mb-1">Belum ada jadwal</h2>
                                    <p class="text-muted mb-0">Kamu belum memiliki jadwal konseling.</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table ci-table align-middle">
                                        <thead>
                                            <tr>
                                                <th>Tanggal & Jam</th>
                                                <th>Tipe Sesi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($appointments as $apt)
                                                <tr>
                                                    <td class="fw-semibold">{{ \Carbon\Carbon::parse($apt->scheduled_at)->format('d M Y, H:i') }}</td>
                                                    <td>{{ ucfirst($apt->type) }}</td>
                                                    <td>
                                                        @if($apt->status == 'pending')
                                                            <span class="ci-badge ci-badge-warning">Menunggu Persetujuan</span>
                                                        @elseif($apt->status == 'approved')
                                                            <span class="ci-badge ci-badge-success">Disetujui</span>
                                                        @else
                                                            <span class="ci-badge ci-badge-neutral">{{ ucfirst($apt->status) }}</span>
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
            </div>
        </div>
    </section>
@endsection
