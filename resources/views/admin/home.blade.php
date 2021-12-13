@extends('layouts.admin-app')

@section('content')
    <div class="container">
        <br>
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
                            {{ __('You are logged in as Admin!') }}
                        </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
