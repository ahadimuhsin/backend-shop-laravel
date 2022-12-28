@extends('layouts.app', ['title' => 'Profile'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    @if (session('status') == 'profile-information-updated' || session('status') == 'password-updated')
                    Profile has been updated
                    @endif
                    @if (session('status') == 'two-factor-authentication-disabled')
                    Two Factor Authentication disabled
                    @endif
                    @if (session('status') == 'two-factor-authentication-enabled')
                    Two Factor Authentication enabled
                    @endif
                    @if (session('status') == 'recovery-codes-generated')
                    Recovery codes generated
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        <div class="col-md-5 mb-5">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-key"></i> Two Factor Authentication
                    </h6>
                </div>
                <div class="card-body">
                    @if(!auth()->user()->two_factor_secret)
                        {{-- Enable 2FA --}}
                        <form action="{{ route('two-factor.enable') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary text-uppercase">Enable Two Factor</button>
                        </form>
                    @else
                        {{-- Disable 2FA --}}
                        <form action="{{ route('two-factor.disable') }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger text-uppercase">Disable Two Factor</button>
                        </form>

                        @if(session('status') == 'two-factor-authentication-enabled')
                        {{-- Show SVG QR Code, After Enabling 2FA --}}
                        <p>Autentikasi dua faktor sekarang diaktifkan. Pindai kode QR berikut
                            menggunakan aplikasi authenticator di ponsel Anda
                        </p>
                        <div class="mb-3">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        @endif

                        {{-- Show 2FA Recovery Codes --}}
                        <p>
                            Simpan recovery code ini dengan aman. Ini dapat digunakan untuk memulihkan
                            akses ke akun Anda jika perangkat autentikasi dua faktor Anda hilang
                        </p>

                        <div class="rounded p-3 mb-2" style="background: rgb(44,44,44); color: white">
                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                            @endforeach
                        </div>

                        {{-- Regenrate 2FA Recovery Codes --}}
                        <form action="{{ route('two-factor.recovery-codes') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-dark text-uppercase">Regenerate Recovery
                                Codes</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-7">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-user-circle"></i> Edit Profile
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('user-profile-information.update') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="text-uppercase">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? auth()->user()->name }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-uppercase">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') ?? auth()->user()->email }}" required autofocus readonly>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-uppercase">
                            Update Profile
                        </button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow mt-3 mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-unlock"></i> Update Password
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('user-password.update') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password" class="text-uppercase">Password Sekarang</label>
                        <input type="password" name="current_password" class="form-control" required autocomplete="current-password">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-uppercase">Password Baru</label>
                        <input type="password" name="password" class="form-control" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="text-uppercase">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-uppercase">
                            Update Profile
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
