<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'from_user_id',
        'to_user_id',
        'seen',
        'conversation_id'
    ];

    public function from(){
        return $this->belongsTo(User::class, 'from_user_id');
    }
    public function to(){
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function getBodyAttribute(){
        return Crypt::decryptString($this->attributes['body']);
    }
    public function setBodyAttribute($value){
        $this->attributes['body']  = Crypt::encryptString($value);
    }
}
