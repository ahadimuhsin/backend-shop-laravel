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
                        <h1 class="h5 text-gray-900 mb-3">CONFIRM PASSWORD</h1>
                    </div>

                    <form action="{{ route('password.confirm') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="password" class="font-weight-bold text-uppercase">
                                Password
                            </label>
                            <input type="password" name="password" id="password" class="form-control @error('password')
                            is-invalid @enderror" placeholder="Masukkan Password"
                            required autocomplete="password" tabindex="1">

                            @error('password')
                            <div class="alert alert-danger mt-2">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            CONFIRM PASSWORD
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
