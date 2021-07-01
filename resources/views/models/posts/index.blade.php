@extends('layouts.main')

@section('content')
<h1>Посты</h1>

@if(auth()->check())
    <a href="{{route('posts.create')}}">Добавить пост</a>
@endif

<hr>

@if($posts->isNotEmpty())
    <ol>
        @foreach($posts as $post)
            <li value="{{$post->id}}">
                <a href="{{route('posts.show', $post)}}">
                    {{$post->title}}
                </a>
            </li>
        @endforeach
    </ol>
@else
    <div>
        Постов нет! Приходите завтра! :)
    </div>
@endif
@endsection
