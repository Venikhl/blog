<h1>{{$post->title}}</h1>
<a href="{{route('post.index')}}">Все посты</a>
<div>
    <small>
        Создано: {{$post->created_at}}
    </small>
</div>

<p>
    {{$post->content}}
</p>

<a href="{{route('posts.edit', $post)}}">Изменить</a>
<form action="{{route('posts.delete', $post)}}" method="post">
    @csrf
    @method('delete')
    <button>Удалить</button>
</form>
