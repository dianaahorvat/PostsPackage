<?php

namespace dianaahorvat\posts\Http\Controllers;

use App\Http\Controllers\Controller;
use dianaahorvat\posts\Models\Post;
use CloudCreativity\LaravelJsonApi\Validation\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $posts = Post::latest()->with('user','likes')->paginate(20);

        return view('posts::posts.index',[
            'posts' => $posts
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts::posts.show',[
            'post' => $post
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('delete',$post);   //delete is a method in PostPolicy  --> will throw an exception
        $post->delete();

        return back();
    }

    public function likedPosts(){
        $posts = Post::whereHas('likes');

        return $posts;
    }
}
