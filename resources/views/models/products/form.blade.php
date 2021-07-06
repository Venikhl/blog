<?php
$product = $product ?? null;
?>

@extends('layouts.main')

@section('content')
<h1>@if($product) Редактировать продукт @else Новый продукт @endif</h1>

<form enctype="multipart/form-data" action="{{$product ? route('posts.update', $product) : route('products.store')}}" method="post">
    @csrf
    @if($product)
        @method('put')
    @endif


    <div>
        <label for="title">Название продукта</label>
    </div>
    <div>
        <input value="{{old('name', $product->name ?? null)}}" type="text" name="name" required autofocus />
        @error('name')
        <span>{{$message}}</span>
        @enderror
    </div>

    <div>
        <label for="description">Описание продукта</label>
    </div>
    <div>
        <textarea name="description" id="description" required>{{old('description', $product->description ?? null)}}</textarea>
        @error('description')
        <span>{{$message}}</span>
        @enderror
    </div>
    <button>@if($product) Редактировать продукт @else Создать продукт @endif</button>
</form>

@endsection
