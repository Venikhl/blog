<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
//        dd($request->file('image'));
        $post = auth()->user()
            ->posts()
            ->create($data);

        $this->uploadImage($post, $request);

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
        $this->uploadImage($post, $request);

        return redirect()->route('posts.show', $post);
    }

    function destroy(Post $post){
        $this->removeImage($post);

        $post->delete();
        return redirect()->route('posts.index');
    }

    function deleteImage(Post $post){
        $this->authorize('update', $post);

        $this->removeImage($post);
        $post->update([
            'image_path' => null
        ]);

        return back();
    }

    function uploadImage(Post $post, PostRequest $request){
        if(!$request->hasFile('image'))
            return;

        $path = $request->file('image')->store('public');

        if($path === false)
            throw ValidationException::withMessages([
                'image' => 'Sorry, server error. Cannot upload image'
            ]);

        $this->removeImage($post);

        $post->fill([
            'image_path' => $path
        ])->save();
    }

    function removeImage(Post $post){
        if(!$post->image_path)
            return;

        Storage::delete($post->image_path);
    }
}
