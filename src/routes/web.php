<?php

use dianaahorvat\posts\Http\Controllers\Auth\ForgotPasswordController;
use dianaahorvat\posts\Http\Controllers\Auth\RegisterController;
use dianaahorvat\posts\Http\Controllers\DashboardController;
use dianaahorvat\posts\Http\Controllers\HomeController;
use dianaahorvat\posts\Http\Controllers\LoginController;
use dianaahorvat\posts\Http\Controllers\LogoutController;
use dianaahorvat\posts\Http\Controllers\PostController;
use dianaahorvat\posts\Http\Controllers\PostLikeController;
use dianaahorvat\posts\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'dianaahorvat\posts\Http\Controllers',
    'middleware' => 'web'], function (){

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/', function () {
        return view('posts::home');
    })->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')
        ->middleware('auth');

    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
    Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy']);

    Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('user.posts');

// Password reset link request routes...
    Route::get('password/email', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email') ->middleware('guest');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);

// Password reset routes...
    Route::post('password/reset', [ForgotPasswordController::class, 'store'])->name('password.reset');
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.request');



//    Auth::routes();

});

