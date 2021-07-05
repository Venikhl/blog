<?php
$post = $post ?? null;
?>

@extends('layouts.main')

@section('content')
<h1>@if($post) Редактировать пост @else Новый пост @endif</h1>

<form enctype="multipart/form-data" action="{{$post ? route('posts.update', $post) : route('posts.store')}}" method="post">
    @csrf
    @if($post)
        @method('put')
    @endif


    <div>
        <label for="title">Заголовок</label>
    </div>
    <div>
        <input value="{{old('title', $post->title ?? null)}}" type="text" name="title" required autofocus />
        @error('title')
        <span>{{$message}}</span>
        @enderror
    </div>

    <div>
        <label for="image">Картинка поста</label>
    </div>
    <div>
        <input type="file" name="image" id="image" accept="image/*" />
        @error('image')
        <span>{{$message}}</span>
        @enderror
    </div>

    <div>
        <label for="content">Пост</label>
    </div>
    <div>
        <textarea name="content" id="content" required>{{old('content', $post->content ?? null)}}</textarea>
        @error('content')
        <span>{{$message}}</span>
        @enderror
    </div>
    <button>@if($post) Редактировать пост @else Создать пост @endif</button>
</form>

@endsection
