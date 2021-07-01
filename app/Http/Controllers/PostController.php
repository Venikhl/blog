<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /*
     * Список всех постов
     */
    function index(){
        $posts = Post::query()
            ->latest()
            ->with('user')
            ->get();
        return view('models.posts.index', [
            'posts' => $posts
        ]);
    }

    function create(){
        $this->authorize('create', Post::class);
        return view('models.posts.form');
    }

    function store(){
        $this->authorize('create', Post::class);
        $data = request()->validate($this->rules());

        $post = auth()->user()
            ->posts()
            ->create($data);
        return redirect()->route('posts.show', $post);
    }

    function show(Post $post){

        return view('models.posts.show', [
            'post' => $post
        ]);
    }

    function edit(Post $post){
        $this->authorize('update', $post);
        return view('models.posts.form', [
            'post' => $post
        ]);
    }

    function update(Post $post){
        $this->authorize('update', $post);
        $data = \request()->validate($this->rules($post));

        $post->update($data);
        return redirect()->route('posts.show', $post);
    }

    function destroy(Post $post){
        $this->authorize('delete', Post::class);
        $post->delete();
        return redirect()->route('posts.index');
    }

    protected function rules(Post $post = null): array{
        $uniqueTitle = Rule::unique('posts', 'title');
        if($post)
            $uniqueTitle->ignoreModel($post);
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'content' => ['required', 'string', 'min:10']
        ];
    }
}
