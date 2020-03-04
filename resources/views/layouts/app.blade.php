<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>




    @stack('scripts')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">







</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
            </div>
        </nav>
        <div class="logo-section">
            <div class="container">
                <div class="logo-container">
                    <div class="logo">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="logo-description">
                        <p>Лучшие рецепты для всей Вашей семьи!</p>
                        <p>Помощь профессиональных диетологов!</p>
                        <p>Возможность самых смелых кулинарных экспериментов!</p>
                    </div>
                    <div class="logo-diet">
                        <img src={{asset('storage/uploads/doctor.png')}}>
                        <a class='btn btn-default nutritionist' href='{{route('doctor-list')}}'>Диетологи</a>
                    </div>
                </div>


            </div>
        </div>

        @if(\Illuminate\Support\Facades\Auth::user() != null && \Illuminate\Support\Facades\Auth::user()->hasRole(3))
                <nav class="menu">
                    <div class="container" >
                        <ul >
                            <li  id="admin" style="position: relative"><a href="{{route('admin-panel')}}">Админпанель</a>
                                @if(\Illuminate\Support\Facades\Auth::user() != null)
                                    @if(count(\Illuminate\Support\Facades\Auth::user()->adminTakeNoReadMessages())>0)
                                        <div style="position:absolute; top:30px; left:0; background: #ffe924;padding: 5px;
    border-radius: 0 10px 10px 10px; color: #4d4729;">
                                            Message!
                                        </div>
                                    @endif
                                @endif
                            </li>
                            <li><a href="{{route('categories')}}">Категории</a></li>
                            <li><a href="{{route('units')}}">Единицы измерений</a></li>
                            <li><a href="{{route('admin-nutritionist')}}">Диетологи</a></li>
                            <li><a href="{{route('nutritionist-application')}}">Заявки на подтверждение</a></li>
                        </ul>
                    </div>
                </nav>

        @else
            <nav class="menu">
                <div class="container">
                    <ul>
                        <li><a href="{{route('home')}}">Главная</a></li>
                        <li ><a href="{{route('personal-show')}}">Личный кабинет</a>

                        </li>

                        <li><a href="{{route('cooker-book-show')}}">Кулинарная книга</a></li>
                        <li><a href="">Подписки</a></li>
                        <li><a href="">Подписчики</a></li>
                        <li><a href="{{route('own-recipe-show')}}">Мои рецепты</a></li>
                        <li><a href="{{route('nutritionist-conditions')}}">Диетологам</a></li>

                    </ul>
                </div>
            </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            @if(\Illuminate\Support\Facades\Auth::user() != null && \Illuminate\Support\Facades\Auth::user()->hasRole(3))
                <nav class="menu">
                    <div class="container">
                        <ul>
                            <li><a href="{{route('admin-panel')}}">Админпанель</a></li>
                            <li><a href="{{route('categories')}}">Категории</a></li>
                            <li><a href="{{route('units')}}">Единицы измерений</a></li>
                            <li><a href="{{route('admin-nutritionist')}}">Диетологи</a></li>
                            <li><a href="{{route('nutritionist-application')}}">Заявки на подтверждение</a></li>
                        </ul>
                    </div>
                </nav>

            @else
            <nav class="menu">
                <div class="container">
                    <ul>
                        <li><a href="{{route('home')}}">Главная</a></li>
                        <li id="admin" style="position: relative"><a href="{{route('personal-show')}}">Личный кабинет</a>

                        </li>
                        <li><a href="{{route('cooker-book-show')}}">Кулинарная книга</a></li>
                        <li><a href="">Подписки</a></li>
                        <li><a href="">Подписчики</a></li>
                        <li><a href="{{route('own-recipe-show')}}">Мои рецепты</a></li>
                        <li><a href="{{route('nutritionist-conditions')}}">Диетологам</a></li>
                    </ul>
                </div>
            </nav>
            @endif
        </footer>
    </div>


</body>
</html>
