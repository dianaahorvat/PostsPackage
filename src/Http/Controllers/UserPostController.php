<?php

namespace dianaahorvat\posts\Http\Controllers;

use App\Http\Controllers\Controller;
use dianaahorvat\posts\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user){
        $posts = $user->posts()->with(['user', 'likes'])->paginate(20);

        return view('posts::users.posts.index',[
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
