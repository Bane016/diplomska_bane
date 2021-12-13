@extends('layouts.admin-app')
@section('style')
    <style>
        .login {
            background-color: #4CAF50;
            border: none;
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    @if(auth()->guard('admin')->check())
        <div class="container-fluid">
            <div class="row justify-content-center mb-3">
                {{--            <div class="col-md-11">--}}
                {{--                <h5 class="font-weight-bold" style="color: white"><i class="fas fa-home"></i>--}}
                {{--                    {{__("Dashboard")}}--}}
                {{--                </h5>--}}
                {{--            </div>--}}
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(242,242,242)"><b>Admin Dashboard</b></div>

                        <div class="card-body" style="background-color: rgb(242,242,242)">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <b>You are logged in as Admin!</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <body style="background-color: #76b852">
        <div class="container">
            <div class="rpw justify-content-center mb-3">

            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="background-color: #F2F2F2"><b>{{ __('Admin Login') }}</b></div>

                        <div class="card-body" style="background-color: rgb(242,242,242)">
                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right"><b>{{ __('E-Mail Address') }}</b></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right"><b>{{ __('Password') }}</b></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn login btn-primary" style="background-color: #4CAF50">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endsection
