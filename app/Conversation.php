<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users',
        'from_user_id',
        'to_user_id',
        'seen',
        'blocked_from_id',
        'updated_at'
    ];
    protected $casts = [
        'users' => 'array'
    ];

    public function messages(){
        return $this->hasMany(Message::class, 'conversation_id');
    }
    public function lastMessage(){
        return $this->hasOne(Message::class, 'conversation_id')->orderBy('created_at', 'desc');
    }

}
