@extends('layouts.main')

@section('content')
    <h1>{{$post->title}}</h1>
    <a href="{{route('posts.index')}}">Все посты</a>
    <div>
        <small>
            Создано: {{$post->created_at}}
        </small><br />
        <small>
            Автор: {{$post->user->name}}
        </small>
    </div>

    <p>
        {{$post->content}}
    </p>
    @can('update', $post)
        <a href="{{route('posts.edit', $post)}}">Изменить</a>
    @endcan
    @can('delete', $post)
        <form action="{{route('posts.destroy', $post)}}" method="post">
            @csrf
            @method('delete')
            <button>Удалить</button>
        </form>
    @endcan

@endsection
