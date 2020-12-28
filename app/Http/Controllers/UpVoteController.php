<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\MultiPost;
use App\Models\Post;
use App\Events\StatusLiked;
use App\Events\ActivityEvent;
use Illuminate\Http\Request;
use App\Models\Upvote;


class UpVoteController extends Controller
{
    public function post_up_vote(Post $post){
        $upvote = new Upvote;
        $post->upvotes()->save($upvote);
        //event(new StatusLiked('Someone'));
        //event(new ActivityEvent('s'));
        // require __DIR__ . '\vendor\autoload.php';
        // $pusher = new Pusher\Pusher("APP_KEY", "APP_SECRET", "APP_ID", array('cluster' => 'APP_CLUSTER'));

        // $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));
        return redirect()->route('home');
    }

    public function multi_post_up_vote(MultiPost $multi_post){
        $upvote = new Upvote;
        $multi_post->upvotes()->save($upvote);
        return redirect()->route('home');
    }

    public function comment_up_vote(Comment $comment){
        $upvote = new Upvote;
        $comment->upvotes()->save($upvote);
        return redirect()->route('home');
    }
}
