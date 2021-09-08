<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'blog_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function blog(){
        return $this->belongsTo(Post::class, 'blog_id');
    }
}
