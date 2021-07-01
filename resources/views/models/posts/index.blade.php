<h1>Посты</h1>
<a href="{{route('post.create')}}">Добавить пост</a>

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
