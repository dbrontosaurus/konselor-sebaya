@extends('layouts.app')

@section('content')
    <section class="ci-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <div class="card ci-auth-card">
                        <div class="ci-auth-banner">
                            <h1>Verifikasi alamat email</h1>
                            <p>Satu langkah lagi sebelum kamu bisa memakai akunmu.</p>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    Tautan verifikasi baru sudah dikirim ke alamat emailmu.
                                </div>
                            @endif

                            <p>Sebelum melanjutkan, periksa emailmu untuk menemukan tautan verifikasi.</p>
                            <div class="text-muted">Belum menerima email?
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link ci-link p-0 m-0 align-baseline">Kirim ulang tautan verifikasi</button>.
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
