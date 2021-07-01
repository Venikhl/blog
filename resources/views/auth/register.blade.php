@extends('layouts.main')

@section('content')
<h1>Регистрация</h1>

<a href="{{route('login')}}">Войти</a>

<form action="{{route('register')}}" method="post">
    @csrf

    <div>
        <label for="name">Имя</label>
    </div>
    <input value="{{old('name')}}" type="text" name="name" id="name" required autofocus />
    @error('name')
    <span>{{$message}}</span>
    @enderror

    <div>
        <label for="email">Email</label>
    </div>
    <input value="{{old('email')}}" type="email" name="email" id="email" required />
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
        <label for="password_confirmation">Пароль еще раз</label>
    </div>
    <input type="password" name="password_confirmation" id="password_confirmation" required />

    <div>
        <button>Зарегистрироваться</button>
    </div>
</form>
@endsection
