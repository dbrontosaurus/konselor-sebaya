@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('appointments.index') }}" class="text-decoration-none text-secondary mb-3 d-block">
                &larr; Kembali
            </a>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Buat Jadwal Konseling</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="type" class="form-label fw-semibold">Jenis Sesi</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Jenis Sesi --</option>
                                <option value="online">Online (Chat/Zoom)</option>
                                <option value="offline">Offline (Tatap Muka)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="scheduled_at" class="form-label fw-semibold">Tanggal & Jam</label>
                            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">Ajukan Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection