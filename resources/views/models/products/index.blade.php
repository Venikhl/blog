@extends('layouts.main')

@section('content')
<h1>Продукты</h1>

@can('create', App\Models\Product::class)
    <a href="{{route('products.create')}}">Добавить продукт</a>
@endcan

<hr>

@if($products->isNotEmpty())
    <ol>
        @foreach($products as $product)
            <li value="{{$product->id}}">
                <a href="{{route('products.show', $product)}}">
                    {{$product->name}}
                </a>,
                <small>
                    {{$product->user->name}}
                </small>
            </li>
        @endforeach
    </ol>
@else
    <div>
        Продуктов нет! Приходите завтра! :)
    </div>
@endif
@endsection
