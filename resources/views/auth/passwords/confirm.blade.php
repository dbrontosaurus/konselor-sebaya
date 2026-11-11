@extends('layouts.app')

@section('content')
    <section class="ci-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <div class="card ci-auth-card">
                        <div class="ci-auth-banner">
                            <h1>Konfirmasi kata sandi</h1>
                            <p>Masukkan kata sandimu untuk melanjutkan.</p>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div class="mb-4">
                                    <label for="password" class="form-label">Kata sandi</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">
                                    @error('password')
                                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-3">
                                    <button type="submit" class="btn btn-primary btn-lg">Konfirmasi</button>
                                    @if (Route::has('password.request'))
                                        <a class="ci-link text-center" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
