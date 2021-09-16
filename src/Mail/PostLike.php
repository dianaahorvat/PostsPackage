<?php

namespace dianaahorvat\posts\Mail;

use dianaahorvat\posts\Models\Post;
use dianaahorvat\posts\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostLike extends Mailable
{
    use Queueable, SerializesModels;
    public $liker, $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $liker, Post $post)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('posts::emails.posts.post_liked')
            ->subject('Someone liked your post');
    }
}
