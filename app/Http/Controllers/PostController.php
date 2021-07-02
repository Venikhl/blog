<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post', [
            'except' => ['index', 'show']
        ]);
    }

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
        return view('models.posts.form');
    }

    function store(PostRequest $request){
        $data = $request->validated();

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
        return view('models.posts.form', [
            'post' => $post
        ]);
    }

    function update(PostRequest $request, Post $post){
        $data = $request->validated();

        $post->update($data);
        return redirect()->route('posts.show', $post);
    }

    function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index');
    }
}
