<?php

namespace dianaahorvat\posts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected  $fillable = [
        'body', 'user_id'
    ];

    public function likedBy(User $user){
        return $this->likes->contains('user_id',$user->id);
    }

    public function user(){
        return $this->belongsTo((User::class));  //a post belongs to a user
    }

    public function likes(){
        return $this->hasMany(Like::class);  //a post has many likes
    }
}
