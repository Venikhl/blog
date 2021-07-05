@extends('layouts.main')

@section('content')
    <h1>{{$post->title}}</h1>
    <a href="{{route('posts.index')}}">Все посты</a>
    <div>
        <small>
            Создано: {{$post->created_at}}
        </small><br />
        <small>
            <a href="{{route('users.show', $post->user)}}">
                Автор: {{$post->user->name}}
            </a>
        </small>
    </div>

    @if($post->image_path)
        <p>
            <img src="{{\Illuminate\Support\Facades\Storage::url($post->image_path)}}" height="100" alt="">
        </p>
        @can('update', $post)
            <form action="{{route('posts.deleteImage', $post)}}" method="post">
                @csrf @method('delete')
                <button>Удалить картинку</button>
            </form>
        @endcan
    @endif
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

    <hr>

    <h3>Комментарии</h3>

    @can('create', \App\Models\Comment::class)
    <form action="{{route('comments.store', $post)}}" method="post">
        @csrf

        <textarea name="content">{{old('content')}}</textarea>
        @error('content')
        <span>{{$message}}</span>
        @enderror

        <div>
            <button>Добавить</button>
        </div>
    </form>
    @else
        Вы не подвтвердили свою почту! <br>
        <a href="{{route('verification.notice')}}">Подтвердить</a>
    @endcan

    @forelse($post->comments as $comment)
        <p>
            <small>
                <span>
                    @if($comment->user)
                        <a href="{{route('users.show', $post->user)}}">
                            {{$comment->user->name}}
                        </a>
                    @else
                        DELETED
                    @endif
                </span>
                @can('delete', $comment)
                    <a href="#" class="delete-comment-link" data-form-id="delete-comment-{{$comment->id}}">Удалить</a>
                @endcan
            </small>
            <br>
            <span>
                {{$comment->content}}
            </span>
        </p>
        @can('delete', $comment)
            <form id="delete-comment-{{$comment->id}}" action="{{route('comments.destroy', $comment)}}" method="post">
                @csrf
                @method('delete')
            </form>
        @endcan
    @empty
    <div>
        Комментариев пока нет!
    </div>
    @endforelse
    <script>
        let links = document.querySelectorAll('.delete-comment-link');
        links.forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                let id = link.dataset.formId;
                if(id){
                    let form = document.getElementById(id);
                    if(form)
                        form.submit();
                }
            });
        });
    </script>
@endsection
