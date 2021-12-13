{{--@extends('layouts.app')--}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #3a546b;
            color: #9da3ae;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 14px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .background {
            background-image: url("pozadina.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        h1, .top-right {
            background-color: #2c3451;
        }
    </style>
</head>
<body>
<div class="background">
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('/user.home') }}">Home</a>
            @else
                <a href="{{ route('login') }}" style="color: white">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" style="color: white">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content" style="color: white">
        <h1><b>Welcome to our ads site</b></h1>

        <button class="btn btn-success" href="{{ route('all.ads') }}"
                onclick="event.preventDefault();
                                                                    document.getElementById('settings').submit();">
            {{ __('Click here to view all ads on this site') }}
        </button>
        <form id="settings" action="{{ route(('all.ads')) }}" method="get"
              style="display: none">

        </form>
    </div>
</div>
</div>
</body>
</html>
