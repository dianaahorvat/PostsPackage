<?php

namespace dianaahorvat\posts\Models;

use dianaahorvat\posts\Notifications\ResetPasswordNotifications;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class); //a user has many posts
    }

    public function likes(){
        return $this->hasMany(Like::class);   //how many posts the user has liked
    }

    public function receivedLikes(){
        return $this->hasManyThrough(Like::class, Post::class);  //many likes through many posts
        //how many likes this user received
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotifications($token));
    }
}
