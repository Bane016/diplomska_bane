<!doctype html>
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
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="{{asset("css/intlTelInput.css")}}">--}}
{{--    <link rel="stylesheet" href="{{asset("css/global.css")}}">--}}
    @yield("styles")
</head>
<body style="background-color: #3d5c96">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Ads site') }}
                </a>
            @elseif(auth()->guard('web')->check())
                <a class="navbar-brand" href="{{ route('user.home') }}">
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
                            <a class="nav-link" href="{{ route('login') }}"><b>{{ __('Login') }}</b></a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><b>{{ __('Register') }}</b></a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} {{ Auth::user()->surname }} <img alt="Profile Pic"
                                                             src="{{(auth()->user()->img !=null) ? asset("user_images/".auth()->user()->img) : asset("user_images/no_image.png")}}"
                                                             class="avatar" style="max-width: 40px"> <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
{{--                                <a class="dropdown-item" href="{{ route('user.settings') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                                    document.getElementById('settings').submit();">--}}
{{--                                    {{ __('Settings') }}--}}
{{--                                </a>--}}
{{--                                <form id="settings" action="{{ route(('user.settings')) }}" method="POST"--}}
{{--                                      style="display: none">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
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
    @if(auth()->guard('web')->check())
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: white">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent1"
                        aria-labelledby="navbarSupportedContent1" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav mr-auto" style="color: #1b1e21">
                        @if(auth()->guard("web")->check())
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link dashboard-nav-item {{ (Route::current()->getName() == 'user.home') ? 'active' : '' }}"
                                   href="{{route("user.home")}}">
                                    <i class="fas fa-home {{ (Route::current()->getName() == 'home') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("Dashboard") }}</b>
                                </a>
                            </li>
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link allBids-nav-item {{ (Route::current()->getName() == 'all.bids') ? 'active' : '' }}"
                                   href="{{route("all.bids")}}">
                                    <i class="fab fa-adversal {{ (Route::current()->getName() == 'all.bids') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("All Ads") }}</b>
                                </a>
                            </li>
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link myBids-nav-item {{ (Route::current()->getName() == 'user.my.bids') ? 'active' : '' }}"
                                   href="{{route("user.my.bids")}}">
                                    <i class="fas fa-address-book {{ (Route::current()->getName() == 'user.my.bids') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("My Ads") }}</b>
                                </a>
                            </li>
                            <li class="nav-item nav-item-custom">
                                <a class="nav-link settings-nav-item {{ (Route::current()->getName() == 'user.settings') ? 'active' : '' }}"
                                   href="{{route("user.settings")}}">
                                    <i class="fas fa-cog {{ (Route::current()->getName() == 'user.settings') ? 'logo-color1' : '' }}"></i>
                                    <b>{{ __("Settings") }}</b>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @endif

    <main class="py-4">
        @yield('content')
    </main>
</div>
    <script src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
    <script src="{{asset("js/popper.min.js")}}"></script>
{{--    <script src="{{asset("js/bootstrap.min.js")}}"></script>--}}
{{--    <script src="{{asset("js/intlTelInput.js")}}"></script>--}}
@yield('scripts')
{{--@include('footer')--}}
</body>
</html>
