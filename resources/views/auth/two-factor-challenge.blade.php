@extends('layouts.auth', ['title' => 'Confirm Password'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="img-logo text-center mt-5">
                <img src="{{ asset('assets/img/company.png') }}" alt="logo" style="width: 80px;">
            </div>

            <div class="card o-hidden border-0 shadow-lg mb-3 mt-5">
                <div class="card-body p-4">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="text-center">
                        <h1 class="h5 text-gray-900 mb-3">TWO FACTOR CHALLENGE</h1>
                    </div>

                    <form action="{{ route('two-factor.login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="text-uppercase">Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code')
                            is-invalid
                            @enderror" placeholder="Masukkan Code dari Aplikasi Authenticator">

                            @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <p class="text-muted">
                            <i>Atau Anda dapat memasukkan salah satu recovery code</i>
                        </p>
                        <div class="form-group">
                            <label for="" class="text-uppercase">Recovery Code</label>
                            <input type="text" name="recovery_code" id="recovery_code"
                            class="form-control @error('recovery_code')
                            is-invalid
                            @enderror" placeholder="Masukkan Recovery Code">

                            @error('recovery_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            LOGIN
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center text-white">
                <label for=""><a href="{{ route('password.email') }}" class="text-dark">
                Lupa Password
                </a></label>
            </div>
        </div>
    </div>
@endsection
