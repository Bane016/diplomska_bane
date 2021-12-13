@extends('layouts.app')
@section('styles')
    <style>
        .test {
            background-image: url("login.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
@endsection

@section('content')
    <div class="test">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><b>{{ __('User Dashboard') }}</b></div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <b>
                                {{ __('Hi') }} {{ Auth::user()->name }} {{ Auth::user()->surname }}, <br>
                                {{ __('You are logged in!') }}
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
