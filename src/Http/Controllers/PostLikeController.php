<?php

namespace dianaahorvat\posts\Http\Controllers;

use App\Http\Controllers\Controller;
use dianaahorvat\posts\Mail\PostLike;
use dianaahorvat\posts\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);   // a user can like a post only if is logged in
    }

    public function store(Post $post, Request $request){

        if($post->likedBy($request->user())){
            return response(null, 409);  //conflict code
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        //we're grabbing the softdeleted/deleted records where the user_id equals the currently authenticated user()->id
        if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            //only sends the email if it hasn't previously being liked
            Mail::to($post->user)->send(new PostLike(auth()->user(), $post));
        }

        return back();
    }

    public function destroy(Post $post, Request $request){

        $request->user()->likes()->where('post_id',$post->id)->delete();

        return back();
    }
}
