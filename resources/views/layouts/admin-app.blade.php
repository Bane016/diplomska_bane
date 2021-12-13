<!DOCTYPE>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ads site') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    @yield("styles")
</head>
<body style="background-color: gray">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel border-bottom  bg-white shadow-sm"
         style="background-color: #76b852">
        <div class="container-fluid">
            @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Ads site') }}
                </a>
            @elseif(auth()->guard('admin')->check())
                <a class="navbar-brand" href="{{ url('/admin/home') }}">
                    {{ config('app.name', 'Ads site') }}
                </a>
            @endguest

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.login') }}"><b>{{ __('Admin Login') }}</b></a>
                        </li>
                    @elseif(auth()->guard('admin')->check())
                        <li class="nav-item dropdown mr-3 mt-2">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b>{{ Auth::user()->name }}</b> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{--                                <a class="dropdown-item" href="{{ route('admin.home') }}">--}}
                                {{--                                    {{__("Dashboard")}}--}}
                                {{--                                </a>--}}
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if(auth()->guard('admin')->check())
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: white">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent1"
                        aria-labelledby="navbarSupportedContent1" aria-expanded="false"
                        aria-label="{{ __("Toggle navigation") }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav mr-auto" style="color: #1b1e21">
                        @if(auth()->guard('admin')->check())
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link dashboard-nav-item {{ (Route::current()->getName() == 'admin.home') ? 'active' : '' }}"
                                   href="{{route("admin.home")}}">
                                    <i class="fas fa-home {{ (Route::current()->getName() == 'home') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("Dashboard") }}</b>
                                </a>
                            </li>
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link allBids-nav-item {{ (Route::current()->getName() == 'admin.all.ads') ? 'active' : '' }}"
                                   href="{{route("admin.all.ads")}}">
                                    <i class="fab fa-adversal {{ (Route::current()->getName() == 'admin.all.ads') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("All Ads") }}</b>
                                </a>
                            </li>
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link dashboard-nav-item {{ (Route::current()->getName() == 'admin.users') ? 'active' : '' }}"
                                   href="{{route("admin.users")}}">
                                    <i class="fas fa-users {{ (Route::current()->getName() == 'users') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("Users") }}</b>
                                </a>
                            </li>
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link settings-nav-item {{ (Route::current()->getName() == 'admin.settings') ? 'active' : '' }}"
                                   href="{{route("admin.settings")}}">
                                    <i class="fas fa-cog {{ (Route::current()->getName() == 'admin.settings') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("Settings") }}</b>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @endif
    @yield('content')
</div>
@yield('scripts')
</body>
</html>
