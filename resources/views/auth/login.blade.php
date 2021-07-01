@extends('layouts.main')

@section('content')
    <h1>Войти</h1>

@if(\Route::has('register'))
    <a href="{{route('register')}}">Регистрация</a>
@endif

<form action="{{route('login')}}" method="post">
    @csrf

    <div>
        <label for="email">Email</label>
    </div>
    <input value="{{old('email')}}" type="email" name="email" id="email" required autofocus />
    @error('email')
    <span>{{$message}}</span>
    @enderror

    <div>
        <label for="password">Пароль</label>
    </div>
    <input type="password" name="password" id="password" required />
    @error('password')
    <span>{{$message}}</span>
    @enderror

    <div>
        <label for="remember">
            <input {{old('remember') ? 'checked' : ''}} type="checkbox" id="remember" name="remember" />
            Запомнить
        </label>
    </div>

    <div>
        <button>Войти</button>
    </div>
</form>

@endsection
