@extends('layouts.app', ['title' => 'Edit User'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-folder"> Edit User {{ $user->name }}</i>
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control @error('name')
                        is-invalid
                        @enderror" placeholder="Masukkan Nama User" value="{{ old('name', $user->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control
                        @error('email') is-invalid @enderror"
                        placeholder="Email User" value="{{ old('email', $user->email) }}" readonly>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                class="form-control @error('password')
                                is-invalid
                                @enderror" placeholder="Masukkan Password">

                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control @error('password_confirmation')
                                is-invalid
                                @enderror" placeholder="Masukkan Konfirmasi Password">

                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mr-1 btn-submit" type="submit">
                        <i class="fa fa-paper-plane"></i> Simpan
                    </button>
                    <button type="reset" class="btn btn-warning btn-reset"><i class="fa fa-redo"></i> Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
