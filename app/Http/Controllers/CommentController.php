<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    function store(CommentRequest $request, Post $post)
    {
//        $comment = $post->comments()
//            ->create($request->validated());
//
//        $comment->user()
//            ->associate(auth()->user())
//            ->save();

        $comment = new Comment($request->validated());
        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());
        $comment->save();
        return back();
    }

    function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
