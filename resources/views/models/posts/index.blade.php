@extends('layouts.main')

@section('content')
<h1>Посты</h1>

@can('create', App\Models\Post::class)
    <a href="{{route('posts.create')}}">Добавить пост</a>
@endcan

<hr>

@if($posts->isNotEmpty())
    <ol>
        @foreach($posts as $post)
            <li value="{{$post->id}}">
                <a href="{{route('posts.show', $post)}}">
                    {{$post->title}}
                </a>,
                <small>
                    {{$post->user->name}}
                </small>
            </li>
        @endforeach
    </ol>
@else
    <div>
        Постов нет! Приходите завтра! :)
    </div>
@endif
@endsection
