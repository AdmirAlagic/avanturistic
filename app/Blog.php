<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'blog';
    protected $fillable = [
        'title',
        'description',
        'body',
        'slug',
        'image',
        'attachments',
        'likes',
        'user_id',
        'is_published',
        'published_at',
        'show_comments',
        'views'
    ];
    protected $dates = [
        'published_at',
    ];

    protected $casts = [
        'image' => 'array',
        'attachments' => 'array',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'blog_id');
    }
    public function likesModel(){
        return $this->hasMany(BlogLike::class, 'blog_id');
    }

    public function scopeLatest($query){
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublished($query){
        return $query->where('is_published', 1);
    }

}
