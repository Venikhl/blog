<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->hasVerifiedEmail();
    }

    public function delete(User $user, Comment $comment)
    {
        //$postFK = (new Post())->getForeignKey();
        //$comment->getAttribute($postFK)
        $exists = $user
            ->posts()
            ->where('id', $comment->post_id)
            ->exists();

        if($exists)
            return true;

        if(!$comment->user)
            return false;

        return $user->id == $comment->user->id;
    }
}
