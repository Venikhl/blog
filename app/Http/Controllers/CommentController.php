<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function store(CommentRequest $request, Post $post)
    {
        $comment = $post->comments()
            ->create($request->validated());

        $comment->user()->associate(auth()->user());
        return back();
    }

    function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
