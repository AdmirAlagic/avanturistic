<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id',
        'post_id',
        'blog_id',
        'seen',
        'post_user_id',
        'name',
        'email',
        'website',
        'approved'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function blog(){
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function scopeApproved($query){
        return $query->where('approved', true);
    }
    public function scopeUnapproved($query){
        return $query->where('approved', false);
    }
}
