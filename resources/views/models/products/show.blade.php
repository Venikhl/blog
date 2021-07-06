@extends('layouts.main')

@section('content')
    <hr>
    <h1>{{$products->name}}</h1>
    <a href="{{route('products.index')}}">Все продукты</a>
    <div>
        <small>
            Создано: {{$products->created_at}}
        </small><br />
    </div>

    <p>
        {{$products->description}}
    </p>
    @can('update', $products)
        <a href="{{route('products.edit', $products)}}">Изменить</a>
    @endcan
    @can('delete', $products)
        <form action="{{route('products.destroy', $products)}}" method="post">
            @csrf
            @method('delete')
            <button>Удалить</button>
        </form>
    @endcan

@endsection
