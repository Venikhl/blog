<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentCreated extends Notification
{
    use Queueable;

    protected $post;
    protected $comment;

    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail(User $user)
    {
        return (new MailMessage)
            ->subject("Новый комментарий к посту \"{$this->post->title}\"")
            ->line("К вашему посту \"{$this->post->title}\" {$this->comment->user->name} оставил комментарий")
            ->action('Открыть пост', route('posts.show', $this->post));
    }
}
