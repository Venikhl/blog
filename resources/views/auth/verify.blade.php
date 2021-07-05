@extends('layouts.main')

@section('content')

    <hr>

    <img src="https://www.meme-arsenal.com/memes/ccd316cdc31245b2e05b93bcff80d6ba.jpg" />

    <p>
        Вам нужно подтвердить свою почту!
    </p>

    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <button>
            Переотправить письмо
        </button>
    </form>

@endsection
