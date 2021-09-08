<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
        'from_user_id',
        'type',
        'image_url',
        'seen',
        'url',
        'created_at'
        
    ];

    public static $_TYPE_LIKE = 1;
    public static $_TYPE_COMMENT = 2;
    public static $_TYPE_VISITED = 3;
    public static $_TYPE_GENERAL = 4;
    public static $_TYPE_TIMELAPSE_LIKE = 5;

    public static function getTypes(){
        return [
            self::$_TYPE_TIMELAPSE_LIKE => 'Like',
            self::$_TYPE_LIKE => 'Like',
            self::$_TYPE_COMMENT => 'Comment',
            self::$_TYPE_VISITED => 'I was here',
            self::$_TYPE_GENERAL => 'Notification',
            
        ];
    }

    public function getType(){
        return self::getTypes()[$this->type];
    }

    public static function getViews(){
        return [
            self::$_TYPE_LIKE => 'notifications.like',
            self::$_TYPE_COMMENT => 'notifications.comment',
            self::$_TYPE_VISITED => 'notifications.visited',
            self::$_TYPE_GENERAL => 'notifications.general',
            self::$_TYPE_TIMELAPSE_LIKE => 'notifications.timelapse_like',

        ];
    }

    public function getView(){
        return self::getViews()[$this->type];
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function fromUser(){
        return $this->belongsTo(User::class, 'from_user_id')->withTrashed();
    }
 
    public function scopeUnread($query){
        return $query->where('seen', false);
    }

    public function scopeLatest($query){
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeByAdmin($query){
        return $query->whereNull('from_user_id');
    }
}