@extends('layouts.main')

@section('content')

    <h1>{{$user->name}}</h1>

    <h3>Посты</h3>

    @if($posts->isEmpty())
        Постов нет!
    @else
        <ul>
            @foreach($posts as $post)
                <li>
                    <a href="{{route('posts.show', $product)}}">
                        {{$product->title}}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <hr>

    <h3>Комментарии</h3>
    @forelse($comments as $comment)
        <p>
            {{$comment->content}}
            <br>
            <small>
                <a href="{{route('posts.show', $comment->post)}}">
                    {{$comment->post->title}}
                </a>
            </small>
        </p>
        @empty
        Комментарев нет!
        @endforelse
@endsection
