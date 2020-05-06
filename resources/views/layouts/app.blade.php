<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
        
            <title>{{ config('app.name', 'Laravel') }}</title>
        
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
            <livewire:styles>
            <!-- Fonts -->
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
            <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        </head>
        
<body>
    <div id="app">
            <nav class="nav-nav">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div class="logo-box">
                            <h1>THEMOVIEBOX</h1>
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="menu-nav navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul>
                            <!-- Authentication Links -->
                            @guest
                            <li><livewire:search></li>
                                <li>
                                    <a href="{{ route('login') }}"><button class="btn-login-login">{{ __('Login') }}</button></a>
                                </li>

                                @if(Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}"><button class="btn-signin-signin">{{ __('Register') }}</button></a>
                                    </li>
                                @endif
                            @else
                            <li><a class="nav-link" href="{{ route('watchlist.index', auth()->user()->id )}}">Watchlist</a></li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
            </nav>
           
    

        <main> 
            @yield('content')
       </main>
    </div>
    <livewire:scripts>
</body>
</html>
