<?php

namespace dianaahorvat\posts\Http\Controllers;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function store(){
        auth()->logout();

        return redirect()->route('home');
    }
}
