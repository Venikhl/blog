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
            ->get();
        return view('models.posts.index', [
            'posts' => $posts
        ]);
    }

    function create(){
        return view('models.posts.form');
    }

    function store(){
        $data = request()->validate($this->rules());
        $post = Post::query()
            ->create($data);
        return redirect()->route('posts.show', $post);
    }

    function show(Post $post){

        return view('models.posts.show', [
            'post' => $post
        ]);
    }

    function edit(Post $post){
        return view('models.posts.form', [
            'post' => $post
        ]);
    }

    function update(Post $post){
        $data = \request()->validate($this->rules($post));

        $post->update($data);
        return redirect()->route('posts.show', $post);
    }

    function destroy(Post $post){
        $post->delete();
        return redirect()->route('post.index');
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
