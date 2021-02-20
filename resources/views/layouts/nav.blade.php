
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            Larafoto
        </a>

        {{-- Boton responsive --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else {{-- Users logeado --}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('like.index')}}">Favoritos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('image.create')}}">Subir imagen</a>
                    </li>

                    {{-- AVATAR --}}
                    @if (Auth::user()->image)
                        <li>
                            @include('includes.avatar')
                        </li>
                    @endif

                    {{-- MENU DESPLEGABLE --}}
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Str::ucfirst(Auth::user()->name) }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            {{-- Mi Perfil --}}
                            <a class="dropdown-item" href="">Mi perfil</a>
                            {{-- Configuracion --}}
                            <a class="dropdown-item" href="{{ route('config') }}">Configuración</a>

                            {{-- Logout --}}
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