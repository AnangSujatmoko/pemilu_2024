@extends('layouts.auth')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                {{-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> --}}
                <img src="{{ asset('assets/img/logo_kpu.png') }}" alt="Laravel Logo" width="200" height="200">
                <br>
                <h3>Aplikasi Manajemen ​Timses & Pemenangan</h3>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            placeholder="Username" value="{{ old('username') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"> Login </button>
                        </div>
                    </div>
                    <br>
                    {{-- <p class="my-1">
                        <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p> --}}
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
