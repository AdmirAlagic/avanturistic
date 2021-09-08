<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'options',
        'icon',
        'icon_empty',
        'bg_image',
        'keywords',
        'color',
    ];
    protected $casts = [
        'options' => 'array',

    ];

//    public function posts(){
//        return $this->belongsToMany(Post::class, 'category_id', '');
//    }

}
