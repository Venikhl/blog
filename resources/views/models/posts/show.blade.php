@extends('layouts.main')

@section('content')
    <h1>{{$post->title}}</h1>
    <a href="{{route('posts.index')}}">Все посты</a>
    <div>
        <small>
            Создано: {{$post->created_at}}
        </small>
    </div>

    <p>
        {{$post->content}}
    </p>
    @if(auth()->check())
        <a href="{{route('posts.edit', $post)}}">Изменить</a>
        <form action="{{route('posts.destroy', $post)}}" method="post">
            @csrf
            @method('delete')
            <button>Удалить</button>
        </form>
    @endif

@endsection
