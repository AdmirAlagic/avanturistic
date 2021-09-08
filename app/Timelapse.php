<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timelapse extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'type',
        'path',
        'thumb_path',
        'is_public',
        'filename'
    ];

    public static $_TYPE_POST = 1;
    public static $_TYPE_CUSTOM = 2;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function scopePublic($query){
        return $query->where('is_public', true);
    }

    public function scopeCustom($query){
        return $query->where('type', self::$_TYPE_CUSTOM);
    }

    public function likes(){
        return $this->hasMany(TimelapseLike::class, 'timelapse_id');
    }
}
