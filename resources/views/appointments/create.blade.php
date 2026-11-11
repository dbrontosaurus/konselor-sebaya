@extends('layouts.app')

@section('content')
    <section class="ci-hero ci-hero-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6">
                    <span class="ci-hero-badge">🗓️ Sesi konseling</span>
                    <h1 class="ci-hero-title mb-2">Buat Jadwal Konseling</h1>
                    <p class="mb-0">Pilih jenis sesi dan waktu yang nyaman untukmu.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="ci-overlap pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6">
                    <a href="{{ route('appointments.index') }}" class="ci-back mb-3">
                        &larr; Kembali
                    </a>

                    <div class="card">
                        <div class="card-body p-4 p-md-5">
                            <form action="{{ route('appointments.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="type" class="form-label">Jenis Sesi</label>
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="" disabled selected>-- Pilih Jenis Sesi --</option>
                                        <option value="online">Online (Chat/Zoom)</option>
                                        <option value="offline">Offline (Tatap Muka)</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="scheduled_at" class="form-label">Tanggal & Jam</label>
                                    <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" required>
                                </div>

                                <div class="d-flex flex-column-reverse flex-sm-row justify-content-sm-between align-items-sm-center gap-3">
                                    <small class="text-muted">Setelah diajukan, statusnya muncul di Jadwal Saya.</small>
                                    <button type="submit" class="btn btn-primary px-4">Ajukan Jadwal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
