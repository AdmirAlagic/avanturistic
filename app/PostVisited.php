<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVisited extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'post_user_id',
        'seen'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }
}
