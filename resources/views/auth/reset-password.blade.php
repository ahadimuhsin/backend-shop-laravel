@extends('layouts.auth', ['title' => 'Update Password'])

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
                    <h1 class="h5 text-gray-900 mb-3">LOGIN ADMIN</h1>
                </div>

                <form action="{{ route('password.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="form-group">
                        <label for="email" class="font-weight-bold text-uppercase">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email')
                            is-invalid @enderror" value="{{ $request->email ?? old('email') }}" required placeholder="Masukkan Alamat Email"
                            readonly>

                        @error('email')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bold text-uppercase">Email</label>
                        <input type="password" name="password" id="password" class="form-control @error('password')
                            is-invalid @enderror" placeholder="Password Baru" autocomplete="new-password" required>

                        @error('password')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="font-weight-bold text-uppercase">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" id="password-confirm"
                        required autocomplete="new-password" class="form-control"
                        placeholder="Konfirmasi Password Baru">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">UPDATE PASSWORD</button>
                    <hr>
                    <a href="/forgot-password">Lupa Password</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
