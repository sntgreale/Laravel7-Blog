<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                rePost
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if (Auth::check())
                    @if (Auth::user() -> is_admin == 1)
                        <ul class="navbar-nav mr-auto">
                            <li>
                                <a class="nav-link" href="/users"> Users </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/posts"> Posts </a>
                            </li>   
                            <li>
                                <a class="nav-link" href="/comments"> Comments </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/reposts"> Reposts </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/likes"> Likes </a>
                            </li>
                        </ul>
                    @else
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a class="nav-link" href="/home"> Feed </a>
                        </li>
                    </ul>
                    @endif
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user() -> is_admin == 0)
                                    <a class="dropdown-item" href="{{ route('users.show', Auth::user() -> id) }}"> Profile </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>