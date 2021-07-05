<!doctype html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <!-- CSS only -->
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
</head>
<body>

<div>
    <a href="{{route('index')}}">Главная</a>

    @auth
        <div style="display: flex">
            <a href="{{route('users.show', auth()->user())}}">{{auth()->user()->name}}</a>
        </div>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button>Выйти</button>
        </form>
    @else
        <a href="{{route('login')}}">Войти</a>
        @if(\Route::has('register'))
            <a href="{{route('register')}}">Регистрация</a>
        @endif
    @endauth
</div>

@yield('content')
</body>
</html>
