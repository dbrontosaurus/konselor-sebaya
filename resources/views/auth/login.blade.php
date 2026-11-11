@extends('layouts.app')

@section('content')
    <section class="ci-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <div class="card ci-auth-card">
                        <div class="ci-auth-banner">
                            <h1>Masuk ke Console-Ing</h1>
                            <p>Lanjutkan ceritamu dan pantau jadwal konselingmu.</p>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Alamat email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata sandi</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">
                                    @error('password')
                                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="remember">Ingat saya</label>
                                </div>

                                <div class="d-grid gap-3">
                                    <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                                    @if (Route::has('password.request'))
                                        <a class="ci-link text-center" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                                    @endif
                                </div>
                            </form>

                            @if (Route::has('register'))
                                <hr class="my-4">
                                <p class="text-center text-muted mb-0">Belum punya akun?
                                    <a class="ci-link" href="{{ route('register') }}">Daftar</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
