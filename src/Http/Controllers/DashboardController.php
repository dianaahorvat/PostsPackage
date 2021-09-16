<?php

namespace dianaahorvat\posts\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();

        return view('posts::dashboard');
    }
}
